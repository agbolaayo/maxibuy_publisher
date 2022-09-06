<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class SubscriberController extends Controller
{
    public function subscribe_post(Request $request, $topic){
        $request->validate([
            'url'=>'required|url',
        ]);


        if(!is_numeric($topic) && is_string($topic) && (strlen(trim($topic)) > 0)){
            //subscribed
            redis::publish('_i_s_s_b_',$topic);
            
            return response()->json([
                'url' => $request->url,
                'topic' => $topic
            ],200);
        }
        else {
            return response()->json([
                'status' => 0,
                'data' => 'Topic must be string',
            ],400);
        }
        
    }

    public function subscribe(Request $request,$topic){
        //subscription is now successful you will start reciveing broadcast 
        $data['topic'] = $topic;
        return view('subscribe',$data);
    }
}
