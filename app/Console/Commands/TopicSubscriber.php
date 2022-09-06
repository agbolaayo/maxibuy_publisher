<?php

namespace App\Console\Commands;
use Illuminate\Support\Facades\Redis;
use Illuminate\Console\Command;
use App\Events\SendMessage;

class TopicSubscriber extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'topic:subscribe';
    protected $subscriber = [];

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    { 
        file_put_contents(__DIR__.'/../../../resources/sub.txt',serialize([]));
        //create a new array resource when the subscriber is added
        // return 0;
        Redis::psubscribe("*", function($msg,$channel){
            if($channel == '_i_s_s_b_'){
                //you are subscribing to new channel
                $this->subscriber[] = $msg;
                file_put_contents(__DIR__.'/../../../resources/sub.txt',serialize($this->subscriber));
            }
            elseif(in_array($channel,$this->subscriber) ){
                echo "$channel > $msg \n";
            }
            /*uncomment below to receive message on the web client    */
            // SendMessage::dispatch($msg,$channel);
        });
    }
}
