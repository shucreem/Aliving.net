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


	/***
	 *
	 * 簡単にカスタマイズできる内容
	 *
	***/

	define( 'DEBUG_MODE' , 'false' );                    // DEBUGモード (true:解析モード false:通常モード)
	define( 'LIB_ROOT_DIR' , './lib' );                  // ライブラリのディレクトリ
	define( 'SCHEDULE_DATA_DIR' , './schedule_data' );   // エクセルのディレクトリ
	define( 'IMAGE_DIR' , './image' );                   // 普通の画像のディレクトリ
	define( 'FLYER_DIR' , './image/schedule' );          // フライヤー画像のディレクトリ
	define( 'TEMPLATE_DIR' , './template' );             // テンプレートファイルのディレクトリ

	$scheduleTemplate = TEMPLATE_DIR."/schedule_template.txt";                // scheduleページのテンプレートファイル
	$scheduleDetailTemplate = TEMPLATE_DIR."/schedule_detail_template.txt";   // イベント詳細ページのテンプレートファイル


	/***
	 *
	 * 固定の初期設定
	 *
	***/

	mb_language('ja');
	mb_internal_encoding('utf-8');
	require_once(LIB_ROOT_DIR.'/custom/CustomExceptions.php');
	require_once(LIB_ROOT_DIR.'/custom/CustomUtilities.php');


	/***
	 *
	 * AlivingCustomClass
	 *
	***/

	class AlivingCustomClass{

		const REGEXP_EXCEL_DATE_PATTERN = "@^\d{4}/\d{1,2}/\d{1,2}$@";
		const REGEXP_STRICT_URL_PATTERN = "/^(https?|ftp)(:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,%#]+)$/";

		public static $placeList = array("and","alamas","aisotope","avantgarde");
		public static $infoList=array("constraint","floor","genre","open","close","fee","guest");
		public static $detailList=array("catchcopy","text","pc_url","other_url","twitter","facebook","mixi");

		public static function formEventData( $beforeList )
		{
			foreach( $beforeList as $key1 => $before )
			{
				foreach( $before as $key2 => $value )
				{
					$value = trim($value);
					$value = str_replace("\r\n","<br>",$value);
					$value = str_replace("\n","<br>",$value);
					$changeFunction = "change_".$key2;

					try{
						$after[$key2] = self::$changeFunction($value);
					}catch( InvalidFormatException $e ){
						if( DEBUG_MODE == "true" ) {
							print("[row:".$key1." col:".$key2."]".$e->getMessage()."<br><br>\n\n");
							print_r($before);
							exit();
						} else {
							throw new InvalidFormatException();
						}
					}
				}
				$afterList[] = $after;
			}
			return $afterList;
		}


		/***
		 *
		 * フィールドごとの個別関数
		 *
		***/

		public static function change_date($value)
		{
			if( !preg_match(self::REGEXP_EXCEL_DATE_PATTERN,$value) ) throw new InvalidFormatException("[ERROR] 日付(yyyy-mm-dd)が不正 入力値→".$value);

			$tempArray = explode("/",$value);
			$year = $tempArray[0];
			$month = ( strlen($tempArray[1])==1 ) ? "0".$tempArray[1] :$tempArray[1];
			$day = ( strlen($tempArray[2])==1 ) ? "0".$tempArray[2] :$tempArray[2];

			return $year."-".$month."-".$day;
		}

		public static function change_place($value)
		{
			$flag = false;
			$value = strtolower($value);

			foreach( self::$placeList as $place )
			{
				if( $value==$place ) $flag = true;
			}

			if( $flag == false ) throw new InvalidFormatException("[ERROR] 店舗名が不正 入力値→".$value);

			return $value;
		}

		public static function change_title($value)
		{
			$value = mb_str_replace("【","",$value);
			$value = mb_str_replace("】","",$value);
			return $value;
		}


		public static function change_subtitle($value)
		{
			return $value;
		}

		public static function change_constraint($value)
		{
			$value = ( $value=="" ) ? "" : "入場制限：".$value;
			return $value;
		}

		public static function change_floor($value)
		{
			$value = ( $value=="" ) ? "" : "FLOOR：".$value;
			return $value;
		}

		public static function change_genre($value)
		{
			$value = ( $value=="" ) ? "" : "GENRE：".$value;
			return $value;
		}

		public static function change_open($value)
		{
			$value = ( $value=="" ) ? "" : "OPEN：".$value;
			return $value;
		}

		public static function change_close($value)
		{
			$value = ( $value=="" ) ? "" : "CLOSE：".$value;
			return $value;
		}

		public static function change_fee($value)
		{
			return $value;
		}

		public static function change_guest($value)
		{
			return $value;
		}

		public static function change_catchcopy($value) { return $value; }

		public static function change_text($value)
		{
			return $value;
		}

		public static function change_ust($value) { return $value; }

		public static function change_pc_url($value)
		{
			if( $value!="" && !preg_match(self::REGEXP_STRICT_URL_PATTERN,$value) ) throw new InvalidFormatException("[ERROR] URLが不正 入力値→".$value);
			return $value;
		}

		public static function change_twitter($value)
		{
			if( $value!="" && !preg_match(self::REGEXP_STRICT_URL_PATTERN,$value) ) throw new InvalidFormatException("[ERROR] URLが不正 入力値→".$value);
			return $value;
		}

		public static function change_facebook($value)
		{
			if( $value!="" && !preg_match(self::REGEXP_STRICT_URL_PATTERN,$value) ) throw new InvalidFormatException("[ERROR] URLが不正 入力値→".$value);
			return $value;
		}

		public static function change_mixi($value)
		{
			if( $value!="" && !preg_match(self::REGEXP_STRICT_URL_PATTERN,$value) ) throw new InvalidFormatException("[ERROR] URLが不正 入力値→".$value);
			return $value;
		}

		public static function change_other_url($value)
		{
			if( $value!="" && !preg_match(self::REGEXP_STRICT_URL_PATTERN,$value) ) throw new InvalidFormatException("[ERROR] URLが不正 入力値→".$value);
			return $value;
		}

		public static function change_flyer1_name($value)
		{
			$value = ( $value == "" ) ? "" : FLYER_DIR."/".$value;
			return $value;
		}

		public static function change_flyer1_style($value) { return self::styleConverter($value); }

		public static function change_flyer2_name($value)
		{
			$value = ( $value == "" ) ? "" : FLYER_DIR."/".$value;
			return $value;
		}

		public static function change_flyer2_style($value) { return self::styleConverter($value); }


		/***
		 *
		 * フィールド共通関数
		 *
		***/

		public static function styleConverter($styleName)
		{
			switch($styleName)
			{
				case "big" :
					$styleValue = "img_border1_width334";
					break;
				case "small" :
					$styleValue = "img_border0_width150";
					break;
				default :
					$styleValue = "";
			}
			return $styleValue;
		}
	}

?>
