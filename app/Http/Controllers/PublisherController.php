<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redis;

use Illuminate\Http\Request;

class PublisherController extends Controller
{
    public function publish(Request $request, $topic){
        if(!is_numeric($topic) && is_string($topic) && (strlen(trim($topic)) > 0)){
            //check if it is published 
            $subscribers = unserialize(file_get_contents(__DIR__.'/../../../resources/sub.txt'));
            if(!in_array($topic,$subscribers)){
                return response()->json([
                    'status' => 0,
                    'message' => 'No subscribers found for the topic',
                ],404);
            }
            else {
                $content = json_encode($request->all(),JSON_FORCE_OBJECT );
                redis::publish($topic,$content);
                return response()->json([
                    'topic' => $topic,
                    'data' => $request->all(),
                ],200);
            }
            
        }
        else {
            return response()->json([
                'status' => 0,
                'data' => 'Sorry, Topic must be string',
            ],403);
        }
    }   
}