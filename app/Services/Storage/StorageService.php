<?php
namespace App\Services\Storage;

use Illuminate\Support\Facades\Storage;

class StorageService
{
    public function get($path)
    {
        return Storage::get($path);
    }

    public function store($path, $file, $name = '')
    {
        if ($name) {
            $path = Storage::putFileAs($path ?? '', $file, $name);
        }

        $path = Storage::put($path ?? '', $file);

        return $path;
    }

    public static function getUrl($path)
    {
        return asset('uploads/' . $path);
    }

    public function getFileAsResponse($path)
    {
        return Storage::response($path);
    }

    public function delete($path)
    {
        if (Storage::exists($path)) {
            Storage::delete($path);
        }

        return true;
    }
}
