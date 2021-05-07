<?php

namespace App\Http\Controllers;

use App\Models\Historic;
use App\Models\Image;
use App\Models\Tshirt;
use Illuminate\Http\Request;

class HistoricController extends Controller
{
    public function index()
    {
        $tshirts = Tshirt::all();
        $images = Image::all();
        return view('index', ['tshirts' => $tshirts, 'images' => $images]);
    }

    public function new(Request $request)
    {
        $tshirtId = $request->input('tshirt');
        $imageId = $request->input('image');

        $tshirtModel = Tshirt::findOrFail($tshirtId);
        $imageModel = Image::findOrFail($imageId);

        $historic = new Historic();
        $historic->save();

        $entry = EntryController::new($historic->id, $tshirtModel->absolute_path, $imageModel->absolute_path, 0, 0, 1);

        return view('historic.adjust', ['entry' => $entry]);
    }
}
