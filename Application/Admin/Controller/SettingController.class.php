<?php
/**
 * Created by PhpStorm.
 * User: ling
 * Date: 2016/4/28
 * Time: 16:14
 */

namespace Admin\Controller;


class SettingController extends BaseController
{
    public function index(){
        $result = M('setting')->field('id,register_end_time,civil_permit_end_time,pub_permit_end_time')->find();
        if(empty($result)){
            //404
        }
        $this->assign('info_time',$result['register_end_time'] ? date('Y-m-d',  $result['register_end_time']) : '');
        $this->assign('civil_time', $result['civil_permit_end_time']?date('Y-m-d', $result['civil_permit_end_time']):'');
        $this->assign('pub_time', $result['pub_permit_end_time']?date('Y-m-d',  $result['pub_permit_end_time']):'');
        $this->assign('title', '系统设置');
        $this->assign('route', '系统设置');
        $this->display();
    }

    private $error_arr = [
        'unknown' => ['code' => 0xF001, 'msg'=> '未知错误'],
        'time_option_error' => ['code' => 0xF011, 'msg'=> '参数错误'],
        'info_time_error' => ['code' => 0xF011, 'msg'=> '录取时间']
    ];

    public $route = [
        'index' => ['allow' => [CITY_RANK]],
        'update_time' => ['allow' => [CITY_RANK]]
    ];

    public function update_time(){
        $type = trim(I('get.type'));
        $val = strtotime(trim(I('post.time')));
        if(empty($val) || empty($type)){
            $this->json_response($this->error_arr['time_option_error']);
        }
        $data = [];
        $m = M('setting');
        $result = $m->find();
        if(empty($result)){
            $result = $m->add(array('id' => 1));
            if(empty($result)){
                $this->json_response($this->error_arr['unknown']);
            }
        }
        switch($type){
            case 'info' :
                if($val + 3600 *24  <= time()){
                    $this->json_response($this->error_arr['info_time_error']);
                }
                $data['register_end_time'] = $val;
                break;
            case 'pub' :
                if($val <= $result['register_end_time']){
                    $this->json_response($this->error_arr['pub_time_error']);
                }
                $data['pub_permit_end_time'] = $val;
                break;
            case 'civil' :
                if($val <= $result['pub_permit_end_time']){
                    $this->json_response($this->error_arr['civil_time_error']);
                }
                $data['civil_permit_end_time'] = $val;
                break;
            default : $this->json_response($this->error_arr['time_option_error']);
        }

        $result = $m->where(array('id' => array('gt' , 0)))->save($data);
        if($result === false){
            $this->json_response($this->error_arr['unknown']);
        }else{
            $this->json_response();
        }
        //var_dump($data);
    }
}