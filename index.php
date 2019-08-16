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
	var changeDate = new Date(2019, 8-1, 1);

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
<div class="sns_icon"><a href="https://twitter.com/anniv_aliving" target="_blank"><i class="fa fa-twitter-square" aria-hidden="true"></i></a><a href="https://www.facebook.com/events/448058282221744/" target="_blank"><i class="fa fa-facebook-square" aria-hidden="true"></i></a><a href="https://www.instagram.com/aisotope_lounge/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></div>
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
							<a href="https://aliving.net/AVANTGARDE/" target="_blank"><img src="slideimg/top_2.jpg" alt="" /></a>
							<img src="slideimg/top_3.jpg" alt="" />
							<a href="https://aliving.net/wanted.html" onclick="window.open('wanted.html','foo','width=540,height=500,scrollbars=yes'); return false;" target="_blank"><img src="slideimg/top_4.jpg" alt="" /></a>
							<a href="https://aliving.net/aiirocafe/" target="_blank"><img src="slideimg/top_5.jpg" alt="" /></a>
							<a href="https://www.facebook.com/QUEENSLOUNGETHESHOW/" target="_blank"><img src="slideimg/top_6.jpg" alt="" /></a>
						</div><!--bigPic-->
						<div id="smallPic">
							<ul id="thumbs">
							<li class="active" rel="1"><img src="slideimg/top_2.jpg" class="object-fit-img"></li>
							<li rel="2"><img src="slideimg/top_3.jpg" class="object-fit-img"></li>
							<li rel="3"><img src="slideimg/top_4.jpg" class="object-fit-img"></li>
							<li rel="4"><img src="slideimg/top_5.jpg" class="object-fit-img"></li>
							<li rel="5"><img src="slideimg/top_6.jpg" class="object-fit-img"></li>						
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
	<span class="date">2019.7.21(sun)</span>
		<p class="info-text">
			<a href="https://aliving.net/schedule.php?month=2019-08">8月のスケジュール</a>を更新しました。<br />
		</p>
</div>

<div class="block">
	<span class="date">2018.7.8(mon)</span>
		<p class="info-text">
			<a href="anniv2019/">2019年アニバーサリー特設サイトオープンいたしました！</a>
		</p>
</div>	

<div class="block">
	<span class="date">2019.6.1(sat)</span>
		<p class="info-text">
			<a href="https://aliving.net/menu.html">6月のメニュー</a>を更新しました。<br />
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

<div class="block">
	<span class="date">2018.12.22(sat)</span>
		<p class="info-text">
			<a href="https://aliving.net/2018-countdown/">「2018年カウントダウンイベント特設サイト」がオープンしました！</a>
		</p>
</div>	

<div class="block">
	<span class="date">2018.11.10(sat)</span>
		<p class="info-text">
			<a href="https://aliving.net/AVANTGARDE/">「アバンギャルド トウキョウ」HPが完成いたしました！</a><span class="avan">AVANTGARDE</span>
		</p>
</div>	

<div class="block">
	<span class="date">2018.7.10(mon)</span>
		<p class="info-text">
			<a href="anniv2018/">2018年アニバーサリー特設サイトオープンいたしました！</a>
		</p>
</div>	
				
<div class="block">
	<span class="date">2018.5.27(sun)</span>
		<p class="info-text">
			6月12日(火) AiSOTOPELOUNGEで予定をしておりました『Diesel Disco Club』『PUB★おベガス！』はお休みとなりましたのでお知らせいたします。次回は7月17日(火)の開催予定でございますので、皆様のご来店お待ち致しております。<span class="aiso">AiSOTOPE</span>
		</p>
</div>				
				
				
<div class="block">
	<span class="date">2018.3.23(fri)</span>
		<p class="info-text">
			<img src="image/DDT.jpg" width="100px" align="left" style="padding-right:8px">【AiSOTOPEがロケーションで使用されました!!】<br />
株式会社DDTプロレスリングより3/25両国国技館大会から販売されるHARASHIMA＆高尾蒼馬選手の写真集で撮影ロケーションにAiSOTOPEが使用されました! いつもの雰囲気と違ったAiSOでお二人のステキな表情が満載の一冊です!! 是非、お求めください!<span class="aiso">AiSOTOPE</span>
		</p>
															<div style="clear:both"></div>
</div>


<div class="block">
	<span class="date">2017.12.15(fri)</span>
		<p class="info-text">
			<a href="https://aliving.net/2017-countdown/" target="_blank">2017年カウントダウンイベント特設サイトがオープンしました！</a>
		</p>
</div>

<div class="block">
	<span class="date">2017.12.1(fri)</span>
		<p class="info-text">
			<img src="image/monthly201712.jpg" width="100px" align="left" style="padding-right:8px">【A living paper最新号】12月号の表紙は故ホイットニー・ヒューストン出演の不朽の名画『ボディガード』が公開から25年、大ヒット曲「オールウェイズ・ラヴ・ユー」初テイク音源ほか、貴重なライブ音源など未発表音源を収録した究極のサウンドトラックが日本限定BSCD2仕様で12月6日発売！<br>
			映画サウンドトラック『愛よ永遠に～ボディガード25周年記念盤』 <br>
			■品番：SICP-31131<br>
			 ■価格：2,500円（＋税）<br>
			■その他：国内盤のみBlu-Spec CD2仕様 /歌詞・対訳・解説付<br>
		</p>
															<div style="clear:both"></div>
</div>
<div class="block">
	<span class="date">2017.11.1(wed)</span>
		<p class="info-text">
			<img src="image/monthly201711.jpg" width="100px" align="left" style="padding-right:8px">【A living paper最新号】11月号の表紙は音楽プロデューサーSTYが「二面性」をテーマに描く４つの個性。 洗練されたダンスとボーカルパフォーマンスで世界を魅了する新鋭最強ガールズグループ「BANANALEMON（バナナレモン）」 11/15より「GIRLS GONE WILD」配信決定！
		</p>
															<div style="clear:both"></div>
</div>


				<div class="block">
					<span class="date">2017.10.1(sun)</span>
						<p class="info-text">
							<img src="image/monthly201710.jpg" width="100px" align="left" style="padding-right:8px">【A living paper最新号】 10月の表紙は世界一ロックなポップ・クィーン『P!NK』がソニー・ミュージック公認で本紙初登場！10/13(金)に5年振りとなるニューアルバム「ビューティフル・トラウマ」を発売。アイソ系列店舗を中心に順次全国配布予定！是非お手にとってご覧ください！
						</p>
						                          <div style="clear:both"></div>
				</div>

					<div class="block">
						<span class="date">2017.7.7(fri)</span>
						<p class="info-text">
							<a href="https://aliving.net/anniv2017/" target="_blank">2017年アニバーサリー特設サイトオープンしました！<br />
							</p>
					</div>

					<div class="block">
						<span class="date">2016.12.9(fri)</span>
						<p class="info-text">
							<a href="https://aliving.net/2016-countdown/">2016年カウントダウンイベント特設サイトがオープンしました。</a><br />
							</p>
					</div>

					<div class="block">
						<span class="date">2016.12.9(fri)</span>
						<p class="info-text">
							<a href="download/20161209_info.pdf" target="_blank">ArcH閉店のお知らせ。</a><span class="arch">ArcH</span><br />
							</p>
					</div>

					<div class="block">
						<span class="date">2016.5.13(sat)</span>
						<p class="info-text">
							<a href="image/AJISAI_CLOSE.pdf" target="_blank">『スナックあじさい』閉店のご挨拶</a><br />
							</p>
					</div>

					<div class="block">
						<span class="date">2016.4.29(thu)</span>
						<p class="info-text">
							系列5店舗合同GW特別企画スタート!! GW中限定で、各店スタッフの出身地の特産品を割り物に使った酎ハイ(￥700)を販売します。最も人気の高かった割り物は、後日、当アプリにて無料で1杯飲めるクーポンを発行予定。ぜひ飲み比べてみて下さい!!
							</p>
					</div>

					<div class="block">
						<span class="date">2016.4.1(fri)</span>
						<p class="info-text">
							4月は、<a href="https://aliving.appsta.jp/letter.html?FRONT_LETTER_ID=133" target="_blank">春のA livingアプリキャンペーンを実施!</a>
                            4月中にインストールするだけでお得なクーポンをGETできちゃう!
                            もちろん、すでにアプリを使ってる人も嬉しい、<a href="https://aliving.appsta.jp/letter.html?FRONT_LETTER_ID=133" target="_blank">4月限定クーポン</a>を各店ご用意!! 使わなきゃ絶対損です!!
							</p>
					</div>

					<div class="block">
						<span class="date">2016.3.31(thu)</span>
						<p class="info-text">
							<a href="https://goo.gl/E5IQgQ" target="_blank"><img src="image/20160331_info.jpg" width="100px" align="left" style="padding-right:8px"></a>外国人向け都内ガイドブック(無料)<a href="https://goo.gl/E5IQgQ" target="_blank">『タイムアウト東京マガジン第10号』</a>にて、ALAMAS CAFEとAiiRO CAFEをご紹介頂きました。<br>
                            都内の駅構内、空港、宿泊施設等で配布中。ぜひご一読ください!<span class="alamas">ALAMAS CAFE</span><span class="aiiro">AiiRO CAFE</span>
							</p>
                          <div style="clear:both"></div>
					</div>

					<div class="block">
						<span class="date">2016.3.12(sat)</span>
						<p class="info-text">
                        	4月2日の世界自閉症啓発デーに向けて、3月26日(土)は啓発活動の周知や理解を促すため、<a href="https://aliving.net/schedule_detail.php?date=2016-03-26">ALAMAS CAFEとAiiRO CAFEで撮影会</a>をおこないます。イメージカラーであるブルーのアイテムを身につけて記念撮影をしましょう!<span class="alamas">ALAMAS CAFE</span> <span class="aiiro">AiiRO CAFE</span>
							</p>
					</div>

					<div class="block">
						<span class="date">2016.3.5(sat)</span>
						<p class="info-text">
							<a href="https://dayout.tokyobookmark.net/" target="_blank"><img src="image/20160305_info.jpg" width="100px" align="left" style="padding-right:8px"></a>都内の新感覚ガイドブック<a href="https://dayout.tokyobookmark.net/" target="_blank">『東京の24時間を旅する本』</a>で、AiSOTOPE LOUNGEとALAMAS CAFEが紹介されました。ぜひご一読下さい!<span class="aiso">AiSOTOPE</span> <span class="alamas">ALAMAS CAFE</span><br>
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

<!-- 6/1 start-->
<div id="this_month">
<a href="image/monthly_07.jpg" rel="lightbox[INFORMATION]"><img src="image/monthly_07.jpg" alt="Aliving Book" width="240px" style="margin-bottom:10px;"></a>
</div>

<!--7/1 start-->
<div id="next_month">
<a href="image/monthly.jpg" rel="lightbox[INFORMATION]"><img src="image/monthly.jpg" alt="Aliving Book" width="240px" style="margin-bottom:10px;"></a>
</div>

<div class="side_banar">
	<a href="https://ameblo.jp/aliving2/theme-10097006720.html" target="_blank"><img src="image/banar_acvrep.png" alt="活動報告" width="240px" style="margin-bottom:10px"></a>
	<a href="https://aliving.net/AVANTGARDE/" target="_blank"><img src="image/avant.png" alt="AVANTGARDE TOKYO" width="240px" style="margin-bottom:10px"></a>
	<a href="https://www.gx3underwear.com/" target="_blank" onClick="ga('send','event','AD','click' ,'https://www.gx3underwear.com/');"><img src="image/GX3.jpg" alt="GX3" width="100%" style="margin-bottom:10px"></a>
<!-- 	<a href="https://aliving.net/OVEGAS/" target="_blank"><img src="image/banar_ovegas.png" alt="魅惑の二丁目エンターテインメント！おベガス！" width="240px"></a> -->
	<img src="image/akemi_banner.jpg" alt="スナックアケミ" width="240px" style="margin-bottom:-4px" >
	<video controls poster="image/akemi_movie_poster.png" width="240" height="auto">
		<source src="image/dance03-3.mp4">
	</video>

</div>


<!--
<div class="side_banar_passbook">
<a href="https://goo.gl/n61sNg" target="_blank"><img src="image/passbook_aiso.png" alt="Passbook"></a>
<a href="https://goo.gl/yUrOmQ" target="_blank"><img src="image/passbook_alamas.png" alt="Passbook"></a>
<a href="https://goo.gl/mTEmrK" target="_blank"><img src="image/passbook_and.png" alt="Passbook"></a>
</div>
-->

	</div><!--side_barここまで-->

	<div class="clear"></div>
</div><!--sp_layoutend-->

	<div id="attention">
    	<div class="atn_box">
			<span class="atn_title">AiSOTOPE LOUNGEご来場のお客様への注意事項</span>
	        <ul class="atn_list">
				<li>◯ 入場時に全ての方にIDチェックをさせて頂きます。<br />
				※顔写真付きの身分証明証を必ずお持ち下さい。（運転免許証・パスポート・住民基本台帳カード・外国人登録証明書・学生証）</li>
				<li>◯ 18歳 未満の方、高校在学中の方、写真付きの身分証明証をお持ちでない方はご入場できません。（イベントによって20歳以上限定の場合もございます）<br />
				※酒類の提供は20歳以上の方のみとなります。未成年の飲酒・喫煙が発覚した場合、AiSOTOPE LOUNGEへの出入り禁止・即刻退場の処置を致します。成人者が未成年への飲酒・喫煙の誘発をした場合においても同様の処置をいたします。</li>
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
