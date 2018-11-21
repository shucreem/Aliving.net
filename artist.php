<?php
	
	if( isset($_GET["id"]) )
	{
		$id = $_GET["id"];
		
		if( is_numeric($id) )
		{
		
			$fileName = "profile/".$id.".txt";
			$profile = explode(",",file_get_contents($fileName));
	
			$html = file_get_contents("profile/template.txt");
			$html = str_replace("%%TITLE%%",$profile[0],$html);
			$html = str_replace("%%IMAGE%%","profile/".$profile[1],$html);
			$html = str_replace("%%NAME%%",$profile[2],$html);
			$html = str_replace("%%CATEGORY%%",$profile[3],$html);
			$html = str_replace("%%GENRE%%",$profile[4],$html);
			$html = str_replace("%%DESCRIPTION%%",$profile[5],$html);
			$html = str_replace("%%HISTORY%%",$profile[6],$html);
		}
		else
		{
			$html = file_get_contents("artist.html");
		}
	}
	else
	{
		$html = file_get_contents("artist.html");
	}

	print($html);

?>