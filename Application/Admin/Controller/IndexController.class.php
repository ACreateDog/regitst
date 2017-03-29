<?php
namespace Admin\Controller;

class IndexController extends BaseController {

    public $route = [
        'index' => 'all',
        'notify_info' => ['deny' => [CIVIL_JUNIOR_RANK,PUB_JUNIOR_RANK]],
        'notify_fail' => ['allow' => [CIVIL_JUNIOR_RANK,PUB_JUNIOR_RANK]]
    ];

    public function index(){

        $rank = session('rank');
        if($rank == 3){
            $this->redirect("Enter/pubindex");
        }elseif($rank == 4){
            $this->redirect("Enter/civilindex");
        }

        $db = D('Index');
        $org_name = $db->get_org_name();
        $overall = $db->get_overall_num();
        $district = $db->get_district_num();
        $enter_data = $db->get_enter_data();
        $enter_time = $db->get_enter_time();
        $this->assign('rank',$rank);
        $this->assign('org_name',$org_name);
        //统筹学区
        $this->assign('overall',$overall);
        $this->assign('district',$district);
        if(0 == $overall + $district){
            $this->assign('overall_proportion', 0 );
            $this->assign('district_proportion', 0);
        }else{
            $this->assign('overall_proportion', round($overall / ($overall + $district) * 100 , 1) );
            $this->assign('district_proportion', round($district / ($overall + $district) * 100 ,1));
        }

        //录取情况
        $this->assign('pub_num',$enter_data['pub']);
        $this->assign('civil_num',$enter_data['civil']);
        $this->assign('other_num',$enter_data['all'] - $enter_data['civil'] - $enter_data['pub']);
        $this->assign('all_num',$enter_data['all']);

        if(0 == $enter_data['all']){
            $this->assign('other_proportion',0);
            $this->assign('pub_proportion', 0);
            $this->assign('civil_proportion',0);
        }else{
            $this->assign('pub_proportion', round(($enter_data['pub'] / $enter_data['all']) * 100, 1));
            $this->assign('civil_proportion',round(($enter_data['civil'] / $enter_data['all']) * 100 ,1));
            $this->assign('other_proportion', round(((1 - (($enter_data['civil'] + $enter_data['pub']) / $enter_data['all'])) * 100),1));
        }
        $org_introduction = $db->get_org_introduction();
        $this->assign('org_introduction',$org_introduction);
        $this->assign('enter_time',date('Y-m-d',$enter_time));
        $this->assign('ex_time',ceil( (next_date($enter_time) - time())  / (3600 *24) ));
        $this->assign('title','首页');
        $this->assign('route','首页');

//       switch($rank){
//           case 1 :$this->city_index();break;
//
//           case 2 :$this->area_index();break;
//
//           case 3 :$this->pub_index();break;
//
//           case 4 :$this->civil_index();break;
//
//           case 5 :$this->primary_index();break;
//
//           case 6 :$this->teacher_index();break;
//       }
        $this->display();
    }

    private function city_index(){
        $this->display('city_index');
    }

    private function area_index(){
        $this->display('area_index');
    }

    private function civil_index(){
        $this->display('Enter/civilindex');
    }
    private function pub_index(){
        $this->display('Enter/pubindex');
    }

    private function primary_index(){
        $this->display('primary_index');
    }

    private function teacher_index(){
        $this->display('teacher_index');
    }

    /**
     * 首页提示信息 (有几人未提交)
     */
    public function notify_info(){
        $option = M('setting')->find();
        $ex_time = next_date($option['register_end_time']) - time();
        if($ex_time > 0 && $ex_time < 3600 * 24 * 3){
            $m = M('student');
            $remain = $m
                ->field('count(*) as count')
                ->where(array('status' => 0, 'oid' => session('oid')))
                ->select();
            if($remain[0]['count'] > 0){
                $this->json_response(array('data' => '还有'.ceil($ex_time / (3600 * 24)). '天报名截止<br>你还有' .$remain[0]['count']. '名学生没有提交'));
            }
        }
        $this->json_response();
    }

    /**
     * 初中首页提示信息 (有几人未处理)
     */
    public function notify_fail(){
        $option = M('setting')->find();
        if($option['register_end_time'] - time() < 3600 * 24 * 3){
            if(session('rank') == 3){
                $count = count(D('Enter')->get_pubfail());
            }elseif(session('rank') == 4){
                $count = count(D('Enter')->get_civilfail());
            }
            if($count > 0){
                $this->json_response(array('data' => '你还有' .$count. '名学生没有处理'));
            }
        }
        $this->json_response();
    }
}