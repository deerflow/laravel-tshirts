<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\UploadedFile;

class ImageController extends Controller
{
    public function new(?string $name, UploadedFile $file)
    {
        $path = $file->store('public/images');
        $url = str_replace('public', '/storage', $path);

        $image = new Image();
        $image->name = $name || '';
        $image->url = $url;
        $image->save();
    }
}
