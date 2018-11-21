<?php

	/***
	 * 
	 * 作成日：2014-09-02
	 * 最終修正日：2014-09-03
	 * 
	 * 作成者：TakashiTsuyuguchi (pc@tazakazushi.net)
	 * 
	 * - CalendarMaker.class.php
	 *     - カレンダー・日付関連の処理をまとめたクラス
	 *     - デフォルトでは実行された日の日付を利用するが、日時の指定が可能
	 * 
	 * << 参考 >>
	 * 農研機構 - 曜日・祝日計算サービス
	 * https://www.finds.jp/wsdocs/calendar/index.html.ja
	 * 
	 * 
	***/

require_once( dirname(__FILE__).'/CustomExceptions.php' );

class CalendarMaker{
	
	const REGEXP_DATE_PATTERN = "/^20[0-9]{2}-[0-1]{1}[0-9]{1}-[0-3]{1}[0-9]{1}$/";
	const REGEXP_YEARMONTH_PATTERN = "/^20[0-9]{2}-[0-1]{1}[0-9]{1}$/";
	const HOLIDAYS_CALENDAR_API_URL_FORMAT = "https://www.finds.jp/ws/calendar.php?l=1&t=h&y=%s&m=%s";
	
	const ERROR_MESSAGE_1 = "[CalendarMaker][ERROR] Date Format is Invalid. Expected format is (yyyy-mm-dd) : Input=";
	const ERROR_MESSAGE_2 = "[CalendarMaker][ERROR] YearMonth Format is Invalid. Expected format is (yyyy-mm) : Input=";
	
	private $baseDate;
	private $year;
	private $month;
	private $day;
	private $format;
	private $calendarList;
	
	public static $youbiNameList = array( 
	  "en_short" => array("","Mon","Tue","Wed","Thu","Fri","Sat","Sun"),
	  "en_long" => array("","Monday","TuesDay","Wednesday","Thursday","Friday","Saturday","Sunday"),
	  "jp_short" => array("","月","火","水","木","金","土","日"),
	  "jp_long" => array("","月曜日","火曜日","水曜日","木曜日","金曜日","土曜日","日曜日"));
	public static $monthNameList = array(
	  "num_filled_zero" => array("","01","02","03","04","05","06","07","08","09","10","11","12"),
	  "en_short" => array("","Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"),
	  "en_long" => array("","January","Febrary","March","April","May","June","July","August","September","October","November","December"),
	  "jp_inreki" => array("","睦月","如月","弥生","卯月","皐月","水無月","文月","葉月","長月","神無月","霜月","師走"));
	
	
	/*****************************************************************************************************************
	 * 
	 * コンストラクタ
	 * 
	***/
	function __construct( $baseDate="" , $format="en_short" )
	{
		date_default_timezone_set("Asia/Tokyo");
		
		if($baseDate == "") $baseDate = date("Y-m-d");
		if(!preg_match(self::REGEXP_DATE_PATTERN,$baseDate)) throw new InvalidFormatException(self::ERROR_MESSAGE_1.$baseDate);
		
		$this->baseDate = $baseDate;
		$this->format = $format;
		$tempArray = explode("-",$baseDate);
		$this->year = $tempArray[0];
		$this->month = $tempArray[1];
		$this->day = $tempArray[2];
	}


	/*****************************************************************************************************************
	 * 
	 * クラス内の日付の曜日を取得する関数
	 * 
	***/
	function getYoubiName($format="")
	{
		if($format == "") $format = $this->format;
		return self::getYoubiName_static($this->baseDate,$format);
	}


	/*****************************************************************************************************************
	 * 
	 * クラス内の日付の月の名称を取得する関数
	 * 
	***/
	function getMonthName($format="")
	{
		if($format == "") $format = $this->format;
		return self::getMonthName_static($this->baseDate,$format);
	}


	/*****************************************************************************************************************
	 * 
	 * クラス内の日付の月のカレンダー用の配列を作成する関数
	 * 
	***/
	function getMonthlyCalendarArray( $startYoubi="Mon",$format="" )
	{
		if($format == "") $format = $this->format;
		$this->calendarList = $this->getMonthlyCalendarArray_static($this->year."-".$this->month,$startYoubi,$format);
		
		return $this->calendarList;
	}


	/*****************************************************************************************************************
	 * 
	 * 指定した月のカレンダー用の配列を作成する関数
	 * 
	 *   - Input
	 *       - $baseMonth	: 月の名称を知りたい日付(yyyy-mm)
	 *       - $startYoubi	: カレンダーの最初の曜日(Mon,Tue...)。小文字で書いても大丈夫だけど、en_short形式で渡す。
	 *                        デフォルトはMon(月曜始まりカレンダー)
	 *       - $format		: 曜日の名称フォーマット。デフォルトはen_short。
	 *   - Output
	 *       - $calendarList	: カレンダー用になっている配列。(7×n個の配列)
	 *             -$calendarList["meta"][]		: カレンダー全体に関する情報
	 *             -$calendarList["header"][]	: 曜日が左から順に並んでいる。なお、配列は１から始まるので注意！
	 *             -$calendarList["body"][]		: 実際のカレンダー配列。なお、配列は1から始まるので要注意！
	 *               -$calendarList["body"][]["date"]	: 日付(yyyy-mm-dd)。前後の端数の日付も入っている。
	 *               -$calendarList["body"][]["youbi"]	: 曜日名。フォーマットはinputで指定されたフォーマット。
	 *               -$calendarList["body"][]["holi"]	: 祝日なら祝日名が入っている。祝日でなければ存在しない。
	 * 
	***/
	function getMonthlyCalendarArray_static( $baseMonth="", $startYoubi="Mon" , $format="en_short" )
	{
		if($baseMonth=="") $baseMonth = date("Y-m");
		if(!preg_match(self::REGEXP_YEARMONTH_PATTERN,$baseMonth)) throw new InvalidFormatException(self::ERROR_MESSAGE_2.$baseMonth);
		
		/***
		 * 
		 * カレンダーの開始曜日を変化させるための下準備
		 * 
		***/
		foreach( self::$youbiNameList["en_short"] as $key => $value)
		{
			if( strtolower($value) == strtolower($startYoubi) )
			{
				$youbiOffset = 7 - $key;
				$startYoubiNum = $key;
				$startYoubiStr= $value;
			}
		}
		if($youbiOffset==null) $youbiOffset=1;
		
		/***
		 * 
		 * カレンダー準備
		 * 
		***/
		$tempArray = explode("-",$baseMonth);
		$year = $tempArray[0];
		$month = $tempArray[1];
		
		$dayCount = date("t",mktime(0, 0, 0, $month, 1, $year));
		$startCol = (date("N",mktime(0, 0, 0, $month, 1, $year))+$youbiOffset) % 7;
		$rowCount = ceil(($startCol+$dayCount)/7);
		$calendarList = array();
		
		/***
		 * 
		 * meta情報作成
		 * 
		***/
		$calendarList["meta"]["year"] = $year;
		$calendarList["meta"]["month"] = $month;
		$calendarList["meta"]["count"] = $dayCount;
		$calendarList["meta"]["start"] = $startYoubiStr;
		$calendarList["meta"]["row"] = $rowCount;
		$calendarList["meta"]["next"] = date("Y-m",mktime(0, 0, 0, $month+1, 1, $year));
		$calendarList["meta"]["previous"] = date("Y-m",mktime(0, 0, 0, $month-1, 1, $year));
		
		/***
		 * 
		 * ヘッダ情報作成
		 * 
		***/
		for($i=1;$i<=7;$i++)
		{
			$youbiNum = ($startYoubiNum+$i-1) % 7;
			if( $youbiNum == 0 ) $youbiNum = 7;
			$calendarList["header"][$i] = self::$youbiNameList[$format][$youbiNum];
		}
		
		/***
		 * 
		 * Body情報（日付・曜日）作成
		 * 
		***/
		for($boxCount=1;$boxCount<$rowCount*7+1;$boxCount++)
		{
			$day = $boxCount-$startCol;
			$calendarList["body"][$boxCount]["date"] = date("Y-m-d",mktime(0,0,0,$month,$day,$year));
			$calendarList["body"][$boxCount]["youbi"] = self::$youbiNameList[$format][date("N",mktime(0,0,0,$month,$day,$year))];
		}
		
		/***
		 * 
		 * Body情報（祝日）作成
		 * 
		***/
		//$holidays = self::getHolidays_static( $year."-".$month );
		//
		//foreach( $calendarList["body"] as $key => $box )
		//{
		//	foreach( $holidays as $holiday )
		//	{
		//		if( $box["date"] == $holiday["date"] ) $calendarList["body"][$key]["holi"] = $holiday["name"];
		//	}
		//}
		
		return $calendarList;
	}


	/*****************************************************************************************************************
	 * 
	 * 指定した日付の曜日の名称を取得する関数
	 * 
	 *   - Input
	 *       - $baseDate	: 曜日の名称を知りたい日付(yyyy-mm-dd)
	 *       - $format		: 名称のフォーマット。デフォルトはen_short。
	 *   - Output
	 *       - String		: 曜日の名称
	 * 
	***/
	public static function getYoubiName_static( $baseDate , $format="en_short" )
	{
		if(!preg_match(self::REGEXP_DATE_PATTERN,$baseDate)) throw new InvalidFormatException(self::ERROR_MESSAGE_1.$baseDate);
		if( !array_key_exists($format,self::$youbiNameList) ) $format="en_short";
		
		$tempArray = explode("-",$baseDate);
		return self::$youbiNameList[$format][date("N",mktime(0, 0, 0, $tempArray[1], $tempArray[2], $tempArray[0]))];
	}


	/*****************************************************************************************************************
	 * 
	 * 指定した日付の月の名称を取得する関数
	 * 
	 *   - Input
	 *       - $baseDate	: 月の名称を知りたい日付(yyyy-mm-dd)
	 *       - $format		: 名称のフォーマット。デフォルトはen_short。
	 *   - Output
	 *       - String		: 指定月の名称
	 * 
	***/
	public static function getMonthName_static( $baseDate , $format="en_short" )
	{
		if(!preg_match(self::REGEXP_DATE_PATTERN,$baseDate)) throw new InvalidFormatException(self::ERROR_MESSAGE_1.$baseDate);
		if( !array_key_exists($format,self::$monthNameList) ) $format="en_short";
		
		$tempArray = explode("-",$baseDate);
		return self::$monthNameList[$format][intval($tempArray[1])];
	}


	/*****************************************************************************************************************
	 * 
	 * 農研のAPIを利用して、祝日のリストを取得する関数
	 * 
	 *   - Input
	 *       - $startMonth	: 取得開始の年月(yyyy-mm)
	 *       - $endMonth	: 取得最後の年月(yyyy-mm)。指定がなければstartMonthと同じ
	 *   - Output
	 *       - $holidays	: 祝日リストの配列
	 *           - $holidays[]["date"]	: 祝日の日付(yyyy-mm-dd)
	 *           - $holidays[]["name"]	: 祝日の名前(日本語)
	 * 
	***/
	public static function getHolidays_static( $startMonth , $endMonth="" )
	{
		if( $endMonth=="" ) $endMonth = $startMonth;
		if(!preg_match(self::REGEXP_YEARMONTH_PATTERN,$startMonth)) throw new InvalidFormatException(self::ERROR_MESSAGE_2.$startMonth);
		if(!preg_match(self::REGEXP_YEARMONTH_PATTERN,$endMonth)) throw new InvalidFormatException(self::ERROR_MESSAGE_2.$endMonth);
		
		$holidays = array();
		$reqMonthList = array();
		$i=0;
		
		$tempArray = explode("-",$startMonth);
		$year = intval($tempArray[0]);
		$month = intval($tempArray[1]);
		
		while( true )
		{
			$reqMonthList[] = $year."-".self::$monthNameList["num_filled_zero"][$month];
			if( $year."-".self::$monthNameList["num_filled_zero"][$month] == $endMonth ) break;
			$month++;
			if( $month == 13 ) { $year++; $month = 1; }
		}
		
		foreach( $reqMonthList as $reqMonth )
		{
			$tempArray = explode("-",$reqMonth);
			$url = sprintf( self::HOLIDAYS_CALENDAR_API_URL_FORMAT , $tempArray[0] , $tempArray[1] );
			
			$results = simplexml_load_string(file_get_contents($url));
			
			if( $results->status == "200" )
			{
				foreach ( $results->result->day as $item )
				{
					$holidays[$i]["date"] = $reqMonth."-".$item->mday;
					$holidays[$i]["name"] = strval($item->hname);
					$i++;
				}
			}
			else
			{
				exit("[ERROR] 祝日データ取得ミス：".$result->status);
			}
		}
		
		return $holidays;
	}

}


?>