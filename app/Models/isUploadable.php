<?php


namespace App\Models;


interface isUploadable
{
    public function getUploadPath();

    public function save();

    public function delete();
}
