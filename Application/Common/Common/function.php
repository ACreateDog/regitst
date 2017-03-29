<?php
/**
 * Created by PhpStorm.
 * User: 孝远
 * Date: 2016/4/23
 * Time: 12:04
 */
function is_login(){
    if(session('id')){
        return true;
    }else{
        return false;
    }
}

function getDefualtPass(){
    return md5(md5(C('DEFAULT_PASS')));
}

function blog($code , $msg){
    Think\Log::record('USER','0x'.strtoupper(dechex($code)) . ':' . $msg);
}

/**
 * 检测验证码
 * @param  integer $id 验证码ID
 * @return boolean     检测结果
 */
function check_verify($code, $id = 1){
    $verify = new \Think\Verify();
    return $verify->check($code, $id);
}

function To_Exel($fileName, $headArr, $list)
{
    //导入PHPExcel类库，因为PHPExcel没有用命名空间，只能import导入
    Vendor("PHPExcel.PHPExcel");
    Vendor("PHPExcel.PHPExcel.Writer.Excel5");
    Vendor("PHPExcel..PHPExcel.IOFactory.php");

    $date = date("Y_m_d", time());
    $fileName .= "_{$date}.xls";

    //创建PHPExcel对象，注意，不能少了\
    $objPHPExcel = new \PHPExcel();
    $objProps = $objPHPExcel->getProperties();

    //设置表头
    $key = ord("A");
    //print_r($headArr);exit;
    foreach ($headArr as $v) {
        $colum = chr($key);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum . '1', $v);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue($colum . '1', $v);
        $key += 1;
    }

    $column = 2;
    $objActSheet = $objPHPExcel->getActiveSheet();
    foreach ($list as $key => $rows) { //行写入
        $span = ord("A");
        foreach ($rows as $keyName => $value) {// 列写入
            $j = chr($span);
            $objActSheet->setCellValue($j . $column, $value,PHPExcel_Cell_DataType::TYPE_STRING);
            $objPHPExcel->getActiveSheet()->getStyle($j . $column)->getNumberFormat()->setFormatCode("@");
            $span++;
        }
        $column++;
    }

    $fileName = iconv("utf-8", "gb2312", $fileName);
    $objPHPExcel->setActiveSheetIndex(0);
    ob_end_clean();//清除缓冲区,避免乱码
    header('Content-Type: application/vnd.ms-excel');
    header("Content-Disposition: attachment;filename=\"$fileName\"");
    header('Cache-Control: max-age=0');

    $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    $objWriter->save('php://output'); //文件通过浏览器下载
    exit;
}

function From_Excel($file)
{
    /* 实例化类 */
    Vendor("PHPExcel.PHPExcel");
    Vendor("PHPExcel.PHPExcel.IOFactory");
    $ext = pathinfo($file, PATHINFO_EXTENSION);
    if( $ext =='xlsx' ) {
        $objReader = new \PHPExcel_Reader_Excel2007();
    } else {
        $objReader = new \PHPExcel_Reader_Excel5();
    }
    $objPHPExcel = $objReader->load($file);
    $objWorksheet = $objPHPExcel->getActiveSheet();
    $sheetData =$objWorksheet->toArray(null,true,true,true);

    return $sheetData;
}

/**
 * 格式化 I() 的信息
 * @return mixed
 */
function format_I(){
    $data = I('post.');
    foreach($data as $key => $value){
        $data[$key] = trim($value);
        if(is_numeric($data[$key]) && strlen($data[$key]) < 10 ){
            $data[$key] = (int)$data[$key];
        }
    }
    return $data;
}

/**
 * @param $time 时间戳
 * @return int  $time的下一天早上的0:00的时间戳
 */
function next_date($time){
    return strtotime(date('Y-m-d',$time + 3600 * 24)) ;
}