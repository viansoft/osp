<?php

namespace osp\src\components;

class JsonHelper
{
    static public function outputSuccess($message=null, $options=[])
    {
        return json_encode(self::success($message, $options));
    }
    
    static public function success($message=null, $options=[])
    {
        return self::result('success', $message, $options);
    }

    static public function error($message=null, $options=[])
    {
        return self::result('error', $message, $options);
    }

    static public function result($result, $message=null, $options=[])
    {
        $res = ['result' => $result];
        
        if ($message)
            $res['message'] = is_array($message) ? implode(PHP_EOL,$message) : $message;
        
        foreach($options as $key => $option){
            $res[$key] = $option;
        }
        
        return $res;
    }
}