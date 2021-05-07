<?php

namespace App\Http\Controllers;

use App\Models\Historic;
use App\Models\Image;
use App\Models\Tshirt;
use App\Services\UploadFile;
use Error;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;

class HistoricController extends Controller
{
    const OFFSET = 20;
    const ZOOM_FACTOR = 0.25;

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

        if ($imageId === 'user-image') {
            $imageId = UploadFile::upload(null, $request->file('user-image'), Image::class);
        }

        $historic = new Historic();
        $historic->save();

        $entry = EntryController::newAndCalculateOffset($historic->id, $tshirtId, $imageId);

        return view('historic.adjust', [
            'entry' => $entry,
            'historicId' => $historic->id,
        ]);
    }

    public function adjust(Request $request)
    {
        $historic = Historic::findOrFail($request->input('historic_id'));
        $lastEntry = $historic->lastEntry();
        $adjust = $request->input('adjust');

        $offsetX = $lastEntry->offset_x;
        $offsetY = $lastEntry->offset_y;
        $zoom = $lastEntry->zoom;

        switch ($adjust) {
            case 'up':
                $offsetY -= self::OFFSET;
                break;
            case 'right':
                $offsetX += self::OFFSET;
                break;
            case 'down':
                $offsetY += self::OFFSET;
                break;
            case 'left':
                $offsetX -= self::OFFSET;
                break;
            case 'zoom-in':
                $zoom += self::ZOOM_FACTOR;
                break;
            case 'zoom-out':
                $zoom -= self::ZOOM_FACTOR;
                break;
            default:
                throw new Error('No adjustment provided');
        }

        $newEntry = EntryController::new($historic->id, $lastEntry->tshirt_id, $lastEntry->image_id, $offsetX, $offsetY, $zoom);

        return view('historic.adjust', [
            'entry' => $newEntry,
            'historicId' => $historic->id,
        ]);
    }

    public function generatePDF(Request $request): Response
    {
        $entries = Historic::findOrFail($request->input('historic_id'))->entries;
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('historic.pdf', ['entries' => $entries]);
        return $pdf->download('Historic.pdf');
    }
}
