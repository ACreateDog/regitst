<?php
/**
 * Created by PhpStorm.
 * User: 孝远
 * Date: 2016/4/23
 * Time: 11:39
 */
namespace Admin\Controller;

class EnterController extends BaseController{
    public $route = [
        'pubindex'=>['allow'=>[PUB_JUNIOR_RANK]],
        'pubfail'=>['allow'=>[PUB_JUNIOR_RANK]],
        'pubadopt'=>['allow'=>[PUB_JUNIOR_RANK]],
        'pubannals'=>['allow'=>[PUB_JUNIOR_RANK]],
        'pubreginfo'=>['allow'=>[PUB_JUNIOR_RANK]],
        'pub_admis'=>['allow'=>[PUB_JUNIOR_RANK]],
        'pub_Nadmis'=>['allow'=>[PUB_JUNIOR_RANK]],
        'pub_issued_admis'=>['allow'=>[PUB_JUNIOR_RANK]],
        'pub_studnet_info_export'=>['allow'=>[PUB_JUNIOR_RANK]],
        'civilindex'=>['allow'=>[CIVIL_JUNIOR_RANK]],
        'civilfail'=>['allow'=>[CIVIL_JUNIOR_RANK]],
        'civiladopt'=>['allow'=>[CIVIL_JUNIOR_RANK]],
        'civilannals'=>['allow'=>[CIVIL_JUNIOR_RANK]],
        'civilreginfo'=>['allow'=>[CIVIL_JUNIOR_RANK]],
         'lotNum'=>['allow'=>[CITY_RANK]],
        'NlotNum'=>['allow'=>[CITY_RANK]],
        'cilil_issued_lot'=>['allow'=>[CITY_RANK]],
        'civil_issued_admis'=>['allow'=>[CIVIL_JUNIOR_RANK]],
        'civil_admis'=>['allow'=>[CIVIL_JUNIOR_RANK]],
        'pub_Nadmis'=>['allow'=>[PUB_JUNIOR_RANK]],
        'civil_Nadmis'=>['allow'=>[CIVIL_JUNIOR_RANK,PUB_JUNIOR_RANK]],
        'civil_studnet_info_export'=>['allow'=>[CIVIL_JUNIOR_RANK]],
    ];
    Protected $erroe_msg = [
        'UgainId'=>['code'=>'0xA001', 'msg'=>'学校ID不存在!','data'=>null],
        'queryErr'=>['code'=>'0xA002', 'msg'=>'查询失败!','data'=>null],
        'Ureid'=>['code'=>'0xA003', 'msg'=>'参数不存在!','data'=>null],
        'success'=>['code'=>'0xA004', 'msg'=>'操作成功!','data'=>null],
        'error'=>['code'=>'0xA005', 'msg'=>'操作失败!','data'=>null],
    ];

    /**
     * 公办初中
     */
    public function pubindex(){
        $data = D('Enter')->get_pub_indexinfo();
        $this->assign('enter_time',date('Y-m-d',$data['enter_time']));
        $this->assign('ex_time',ceil( (next_date($data['enter_time']) - time())  / (3600 *24) ));
        $this->assign('data',$data);
        $this->assign('title', '首页');
        $this->assign('route', '首页');
        $this->display();
    }

    public function pubfail(){
        $data = D('Enter')->get_pubfail();
        $this->assign('title', '尚未审批');
        $this->assign('route', '尚未审批');
        $this->assign('data', $data);
        $this->display();
    }

    public function pubadopt(){
        $data = D('Enter')->get_pub_adopt_student();
        $this->assign('title', '已录学生');
        $this->assign('route', '已录学生');
        $this->assign('data',$data);
        $this->display();
    }

    public function pubannals(){
        $data = D('Enter')->get_pub_annals_student();
        $this->assign('title', '历史记录');
        $this->assign('route', '历史记录');
        $this->assign('data',$data);
        $this->display();
    }

    public function pubreginfo(){
        $type = I('get.type');
        if(trim($type) === '0'){
            $data =  D('Enter')->get_pubreginfo($type);
            $this->assign('route', '报名信息--学区生');
        }elseif(trim($type) === '1'){
            $data =  D('Enter')->get_pubreginfo($type);
            $this->assign('route', '报名信息--统筹生');
        }elseif(trim($type) === '2'){
            $data =  D('Enter')->get_pubreginfo($type);
            $this->assign('route', '报名信息--调剂生');
        }else{
            $data =  D('Enter')->get_pubreginfo();
            $this->assign('route', '报名信息');
        }
        $this->assign('data', $data);
        $this->assign("title","查看报名信息");
        $this->display();
    }

    //录取
    function pub_admis(){
        $reid = I('post.register_id');
        if(empty($reid)){
            $this->json_response($this->erroe_msg['Ureid']);
        }
        $result = D('Enter')->set_pub_admis($reid);
        if(false === $result){
            $this->json_response($this->erroe_msg['error']);
        }else{
            $msg = $this->erroe_msg['success'];
            $msg['data'] = $result;
            $this->json_response($msg);
        }
    }

    //不录取
    function pub_Nadmis(){
        $reid = I('post.register_id');
        $reject_conten = I('post.reject_conten');
        if(empty($reid)){
            $this->json_response($this->erroe_msg['Ureid']);
        }
        if(empty($reject_conten)){
            $this->json_response($this->erroe_msg['Ureid']);
        }
        $result = D('Enter')->set_pub_Nadmis($reid,$reject_conten);
        if(false === $result){
            $this->json_response($this->erroe_msg['error']);
        }else{
            $msg = $this->erroe_msg['success'];
            $msg['data'] = $result;
            $this->json_response($msg);
        }
    }
    //再分配
    function pub_redistri(){
        $reid = I('post.register_id');
        if(empty($reid)){
            $this->json_response($this->erroe_msg['Ureid']);
        }
        $result = D('Enter')->set_pub_redistri($reid);
        if(false === $result){
            $this->json_response($this->erroe_msg['error']);
        }else{
            $msg = $this->erroe_msg['success'];
            $msg['data'] = $result;
            $this->json_response($msg);
        }
    }
    //发布录取
    function pub_issued_admis(){
        $result = D('Enter')->set_pub_issued_admis();
        if(false !== $result){
            $msg = $this->erroe_msg['success'];
            $msg['data'] = $result;
            $this->json_response($msg);
        }else{
            $this->json_response($this->erroe_msg['error']);
        }
    }
    /**
     * 民办初中
     */
    public function civilindex(){
        $data = D('Enter')->get_civil_indexinfo();
        $this->assign('enter_time',date('Y-m-d',$data['enter_time']));
        $this->assign('ex_time',ceil( (next_date($data['enter_time']) - time())  / (3600 *24) ));
        $this->assign('config',$this->config);
        $this->assign('title', '首页');
        $this->assign('route', '首页');
        $this->assign('data',$data);
        $this->display();
    }

    public function civilfail(){
        $data = D('Enter')->get_civilfail();
        $this->assign('title', '尚未审批');
        $this->assign('route', '尚未审批');
        $this->assign('data', $data);
        $this->display();
    }

    public function civiladopt(){
        $data = D('Enter')->get_civil_adopt_student();
        $this->assign('title', '已录学生');
        $this->assign('route', '已录学生');
        $this->assign('data', $data);
        $this->display();
    }

    public function civilannals(){
        $data = D('Enter')->get_cicil_annals_student();
        $this->assign('title', '未录记录');
        $this->assign('route', '未录记录');
        $this->assign('data', $data);
        $this->display();
    }
    public function lot_orginfo(){
        $data = D('Enter')->get_lot_orginfo();
        $this->assign('title', '摇号信息');
        $this->assign('route', '摇号信息');
        $this->assign('data', $data);
        $this->display();
    }
    public function civilreginfo(){
        $type = I('get.type');
        if(trim($type) === '0'){
            $data =  D('Enter')->get_civilreginfo($type);
            $this->assign('route', '报名信息--学区生');
        }elseif(trim($type) === '1'){
            $data =  D('Enter')->get_civilreginfo($type);
            $this->assign('route', '报名信息--统筹生');
        }else{
            $data =  D('Enter')->get_civilreginfo();
            $this->assign('route', '报名信息');
        }
        $this->assign('data', $data);
        $this->assign("title","查看报名信息");
        $this->display();
    }

    function lotNum(){
        $reid = I('post.register_id');
        if(empty($reid)){
            $this->json_response($this->erroe_msg['Ureid']);
        }
        $result = D('Enter')->set_lot($reid);
        if($result === false){
            $this->json_response($this->erroe_msg['error']);
        }else{
            $msg = $this->erroe_msg['success'];
            $msg['data'] = $result;
            $this->json_response($msg);
        }
    }

    function NlotNum(){
        $reid = I('post.register_id');
        if(empty($reid)){
            $this->json_response($this->erroe_msg['Ureid']);
        }
        $result = D('Enter')->set_Nlot($reid);
        if($result === false){
            $this->json_response($this->erroe_msg['error']);
        }else{
            $msg = $this->erroe_msg['success'];
            $msg['data'] = $result;
            $this->json_response($msg);
        }
    }
    //摇号
    function cilil_issued_lot(){
        $result = D('Enter')->set_cilil_issued_lot();
        if(false !== $result){
            $msg = $this->erroe_msg['success'];
            $msg['data'] = $result;
            $this->json_response($msg);
        }else{
            $this->json_response($this->erroe_msg['error']);
        }
    }
    //发布录取
    function civil_issued_admis(){
        $result = D('Enter')->set_civil_issued_admis();
        if(false !== $result){
            $msg = $this->erroe_msg['success'];
            $msg['data'] = $result;
            $this->json_response($msg);
        }else{
            $this->json_response($this->erroe_msg['error']);
        }
    }

    //录取
    function civil_admis(){
        $reid = I('post.register_id');
        if(empty($reid)){
            $this->json_response($this->erroe_msg['Ureid']);
        }
        $result = D('Enter')->set_civil_admis($reid);
        if(false === $result){
            $this->json_response($this->erroe_msg['error']);
        }else{
            $msg = $this->erroe_msg['success'];
            $msg['data'] = $result;
            $this->json_response($msg);
        }
    }
    //导入摇号状态
    function import_lot(){
        $info = $this->upload();
        $file = './Uploads/'.$info['savepath'].$info['savename'];
        $sheetData = From_Excel($file);
        $datalist = [];
        foreach($sheetData as $i =>$item){
            foreach($item as $k =>$v){
                $datalist[$i] = $v;
            }
        };
        $result = D('Enter')->set_import_lot($datalist);
        if(false === $result){
            $this->json_response($this->erroe_msg['error']);
        }else{
            $msg = $this->erroe_msg['success'];
            $msg['data'] = $result;
            $this->json_response($msg);
        }
    }

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

    //不录取
    function civil_Nadmis(){
        $reid = I('post.register_id');
        $reject_conten = I('post.reject_conten');
        if(empty($reid)){
            $this->json_response($this->erroe_msg['Ureid']);
        }
        if(empty($reject_conten)){
            $this->json_response($this->erroe_msg['Ureid']);
        }
        $result = D('Enter')->set_civil_Nadmis($reid,$reject_conten);
        if(false === $result){
            $this->json_response($this->erroe_msg['error']);
        }else{
            $msg = $this->erroe_msg['success'];
            $msg['data'] = $result;
            $this->json_response($msg);
        }
    }
    //判断公办状态
    protected function is_pub_status($pub_status, $pub_release){
        if($pub_status == 1 && $pub_release == 1){
            return "同意";
        }elseif($pub_status == 2 && $pub_release == 1){
            return "拒绝";
        }else{
            return "等待";
        }
    }
    //判断民办状态
    protected function is_civil_status($civil_status, $civil_release, $lot_status){
       if($civil_status == 2 && $civil_release == 1){
            return "同意";
        }elseif(($civil_status == 3) and ($civil_release == 1)){
            return "拒绝";
        }elseif($civil_status == 1 and $lot_status == 1){
            return "派中";
        }elseif($civil_status == 3 and $lot_status == 1){
            return "拒绝";
        }else{
            return "等待";
        }
    }
    //判断男女
    protected function issex($sex){
        if($sex == 0){
            return "男";
        }else{
            return "女";
        }
    }
    //判断男女
    protected function get_school($data){
        if($data['drank'] == '' or $data['drank'] == 1){
            return $data['cname'];
        }else{
            return $data['oname'];
        }
    }
    //是否发布
    protected function issued($lot_release, $pub_release, $civil_release){
        if($lot_release == 1 || $pub_release == 1 || $civil_release == 1){
            return "已发布";
        }else{
            return "未发布";
        }
    }
    //公办导出报名学生信息
    function pub_studnet_info_export()
    {
        $type = trim(I('get.type'));
        if($type == 4){
            $studnet_list = D('Enter')->get_pubreginfo();
            $filename="报名信息表";
            $title = "学生报名信息表";
        }elseif($type == 3){
            $studnet_list = D('Enter')->get_pub_annals_student();
            $filename="历史记录表";
            $title = "历史记录学生报名信息表";
        }elseif($type == 2){
            $studnet_list = D('Enter')->get_pub_adopt_student();
            $filename="已录学生表";
            $title = "已录学生报名信息表";
        }else{
            $studnet_list = D('Enter')->get_pubfail();
            $filename="尚未审批表";
            $title = "尚未审批学生报名信息表";
        }
        $data = array();
        foreach ($studnet_list as $k=>$student_info){
            $data[$k]['id'] = $k+1;
            $data[$k]['stu_name'] = $student_info['stu_name'];
            $data[$k]['sex'] = $this->issex($student_info['sex']);
            $data[$k]['sid_num'] = $student_info['sid_num'];
            $data[$k]['sch_name']  = $this->get_school($student_info);
            $data[$k]['address']  = $student_info['address'];
            $data[$k]['account']  = $student_info['account'];
            $data[$k]['phone']  = $student_info['phone'];
        }

        $headArr[]='序号';
        $headArr[]='学生姓名';
        $headArr[]='性别';
        $headArr[]='学籍号码';
        $headArr[]='毕业小学';
        $headArr[]='家庭住址';
        $headArr[]='户口所在地';
        $headArr[]='联系电话';
        $marg = "A1:H1";
        $this->getExcel($filename,$headArr,$data,$marg,$title);
    }
    //民办初中导出报名学生信息数据
    function civil_studnet_info_export()
    {
        $type = trim(I('get.type'));
        if($type == 4){
            $studnet_list = D('Enter')->get_civilreginfo();
            $filename="报名信息表";
            $title = "学生报名信息表";
        }elseif($type == 3){
            $studnet_list = D('Enter')->get_cicil_annals_student();
            $filename="历史记录表";
            $title = "历史记录学生报名信息表";
        }elseif($type == 2){
            $studnet_list = D('Enter')->get_civil_adopt_student();
            $filename="已录学生表";
            $title = "已录学生报名信息表";
        }else{
            $studnet_list = D('Enter')->get_civilfail();
            $filename="尚未审批表";
            $title = "尚未审批学生报名信息表";
        }
        $data = array();
        foreach ($studnet_list as $k=>$student_info){
            $data[$k]['id'] = $k+1;
            $data[$k]['stu_name'] = $student_info['stu_name'];
            $data[$k]['sex'] = $this->issex($student_info['sex']);
            $data[$k]['sid_num'] = $student_info['sid_num'];
            $data[$k]['sch_name']  = $this->get_school($student_info);
            $data[$k]['address']  = $student_info['address'];
            $data[$k]['account']  = $student_info['account'];
            $data[$k]['phone']  = $student_info['phone'];
        }

        $headArr[]='序号';
        $headArr[]='学生姓名';
        $headArr[]='性别';
        $headArr[]='学籍号码';
        $headArr[]='毕业小学';
        $headArr[]='家庭住址';
        $headArr[]='户口所在地';
        $headArr[]='联系电话';
        $marg = "A1:H1";
        $this->getExcel($filename,$headArr,$data,$marg,$title);
    }


    protected function getExcel($fileName,$headArr,$data,$marg, $title){
        //导入PHPExcel类库，因为PHPExcel没有用命名空间，只能inport导入
        Vendor("PHPExcel.PHPExcel");
        Vendor("PHPExcel.PHPExcel.Writer.Excel5");
        Vendor("PHPExcel..PHPExcel.IOFactory.php");

        $date = date("Y_m_d",time());
        $fileName .= "_{$date}.xls";

        //创建PHPExcel对象，注意，不能少了\
        $objPHPExcel = new \PHPExcel();
        $objProps = $objPHPExcel->getProperties();
        //设置表头
        $key = ord("A");
        $objActSheet = $objPHPExcel->getActiveSheet();
        $objPHPExcel->setActiveSheetIndex(0) ->setCellValue('A1', $title);
        $objActSheet->mergeCells($marg);
        $styleArray1 = array(
            'font' => array(
                'bold' => true,
                'size'=>14,
                'color'=>array(
                    'argb' => '00000000',
                ),
            ),
        );
        $styleThinBlackBorderOutline = array(
            'borders' => array (
                'outline' => array (
                    'style' => \PHPExcel_Style_Border::BORDER_THIN, //设置border样式 'color' => array ('argb' => 'FF000000'), //设置border颜色
                ),
            ),);
        $objActSheet->getStyle('A1')->applyFromArray($styleArray1);
        $objActSheet->getStyle('A1')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($marg)->applyFromArray($styleThinBlackBorderOutline);
        foreach($headArr as $v){
            $colum = chr($key);
            $objPHPExcel->setActiveSheetIndex(0) ->setCellValue($colum.'2', $v);
            $objPHPExcel->setActiveSheetIndex(0) ->setCellValue($colum.'2', $v);
            $objPHPExcel->getActiveSheet()->getColumnDimension($colum)->setWidth(23);
            $objActSheet->getStyle($colum.'2')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objActSheet->getStyle($colum.'2')->applyFromArray($styleArray1);
            $objActSheet->getStyle($colum.'2')->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->getStyle("A1:".$colum.'2')->applyFromArray($styleThinBlackBorderOutline);
            $key += 1;
        }

        $column = 3;
        foreach($data as $key => $rows){ //行写入
            $span = ord("A");
            foreach($rows as $keyName=>$value){// 列写入
                $j = chr($span);
                $objActSheet->getStyle($j . $column)->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
                $objActSheet->setCellValue($j . $column, $value,\PHPExcel_Cell_DataType::TYPE_STRING);
                $objPHPExcel->getActiveSheet()->getStyle($j . $column)->getNumberFormat()->setFormatCode("@");
                $objPHPExcel->getActiveSheet()->getStyle("A1:".$j . $column)->applyFromArray($styleThinBlackBorderOutline);
                $span++;
            }
            $column++;
        }
        $fileName = iconv("utf-8", "gb2312", $fileName);
        //设置活动单指数到第一个表,所以Excel打开这是第一个表
        $objPHPExcel->setActiveSheetIndex(0);
        ob_end_clean();//清除缓冲区,避免乱码
        header('Content-Type: application/vnd.ms-excel');
        header("Content-Disposition: attachment;filename=\"$fileName\"");
        header('Cache-Control: max-age=0');

        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output'); //文件通过浏览器下载
        exit;
    }
}