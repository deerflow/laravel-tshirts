<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Tshirt;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BackOfficeController extends Controller
{
    public function index()
    {
        $tshirts = Tshirt::all();
        $images = Image::all();
        return view('backoffice.index', ['tshirts' => $tshirts, 'images' => $images]);
    }

    public function upload(Request $request, TshirtController $tshirtController, ImageController $imageController): RedirectResponse
    {
        $tshirt = $request->file('tshirt-file');
        $image = $request->file('image-file');

        if ($tshirt) {
            $tshirtName = $request->input('tshirt-name');
            $tshirtController->new($tshirtName, $tshirt);
        }

        if ($image) {
            $imageName = $request->input('image-name');
            $imageController->new($imageName, $image);
        }

        return redirect()->route('backoffice.index');
    }
}
