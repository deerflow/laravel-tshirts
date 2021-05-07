<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Services\UploadFile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function new(Request $request): RedirectResponse
    {
        $imageFile = $request->file('image-file');

        if ($imageFile) {
            UploadFile::upload($request->input('tshirt-name'), $imageFile, Image::class);
        }

        return redirect()->route('backoffice.index');
    }

    public function remove(int $id): RedirectResponse
    {
        UploadFile::remove($id, Image::class);
        return redirect()->route('backoffice.index');
    }
}
