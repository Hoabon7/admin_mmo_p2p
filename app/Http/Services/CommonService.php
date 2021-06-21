<?php

namespace App\Http\Services;


class CommonService {
    
    public function splitImage($image){
        $arrayDataImage = explode("__", $image);
        array_pop($arrayDataImage);
        return $arrayDataImage;

    }

    public function randomPassword(){
        $characters = '123456789ABCDEFGHIJKLMNPQRSTVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 8; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $pin=$randomString;
        return $pin;
    }
}