<?php

namespace App\Http\Controllers;

use App\Jobs\GenerateImageJob;
use App\Models\Entry;
use App\Models\Image;
use App\Models\Tshirt;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use InterventionImage;
use Validator;

class EntryController extends Controller
{
    const MINIMIZE_IMAGE_FACTOR = 3;

    public function all()
    {
        $entries = Entry::all()->sortByDesc('created_at');
        return view('entries.all', ['entries' => $entries]);
    }

    public static function newAndCalculateOffset(int $historicId, int $tshirtId, int $imageId): Entry
    {
        $tshirtModel = Tshirt::findOrFail($tshirtId);
        $tshirtImage = InterventionImage::make($tshirtModel->absolute_path);

        $offsetX = $tshirtImage->width() / 2 - $tshirtImage->width() / self::MINIMIZE_IMAGE_FACTOR / 2;
        $offsetY = $tshirtImage->height() / 2 - $tshirtImage->height() / self::MINIMIZE_IMAGE_FACTOR / 2;

        return self::new($historicId, $tshirtId, $imageId, $offsetX, $offsetY, 1);
    }

    public static function new(int $historicId, int $tshirtId, int $imageId, int $offsetX, int $offsetY, float $zoom): Entry
    {
        $tshirtModel = Tshirt::findOrFail($tshirtId);
        $imageModel = Image::findOrFail($imageId);

        $tshirt = InterventionImage::make($tshirtModel->absolute_path);
        $image = InterventionImage::make($imageModel->absolute_path);

        $width = $tshirt->width() / self::MINIMIZE_IMAGE_FACTOR * $zoom;
        $height = $tshirt->height() / self::MINIMIZE_IMAGE_FACTOR * $zoom;

        if ($tshirt->width() > $tshirt->height()) {
            $width = null;
        } else {
            $height = null;
        }

        $image->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });

        $tshirt->insert($image, 'top-left', $offsetX, $offsetY);

        $fileName = Str::uuid() . '.png';
        $relativePath = 'public/entries/' . $fileName;
        $absolutePath = storage_path() . '/app/' . $relativePath;
        $url = str_replace('public', '/storage', $relativePath);

        $tshirt->save($absolutePath);

        $entry = new Entry();
        $entry->historic_id = $historicId;
        $entry->tshirt_id = $tshirtId;
        $entry->image_id = $imageId;
        $entry->absolute_path = $absolutePath;
        $entry->relative_path = $relativePath;
        $entry->url = $url;
        $entry->offset_x = $offsetX;
        $entry->offset_y = $offsetY;
        $entry->zoom = $zoom;
        $entry->save();

        return $entry;
    }

    public function newFromApi(Request $request): JsonResponse
    {
        $validator = Validator::make($request->json()->all(), [
            'tshirtId' => ['integer', 'min:1', 'required'],
            'imageId' => ['integer', 'min:1', 'required'],
            'email' => ['email', 'required'],
            'offsetX' => 'integer',
            'offsetY' => 'integer',
            'zoom' => 'numeric'
        ]);

        if ($validator->passes()) {
            dispatch(
                new GenerateImageJob(
                    $request->json('email'),
                    $request->json('tshirtId'),
                    $request->json('imageId'),
                    $request->json('offsetX'),
                    $request->json('offsetY'),
                    $request->json('zoom')
                ));
            return response()->json(['message' => 'Generating your image, an email will be sent to you when it\'s done'], 201);
        }
        return response()->json($validator->errors()->messages(), 401);
    }
}
