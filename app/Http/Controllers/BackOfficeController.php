<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Tshirt;

class BackOfficeController extends Controller
{
    public function index()
    {
        $tshirts = Tshirt::all();
        $images = Image::all();
        return view('backoffice.index', ['tshirts' => $tshirts, 'images' => $images]);
    }
}
