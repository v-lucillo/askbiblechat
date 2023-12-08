<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewController extends Controller
{
    //
    public function bot(){
        // $string = '{"id":"chatcmpl-8TLkfnBFowoL1kjZv';
        // if($this->isJson($string)){
        //     return $string;
        // }else{
        //     return '{"e": "invalid json"}';
        // }
        return view('bot');
    }

    // private function isJson($string) {
    //     json_decode($string);
    //     return json_last_error() === JSON_ERROR_NONE;
    // }


}
