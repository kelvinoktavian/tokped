<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // Kalo user upload image: https://www.itsolutionstuff.com/post/how-to-check-uploaded-file-is-empty-or-not-in-laravel-53example.html
    public function storeImage(Request $request, string $path, int $width, int $height)
    {
        // Get filename with the extension
        $fileNameWithExt = $request
            ->file('image_path')
            ->getClientOriginalName();

        // Get just filename
        $fileName = pathInfo($fileNameWithExt, PATHINFO_FILENAME);

        // Get just ext
        $extension = $request
            ->file('image_path')
            ->getClientOriginalExtension();

        // Filename to store
        $fileNameToStore = $fileName . '_' . time() . '.' . $extension;

        // Upload image
        $imagePath = $request
            ->image_path
            ->move(public_path('images/' . $path), $fileNameToStore);

        // Resize image
        Image::make($imagePath)
            ->fit($width, $height)
            ->save();

        return $fileNameToStore;
    }
}
