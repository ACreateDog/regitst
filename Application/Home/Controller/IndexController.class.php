<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends BaseController {

    public function _initialize() {
        parent::_initialize();
    }

    public function index(){
        $name = 'ThinkPHP';
        $this->assign('name',$name);
        $this->display();
    }
}