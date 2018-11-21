$(function(){
   // #で始まるアンカーをクリックした場合に処理
   $('a[href^=#]').click(function() {
	   
	  //console.log("aaa");
	  
      // スクロールの速度
      var speed = 400;// ミリ秒
      // アンカーの値取得
      var href= $(this).attr("href");
	  //console.log(href);
      // 移動先を取得
      var target = $(href == "#" || href == "" ? 'html' : href);
	  //console.log(target);
      // 移動先を数値で取得
      //var position = target.offset().top;
	  var position = $(this).offset().top;
	  console.log(position);
	  //position = 10000;
      // スムーススクロール
      $($.browser.safari ? 'body' : 'html').animate({scrollTop:position}, speed, 'swing');
      return false;
   });
});