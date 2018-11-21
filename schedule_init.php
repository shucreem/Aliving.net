<?php

	/***
	 * 
	 * 作成日：2014-08-29
	 * 最終修正日：2014-09-10
	 * 
	 * << 説明 >>
	 * 各種設定を行う
	 * 
	***/
	
	define( 'DEBUG_MODE' , false );                    // DEBUGモード (true:解析モード false:通常モード)
	
	define( 'BASE_URL' , 'https://aliving.net' );
	define( 'BASE_DIR' , dirname(__FILE__) );
	define( 'LIB_ROOT_DIR' , BASE_DIR.'/lib' );                  // ライブラリのディレクトリ
	
	define( 'EXCEL_FILE_NAME_FORMAT' , BASE_DIR.'/schedule_data/YYYY-MM.xlsx');
	define( 'SCHEDULE_TEMPLATE' , BASE_DIR.'/template/schedule_template.txt' );
	define( 'SCHEDULE_DETAIL_TEMPLATE' , BASE_DIR.'/template/schedule_detail_template.txt');
	
	define( 'PLACE_LIST_STR' , 'and,aiiro,alamas,arch,aisotope,' );
	define( 'INFO_LIST_STR' , 'constraint,age,floor,genre,open,close,fee,special,guest' );
	define( 'DETAIL_LIST_STR' , 'catchcopy,text,pc_url,other_url,twitter,facebook,mixi' );
	
	require_once( BASE_DIR.'/AlivingCustom.php' );
	require_once( LIB_ROOT_DIR.'/default/phpQuery/phpQuery-onefile.php');
	require_once( LIB_ROOT_DIR.'/custom/FileToArray.class.php');
	require_once( LIB_ROOT_DIR.'/custom/CalendarMaker.class.php');
	
	/***
	 * 
	 * 固定の初期設定
	 * 
	***/
	
	mb_language('ja');
	mb_internal_encoding('utf-8');
	header('content-type: text/html; charset=utf-8');
	
?>