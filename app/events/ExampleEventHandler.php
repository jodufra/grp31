<?php
class ExampleEventHandler {
 
    CONST EVENT = 'example.update';
    CONST CHANNEL = 'example.update';
 
    public function handle($data)
    {
        $redis = Redis::connection();
        $redis->publish(self::CHANNEL, $data);
    }
}