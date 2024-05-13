<?php

namespace App\Http\traits;

trait apitrait
{
    public function apiresponse($data,$token,$message,$status){
        $array = [
            'data'          => $data,
            'message'       => $message,
            'access_token'  => $token,
            'token_type'    => 'Bearer',
        ];
        return response()->json($array,$status);
    }
    public function apicostum($token,$status){
        $array = [
            
            'access_token'  => $token,
            'token_type'    => 'Bearer',
        ];
        return response()->json($array,$status);
    }
    public function apiStore($data,$message,$status){
        $array = [
            'data' => $data,
            'message' => $message,

        ];
        return response()->json($array,$status);
    }
    public function apiUpdate($data,$message,$status){
        $array = [
            'data' => $data,
            'message' => $message,

        ];
        return response()->json($array,$status);
    }
    public function apiDelete($data,$message,$status){
        $array = [
            'data' => $data,
            'message' => $message,

        ];
        return response()->json($array,$status);
    }
    
}
