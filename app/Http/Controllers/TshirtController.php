<?php

namespace App\Http\Controllers;

use App\Models\Tshirt;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Storage;

class TshirtController extends Controller
{
    public function new(Request $request): RedirectResponse
    {
        $tshirtFile = $request->file('tshirt-file');

        if ($tshirtFile) {
            $path = $tshirtFile->store('public/tshirts');
            $url = str_replace('public', '/storage', $path);

            $tshirt = new Tshirt();
            $tshirt->name = $request->input('tshirt-name');
            $tshirt->path = $path;
            $tshirt->url = $url;
            $tshirt->save();
        }

        return redirect()->route('backoffice.index');
    }

    public function remove(int $id): RedirectResponse
    {
        $tshirt = Tshirt::findOrFail($id);
        Storage::delete($tshirt->path);
        $tshirt->delete();
        return redirect()->route('backoffice.index');
    }
}
