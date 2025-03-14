<?php
namespace App\Services\Storage;

use Illuminate\Support\Facades\Storage;

class StorageService
{
    const DISK = "public";

    public function get($path)
    {
        return Storage::disk(self::DISK)->get($path);
    }

    public function store($path, $file, $name = '')
    {
        if ($name) {
            $path = Storage::disk(self::DISK)->putFileAs($path ?? '', $file, $name);
        }

        $path = Storage::disk(self::DISK)->put($path ?? '', $file);

        return $path;
    }

    public function getUrl($path)
    {
        return asset('uploads/' . $path);
    }

    public function exists($path)
    {
        return Storage::disk(self::DISK)->exists($path);
    }

    public function getFileAsResponse($path)
    {
        return Storage::disk(self::DISK)->response($path);
    }

    public function delete($path)
    {
        if (Storage::disk(self::DISK)->exists($path)) {
            Storage::disk(self::DISK)->delete($path);
        }

        return true;
    }
}
