<?php

	/***
	 * 
	 * �쐬���F2014-08-29
	 * �ŏI�C�����F2014-09-01
	 * 
	 * �쐬�ҁFTakashiTsuyuguchi (pc@tazakazushi.net)
	 * 
	 * �� schedule.php (�J�����_�[�y�[�W)
	 * 
	 * GET��month(yyyy-mm)���󂯂Ƃ�A���̔N���̃C�x���g�f�[�^��CSV����擾
	 * �e���v���[�g($template)���x�[�X��HTML�Ƃ��ď����o���B
	 * 
	 * �C�x���g�f�[�^��CSV��$data(./schedule_data/".$year.$month.".csv)�Ƃ��đ��݂���B
	 * 
	 * month���z��O�̌`���������ꍇ�A�w�肳��Ȃ������ꍇ�ɂ͂��̎��̔N���̃J�����_�[���\�������B
	 * ���̌���CSV�����݂��Ȃ��ꍇ�͕\�����Ȃ��Ȃ��Ă��܂��̂Œ��ӂ��K�v�B
	 * 
	 * << �Q�l >>
	 *   �E shcedule_init.php : �����ݒ�
	 *   �E MyEventData.class.php : �C�x���g�f�[�^��CSV����擾����
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