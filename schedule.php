<?php
	
	/***
	 * 
	 * 作成日：2014-08-29
	 * 最終修正日：2014-09-10
	 * 
	 * << 説明 >>
	 * GETでmonth(yyyy-mm)を受けとり、その年月のイベントデータをエクセルから取得
	 * monthが想定外の形式だった場合、指定されなかった場合にはその時の年月のカレンダーが表示される。
	 * その月のエクセルが存在しない場合は表示がなくなってしまうので注意が必要。
	 * 
	***/
	
	include_once( dirname(__FILE__).'/schedule_init.php' );
	
	/***
	 * 
	 * 表示する年月の取得（なかったらその日の年月）
	 * 
	***/
	
	if( !array_key_exists("month",$_GET) ) {
		$yearMonth = date("Y-m");
	}else{
		$yearMonth = $_GET["month"];
	}
	
	if( !preg_match("/^20[0-9]{2}-[0-1]{1}[0-9]{1}$/", $yearMonth) )
	{
		if(  DEBUG_MODE === true ) {
			exit("[WARN][schedule.php] 指定年月のフォーマットが違います。 入力値： ".$yearMonth);
		} else {
			header("Location: ".BASE_URL."/schedule.php");
			exit();
		}
	}
	
	
	/***
	 * 
	 * カレンダー用の配列の準備・イベント情報の取得
	 * 
	***/
	
	$placeList = getList("PLACE_LIST_STR");
	$pageUrl = BASE_URL."/schedule.php?month=".$yearMonth;
	
	$calendar = new CalendarMaker($yearMonth."-01");
	$calData = $calendar->getMonthlyCalendarArray("Mon");
	
	$excelFileName = getExcelPath($yearMonth);
	if( $excelFileName === false )
	{
		if(  DEBUG_MODE === true ) {
			exit("[ERROR][schedule.php] 指定された年月のExcelがありません。 指定年月：".$yearMonth);
		} else {
			header("Location: ".BASE_URL."/index.php");
			exit();
		}
	}
	
	try{
		$excelSheetNum = 0;
		$excel = new FileToArray();
		$eventList = formEventData($excel->getExcelData($excelFileName,$excelSheetNum));
	} catch( InvalidFormatException $e ) {
		if( DEBUG_MODE === true ) {
			print($e->getMessage());
			exit();
		} else {
			header("Location: ".BASE_URL."/index.php");
			exit();
		}
	}
	
	
	/***
	 * 
	 * HTML生成
	 * 
	***/
	
	$content = file_get_contents( SCHEDULE_TEMPLATE );
	$content = str_replace("***BASE_URL***", BASE_URL, $content);
	$content = str_replace("***CANONICAL_URL***", $pageUrl, $content);
	$doc = phpQuery::newDocument($content);
	
	$selector = "#schedule_navi_month_num";
	$textStr = $calendar->getMonthName("num_filled_zero");
	pq($selector)->text($textStr);
	
	$selector = "#schedule_navi_month_str";
	$htmlStr = strtoupper($calendar->getMonthName("en_long"))."<br>SCHEDULE";
	pq($selector)->html($htmlStr);

	if( getExcelPath($calData["meta"]["previous"]) )
	{
		$attrStr = BASE_URL."/schedule.php?month=".$calData["meta"]["previous"];
		pq("#schedule_navi_left a")->attr("href",$attrStr);
	} else {
		pq("#schedule_navi_left")->remove();
	}

	if( getExcelPath($calData["meta"]["next"]) )
	{
		$attrStr = BASE_URL."/schedule.php?month=".$calData["meta"]["next"];
		pq("#schedule_navi_right a")->attr("href",$attrStr);
	} else {
		pq("#schedule_navi_right")->remove();
	}
	
	
	/***
	 * 
	 * カレンダーのHTML生成
	 * 
	***/
	
	for($i=1;$i<=count($calData["body"]);$i++)
	{
		$cellNum = ((floor(($i-1)/7)+1)*10)+($i-floor(($i-1)/7)*7);
		
		if( strpos($calData["body"][$i]["date"],$yearMonth) === 0 )
		{
			$selector = "#cell".$cellNum." .calendar_box";
			$appendStr = "<div class=\"calendar_date\">".substr($calData["body"][$i]["date"],8,2)."</div>";
			pq($selector)->append($appendStr);
			
			$selector = "#cell".$cellNum." .calendar_box";
			$appendStr = "<a href=\"".BASE_URL."/schedule_detail.php?date=".$calData["body"][$i]["date"]."\"></a>";
			pq($selector)->append($appendStr);
			
			foreach($eventList as $event)
			{
				if( $event["date"] == $calData["body"][$i]["date"] )
				{
					foreach( $placeList as $place )
					{
						if( $event["place"] == $place )
						{
							$selector = "#cell".$cellNum." .calendar_box a";
							$appendStr = "<div class=\"calendar_element bg_".$place."\">".$event["title"]."</div>";
							pq($selector)->append($appendStr);
						}
					}
				}
			}
		}
	}
	
	if( $calData["meta"]["row"] == 5 ) pq('#row6')->remove();
	
	
	/***
	 * 
	 * HTML出力
	 * 
	***/
	
	print($doc->htmlOuter());
	
?>
