
function showNext(){
	var len = $('#slider img').length;
	var next = currentIndex < (len-1) ? currentIndex + 1 : 0;
	showImage(next);
}

function showImage(index){
	if(index < $('#slider img').length){
		var indexImage = $('#slider img')[index]
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
		$('#thumbs ul li').removeClass('active');
		$($('#thumbs ul li')[index]).addClass('active');
	}
}
