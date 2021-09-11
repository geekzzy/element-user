<?php
/**
 * Created by zzy
 * Date: 2021/9/8
 * Time: 9:35
 */

namespace app\lib;
class Show{
    public static function api($msg, $status = true){
        $result = [
            'status'    => $status,
            'message'  => $msg,
        ];
        return json($result);
    }
}