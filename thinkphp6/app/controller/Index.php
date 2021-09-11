<?php
namespace app\controller;

use app\BaseController;
use app\lib\Show;
use app\model\User;
use think\App;
use think\Exception;


class Index extends BaseController{
    public function __construct(){
        header('Access-Control-Allow-Origin: *');
    }
    public function index(){
        return redirect(url('index/getuser'));
    }
    public function getTotal(){
        return (new User)->getTotal();
    }

    public function getUser(){
        $page = input('param.page');
        try{
            $data = (new User())->getUserData($page);
        }catch(Exception $e){
            return json([]);
        }
        return json($data);
    }
    public function saveUser(){
        $data = input('param.');
        try{
            if(empty($data['id'])){
                $data = (new User())->insUserData($data);
            }else{
                $data = (new User())->updateUserData($data);
            }
        }catch(Exception $e){
            return Show::api('系统错误：保存用户信息失败，请稍后重试', false);
        }
        return Show::api('保存用户信息成功', true);
    }

    public function delUser(){
        $id = input('param.id', 0, 'intval');
        try{
            $data = (new User())->delUserData($id);
        }catch(Exception $e){
            return Show::api('删除用户失败，请稍后重试', false);
        }
        return Show::api('删除用户成功', true);
    }
}
