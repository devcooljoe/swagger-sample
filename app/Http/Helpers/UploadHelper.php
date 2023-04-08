<?php

namespace App\Http\Helpers;

use Cloudinary\Cloudinary;

class UploadHelper {

    public function uploadFile($file)
    {
        $cloudinary = new Cloudinary(
            [
                'cloud' => [
                    'cloud_name' => 'dpbs9zhkf',
                    'api_key'    => '282554975916687',
                    'api_secret' => 'Q5cFdlBfrYyyvb-Jj-zBXiZZUos',
                ],
            ]
        );
      $file_path = $file->getRealPath();
      $response =  $cloudinary->uploadApi()->upload($file_path, ['public_id' => 'authentication']);
      return $response;
    }
}
