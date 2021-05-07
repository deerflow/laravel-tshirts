<?php


namespace App\Services;


use App\Models\Image;
use App\Models\Tshirt;
use Error;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UploadFile
{
    public static function upload(?string $name, UploadedFile $file, string $model)
    {
        $instance = null;
        $storagePath = '';

        if ($model == Tshirt::class) {
            $instance = new Tshirt();
            $storagePath = 'public/tshirts';
        } else if ($model == Image::class) {
            $instance = new Image();
            $storagePath = 'public/images';
        } else throw new Error('Invalid model');

        $path = $file->store($storagePath);
        $url = str_replace('public', '/storage', $path);

        $instance->name = $name;
        $instance->relative_path = $path;
        $instance->absolute_path = storage_path() . '/app/' . $path;
        $instance->url = $url;
        $instance->save();
    }

    public static function remove(int $id, string $model)
    {
        $instance = null;
        if ($model == Tshirt::class) {
            $instance = Tshirt::findOrFail($id);
        } else if ($model == Image::class) {
            $instance = Image::findOrFail($id);
        } else throw new Error('Invalid model');

        Storage::delete($instance->path);
        $instance->delete();
    }
}
