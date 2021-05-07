<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use App\Models\Image;
use App\Models\Tshirt;
use Illuminate\Support\Str;
use InterventionImage;

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
}
