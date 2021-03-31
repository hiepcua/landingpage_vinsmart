;(function(){
	var win = $(window),
	html = $('html'),
	body = $('body');

	$('.post-thumb-120, .wrap-thumb-220, .big-post-thumb, .wrap-thumb, .i-wrap-thumb').each(function(){
		var url = $(this).attr('data-src');
		if(url !== undefined && url.length > 0){
			$(this).css('background-image', 'url('+url+')');
			$(this).find('img').css('display', 'none');
		}
	});
})(document, window, jQuery);
