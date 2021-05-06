<?php

namespace App\Http\Controllers;

use App\Models\Tshirt;
use Illuminate\Http\UploadedFile;

class TshirtController extends Controller
{
    public function new(?string $name, UploadedFile $file)
    {
        $path = $file->store('public/tshirt');
        $url = str_replace('public', '/storage', $path);

        $tshirt = new Tshirt();
        $tshirt->name = $name || '';
        $tshirt->url = $url;
        $tshirt->save();
    }
}
