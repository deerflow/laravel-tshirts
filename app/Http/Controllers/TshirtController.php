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
            UploadFile::upload($request->input('tshirt-name'), $tshirtFile, new Tshirt());
        }

        return redirect()->route('backoffice.index');
    }

    public function remove(int $id): RedirectResponse
    {
        $tshirt = Tshirt::findOrFail($id);
        UploadFile::remove($tshirt);
        return redirect()->route('backoffice.index');
    }
}
