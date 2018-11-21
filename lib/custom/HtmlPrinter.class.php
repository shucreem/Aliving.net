<?php

	/***
	 * 
	 * 作成日：2014-08-29
	 * 最終修正日：2014-09-01
	 * 
	 * 作成者：TakashiTsuyuguchi (pc@tazakazushi.net)
	 * 
	 * □ schedule.php (カレンダーページ)
	 * 
	 * GETでmonth(yyyy-mm)を受けとり、その年月のイベントデータをCSVから取得
	 * テンプレート($template)をベースにHTMLとして書き出す。
	 * 
	 * イベントデータのCSVは$data(./schedule_data/".$year.$month.".csv)として存在する。
	 * 
	 * monthが想定外の形式だった場合、指定されなかった場合にはその時の年月のカレンダーが表示される。
	 * その月のCSVが存在しない場合は表示がなくなってしまうので注意が必要。
	 * 
	 * << 参考 >>
	 *   ・ shcedule_init.php : 初期設定
	 *   ・ MyEventData.class.php : イベントデータをCSVから取得する
	 * 
	 * 
	***/
	
	
	class HtmlPrinter{
	
		private $template;
		private $replaceList;
		private $html;
	
		function __construct( $path )
		{
			if(!is_readable($path)) throw new FileNotFoundException( "[ERROR] ".$path." is not found." );
			$this->template = $path;
		}
	
	
		function addReplace($search,$replace)
		{
			$num = count($this->replaceList);
			$this->replaceList[$num]["search"] = $search;
			$this->replaceList[$num]["replace"] = $replace;
			
		}
	
	
		function printout()
		{
			$this->html = file_get_contents( $this->template );
			
			foreach( $this->replaceList as $replace )
			{
				$this->html = str_replace($replace["search"],$replace["replace"],$this->html);
			}
			
			print($this->html);
		}
	
	}


?>