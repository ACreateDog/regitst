<?php
namespace Admin\Controller;
use Think\Controller;
class BaseController extends Controller {
    public function __construct(){
        parent::__construct();
        if(!is_login()){
            $this->redirect('Admin/Login/index');
        }

        if(!$this->allow_route()){
            //404页面
            $this->to404();
        }
        if(IS_GET){
            //加载 导航
            $nav = $this->get_nav();
            if($nav == null){
                //404页面
                $this->to404();
            }
            $this->assign("nav", $nav);
        }

        //加载 setting表中的配置
        $this->config = $this->get_config();
    }

    /**
     * 空操作
     * @param $name
     */
    public function _empty($name){
        $this->to404($name);
    }

    /**
     * 404页
     */
    public function to404(){
        if(IS_AJAX){
            $this->error('','',true,array('code' => 0x0001,'msg' => '没有找到'));
        }else{
            $this->redirect('Admin/Empty/index');
        }

    }

    /**
     * 是否越权
     * @return bool
     */
    public function allow_route(){
        $rank = session('rank');
        $arr = $this->route[ACTION_NAME];

        if(empty($arr)){
            return true;
        }
        if($arr == 'all'){
            return true;
        }

        if( !empty($arr['deny']) &&  in_array( $rank , $arr['deny'])){
            return false;
        }
        if( !empty($arr['allow']) &&  !in_array( $rank , $arr['allow'])){
            return false;
        }
        return true;
    }

    /**
     * json的统一返回形式
     * @param $data   code 错误码   msg 信息  data 数据
     */
    public function json_response($data){
        $this->ajaxReturn(array(
            'code' => empty($data['code']) ? 0 : $data['code'],
            'msg' => empty($data['msg']) ? "" : $data['msg'],
            'data' => empty($data['data']) ? "" : $data['data'],
        ));
    }

    /**
     * 根据用户角色返回导航
     * @return array
     */
    private function get_nav(){
        $rank = session('rank');
        if($rank == 1){
            $nav = [
                ['name'=>'首页','url'=>U('Index/index'), 'ico'=>'glyphicon glyphicon-home'],
                ['name'=>'信息填报','url'=>U('Register/add_student_info'), 'ico'=>'glyphicon glyphicon-edit'],
                ['name'=>'我填报的','url'=>U('Register/student_info'), 'ico'=>'glyphicon glyphicon-question-sign'],
                ['name'=>'我管辖的','url'=>U('Register/look_student_info'), 'ico'=>'glyphicon glyphicon-star'],
                ['name'=>'分配学校','url'=>U('Register/assign_junior'), 'ico'=>'glyphicon glyphicon-refresh'],
                ['name'=>'机构信息','url'=>U('Org/orginfo'), 'ico'=>'glyphicon glyphicon-fire'],
                ['name'=>'摇号信息','url'=>U('Enter/lot_orginfo'), 'ico'=>'glyphicon glyphicon-info-sign'],
                ['name'=>'账号管理','ico'=>'glyphicon glyphicon-user', 'children' => [
                    ['name'=>'市教育局','url'=>U('Org/account?type=1')],
                    ['name'=>'区教育局','url'=>U('Org/account?type=2')],
                    ['name'=>'中学','url'=>U('Org/account?type=3')],
                    ['name'=>'小学','url'=>U('Org/account?type=4')],
                    ['name'=>'班主任','url'=>U('Org/account?type=5')],
                ]],
                ['name'=>'系统设置','url'=>U('Setting/index'), 'ico'=>'glyphicon glyphicon-cog'],
                ['name'=>'完善信息','url'=>U('Org/perfectInfo'), 'ico'=>'glyphicon glyphicon-bookmark'],
            ];
        }elseif($rank == 2){
            $nav = [
                ['name'=>'首页','url'=>U('Index/index'), 'ico'=>'glyphicon glyphicon-home'],
                ['name'=>'信息填报','url'=>U('Register/add_student_info'), 'ico'=>'glyphicon glyphicon-edit'],
                ['name'=>'我填报的','url'=>U('Register/student_info'), 'ico'=>'glyphicon glyphicon-question-sign'],
                ['name'=>'我管辖的','url'=>U('Register/look_student_info'), 'ico'=>'glyphicon glyphicon-star'],
                ['name'=>'完善信息','url'=>U('Org/perfectInfo'), 'ico'=>'glyphicon glyphicon-bookmark'],
                ['name'=>'机构信息','url'=>U('Org/orginfo'), 'ico'=>'glyphicon glyphicon-fire'],
            ];
        }elseif($rank == 3){
            $nav = [
                ['name'=>'首页','url'=>U('Enter/pubindex'), 'ico'=>'glyphicon glyphicon-home'],
                ['name'=>'尚未审批','url'=>U('Enter/pubfail'), 'ico'=>'glyphicon glyphicon-check'],
                ['name'=>'已录学生','url'=>U('Enter/pubadopt'), 'ico'=>'glyphicon glyphicon-thumbs-up'],
                ['name'=>'未录学生','url'=>U('Enter/pubannals'), 'ico'=>'glyphicon glyphicon-time'],
                ['name'=>'报名信息','url'=>U('Enter/pubreginfo'), 'ico'=>'glyphicon glyphicon-question-sign'],
                ['name'=>'完善信息','url'=>U('Org/perfectInfo'), 'ico'=>'glyphicon glyphicon-bookmark'],
                ['name'=>'机构信息','url'=>U('Org/orginfo'), 'ico'=>'glyphicon glyphicon-fire'],
            ];
        }elseif($rank == 4){
            $nav = [
                ['name'=>'首页','url'=>U('Enter/civilindex'), 'ico'=>'glyphicon glyphicon-home'],
                ['name'=>'尚未审批','url'=>U('Enter/civilfail'), 'ico'=>'glyphicon glyphicon-check'],
                ['name'=>'已录学生','url'=>U('Enter/civiladopt'), 'ico'=>'glyphicon glyphicon-thumbs-up'],
                ['name'=>'未录学生','url'=>U('Enter/civilannals'), 'ico'=>'glyphicon glyphicon-time'],
                ['name'=>'报名信息','url'=>U('Enter/civilreginfo'), 'ico'=>'glyphicon glyphicon-question-sign'],
                ['name'=>'完善信息','url'=>U('Org/perfectInfo'), 'ico'=>'glyphicon glyphicon-bookmark'],
                ['name'=>'机构信息','url'=>U('Org/orginfo'), 'ico'=>'glyphicon glyphicon-fire'],
            ];
        }elseif($rank == 5){
            $nav = [
                ['name'=>'首页','url'=>U('Index/index'), 'ico'=>'glyphicon glyphicon-home'],
                ['name'=>'完善信息','url'=>U('Org/perfectInfo'), 'ico'=>'glyphicon glyphicon-bookmark'],
                ['name'=>'班级管理','url'=>U('Org/primaryClass'), 'ico'=>'glyphicon glyphicon-book'],
                ['name'=>'我管辖的','url'=>U('Register/look_student_info'), 'ico'=>'glyphicon glyphicon-info-sign'],
                ['name'=>'机构信息','url'=>U('Org/orginfo'), 'ico'=>'glyphicon glyphicon-fire'],
            ];
        }elseif($rank == 6){
            $nav = [
                ['name'=>'首页','url'=>U('Index/index'), 'ico'=>'glyphicon glyphicon-home'],
                ['name'=>'信息填报','url'=>U('Register/add_student_info'), 'ico'=>'glyphicon glyphicon-edit'],
                ['name'=>'我填报的','url'=>U('Register/student_info'), 'ico'=>'glyphicon glyphicon-question-sign'],
            ];
        }
        return $nav;
    }

    /**
     * 得到 setting表中的配置
     */
    public function get_config(){
        $config = M('Setting')->find();
        return $config;
    }
}