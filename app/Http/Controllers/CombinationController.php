<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Tshirt;
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

    public function result(Request $request)
    {
        $tshirtId = $request->input('tshirt');
        $imageId = $request->input('image');

        $tshirtModel = Tshirt::findOrFail($tshirtId);
        $imageModel = Image::findOrFail($imageId);

        $tshirt = InterventionImage::make($tshirtModel->absolute_path);
        $image = InterventionImage::make($imageModel->absolute_path);

        $width = $tshirt->width() / 3;
        $height = $tshirt->height() / 3;

        if ($tshirt->width() > $tshirt->height()) {
            $width = null;
        } else {
            $height = null;
        }

        $image->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });

        $tshirt->insert($image, 'center');

        return $tshirt->response('png');
    }
}
