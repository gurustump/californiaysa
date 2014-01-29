// remap jQuery to $
(function($){})(window.jQuery);


/* trigger when page is ready */
$(document).ready(function(){
	animatedRotator (8000,'.animRotator',1);
	animatedRotator(6399,'.animSlider',1,'slider');
	picasaGallery();
	if (typeof picasaGalleryFullSource !== 'undefined') { fullPagePicasaGallery(); }
	$('.column .module h3 a, .post .post-content h2 a').hover(function(){
		$(this).closest('li, .post').find('.activity-icon, .post-thumbnail-container').addClass('hover');
	}, function() {
		$(this).closest('li, .post').find('.activity-icon, .post-thumbnail-container').removeClass('hover');
	});
	$('.main-menu').hover(function() {
		$(this).addClass('hover');
		equalHeight($('.main-menu .menu > li'));
	}, function() {
		$(this).removeClass('hover');
	});
	$('.menu-activator').click(function(e){
		e.preventDefault();
		$(this).closest('.main-menu').toggleClass('active');
		$('.main-menu-overlay').addClass('active').click(function(){
			$('.menu-activator').click();
			$(this).removeClass('active');
		});
	});
	if (!$('body').hasClass('page-template-full_page_picasa_gallery-php')){
		var originalHeight = $('.content').height();
		contentResize(originalHeight);
		$(window).resize(function() {
			contentResize(originalHeight);
		});
	}
	$('.tabs h2 a').click(function(e){
		e.preventDefault();
		$(this).closest('.tabs > li').addClass('active').siblings().removeClass('active');
	});
});

function contentResize(originalHeight) {
	if($('body').height()-213 > originalHeight){
		$('.content').height($('body').height()-213);
	}
}

/* optional triggers

$(window).load(function() {
	
});
*/

