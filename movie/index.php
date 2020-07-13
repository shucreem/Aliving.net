<!DOCTYPE html>
<html>
<head>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-12108310-14"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-12108310-14');
</script>

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>酒かぶり姫チーム presents『朗読劇：酒かぶり姫 オンライン</title>
<meta charset="utf-8">
<meta name="description" content="酒かぶり姫2020リモート版 2019年7月にAiSOTOPE LOUNGEアニバーサリーパーティーで1回限り上演した伝説のお芝居「酒かぶり姫」 コロナショックにより、多くの人が自粛を強いられる中、酒かぶり姫制作チームによって、AiSOTOPE LOUNGE系列店応援を目的にリモート朗読劇として再演！">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">

<meta property="og:title" content="酒かぶり姫チーム presents『朗読劇：酒かぶり姫 オンライン" >
<meta property="og:type" content="website" >
<meta property="og:description" content="酒かぶり姫2020リモート版 2019年7月にAiSOTOPE LOUNGEアニバーサリーパーティーで1回限り上演した伝説のお芝居「酒かぶり姫」 コロナショックにより、多くの人が自粛を強いられる中、酒かぶり姫制作チームによって、AiSOTOPE LOUNGE系列店応援を目的にリモート朗読劇として再演！" >
<meta property="og:url" content="https://aliving.net/movie/" >

<link rel="shortcut icon" href="https://aliving.net/image/favicon.ico" />
<link rel="stylesheet" href="reset.css">
<link rel="stylesheet" href="style.css">
</head>
<body>
	<header></header>

<section>
	<h1><span>酒かぶり姫チーム presents</span>『朗読劇：酒かぶり姫 オンライン』</h1>

	<p class="date"><span>視聴期間</span>
		2020年6月3日水曜日　19:00-<br>2020年6月7日日曜日　23:59</p>

	<p>酒かぶり姫2020リモート版<br>
	2019年7月にAiSOTOPE LOUNGEアニバーサリーパーティーで1回限り上演した伝説のお芝居「酒かぶり姫」<br>
	コロナショックにより、多くの人が自粛を強いられる中、酒かぶり姫制作チームによって、AiSOTOPE LOUNGE系列店応援を目的にリモート朗読劇として再演！<br>
	<br>
	こんな時代だからこそ、強く生き抜くというメッセージと共に、少しでも笑って頂き免疫UPに繋がれば光栄です。<br>
	多少の失敗もありますが、そこは笑って許してください。笑</p>

	<div id="videoon" class="video">		
		<video controls autoplay poster="poster.png">
		<source src="sakekaburi.mp4">
		<p>動画を再生するには、videoタグをサポートしたブラウザが必要です。</p>
		</video>
	</div>

	<div id="videooff" class="video">
		<p class="fin">現在動画は公開しておりません。<br>視聴期間をご確認ください。</p>
	</div>

</section>

<footer>
	&copy; <a href="https://aliving.net/" target="_blank">Aliving.net</a>
</footer>

<script>
	// イベントの開始、終了設定
	var startday = new Date('2020/06/03 19:00:00');
	var endday = new Date('2020/06/08 00:00:00');
	   
	var today = new Date();
	if ( startday < today && today < endday ){
	   document.getElementById("videoon").style.display="block";
	   document.getElementById("videooff").style.display="none";
	}else{
	   document.getElementById("videoon").style.display="none";
	   document.getElementById("videooff").style.display="block";  
	}
</script>
</body>
</html>