<?php

namespace App\Http\Helpers;

use Cloudinary\Cloudinary;
use Illuminate\Support\Str;

class UploadHelper
{

    public static function uploadFile($file)
    {
        $cloudinary = new Cloudinary(
            [
                'cloud' => [
                    'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
                    'api_key'    => env('CLOUDINARY_API_KEY'),
                    'api_secret' => env('CLOUDINARY_API_SECRET'),
                ],
            ]
        );
        $file_path = $file->getRealPath();
        $response =  $cloudinary->uploadApi()->upload($file_path, ['public_id' => 'authentication/' . Str::random(50)]);
        return $response['secure_url'];
    }
}
