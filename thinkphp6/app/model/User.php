<?php
/**
 * Created by zzy
 * Date: 2021/9/5
 * Time: 21:43
 */

namespace app\model;
use think\Model;

class User extends Model {
    public function getTotal(){
        $total = $this->count();
        return $total;
    }
    public function getUserData($page = 0){
        $limit = 5;
        $total = $page * $limit;
        $data = $this->limit($total, $limit)->select();
        return $data;
    }

    public function insUserData($data){
        $res = $this->save($data);
        return $res;
    }

    public function delUserData($id){
        $res = $this->where('id', $id)->delete();
        return $res;
    }

    public function updateUserData($data){
        $res = $this::update($data);
        return $res;
    }
}