<?php
return array(
	//'配置项'=>'配置值'
    'LOAD_EXT_CONFIG' => 'db',
    //'SHOW_PAGE_TRACE'=>True,
    'LOG_RECORD' => true, // 开启日志记录
    'LOG_LEVEL'  =>'EMERG,ALERT,CRIT,ERR,USER', // 只记录EMERG ALERT CRIT ERR 错误
    'TMPL_ACTION_ERROR'     =>  COMMON_PATH .'error.html', // 默认错误跳转对应的模板文件
);