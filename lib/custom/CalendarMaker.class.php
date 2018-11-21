<?php

	/***
	 * 
	 * �쐬���F2014-09-02
	 * �ŏI�C�����F2014-09-03
	 * 
	 * �쐬�ҁFTakashiTsuyuguchi (pc@tazakazushi.net)
	 * 
	 * - CalendarMaker.class.php
	 *     - �J�����_�[�E���t�֘A�̏������܂Ƃ߂��N���X
	 *     - �f�t�H���g�ł͎��s���ꂽ���̓��t�𗘗p���邪�A�����̎w�肪�\
	 * 
	 * << �Q�l >>
	 * �_���@�\ - �j���E�j���v�Z�T�[�r�X
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
	  "jp_short" => array("","��","��","��","��","��","�y","��"),
	  "jp_long" => array("","���j��","�Ηj��","���j��","�ؗj��","���j��","�y�j��","���j��"));
	public static $monthNameList = array(
	  "num_filled_zero" => array("","01","02","03","04","05","06","07","08","09","10","11","12"),
	  "en_short" => array("","Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"),
	  "en_long" => array("","January","Febrary","March","April","May","June","July","August","September","October","November","December"),
	  "jp_inreki" => array("","�r��","�@��","�퐶","�K��","�H��","������","����","�t��","����","�_����","����","�t��"));
	
	
	/*****************************************************************************************************************
	 * 
	 * �R���X�g���N�^
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
	 * �N���X���̓��t�̗j�����擾����֐�
	 * 
	***/
	function getYoubiName($format="")
	{
		if($format == "") $format = $this->format;
		return self::getYoubiName_static($this->baseDate,$format);
	}


	/*****************************************************************************************************************
	 * 
	 * �N���X���̓��t�̌��̖��̂��擾����֐�
	 * 
	***/
	function getMonthName($format="")
	{
		if($format == "") $format = $this->format;
		return self::getMonthName_static($this->baseDate,$format);
	}


	/*****************************************************************************************************************
	 * 
	 * �N���X���̓��t�̌��̃J�����_�[�p�̔z����쐬����֐�
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
	 * �w�肵�����̃J�����_�[�p�̔z����쐬����֐�
	 * 
	 *   - Input
	 *       - $baseMonth	: ���̖��̂�m�肽�����t(yyyy-mm)
	 *       - $startYoubi	: �J�����_�[�̍ŏ��̗j��(Mon,Tue...)�B�������ŏ����Ă����v�����ǁAen_short�`���œn���B
	 *                        �f�t�H���g��Mon(���j�n�܂�J�����_�[)
	 *       - $format		: �j���̖��̃t�H�[�}�b�g�B�f�t�H���g��en_short�B
	 *   - Output
	 *       - $calendarList	: �J�����_�[�p�ɂȂ��Ă���z��B(7�~n�̔z��)
	 *             -$calendarList["meta"][]		: �J�����_�[�S�̂Ɋւ�����
	 *             -$calendarList["header"][]	: �j���������珇�ɕ���ł���B�Ȃ��A�z��͂P����n�܂�̂Œ��ӁI
	 *             -$calendarList["body"][]		: ���ۂ̃J�����_�[�z��B�Ȃ��A�z���1����n�܂�̂ŗv���ӁI
	 *               -$calendarList["body"][]["date"]	: ���t(yyyy-mm-dd)�B�O��̒[���̓��t�������Ă���B
	 *               -$calendarList["body"][]["youbi"]	: �j�����B�t�H�[�}�b�g��input�Ŏw�肳�ꂽ�t�H�[�}�b�g�B
	 *               -$calendarList["body"][]["holi"]	: �j���Ȃ�j�����������Ă���B�j���łȂ���Α��݂��Ȃ��B
	 * 
	***/
	function getMonthlyCalendarArray_static( $baseMonth="", $startYoubi="Mon" , $format="en_short" )
	{
		if($baseMonth=="") $baseMonth = date("Y-m");
		if(!preg_match(self::REGEXP_YEARMONTH_PATTERN,$baseMonth)) throw new InvalidFormatException(self::ERROR_MESSAGE_2.$baseMonth);
		
		/***
		 * 
		 * �J�����_�[�̊J�n�j����ω������邽�߂̉�����
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
		 * �J�����_�[����
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
		 * meta���쐬
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
		 * �w�b�_���쐬
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
		 * Body���i���t�E�j���j�쐬
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
		 * Body���i�j���j�쐬
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
	 * �w�肵�����t�̗j���̖��̂��擾����֐�
	 * 
	 *   - Input
	 *       - $baseDate	: �j���̖��̂�m�肽�����t(yyyy-mm-dd)
	 *       - $format		: ���̂̃t�H�[�}�b�g�B�f�t�H���g��en_short�B
	 *   - Output
	 *       - String		: �j���̖���
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
	 * �w�肵�����t�̌��̖��̂��擾����֐�
	 * 
	 *   - Input
	 *       - $baseDate	: ���̖��̂�m�肽�����t(yyyy-mm-dd)
	 *       - $format		: ���̂̃t�H�[�}�b�g�B�f�t�H���g��en_short�B
	 *   - Output
	 *       - String		: �w�茎�̖���
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
	 * �_����API�𗘗p���āA�j���̃��X�g���擾����֐�
	 * 
	 *   - Input
	 *       - $startMonth	: �擾�J�n�̔N��(yyyy-mm)
	 *       - $endMonth	: �擾�Ō�̔N��(yyyy-mm)�B�w�肪�Ȃ����startMonth�Ɠ���
	 *   - Output
	 *       - $holidays	: �j�����X�g�̔z��
	 *           - $holidays[]["date"]	: �j���̓��t(yyyy-mm-dd)
	 *           - $holidays[]["name"]	: �j���̖��O(���{��)
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
				exit("[ERROR] �j���f�[�^�擾�~�X�F".$result->status);
			}
		}
		
		return $holidays;
	}

}


?>