<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="description" content="新宿2丁目の遊び場！クラブ、Bar、カフェなど系列店舗合同ウェブサイト。イベントスケジュール、一押しメニューなど、最新の情報をご紹介します。">
<meta name="keywords" content="AiSOTOPE LOUNGE(アイソトープラウンジ),ALAMAS CAFE(アラマスカフェ),AiiRO CAFE(アイイロカフェ),and(アンド),新宿,2丁目,レンタルスペース,ライブ,イベント,ハウス,パーティー" />
<meta http-equiv=”cache-control” content=”no-cache” />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ALAMAS CAFE / AiSOTOPE LOUNGE / AiiRO CAFE</title>

<meta property="og:title" content="ALAMAS CAFE / AiSOTOPE LOUNGE / AiiRO CAFE" />
<meta property="og:type" content="website" />
<meta property="og:description" content="新宿2丁目の遊び場！クラブ、Bar、カフェなど系列店舗合同ウェブサイト。イベントスケジュール、一押しメニューなど、最新の情報をご紹介します。" />
<meta property="og:url" content="https://aliving.net" />
<meta property="og:site_name" content="ALAMAS CAFE / AiSOTOPE LOUNGE / AiiRO CAFE" />
<meta property="og:image" content="" />

<link rel="shortcut icon" href="image/favicon.ico" />
<link href="style.css?20190730" rel="stylesheet" type="text/css" />
<link rel="canonical" href="https://aliving.net" />
<link href="lightbox.css" rel="stylesheet" />
<link href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/scrolltopcontrol.js"></script>
<script type="text/javascript" src="js/lightbox.js"></script>
<script type="text/javascript" src="js/ofi.min.js"></script>

<script type="text/javascript">
(function($) {
	$(function() {
		$("#scroller").simplyScroll();
	});
})(jQuery);
</script>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>

<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-12108310-14', 'aliving.net');
  ga('send', 'pageview');
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}

$(function(){
	var setImg = '#viewer';
	var fadeSpeed = 1500;
	var switchDelay = 5000;

	$(setImg).children('img').css({opacity:'0'});
	$(setImg + ' img:first').stop().animate({opacity:'1',zIndex:'20'},fadeSpeed);

	setInterval(function(){
		$(setImg + ' :first-child').animate({opacity:'0'},fadeSpeed).next('img').animate({opacity:'1'},fadeSpeed).end().appendTo(setImg);
	},switchDelay);
});

$(function(){

	var targetMonth = "";
	var todayDate = new Date();
	var changeDate = new Date(2020, 4-1, 1);

	if( todayDate.getTime() > changeDate.getTime() ){
		$("#this_month").hide();
		targetMonth = "#next_month";
	}else{
		$("#next_month").hide();
		targetMonth = "#this_month";
	}
});
</script>

<script type="text/javascript">
	var currentImage;
    var currentIndex = -1;
    var interval;
    function showImage(index){
        if(index < $('#bigPic img').length){
        	var indexImage = $('#bigPic img')[index]
            if(currentImage){
            	if(currentImage != indexImage ){
                    $(currentImage).css('z-index',2);
                    clearTimeout(myTimer);
                    $(currentImage).fadeOut(250, function() {
					    myTimer = setTimeout("showNext()", 3000);
					    $(this).css({'display':'none','z-index':1})
					});
                }
            }
            $(indexImage).css({'display':'block', 'opacity':1});
            currentImage = indexImage;
            currentIndex = index;
            $('#thumbs li').removeClass('active');
            $($('#thumbs li')[index]).addClass('active');
        }
    }

    function showNext(){
        var len = $('#bigPic img').length;
        var next = currentIndex < (len-1) ? currentIndex + 1 : 0;
        showImage(next);
    }

    var myTimer;

    $(document).ready(function() {
	    myTimer = setTimeout("showNext()", 3000);
		showNext(); //loads first image
        $('#thumbs li').bind('click',function(e){
        	var count = $(this).attr('rel');
        	showImage(parseInt(count)-1);
        });
	});
	</script>

	<script>
	  objectFitImages('img.object-fit-img');
	</script>

</head>
<body class="mainbody">
<div id="big-container">

<div class="lead-txt"><p>新宿2丁目の遊び場！クラブ、Bar、カフェなど系列店舗合同ウェブサイト | <a href="https://translate.google.com/translate?hl=en&sl=ja&tl=en&u=https://aliving.net">ENGLISH</a></p></div>
<div class="sns_icon"><a href="https://twitter.com/AiSOTOPE_LOUNGE" target="_blank"><i class="fa fa-twitter-square" aria-hidden="true"></i></a><a href="https://www.facebook.com/AiSOTOPE.info/" target="_blank"><i class="fa fa-facebook-square" aria-hidden="true"></i></a><a href="https://www.instagram.com/aisotope_lounge/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></div>
<div id="header"></div>

<div id="header-navi">

<ul id="navi">
<li><a href="index.php">INFORMATION</a></li>
<li><a href="schedule.php">SCHEDULE</a></li>
<li><a href="menu.html">MENU</a></li>
<li><a href="artist.html">ARTIST</a></li>
<li><a href="access.html">ACCESS</a></li>
<li><a href="rental.html">RENTAL</a></li>
<li><a href="link.html">LINK</a></li>
<li><a href="english.html">ENGLISH</a></li>
</ul>

</div>
<!--headerここまで-->

<div id="container">

<div id="content">

					<div id="showcase">
						<div id="bigPic">
							<a href="https://lin.ee/cpgn0Fg" target="_blank"><img src="slideimg/top_line.jpg" alt="" /></a>
							<a href="https://note.com/cappellasistina" target="_blank"><img src="slideimg/top_info2020.jpg" alt="" /></a>
							<a href="https://aliving.net/AVANTGARDE/" target="_blank"><img src="slideimg/top_2.jpg" alt="" /></a>
							<a href="https://aliving.net/aiirocafe/" target="_blank"><img src="slideimg/top_5.jpg" alt="" /></a>

<!-- 						<a href="https://aliving.net/wanted.html" onclick="window.open('wanted.html','foo','width=540,height=500,scrollbars=yes'); return false;" target="_blank"><img src="slideimg/top_4.jpg" alt="" /></a> -->
<!-- 						<a href="https://twitter.com/queenslounge_ts" target="_blank"><img src="slideimg/top_6.jpg" alt="" /></a> -->
						</div><!--bigPic-->
						<div id="smallPic">
							<ul id="thumbs">
							<li class="active" rel="1"><img src="slideimg/top_line.jpg" class="object-fit-img"></li>
							<li rel="2"><img src="slideimg/top_info2020.jpg" class="object-fit-img"></li>
							<li rel="3"><img src="slideimg/top_2.jpg" class="object-fit-img"></li>
							<li rel="4"><img src="slideimg/top_5.jpg" class="object-fit-img"></li>

<!-- 							<li rel="2"><img src="slideimg/top_4.jpg" class="object-fit-img"></li>
							<li rel="4"><img src="slideimg/top_6.jpg" class="object-fit-img"></li> -->						
							</ul>
						</div><!-- thumbs -->
					</div><!-- showcase -->


<div class="sp_layout"><!--sp_layout-->
		<div id="info-left">

			<h1 class="menu-title">INFORMATION</h1>

			<div id="infoscroll">
				<hr style="height: 1px; border: none; border-top: 1px #BABECB dotted;">

<!--
<span class="arch">ArcH</span><span class="aiso">AiSOTOPE</span><span class="alamas">ALAMAS CAFE</span><span class="aiiro">AiiRO CAFE</span>
<span class="avan">AVANTGARDE</span>
-->

<div class="block">
	<span class="date">2020.7.3(fri)</span>
		<p class="info-text">
			<a href="https://aliving.net/schedule.php?month=2020-07">7月のスケジュール</a>を更新しました。<br />
		</p>
</div>

<div class="block">
	<span class="date">2020.4.28(wed) </span>
		<p class="info-text">
			<span class="aiso" style="margin-left: 0">AiSOTOPE LOUNGE</span><br>
			現在、営業自粛期間中に伴い、臨時休業とさせていただいておりますが、今後の営業再開に関しましては、感染拡大状況や政府・行政の方針等の情報を見極めた上で検討いたします。<br> 5月イベントスケジュールは、再開の目処が立ちましたらお知らせいたします。
		</p>
</div>

<div class="block">
	<span class="date">2020.3.26(thu) </span>
		<p class="info-text">
			【重要なお知らせ】<span class="aiso">AiSOTOPE LOUNGE</span><br>
			<a href="image/information0326.pdf" target="_blank">新型コロナウイルス感染拡大予防に伴う、イベントの開催中止・延期ならびに臨時休業のお知らせです。</a><br>
			苦渋の決断ではございますが、ご理解賜りますようお願い申し上げます。
		</p>
</div>

<div class="block">
	<span class="date">2020.3.23(mon) </span>
		<p class="info-text">
			【定休日変更のお知らせ】<span class="alamas">ALAMAS CAFE</span><br>
			日頃よりALAMAS CAFEをご愛顧いただきありがとうございます。<br>
			誠に勝手ながら、4月よりしばらくの間、定休日を下記の通り変更させていただきます。<br>
			<br>
			定休日：月曜日・火曜日<br>
			※営業時間に変更はございません<br>
			※祝前日など日程により翌日を振替休日とさせていただく場合がございます予めご了承ください。<br>
			<br>
			お客様にはご迷惑をお掛けいたしますが、今後ともALAMAS CAFEをよろしくお願い申し上げます。<br>
			<a href="image/alamas_closed.jpg"  rel="lightbox[INFORMATION-ALAMAS CAFE]"><img src="image/alamas_closed.jpg" width="200px"></a>
		</p>
</div>

<div class="block">
	<span class="date">2020.3.06(fri)</span>
		<p class="info-text">
			【重要なお知らせ】<br>
			新型コロナウイルス感染拡大予防に伴う、イベント運営及びご来場に際して、趣旨をご理解いただき、下記ご協力のほどお願い致します。<br>
			<br>
			・会場内でのマスクの着用など、ご来場者様ご自身で感染予防対策をお願い致します。<br>
			・エントランス付近に手指消毒用のアルコール消毒液を設置致しますので利用後にご入店ください。<br>
			　※アレルギーの方、手荒れが酷い方はトイレにて手洗いをしてからイベントをお楽しみください。<br>
			・BAR付近において、約2時間に1回程、バーカウンターの消毒・除菌を目的とした清掃を行います。<br>
			　近隣でお楽しみいただいている方には恐縮ですがご協力を宜しくお願い致します。<br>
			・ご来場者様及びスタッフへの感染防止を考慮し、一部スタッフはマスク着用でのご案内をさせていただきますが
			　マスク不足の状況下のため、マスク着用は強制ではございませんのでご了承ください。<br>
			・ご入場時のIDチェックの際に一度マスクを取り外しを依頼させていただく場合もございますので予めご了承ください。<br>
			・ご入場時に非接触系体温計で体温確認を行い、37.5度以上のお客様・体調が優れない方の入店をお断りさせていただきます。<br>
			　遠方から来られるお客様はご自宅で1度測られてからお越しください。<br>
			<br>
			行政の方針、感染拡大状況など今後の情勢によっては、お客様・出演者・スタッフの健康と安全を最優先に考慮し、<br>
			イベント開催の中止・延期・内容の変更をさせていただく可能性がございます。予めご了承ください。<br>
			<br>
			2020年3月6日<br>
			株式会社カペラシスティーナ / AiSOTOPE LOUNGE<br>
			<a href="image/20200316_info.jpg"  rel="lightbox[INFORMATION-AiSOTOPE]"><img src="image/20200316_info.jpg" width="250px"></a>
		</p>
</div>

<div class="block">
	<span class="date">2020.1.13(mon)</span>
		<p class="info-text">
			<a href="image/202001013.JPG"  rel="lightbox[INFORMATION-AiSOTOPE]"><img src="image/202001013.JPG" width="200px" align="left" style="padding-right:8px"></a>日本テレビ2020年1月期土曜ドラマ、主演・天海祐希「トップナイフ－天才脳外科医の条件－」のエンディングダンスにAiSOTOPE LOUNGEがロケ地として使用されました。ぜひご覧ください！<span class="aiso">AiSOTOPE</span><br>
			<br>
			▽放送日時：毎週土曜日 夜10時放送<br>
			▽放送局：日本テレビ<br>
			▽番組名：トップナイフ－天才脳外科医の条件－<br>
			<a href="https://www.ntv.co.jp/topknife/" target="_blank">https://www.ntv.co.jp/topknife/</a><br />
		</p>
                          <div style="clear:both"></div>
</div>

<div class="block">
	<span class="date">2020.1.1(wed)</span>
		<p class="info-text">
			<a href="image/2020_newyear_info.jpg"  rel="lightbox[INFORMATION-AiSOTOPE]"><img src="image/2020_newyear_info.jpg" width="100px" align="left" style="padding-right:8px"></a>あけましておめでとうございます。本年も笑ってよろしくお願いします。<br>
AiSOTOPE LOUNGE・ALAMAS CAFE・AiiRO CAFE・AVANGARDE TOKYOは1月2日より営業致します。詳しくはスケジュールページを御覧ください。<br />
		</p>
                          <div style="clear:both"></div>
</div>

<div class="block">
	<span class="date">2019.10.10(thu)</span>
		<p class="info-text">
			【台風19号接近に伴う開催中止のお知らせ】<br>
			10月12日(土) 『K-POP 1.2.3.LESSON』『KazzのSound Passage』『こてつんち』 『DIAMOND CUTTER』 につきまして、
			台風19号の影響による開催の是非を検討、協議を重ねて参りましたが、
			今年最大規模という連日の気象情報・報道から、公共交通機関の乱れ、来場されるお客様の安全等を第一に考慮し、
			誠に残念ながら開催を中止させていただくこととなりました。<br>
			<br>
			今後の気象情報が変わる可能性も期待したいところでしたが、
			遠方からお越しになられるお客様も多くいらっしゃるため、
			ご迷惑をできる限り軽減できますよう現時点で判断させていただきました。<br>
			ご来場を予定してくださった皆様には大変申し訳なく、心よりお詫び申し上げます。<br>
			<br>
			交通機関その他の混乱による不測の事態が心配されます。<br>
			まずはこの強力な台風の接近に際し、
			身の安全を第一に、十分注意いただきますようお願い申し上げます。<br />
		</p>
</div>

<div class="block">
	<span class="date">2019.10.1(tue)</span>
		<p class="info-text">
			<img src="image/monthly201910.jpg" width="100px" align="left" style="padding-right:8px">【A living paper最新号】<br>10月の表紙はデビュー35周年記念ツアーで来日目前『シンディ・ローパー』がソニー・ミュージック公認で本紙初登場！アイソ系列店舗を中心に順次全国配布予定。是非お手にとってご覧ください！<br />
		</p>
                          <div style="clear:both"></div>
</div>

<div class="block">
	<span class="date">2019.10.1(tue)</span>
		<p class="info-text">
			<a href="https://aliving.net/menu.html">10月のメニュー</a>を更新しました。<br />
		</p>
</div>

<div class="block">
	<span class="date">2019.9.23(mon)</span>
		<p class="info-text">
			<a href="image/20190923_info.jpg"  rel="lightbox[INFORMATION-AiSOTOPE]"><img src="image/20190923_info.jpg" width="100px" align="left" style="padding-right:8px"></a><br>消費税率引上げに伴う価格改定のお知らせ <span class="aiso">AiSOTOPE</span><br />
		</p>
                          <div style="clear:both"></div>
</div>

<div class="block">
	<span class="date">2018.7.8(mon)</span>
		<p class="info-text">
			<a href="anniv2019/">2019年アニバーサリー特設サイトオープンいたしました！</a>
		</p>
</div>	

<div class="block">
	<span class="date">2019.3.2(sat)</span>
		<p class="info-text">
			<a href="image/20190302.jpg" target="_blank"><img src="image/20190302.jpg" width="100px" align="left" style="padding-right:8px">
			A livingアプリ サービス終了のご案内</a>
		</p>
                          <div style="clear:both"></div>
</div>	


		</div><!--info-leftここまで-->
		<h2 class="top_tittle"><i class="fa fa-twitter" aria-hidden="true"></i> twitter </h2>
			<a class="twitter-timeline" href="https://twitter.com/anniv_aliving/lists/a-living?ref_src=twsrc%5Etfw" data-chrome=”noheader nofooter” data-height="600">A Twitter List by anniv_aliving</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>

<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>


<!-- 		<a class="twitter-timeline" data-lang="ja" data-chrome=”noheader nofooter” data-height="600" href="https://twitter.com/anniv_aliving?ref_src=twsrc%5Etfw">Tweets by anniv_aliving</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
 --></div><!--infoscrollここまで-->

	<div id="side_bar">


	<!-- 3/1 start-->
	<!--
	<div id="this_month">
	<a href="image/monthly_03.png" rel="lightbox[INFORMATION]"><img src="image/monthly_03.png" alt="Aliving Book" width="240px" style="margin-bottom:10px;"></a>
	</div>
	-->

	<!--4/1 start-->

	<div id="next_month">
		<a href="https://camp-fire.jp/projects/view/272787" target="_blank"><img src="slideimg/RESQME_top.jpg" width="100%" style="margin-bottom:10px;max-width:240px"></a>
		<!--
		<a href="image/monthly.png" rel="lightbox[INFORMATION]"><img src="image/monthly.png" alt="Aliving Book" width="240px" style="margin-bottom:10px;"></a>
		-->
	</div>

<div class="side_banar">
	<a href="https://ameblo.jp/aliving2/theme-10097006720.html" target="_blank"><img src="image/banar_acvrep.png" alt="活動報告" width="240px" style="margin-bottom:10px"></a>
	<a href="https://aliving.net/AVANTGARDE/" target="_blank"><img src="image/avant.png" alt="AVANTGARDE TOKYO" width="240px" style="margin-bottom:10px"></a>
<!-- 	<a href="https://www.gx3underwear.com/" target="_blank" onClick="ga('send','event','AD','click' ,'https://www.gx3underwear.com/');"><img src="image/GX3.jpg" alt="GX3" width="100%" style="margin-bottom:10px"></a> -->
<!-- 	<a href="https://aliving.net/OVEGAS/" target="_blank"><img src="image/banar_ovegas.png" alt="魅惑の二丁目エンターテインメント！おベガス！" width="240px"></a> -->

</div>

	</div><!--side_barここまで-->

	<div class="clear"></div>
</div><!--sp_layoutend-->

	<div id="attention">
    	<div class="atn_box">
			<span class="atn_title">AiSOTOPE LOUNGEご来場のお客様への注意事項</span>
	        <ul class="atn_list">
				<li>◯ 入場時に全ての方にIDチェックをさせて頂きます。<br />
				※顔写真付きの身分証明証を必ずお持ち下さい。（運転免許証・パスポート・住民基本台帳カード・外国人登録証明書・学生証）</li>
				<li>◯ 20歳 未満の方、高校在学中の方、写真付きの身分証明証をお持ちでない方はご入場できません。</li>
				<li>◯ お客様のプライバシー保護の為、店内の写真撮影は一切禁止しております。</li>
				<li>◯ 店内への飲食の持込は一切禁止しております。また発見された場合は、2,000円の罰金を頂きます。</li>
				<li>◯ 過度の泥酔や他の方の迷惑となる行為をされた方は退場または入場をお断りする場合がございます。その際、チケット代は返金いたしませんのでご了承ください。</li>
				<li>◯ お店の前での溜まり込み、大声で騒ぐ、道路をふさぐ等の行為は、近隣の方のご迷惑となりますので、ご遠慮ください。</li>
				<li class="atn_line">◯ We require photo ID.Drivers Licence,passport,etc.</li>
				<li>◯ No Photo or video shooting without permission.</li>
				<li>◯ No drink or food to bring in.2000yen fine for finding out.</li>
			</ul>


		</div>
	</div>

</div><!--contentsここまで-->

</div><!--containerここまで-->

	<div id="sp_nav">
		<ul>
			<li><a href="https://aliving.net" title="TOP"><i class="fa fa-home fa-4x" aria-hidden="true"></i><br>TOP</a></li>
			<li><a href="schedule.php" title="SCHEDULE"><i class="fa fa-calendar fa-4x" aria-hidden="true"></i><br>SCHEDULE</a></li>
			<li><a href="menu.html" title="MENU"><i class="fa fa-cutlery fa-4x" aria-hidden="true"></i><br>MENU</a></li>
			<li><a href="artist.html" title="ARTIST"><i class="fa fa-user fa-4x" aria-hidden="true"></i><br>ARTIST</a></li>
			<li><a href="access.html" title="ACCESS"><i class="fa fa-map-marker fa-4x" aria-hidden="true"></i><br>ACCESS</a></li>
			<li><a href="rental.html" title="RENTAL"><i class="fa fa-file-text-o fa-4x" aria-hidden="true"></i><br>RENTAL</a></li>
			<li><a href="link.html" title="LINK"><i class="fa fa-link fa-4x" aria-hidden="true"></i><br>LINK</a></li>
			<li><a href="english.html" title="ENGLISH"><i class="fa fa-globe fa-4x" aria-hidden="true"></i><br>ENGLISH</a></li>
		</ul>
	</div>


<div id="footer">
  	<div id="footercompany">
  		<ul>
  			<li><a href="shop.html">店舗</a></li>|
  			<li><a href="company.html">会社概要</a></li>|
  			<li><a href="policy.html">企業理念・ポリシー</a></li>
  		</ul>
  	</div>
  		<div id="footertext">&copy; Cappellasistina All rights reserved.</div>
</div><!--footer-->


</div>
</body>
</html>
