<?php


namespace App\Services;


use App\Models\isUploadable;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UploadFile
{
    public static function upload(?string $name, UploadedFile $file, isUploadable $instance)
    {
        $path = $file->store($instance->getUploadPath());
        $url = str_replace('public', '/storage', $path);

        $instance->name = $name;
        $instance->relative_path = $path;
        $instance->absolute_path = storage_path() . '/app/' . $path;
        $instance->url = $url;
        $instance->save();

        return $instance->id;
    }

    public static function remove(isUploadable $instance)
    {
        Storage::delete($instance->path);
        $instance->delete();
    }
}
