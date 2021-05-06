<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Tshirt;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use InterventionImage;

class CombinationController extends Controller
{
    public function index()
    {
        $tshirts = Tshirt::all();
        $images = Image::all();
        return view('index', ['tshirts' => $tshirts, 'images' => $images]);
    }

    public function generate(Request $request): RedirectResponse
    {
        $tshirtId = $request->input('tshirt');
        $imageId = $request->input('image');

        $tshirt = Tshirt::findOrFail($tshirtId);
        $image = Image::findOrFail($imageId);

        $combination = InterventionImage::make(storage_path() . '/app/' . $tshirt->path);
        $combination->insert(storage_path() . '/app/' . $image->path);
        $combination->save(storage_path() . '/app/public/combination.png');

        return redirect()->route('index');
    }
}
