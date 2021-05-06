<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function new(Request $request): RedirectResponse
    {
        $imageFile = $request->file('image-file');

        if ($imageFile) {
            $path = $imageFile->store('public/images');
            $url = str_replace('public', '/storage', $path);

            $image = new Image();
            $image->name = $request->input('image-name');
            $image->path = $path;
            $image->url = $url;
            $image->save();
        }

        return redirect()->route('backoffice.index');
    }

    public function remove(int $id): RedirectResponse
    {
        $image = Image::findOrFail($id);
        Storage::delete($image->path);
        $image->delete();
        return redirect()->route('backoffice.index');
    }
}
