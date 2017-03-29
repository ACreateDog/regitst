<?php
/**
 * User: zhaoming
 * Date: 2016/5/1
 * Time: 10:34
 */

/**
 * @param $code 用户验证码
 * @param string $id 验证码标识
 * @return bool
 */
function check_code($code, $id = ""){
    $verify = new \Think\Verify();
    return $verify->check($code, $id);
}

/**
 * 获取当前时间的毫秒数
 * @return float
 */
function millisecond()
{
    return ceil(microtime(true) * 1000);
}

/**
 * 执行http get请求
 * @param $url
 * @param null $data
 * @return mixed
 */
function curl_get($url, $data = array())
{
    $data = array_merge($data, array('token' => $_COOKIE['token']));
    $data = http_build_query($data);
    $url .= '?' . $data;
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US) AppleWebKit/A.B (KHTML, like Gecko) Chrome/X.Y.Z.W Safari/A.B.");
    $html = curl_exec($ch);
    curl_close($ch);
    return $html;
}

/**
 * 执行http post请求
 * @param $url
 * @param null $data
 * @return mixed
 */
function curl_post($url, $data = array())
{
    $data = array_merge($data, array('token' => $_COOKIE['token']));
    $post_data = http_build_query($data);
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US) AppleWebKit/A.B (KHTML, like Gecko) Chrome/X.Y.Z.W Safari/A.B.");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $html = curl_exec($ch);

    curl_close($ch);

    return $html;
}

function resp()
{
    $varNum = func_num_args();
    $varArray = func_get_args();
    if ($varNum == 0) {
        //成功
        $res['code'] = 0;
    } else if ($varNum == 1) {
        $res['code'] = 0;
        $res['data'] = $varArray[0];
    } else {
        $res['code'] = intval($varArray[0]);
        $res['msg'] = $varArray[1];
    }
    echo json_encode($res);
    exit;
}

/**
 * 产生全局唯一ID
 * @return string
 */
function guid()
{
    mt_srand((double)microtime() * 10000);//optional for php 4.2.0 and up.
    $charid = strtoupper(md5(uniqid(rand(), true)));
    $uuid = substr($charid, 0, 8)
        . substr($charid, 8, 4)
        . substr($charid, 12, 4)
        . substr($charid, 16, 4)
        . substr($charid, 20, 12);
    return $uuid;
}