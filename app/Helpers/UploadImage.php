<?php

namespace App\Helpers;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;
use Illuminate\Http\Request;

class UploadImage {

    public function upload($requestImage, $type){

        // $requestImage = $request->image;

        $extensio = $requestImage->extension();

        $imageName = md5($requestImage->getClientOriginalName() . strtotime('now') . $extensio);

        $requestImage->move(public_path('img/'.$type), $imageName);

        $imagePath = 'img/'.$type.'/'.$imageName;

        return $imagePath;
    }

}