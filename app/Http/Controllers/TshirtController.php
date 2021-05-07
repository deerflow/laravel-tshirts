<?php

namespace App\Http\Controllers;

use App\Models\Tshirt;
use App\Services\UploadFile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TshirtController extends Controller
{
    public function new(Request $request): RedirectResponse
    {
        $tshirtFile = $request->file('tshirt-file');

        if ($tshirtFile) {
            UploadFile::upload($request->input('tshirt-name'), $tshirtFile, Tshirt::class);
        }

        return redirect()->route('backoffice.index');
    }

    public function remove(int $id): RedirectResponse
    {
        UploadFile::remove($id, Tshirt::class);
        return redirect()->route('backoffice.index');
    }
}
