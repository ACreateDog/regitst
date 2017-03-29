<?php
/**
 * Created by PhpStorm.
 * User: 孝远
 * Date: 2016/4/23
 * Time: 11:21
 */

namespace Admin\Controller;


class OrgController extends BaseController{

    // 权限控制  '方法名' => 'all' 所有权限都可访问
    // 权限控制  '方法名' => ['allow' => [权限列表] ]   允许某些权限访问
    // 权限控制  '方法名' => ['deny' => [权限列表] ]   拒绝某些权限访问
    public $route = [
        'orginfo' => 'all',
        'account' => [ 'allow' =>  [CITY_RANK] ],
        'classAccount' => [ 'allow' =>  [CITY_RANK] ],
        'primaryClass' => [ 'allow' =>  [PRIMARY_RANK] ],
        'perfectInfo' =>  [ 'deny' =>  [CLASS_RANK] ],
        'get_organ_info' =>  [ 'deny' =>  [CLASS_RANK] ],
        'update_organ_info' =>  [ 'deny' =>  [CLASS_RANK] ],
        'get_area_option' => 'all',
        'get_primary_option' => [ 'allow' =>  [CITY_RANK] ],
        'delete_area' => [ 'allow' =>  [CITY_RANK] ],
        'update_area' => [ 'allow' =>  [CITY_RANK] ],
        'insert_area' => [ 'allow' =>  [CITY_RANK] ],
        'delete_org' => [ 'allow' =>  [CITY_RANK,PRIMARY_RANK] ],
        'update_org' => [ 'allow' =>  [CITY_RANK,PRIMARY_RANK] ],
        'insert_org' => [ 'allow' =>  [CITY_RANK,PRIMARY_RANK] ],
        'import_classes' => ['allow' => [CITY_RANK]],
        'download_template'=>['allow' => [CITY_RANK]],
        'import_primary'=> ['allow' => [CITY_RANK]],
        'import_junior'=> ['allow' => [CITY_RANK]],
        'upload' => ['allow' => [CITY_RANK]],
    ];

    //错误类型
    private $error_arr = [
        'empty_data' => ['code' => 0xD001, 'msg' => '没有数据'],
        'unknown' => ['code' => 0xD002, 'msg' => '未知错误'],
        'incomplete_data' => ['code' => 0xD003, 'msg' => '数据不完整'],
        'file_error' => ['code' => 0xD131, 'msg' => '文件错误'],
        'download_option' => ['code' => 0xD132, 'msg' => '下载参数错误']
    ] ;

    /**
     * 市教育局的查看机构信息
     */
    public function orginfo(){
        $org = D('Org');
        $flag = false;
        $city_info = $org->get_city($flag);
        $area_list = $org->get_areas($flag);
        $primary_list = $org->get_primarys($flag);
        $junior_list = $org->get_juniors($flag);
        $this->assign('city', $city_info);
        $this->assign('area_list', $area_list);
        $this->assign('primary_list', $primary_list);
        $this->assign('junior_list', $junior_list);
        $this->assign('title', '机构信息');
        $this->assign('route', '机构信息');
        $this->display();
    }

    /**
     * 账号管理
     */
    public function account(){
        $org = D('Org');
        $account_rank = I('type');
        $route = '账号管理 / ';
        switch ( $account_rank ){
            case 1 :
                $city_info = $org->get_city(true);
                $this->assign('city', $city_info);
                $this->assign('route',$route.'市教育局');
                break;
            case 2 :
                $area_list = $org->get_areas(true);
                $this->assign('area_list', $area_list);
                $this->assign('route', $route.'区教育局');
                break;
            case 3 :
                $junior_list = $org->get_juniors(true);
                $this->assign('junior_list', $junior_list);
                $this->assign('route', $route.'中学');
                break;
            case 4 :
                $primary_list = $org->get_primarys(true);
                $this->assign('primary_list', $primary_list);
                $this->assign('route', $route.'小学');
                break;
            case 5 :
                $classes_info = $org->get_classes();
                $this->assign('classes_list', $classes_info);
                $this->assign('route', $route.'班主任');
                $this->display('classAccount');
                return;
                break;
            default: $this->error('参数错误');
        }
        $this->assign('title', '账号管理');
        $this->assign('account_rank', $account_rank);
        $this->display();
    }

    /**
     * 小学管理本校班主任
     */
    public function primaryClass(){
        $org = D('Org');
        $classes_info = $org->get_primary_class(session('oid'));
        $this->assign('classes_list', $classes_info);
        $this->assign('title', '班级管理');
        $this->assign('route', '班级管理');
        $this->display();
    }

    /**
     * 查看本机构的信息
     */
    public function perfectInfo(){
        $info = D('Org')->get_organ_info();
        $this->assign('info', $info);
        $this->assign('title', '完善信息');
        $this->assign('route', '完善信息');
        $this->display();
    }

    /**
     * 查看某机构的信息
     * @request oid 机构id
     */
    public function get_organ_info(){
        $db = D('Org');
        $info = $db->get_organ_info((int)I('oid'));
        if($info){
            $this->json_response(array('data' => $info));
        }else{
            $this->json_response($db->getError());
        }
    }

    /**
     * 修改本机构的信息
     */
    public function update_organ_info(){
        $db = D('Org');
        $info = $db->update_organ_info(I('post.'));
        if($info){
            $this->json_response();
        }else{
            $this->json_response($db->getError());
        }
    }

    /**
     * 区域选项
    */
    public function get_area_option(){
        $result = M('organ')->field('id,name')
            ->where( array('rank' => array('between', '1,2'), 'status' => 0) )
            ->select();
        if($result !== false){
            $this->json_response(array('code' => 0, 'data' => $result));
        }else{
            $this->json_response(array('code' => 1));
        }
    }

    /**
     * 小学选项
     */
    public function get_primary_option(){
        $area = I('area');
        if(empty($area)){
            $this->json_response(array('code' => 0, 'data' => []));
            return;
        }
        $result = M('organ')->field('id,name')
            ->where( array('rank' => 5, 'pid' => $area, 'status' => 0) )
            ->select();
        if($result !== false){
            $this->json_response(array('code' => 0, 'data' => $result));
        }else{
            $this->json_response(array('code' => 1));
        }

    }

    /**
     * 添加一个区教育局
     * @request name 区名
     */
    public function insert_area(){
        $name = trim(I('name'));
        $db = D('Org');
        $result = $db->insert_area($name);

        if($result){
            return  $this->json_response(array('code' => 0, 'data' => $result));
        }
        return  $this->json_response($db->getError());
    }

    /**
     * 改变区名
     * @request name 区名
     * @request id 机构id
     */
    public function update_area(){
        $name = trim(I('name'));
        $id = (int)I('id');
        $db = D('Org');

        if($db->update_area($name, $id)){
            return  $this->json_response(array('code' => 0));
        }
        return  $this->json_response($db->getError());

    }

    /**
     * 删除区
     * @request id 机构id
     */
    public function delete_area(){
        $id = (int)I('id');
        $db = D('Org');

        if($db->delete_area($id)){
            return  $this->json_response(array('code' => 0));
        }
        return  $this->json_response(array('code' => 1, 'msg' => $db->getError()));

    }

    /**
     * 添加一个普通机构
     * @request name 区名
     */
    public function insert_org(){
        $data = format_I();

        if(!isset($data['pid']) && session('rank') == PRIMARY_RANK){   //小学管理班级时 pid 默认
            $data['pid'] = session('oid');
        }

        $db = D('Org');
        $oid = $db->insert_org($data);

        if($oid){
            return  $this->json_response(array('data' => $oid));
        }

        return  $this->json_response($db->getError());
    }

    /**
     * 修改普通机构
     * @request name 区名
     * @request id 机构id
     */
    public function update_org(){
        $data = format_I();
        $db = D('Org');

        if($db->update_org($data)){
            if((int)session('rank') == CITY_RANK && !empty(I('name')) ){
                session('name',I('name'));
            }
            return  $this->json_response();
        }
        return  $this->json_response($db->getError());

    }

    /**
     * 删除普通机构
     * @request id 机构id
     */
    public function delete_org(){
        $id = I('ids');
        $db = D('Org');

        if($db->delete_org($id)){
            return  $this->json_response(array('code' => 0));
        }
        return  $this->json_response($db->getError());

    }

    /**
     * 导入时 上传 excel 文件
     * @return array|void  文件信息
     */
    public function upload(){
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize   =     3145728 ;// 设置附件上传大小
        $upload->exts      =     array('xlsx','xls');// 设置附件上传类型
        $upload->rootPath  =      './Uploads/'; // 设置附件上传根目录
        $upload->savePath  =      'import_lsx/'; // 设置附件上传（子）目录

        // 上传文件
        $info   =   $upload->uploadOne($_FILES['import_file']);
        if(!$info) {// 上传错误提示错误信息
            return $this->json_response(array('code' => $this->error_arr['file_error']['code'], 'msg' =>$upload->getError()));
        }

        return $info;
    }

    /**
     * 下载 excel导入模板
     */
    public function download_template(){
        $type = trim(I('type'));

        $filename = '导入文件模板';

        switch ($type){
            case 'junior' : $header_list = ['学校名称','区属/市属','公办/民办','账号'];break;      // 中学
            case 'primary' : $header_list = ['学校名称','区属/市属','账号'];break;      // 小学
            case 'class' : $header_list = ['姓名','学校','班级','联系方式','账号'];break;      // 班主任
            default: return $this->json_response($this->error_arr['download_option']);
        }
        To_Exel($filename,$header_list);
    }
    /**
     * 导入班级账号
     * @throws \PHPExcel_Exception
     */
    public function import_primary(){

        $info = $this->upload();
        $file = './Uploads/'.$info['savepath'].$info['savename'];
        $sheetData = From_Excel($file);
        $highestRow = count($sheetData);           //取得总行数
        $highestColumn = 'C';   //$sheet->getHighestColumn(); //取得总列数

        $dataList = [];
        $area_list = M('organ')->field('id,name')
            ->where( array('rank' => array('between',array(CITY_RANK,AREA_RANK)), 'status' => 0) )
            ->select();
        $temp_school = '';
        $temp_pid = 0;
        for($row=2;$row<=$highestRow;$row++)                        //从第二行开始读取数据
        {
            for($col='A';$col<=$highestColumn;$col++){              //判断 是否字段为空
                if(empty($sheetData[$row][$col])){
                    return  $this->json_response(array('code'=>1, 'msg' => '单元格 '.$col.$row.' 为空'));
                }
            }
        }
        for($row=2;$row<=$highestRow;$row++)
        {
            $now_school = $sheetData[$row]['B'];
            if($temp_school != $now_school){
                $temp_pid = 0;
                foreach($area_list as $key => $item){             //遍历是school数组 得到school对应的机构id
                    if($item['name'] == $now_school){
                        $temp_school = $now_school;
                        $temp_pid = $item['id'];
                        break;
                    }
                }
                if($temp_pid == 0){
                    return  $this->json_response(array('code'=>1, 'msg' => '没有找到单元格 B'.$row.' 对应的教育局'));
                }
            }

            $dataList[] = array(
                'name' => $sheetData[$row]['A'],
                'pid' => $temp_pid,
                'account' => $sheetData[$row]['C'],
                'rank' => 5
            );
        }

        $db = D('Org');
        $result = $db->import_org($dataList);
        unlink($file);
        if($result){
            return  $this->json_response(array('code' => 0));
        }else{
            return  $this->json_response($db->getError());
        }
    }

    /**
     * 导入初中账号
     * @throws \PHPExcel_Exception
     */
    public function import_junior(){

        $info = $this->upload();
        $file = './Uploads/'.$info['savepath'].$info['savename'];
        $sheetData = From_Excel($file);
        $highestRow = count($sheetData);           //取得总行数
        $highestColumn = 'C';   //$sheet->getHighestColumn(); //取得总列数

        $dataList = [];
        $area_list = M('organ')->field('id,name')
            ->where( array('rank' => array('between',array(CITY_RANK,AREA_RANK)), 'status' => 0) )
            ->select();
        $temp_school = '';
        $temp_pid = 0;
        for($row=2;$row<=$highestRow;$row++)                        //从第二行开始读取数据
        {
            for($col='A';$col<=$highestColumn;$col++){              //判断 是否字段为空
                if(empty($sheetData[$row][$col])){
                    return  $this->json_response(array('code'=>1, 'msg' => '单元格 '.$col.$row.' 为空'));
                }
            }
        }
        for($row=2;$row<=$highestRow;$row++)
        {
            $now_school = $sheetData[$row]['B'];
            if($temp_school != $now_school){
                $temp_pid = 0;
                foreach($area_list as $key => $item){             //遍历是school数组 得到school对应的机构id
                    if($item['name'] == $now_school){
                        $temp_school = $now_school;
                        $temp_pid = $item['id'];
                        break;
                    }
                }
                if($temp_pid == 0){
                    return  $this->json_response(array('code'=>1, 'msg' => '没有找到单元格 B'.$row.' 对应的教育局'));
                }
            }
            $type = $sheetData[$row]['C'];
            if('公办' == $type){
                $rank = 3;
            }else if('民办' == $type){
                $rank = 4;
            }


            $dataList[] = array(
                'name' => $sheetData[$row]['A'],
                'pid' => $temp_pid,
                'account' => $sheetData[$row]['D'],
                'rank' => $rank
            );
        }

        $db = D('Org');
        $result = $db->import_org($dataList);
        unlink($file);
        if($result){
            return  $this->json_response(array('code' => 0));
        }else{
            return  $this->json_response($db->getError());
        }
    }

    /**
     * 导入班级账号
     * @throws \PHPExcel_Exception
     */
    public function import_classes(){

        $info = $this->upload();
        $file = './Uploads/'.$info['savepath'].$info['savename'];
        $sheetData = From_Excel($file);
        $highestRow = count($sheetData);           //取得总行数
        $highestColumn = 'E';   //$sheet->getHighestColumn(); //取得总列数

        $dataList = [];
        $school_list = M('organ')->field('id,name')
            ->where( array('rank' => 5, 'status' => 0) )
            ->select();
        $temp_school = '';
        $temp_pid = 0;
        for($row=2;$row<=$highestRow;$row++)                        //从第二行开始读取数据
        {
            for($col='A';$col<=$highestColumn;$col++){              //判断 是否字段为空
                if(empty($sheetData[$row][$col])){
                    return  $this->json_response(array('code'=>1, 'msg' => '单元格 '.$col.$row.' 为空'));
                }
            }
        }
        for($row=2;$row<=$highestRow;$row++)
        {
            $now_school = $sheetData[$row]['B'];
            if($temp_school != $now_school){
                $temp_pid = 0;
                foreach($school_list as $key => $item){             //遍历是school数组 得到school对应的机构id
                    if($item['name'] == $now_school){
                        $temp_school = $now_school;
                        $temp_pid = $item['id'];
                        break;
                    }
                }
                if($temp_pid == 0){
                    return  $this->json_response(array('code'=>1, 'msg' => '没有找到单元格 B'.$row.' 对应的学校'));
                }
            }

            $dataList[] = array(
                'handler' => $sheetData[$row]['A'],
                'pid' => $temp_pid,
                'name' => $sheetData[$row]['C'],
                'phone'=> $sheetData[$row]['D'],
                'account' => $sheetData[$row]['E'],
                'rank' => 6
            );
        }

        $db = D('Org');
        $result = $db->import_org($dataList);
        unlink($file);
        if($result){
            return  $this->json_response(array('code' => 0));
        }else{
            return  $this->json_response($db->getError());
        }

    }

//    /**
//     * 添加一个普通机构
//     * @request name 区名
//     */
//    public function insert_class(){
//        $name = trim(I('name'));
//        $account = trim(I('account'));
//        $pid = (int)I('pid');
//        $rank = (int)I('rank');
//        $db = D('Org');
//
//        if($db->insert_org( array('name' => $name, 'pid' => $pid, 'rank' => $rank, 'account' => $account))){
//            return  $this->json_response(array('code' => 0));
//        }
//
//        return  $this->json_response($db->getError());
//    }
//
//    /**
//     * 修改普通机构
//     * @request name 区名
//     * @request id 机构id
//     */
//    public function update_class(){
//        $data = I('post.');
//        foreach($data as $key => $value){
//            $data[$key] = trim($value);
//            if(is_numeric($data[$key])){
//                $data[$key] = (int)$data[$key];
//            }
//        }
//        $db = D('Org');
//
//        if($db->update_org($data)){
//            return  $this->json_response(array('code' => 0));
//        }
//        return  $this->json_response($db->getError());
//
//    }
//
//    /**
//     * 删除普通机构
//     * @request id 机构id
//     */
//    public function delete_class(){
//        $id = (int)I('id');
//        $db = D('Org');
//
//        if($db->delete_org($id)){
//            return  $this->json_response(array('code' => 0));
//        }
//        return  $this->json_response($db->getError());
//
//    }
}