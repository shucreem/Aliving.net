<?php

	/***
	 *
	 * 作成日：2014-08-29
	 * 最終修正日：2014-11-02
	 *
	 * << 説明 >>
	 * GETでdate(yyyy-mm-dd)を受けとり、その年月日のイベントデータをエクセルから取得
	 * テンプレートをベースにHTMLとして書き出す。
	 * dateが想定外の形式だった場合、イベントの存在しない日付が指定された場合には
	 * schedule.phpにリダイレクトされる。
	 *
	***/

	include_once( dirname(__FILE__).'/schedule_init.php' );

	/***
	 *
	 * 表示する日付の取得
	 *
	***/

	$pattern = "/^20[0-9]{2}-[0-1]{1}[0-9]{1}-[0-3]{1}[0-9]{1}$/";
	if( !(array_key_exists("date",$_GET) && preg_match($pattern, $_GET["date"])) )
	{
		if(  DEBUG_MODE === true ) {
			exit("[ERROR][schedule_detail.php] クエリパラメータ(yyyy-mm-dd)が不正です。 入力値：".$_GET["date"]);
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

	$date = $_GET["date"];
	$yearMonth = substr($date,0,7);
	$pageUrl = BASE_URL."/schedule_detail.php?date=".$date;

	$calendar = new CalendarMaker($date);
	$calData = $calendar->getMonthlyCalendarArray("Mon");

	$placeList = getList("PLACE_LIST_STR");
	$infoList = getList("INFO_LIST_STR");
	$detailList = getList("DETAIL_LIST_STR");

	$excelFileName = getExcelPath($yearMonth);
	if( $excelFileName === false )
	{
		if(  DEBUG_MODE === true ) {
			exit("[ERROR][schedule.php] 指定された年月のExcelがありません。 指定年月：".$yearMonth);
		} else {
			header("Location: ".BASE_URL."/index.php");
		}
	}

	try{
		$excelSheetNum = 0;
		$excel = new FileToArray();
		$eventMonthList = formEventData($excel->getExcelData($excelFileName,$excelSheetNum));
	} catch( InvalidFormatException $e ) {
		if( DEBUG_MODE === true ) {
			print($e->getMessage());
			exit();
		} else {
			header("Location: ".BASE_URL."/schedule.php");
			exit();
		}
	}


	/***
	 *
	 * 指定日付のイベントが存在しなければschedule.phpにリダイレクト
	 *
	***/

	$flag = false;
	foreach( $eventMonthList as $event )
	{
		if( $event["date"] == $date )
		{
			$flag = true;
			foreach( $placeList as $place ) {
				if( $event["place"] == $place ) $eventDayList[$place][] = $event;
			}
		}
	}

	if( $flag == false ) {
		if( DEBUG_MODE === true ) {
			exit("[WARN][schedule_detail.php] 指定された日にイベントはありません。");
		} else {
			header("Location: ".BASE_URL."/schedule.php?month=".$calData["meta"]["previous"]);
			exit();
		}
	}


	/***
	 *
	 * scroll_calendarの作成
	 *
	***/

	$content = file_get_contents( SCHEDULE_DETAIL_TEMPLATE );
	$content = str_replace("***CANONICAL_URL***", $pageUrl, $content);
	$content = str_replace("***BASE_URL***", BASE_URL, $content);
	$doc = phpQuery::newDocument($content);

	$selector = "#scroll_menu_schedule .menu_title";
	$textStr = strtoupper($calendar->getMonthName("en_long"));
	pq($selector)->text($textStr);

	if( $calData["meta"]["row"] == 5 ) pq('#row6')->remove();

	for($i=1;$i<=count($calData["body"]);$i++)
	{
		$cellNum = ((floor(($i-1)/7)+1)*10)+($i-floor(($i-1)/7)*7);

		if( strpos($calData["body"][$i]["date"],$yearMonth) === 0 )
		{
			$selector = "#cell".$cellNum." .calendar_box";
			$appendStr = "<a href=\"".BASE_URL."/schedule_detail.php?date=".$calData["body"][$i]["date"]."\"></a>";
			pq($selector)->append($appendStr);

			$selector = "#cell".$cellNum." .calendar_box a";
			$appendStr = "<div class=\"calendar_date ".strtolower($calData["body"][$i]["youbi"])."\">".substr($calData["body"][$i]["date"],8,2)."</div>";
			pq($selector)->append($appendStr);
		}
	}


	/***
	 *
	 * content_header のHTML生成
	 *
	***/

	$selector = "#title_date";
	$textStr = str_replace("-",".",$date)."(".strtolower($calendar->getYoubiName("en_short")).")";
	pq($selector)->text($textStr);

	$selector = "#schedule_back a";
	$attrStr = BASE_URL."/schedule.php?month=".$yearMonth;
	pq($selector)->attr("href",$attrStr);

	/***
	 *
	 * content_body のHTML生成
	 *
	***/

	foreach( $placeList as $place )
	{
		if( count($eventDayList[$place]) > 0 )
		{
			pq("#content_body #sample_event_table")->clone()->attr("id",$place."_table")->appendTo("#content_body");
			$selectTable = "#".$place."_table";

			pq($selectTable." th")->addClass("bg_".$place);
			pq($selectTable." th img")->attr("src", BASE_URL."/image/schedule_".$place.".png");

			foreach( $eventDayList[$place] as $key => $event )
			{
				if( $key != 0 ) { pq($selectTable." .events_container")->append("<hr class=\"max\">"); }

				pq($selectTable." #sample_single_event")->clone()->attr("id",$place."_event_".$key)->appendTo($selectTable." .events_container");
				$selectEvent = "#".$place."_event_".$key;

				/***
				 *
				 * フライヤー
				 *
				***/
				if( $event["flyer1_name"] != "" || $event["flyer2_name"] != "" )
				{
					if( $event["flyer1_name"] != "" ){
						pq($selectEvent." #sample_event_flyer")->clone()->attr("id",$place."_event_flyer_1")->appendTo($selectEvent." .event_flyer_box");
						pq($selectEvent." #".$place."_event_flyer_1")->addClass($event["flyer1_style"]);
						pq($selectEvent." #".$place."_event_flyer_1 a")->attr("href", BASE_URL."/image/schedule/".$event["flyer1_name"]);
						pq($selectEvent." #".$place."_event_flyer_1 img")->attr("src", BASE_URL."/image/schedule/".$event["flyer1_name"]);
					}
					if( $event["flyer2_name"] != "" ){
						pq($selectEvent." #sample_event_flyer")->clone()->attr("id",$place."_event_flyer_2")->appendTo($selectEvent." .event_flyer_box");
						pq($selectEvent." #".$place."_event_flyer_2")->addClass($event["flyer2_style"]);
						pq($selectEvent." #".$place."_event_flyer_2 a")->attr("href", BASE_URL."/image/schedule/".$event["flyer2_name"]);
						pq($selectEvent." #".$place."_event_flyer_2 img")->attr("src", BASE_URL."/image/schedule/".$event["flyer2_name"]);
					}
				} else {
					pq($selectEvent." .event_flyer_box")->remove();
				}

				/***
				 *
				 * タイトル
				 *
				***/

				pq($selectEvent." .event_info_title")->html($event["title"]);

				if( $event["subtitle"] != "" ) {
					//pq($selectEvent." .event_info_subtitle")->text($event["subtitle"]);
					pq($selectEvent." .event_info_subtitle")->html($event["subtitle"]);
				} else {
					pq($selectEvent." .event_info_subtitle")->remove();
				}

				/***
				 *
				 * INFORMATION
				 *
				***/

				foreach( $infoList as $name )
				{
					if( $event[$name] != "" ) {
						pq($selectEvent." .info_".$name)->html($event[$name]);
					} else {
						pq($selectEvent." .info_".$name)->remove();
					}
				}
				if( $event["ust"] == "" ) pq($selectEvent." .info_ust")->remove();

				/***
				 *
				 * 詳細
				 *
				***/

				$existFlag = false;
				foreach( $detailList as $name ) { if ( $event[$name] != "" ) $existFlag = true; }
				if( $existFlag == true )
				{
					if( $event["catchcopy"] != "" ) {
						pq($selectEvent." .info_catchcopy")->html($event["catchcopy"]);
					} else {
						pq($selectEvent." .info_catchcopy")->remove();
					}

					if( $event["text"] != "" ) {
						pq($selectEvent." .info_text")->html($event["text"]);
					} else {
						pq($selectEvent." .info_text")->remove();
					}

					if( $event["pc_url"] != "" ) {
						pq($selectEvent." .info_pc_url a")->text($event["pc_url"]);
						pq($selectEvent." .info_pc_url a")->attr("href",$event["pc_url"]);
					} else {
						pq($selectEvent." .info_pc_url")->remove();
					}

					if( $event["other_url"] != "" ) {
						pq($selectEvent." .info_other_url a")->text($event["other_url"]);
						pq($selectEvent." .info_other_url a")->attr("href",$event["other_url"]);
					} else {
						pq($selectEvent." .info_other_url")->remove();
					}

					if( $event["twitter"] != "" ) {
						if( strpos($event["twitter"],",") )
						{
							$twList = explode(",",$event["twitter"]);
							foreach($twList as $key => $twLink)
							{
								pq($selectEvent." #twitter_sample")->clone()->attr("id","tw_".$key)->appendTo($selectEvent." .info_urls");
								pq($selectEvent." #tw_".$key." a")->attr("href",$twLink);
								$tempArray = explode("/",strrev($twLink));
								$twName = "@".strrev($tempArray[0]);
								$twHtml = pq($selectEvent." #tw_".$key." a")->html()." ".$twName;
								pq($selectEvent." #tw_".$key." a")->html($twHtml);
							}
							pq($selectEvent." #twitter_sample")->remove();
						} else {
							pq($selectEvent." .info_twitter a")->attr("href",$event["twitter"]);
						}
					} else {
						pq($selectEvent." .info_twitter")->remove();
					}

					if( $event["facebook"] != "" ) {
						pq($selectEvent." .info_facebook a")->attr("href",$event["facebook"]);
					} else {
						pq($selectEvent." .info_facebook")->remove();
					}

					if( $event["mixi"] != "" ) {
						pq($selectEvent." .info_mixi a")->attr("href",$event["mixi"]);
					} else {
						pq($selectEvent." .info_mixi")->remove();
					}

				}
				else
				{
					pq($selectEvent." hr")->remove();
					pq($selectEvent." .event_detail_box")->remove();
				}
			}
		}
	}


	/***
	 *
	 * sample部分の削除
	 *
	***/

	pq("#sample_event_flyer")->remove();
	pq("#sample_single_event")->remove();
	pq("#sample_event_table")->remove();


	/***
	 *
	 * HTML出力
	 *
	***/

	print($doc->htmlOuter());


?>
