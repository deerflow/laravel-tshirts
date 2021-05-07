<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use Illuminate\Support\Str;
use InterventionImage;

class EntryController extends Controller
{
    public function all()
    {
        $entries = Entry::all()->sortByDesc('created_at');
        return view('entries.all', ['entries' => $entries]);
    }

    public static function new(int $historicId, string $tshirtPath, string $imagePath, int $offsetX, int $offsetY, float $zoom): Entry
    {
        $tshirt = InterventionImage::make($tshirtPath);
        $image = InterventionImage::make($imagePath);

        $width = $tshirt->width() / 3 * $zoom;
        $height = $tshirt->height() / 3 * $zoom;

        if ($tshirt->width() > $tshirt->height()) {
            $width = null;
        } else {
            $height = null;
        }

        $image->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });

        $tshirt->insert($image, 'center', $offsetX, $offsetY);

        $fileName = Str::uuid() . '.png';
        $relativePath = 'public/entries' . $fileName;
        $absolutePath = storage_path() . '/app/' . $relativePath;
        $url = str_replace('public', '/storage', $relativePath);

        $tshirt->save($absolutePath);

        $entry = new Entry();
        $entry->historic_id = $historicId;
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
