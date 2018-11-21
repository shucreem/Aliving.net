<?php

	/***
	 * 
	 * 作成日：2014-08-29
	 * 最終修正日：2014-09-09
	 * 
	 * 作成者：TakashiTsuyuguchi (pc@tazakazushi.net)
	 * 
	 * << 説明 >>
	 *   ファイルを読み込んで配列に出力する。
	 * 
	 * << 関数 >>
	 *   - public static function getCsvData( 読み込むCSVファイルのPath , セパレータ ) @return array
	 *   - public static function getExcelData( 読み込むExcelファイルのPath , 読み込むシートの番号 ) @return array
	 * 
	***/


require_once( dirname(__FILE__).'/CustomExceptions.php' );
require_once( dirname(dirname(__FILE__)).'/default/PHPExcel_1.7.9/Classes/PHPExcel/IOFactory.php' );

class FileToArray{

	/****
	 *
	 * CSVから配列に読み込み
	 *   - CSVの１行目は連想配列のkeyとなる
	 *
	***/
	public static function getCsvData( $fileName,$separator="," )
	{
		
		if(!is_readable($fileName)){
			throw new FileNotFoundException($fileName." is not found.");
		}
		
		$file = fopen($fileName, "r");
		$dataList = array();
		$firstFlag = true;
		$i = 0;
		
		while (!feof($file))
		{
			$line = fgets($file);
			$line = mb_convert_encoding($line, "utf-8", "SJIS");
			
			if( $firstFlag == true )
			{
				$headerList = explode($separator,trim($line));
				$firstFlag = false;
			}
			else
			{
				$tempArray = explode($separator,trim($line));
				
				for($j=0;$j<count($tempArray);$j++)
				{
					$dataList[$i][$headerList[$j]] = $tempArray[$j];
				}
			}
			
			$i++;
		}
		fclose($file);
		return $dataList;
	}


	/****
	 *
	 * エクセルから配列に読み込み
	 *   - エクセルの１行目は連想配列のkeyとなる
	 *   - １行目が空ならばその列は読み捨てられる
	 *   - １列目が空の行がでた時点で、読み込みを終了する
	 *
	***/
	public static function getExcelData( $fileName, $sheetNum="0" )
	{
		if(!is_readable($fileName)){
			throw new FileNotFoundException("[ERROR] ".$fileName." is not found.");
		}
		
		/**
		 * Use PHPExcel Library
		 * 
		 * -> toArray function is to create array from worksheet
		 * @param mixed $nullValue Value returned in the array entry if a cell doesn't exist
		 * @param boolean $calculateFormulas Should formulas be calculated?
		 * @param boolean $formatData  Should formatting be applied to cell values?
		 * @param boolean $returnCellRef False - Return a simple array of rows and columns indexed by number counting from zero
		 *                               True - Return rows and columns indexed by their actual row and column IDs
		 * @return array
		 */
		
		$objPExcel = PHPExcel_IOFactory::load($fileName);
 		$excel = $objPExcel->setActiveSheetIndex($sheetNum)->toArray(null,true,true,true);
		
		$fieldNameList = $excel[1];
		
		for($i=2;$i<=count($excel);$i++)
		{
			if( $excel[$i]["A"] == "" ) break;
			
			foreach( $fieldNameList as $key => $fieldName )
			{
				if( $fieldName != "" ) $dataList[$i-2][$fieldName] = $excel[$i][$key];
			}
		}
		return $dataList;
	}
}

?>