<?php

class MyEventData{

	function getData($fileName)
	{
		
		if(!is_readable($fileName)){
			throw new FileNotFoundException($fileName." is not found.");
		}
		
		$separator = "|";
		$file = fopen($fileName, "r");
		$dataset = array();
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
					$dataset[$i][$headerList[$j]] = $tempArray[$j];
				}
			}
			
			$i++;
		}
		fclose($file);
		return $dataset;
	}

}

class FileNotFoundException extends Exception { }


?>