<?php
return array(
	//'配置项'=>'配置值'
    /* 模板替换 */
    'TMPL_PARSE_STRING' => array(
        '__STATIC__' => __ROOT__ . '/Public/staick',
        '__IMG__'    => __ROOT__ . '/Public/' . MODULE_NAME . '/images',
        '__CSS__'    => __ROOT__ . '/Public/' . MODULE_NAME . '/css',
        '__JS__'     => __ROOT__ . '/Public/' . MODULE_NAME . '/js',
    ),

    'DEFAULT_PASS' => '123456',

    define('CITY_RANK',1),
    define('AREA_RANK',2),
    define('PUB_JUNIOR_RANK',3),
    define('CIVIL_JUNIOR_RANK',4),
    define('PRIMARY_RANK',5),
    define('CLASS_RANK',6),
);