<?php
namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait FileImage {
    /**
     * This method will do upload image and get url
     * @param Request $request
     * @param string $folder name of folder example 'myFolder'
     * @param string $nameImage name of image example 'myImage'
     * @return string url of image
     */
    public static function uploadImageAndGetUrl(Request $request, string $folder, string $nameImage): string
    {
        $file = $request->file($nameImage);
        $token = sha1(time());
        $nameFile = $file->getClientOriginalName();
        $nameReplace = Str::replaceArray($nameFile, [$token], $nameFile);
        Storage::disk('public')->put($folder . '/' . $nameReplace . '.' . $file->extension(), File::get($file));
        return config('app.url') . '/storage'.'/'.$folder.'/' . $nameReplace . '.' . $file->extension();
    }

    /**
     * This method will delete the image from the path
     * @param string $path A path
     * @param string $folder Name of folder
     */
    public static function deleteImage(string $path, string $folder)
    {
        $file = basename($path);
        Storage::disk('public')->delete($folder.'/'.$file);
    }
}
