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

        if ($tshirt->width() > $tshirt->height()) {
            $image->resize(null, $tshirt->height() / 3, function ($constraint) {
                $constraint->aspectRatio();
            });
        } else {
            $image->resize($tshirt->width() / 3, null, function ($constraint) {
                $constraint->aspectRatio();
            });
        }

        $tshirt->insert($image, 'center');

        //dd($tshirt);

        //$tshirt->save(storage_path() . '/app/public/combination.png');

        return $tshirt->response('png');
    }
}
