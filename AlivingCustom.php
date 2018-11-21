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

	define( 'LIB_ROOT_DIR' , BASE_DIR.'/lib' );
	require_once(LIB_ROOT_DIR.'/custom/CustomExceptions.php');
	require_once(LIB_ROOT_DIR.'/custom/CustomUtilities.php');


	function getList( $constName )
	{
		if( !defined($constName) ) throw new ConstantNotFoundException("[ERROR][getList] 指定された名称の定数が定義されていません。 定数名：".$constName);
		return explode(",",constant($constName));
	}


	function getExcelPath($yearMonth)
	{
		if( !preg_match("/^20[0-9]{2}-[0-1]{1}[0-9]{1}$/", $yearMonth) ) {
			throw new InvalidFormatException("[ERROR][getExcelPath] 引数の形式(yyyy-mm)が違います。 入力値→".$yearMonth);
		}

		$year = substr($yearMonth,0,4);
		$month = substr($yearMonth,5,2);

		if( !defined("EXCEL_FILE_NAME_FORMAT") ) throw new ConstantNotFoundException("[ERROR][getExcelPath] 指定された名称の定数が定義されていません。 定数名：EXCEL_FILE_NAME_FORMAT");

		$path = str_replace("MM", $month, str_replace("YYYY", $year, EXCEL_FILE_NAME_FORMAT));
		$path = ( is_readable($path) ) ? $path : false;

		return $path;
	}


	function checkUrlFormat($target)
	{
		$pattern = "/^(https?|ftp)(:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,%#]+)$/";
		$result = preg_match($pattern,$target);
		return $result;
	}

	function checkDateFormat($target)
	{
		$pattern = "@^\d{4}/\d{1,2}/\d{1,2}$@";
		$result = preg_match($pattern,$target);
		return $result;
	}

	function formEventData( $beforeList )
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
					$after[$key2] = $changeFunction($value);
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

	function change_date($value)
	{
		if( !checkDateFormat($value) ) throw new InvalidFormatException("[ERROR] 日付(yyyy-mm-dd)が不正 入力値→".$value);

		$tempArray = explode("/",$value);
		$year = $tempArray[0];
		$month = ( strlen($tempArray[1])==1 ) ? "0".$tempArray[1] :$tempArray[1];
		$day = ( strlen($tempArray[2])==1 ) ? "0".$tempArray[2] :$tempArray[2];

		return $year."-".$month."-".$day;
	}

	function change_place($value)
	{
		$flag = false;
		$value = strtolower($value);

		$placeList = getList("PLACE_LIST_STR");
		foreach( $placeList as $place )
		{
			if( $value==$place ) $flag = true;
		}

		if( $flag == false ) throw new InvalidFormatException("[ERROR] 店舗名が不正 入力値→".$value);

		return $value;
	}

	function change_title($value)
	{
		$value = mb_str_replace("【","",$value);
		$value = mb_str_replace("】","",$value);
		return $value;
	}


	function change_subtitle($value)
	{
		return $value;
	}

	function change_constraint($value)
	{
		$value = ( $value=="" ) ? "" : "入場制限：".$value;
		return $value;
	}

	function change_age($value)
	{
		$value = ( $value=="" ) ? "" : "18歳以上からの入場：".$value;
		return $value;
	}

	function change_floor($value)
	{
		$value = ( $value=="" ) ? "" : "FLOOR：".$value;
		return $value;
	}

	function change_genre($value)
	{
		$value = ( $value=="" ) ? "" : "GENRE：".$value;
		return $value;
	}

	function change_open($value)
	{
		$value = ( $value=="" ) ? "" : "START：".$value;
		return $value;
	}

	function change_close($value)
	{
		$value = ( $value=="" ) ? "" : "END：".$value;
		return $value;
	}

	function change_fee($value)
	{
		return $value;
	}

	function change_special($value)
	{
		return $value;
	}

	function change_guest($value)
	{
		return $value;
	}

	function change_catchcopy($value) { return $value; }

	function change_text($value)
	{
		return $value;
	}

	function change_ust($value) { return $value; }

	function change_pc_url($value)
	{
		if( $value!="" && !checkUrlFormat($value) ) throw new InvalidFormatException("[ERROR] URLが不正 入力値→".$value);
		return $value;
	}

	function change_twitter($value)
	{
		if( $value!="" && !checkUrlFormat($value) ) throw new InvalidFormatException("[ERROR] URLが不正 入力値→".$value);
		return $value;
	}

	function change_facebook($value)
	{
		if( $value!="" && !checkUrlFormat($value) ) throw new InvalidFormatException("[ERROR] URLが不正 入力値→".$value);
		return $value;
	}

	function change_mixi($value)
	{
		if( $value!="" && !checkUrlFormat($value) ) throw new InvalidFormatException("[ERROR] URLが不正 入力値→".$value);
		return $value;
	}

	function change_other_url($value)
	{
		if( $value!="" && !checkUrlFormat($value) ) throw new InvalidFormatException("[ERROR] URLが不正 入力値→".$value);
		return $value;
	}

	function change_flyer1_name($value)
	{
		$value = ( $value == "" ) ? "" : $value;
		return $value;
	}

	function change_flyer1_style($value) { return styleConverter($value); }

	function change_flyer2_name($value)
	{
		$value = ( $value == "" ) ? "" : $value;
		return $value;
	}

	function change_flyer2_style($value) { return styleConverter($value); }


	/***
	 *
	 * フィールド共通関数
	 *
	***/

	function styleConverter($styleName)
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

?>
