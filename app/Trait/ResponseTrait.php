<?php
namespace App\Trait;
use Illuminate\Http\JsonResponse;

trait ResponseTrait{
/**
     * @param mixed 
     * @param string 
     * @return JsonResponse
     */

    public function Success($data, $message = 'success'):JsonResponse
    {
        return response()->json([
            'data'=>$data,
            'status'=>200,
            'message'=>$message,
           ]);
    }
    public function Error( $message = 'invalid'):JsonResponse
    {
        return response()->json([
            'data'=>null,
            'status'=>0,
            'message'=>$message,
           ]);
    }
}