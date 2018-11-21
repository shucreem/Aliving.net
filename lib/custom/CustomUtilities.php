<?php
	
	/***
	 * 
	 * 作成日：2014-09-05
	 * 最終修正日：2014-09-05
	 * 
	 * 作成者：TakashiTsuyuguchi (pc@tazakazushi.net)
	 * 
	 * << 参考URL >>
	 * マルチバイトを考慮したstr_replace関数
	 * https://p2b.jp/2008/12/03/mb_str_replace
	 * 
	***/

	function mb_str_replace($search, $replace, $target)
	{
		if(is_array($search))
		{
			if(!is_array($replace)) $replace = array($replace);
			
			foreach ($search as $i => $needle)
			{
				$rep = isset($replace[$i]) ? $replace[$i] : $replace[0];
				$target = my_str_replace($needle, $rep, $target);
			}
			return $target;
		}
		else
		{
			return my_str_replace($search, $replace, $target);
		}
	}

	function my_str_replace($search, $replace, $target, $encoding = 'utf-8')
	{
		$notArray = !is_array($target) ? TRUE : FALSE;
		$target = $notArray ? array($target) : $target;
		$search_len = mb_strlen($search, $encoding);
		$replace_len = mb_strlen($replace, $encoding);
		foreach ($target as $i => $tar)
		{
			$offset = mb_strpos($tar, $search);
			while ($offset !== FALSE)
			{
				$tar = mb_substr($tar, 0, $offset).$replace.mb_substr($tar, $offset + $search_len);
				$offset = mb_strpos($tar, $search, $offset + $replace_len);
			}
			$target[$i] = $tar;
		}
		return $notArray ? $target[0] : $target;
	}


?>
