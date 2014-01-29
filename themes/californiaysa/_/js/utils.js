jQuery.expr[':'].regex = function(elem, index, match) {
    var matchParams = match[3].split(','),
        validLabels = /^(data|css):/,
        attr = {
            method: matchParams[0].match(validLabels) ? 
                        matchParams[0].split(':')[0] : 'attr',
            property: matchParams.shift().replace(validLabels,'')
        },
        regexFlags = 'ig',
        regex = new RegExp(matchParams.join('').replace(/^\s+|\s+$/g,''), regexFlags);
    return regex.test($(elem)[attr.method](attr.property));
}

$(document).ready(function() {
	$('.tblank').attr('target','_blank');
	
	// display and hide search field
	$('.search-form a.activator').toggle(function(){
		$(this).siblings('form').css('visibility','visible');
	},function(){
		$(this).siblings('form').css('visibility','');
	}).hover;
	$('.search-form input').focus(function(){
		$(this).closest('form').css('visibility','visible');
	});
	$('.search-form input').blur(function(){
		$(this).closest('form').css('visibility','');
	});
	modalActivatorActiveClass();
	modalActivatorURL();
	modalActivatorClick();
	animateAdminBar();
});


// modal functions
function modalActivatorActiveClass() {
	if (!$('body').hasClass('services')) {
		$('.modal.active').each(function(){
			var timeBetweenPopups = !isNaN($(this).find('.modal-expiration').val())?$(this).find('.modal-expiration').val():3;
			var cookieLifespan = 1000 * 60 * 60 * 24 * timeBetweenPopups;
			var now = new Date().getTime();
			var expires = new Date(now + cookieLifespan);
			if(getCookie($(this).attr('id')+'-shown') != 'true') {
				modalWindow(('#'+$(this).attr('id')),'url');
				setCookie($(this).attr('id')+'-shown', 'true', expires);
			}
		});
	}
}
function modalActivatorURL() {
	if (type='querystring') {
		modalWindow(window.location.hash,'url');
	}
}
function modalActivatorURLQuery(query) {
	if (type='querystring') {
		var thisQuery = getQuerystring(query);
		modalWindow(queryList(thisQuery));
	} else {
		modalWindow(window.location.hash,'url');
	}
}
function modalActivatorClick() {
	$('.modal-activator').click(function(e){
		e.preventDefault();
		modalWindow($(this).attr('href'));
	});
}
function modalWindow(modalID,source) {
	if ($(modalID).hasClass('modal')) {
		if ($(modalID).siblings('.modal-opaque').length < 1) {
			$(modalID).closest('.modals').append('<div class="modal-opaque"></div>');
		}	
		$(modalID).closest('.modals').find('.modal-opaque').fadeIn(source=='url'?1:400).click(function() {
			modalClose();
		});
		$(modalID).css({
			'margin-top':(($(modalID).outerHeight()/2)*-1),
			'margin-left':(($(modalID).outerWidth()/2)*-1)
		});
		$(modalID).fadeIn(source=='url'?1:400,function(){
			if (source=='url') {
				$('html,body').scrollTop(0);
			}
		});
		if ($(modalID).find('.close-corner').length < 1) {
			$(modalID).append('<a class="close close-corner">Close</a>');
		}
		$(modalID+' .close').click(function(e){
			e.preventDefault();
			modalClose();
		});
	}
}
function modalClose() {
	$('.modal-opaque').fadeOut();
	$('.modal').fadeOut();
	$('.modal-video iframe').each(function(){
		var vidSource = $(this).attr('src');
		$(this).attr('src',vidSource);
	});
}
function getQuerystring(key, default_) {
  if (default_==null) default_="";
  key = key.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
  var regex = new RegExp("[\\?&]"+key+"=([^&#]*)");
  var qs = regex.exec(window.location.href);
  if(qs == null)
    return default_;
  else
    return qs[1];
}
function queryList(query) {
	switch(query) {
		case 'wppi':
			return '#wppi-2011-leads-modal';
			break;
	}
}

/* Animated gallery rotator function
interval = the amount of time on each slide
container = css selector for the parent element of all the slides
setFirst = an interger specifying which slide should show first (not 0-based)
*/
animatedRotator = function(interval, container, setFirst, animStyle) {
	$(container+' > *').css('visibility','visible');
	// checks whether there is more than one slide before running animation
	if ($(container).children().length > 1) {
		var containerWidth = $(container).outerWidth();
		$(container).children().each(function(i) {
			$(this).data('itemKey', 'item-' + i).addClass('item-'+ i);
		});
		// permits script to select first slide
		if (is_int(setFirst)) {
			firstSlide = $(container).children().eq(setFirst-1);
			$(container).height(firstSlide.innerHeight());
			$(container).children().removeClass('animRotatorActive');
			$(container).height(firstSlide.innerHeight());
			firstSlide.addClass('animRotatorActive');
		// randomizes first slide if ".animRotatorActive" class hasn't been given to one of them
		} else if ($(container).find('.animRotatorActive').length < 1) {
			var numSlides = $(container).children().length;
			var firstSlideNumber = Math.floor(Math.random() * numSlides) + 1;
			var firstSlide = $(container).children('*:nth-child(' + firstSlideNumber + ')');
			$(container).height(firstSlide.innerHeight());
			firstSlide.addClass('animRotatorActive');
		} else {
			$(container).height($('.animRotatorActive').innerHeight());
		}
		$(container).find('.animRotatorActive').siblings().hide();
		if ($(container).siblings('.manual-rotator-nav').length > 0) {
			if ($(container).siblings('.manual-rotator-nav').children().length < 1) { var manualRotatorNavContents = false; }
			$(container).children().each(function(i) {
				var thisItem = $(this);
				function manualRotatorNavClick(e,thisClicked) {
					if(animStyle == 'slider' && thisClicked.hasClass('active')) { return; }
					e.preventDefault();
					clearInterval(animRotInt);
					nextItem(thisItem);
				}
				if (manualRotatorNavContents == false) {
					var thisManualNavLink = $('<a href="#"></a>').addClass('item-' + i).click(function(e) {
						var thisClicked = $(this);
						manualRotatorNavClick(e,thisClicked);
					});
					$(container).siblings('.manual-rotator-nav').append(thisManualNavLink);
				} else {
					$(container).siblings('.manual-rotator-nav').children('a.'+thisItem.data('itemKey')).click(function(e) {
						var thisClicked = $(this);
						manualRotatorNavClick(e,thisClicked);
					});
				}
			});
		}
		$(container).siblings('.manual-rotator-nav').find('.' + $('.animRotatorActive').data('itemKey')).addClass('active');
		var animRotInt = setInterval(function() {
			nextItem('interval');
		}, interval);

		function nextItem(initiator) {
			var active = $(container + ' > .animRotatorActive');
			if (initiator == 'interval') {
				var next = (active.next()[0]) ? active.next() : $(container).children('*:first-child');
			} else {
				var next = initiator;
			}
			$(container).animate({
				height: next.innerHeight()
			}, 1000).children().stop(false,true,true);
			$(container).siblings('.manual-rotator-nav').find('.' + next.data('itemKey')).addClass('active').siblings().removeClass('active');
			active.removeClass('animRotatorActive');
			next.addClass('animRotatorActive');
			if (animStyle == 'slider') {
				next.css({
					'left':'+='+containerWidth,
					'display':'block'
				});
				active.css('left',0); // in case previous animation is still running
				active.add(next).animate({
					left:'-='+containerWidth
				},500, function(){
					active.css({
						'display':'none',
						'left':0
					});
				});
			} else {
				next.fadeIn(1000, function() {
					next.siblings().hide();
				});
			}
		}
	}
};

// Simple Accordion
function simpleAccordion (activator,firstOpen,limitOne) {
	$(activator).addClass('accordionActivator').click(function() {
		$(this).toggleClass('closed').next().toggle(500);
		// if this is true, only one item will be permitted to be open at a time
		if (limitOne === true) {
			$(activator).not($(this)).addClass('closed').next().hide(500);
		}
		return false;
	});
	// if there is a hash (#) in the url, tests to see if it points to one of the activators, and opens that activator if it is
	// then tests to see whether the url hash points to an ID inside one of the accordion content areas, and opens that one if it does
	if (window.location.hash) {
		var activatorHasId = 0;
		$(activator).each(function(){
			if (('#'+$(this).attr('id')) === window.location.hash){
				$(activator).not($(window.location.hash)).addClass('closed').next().hide();
				activatorHasId = 1;
				return;
			}
		});
		if (activatorHasId != 1){
			$(activator).not($(window.location.hash).parents().prev(activator)).addClass('closed').next().hide();
		}
	// if firstOpen is an integer, then it will select an item by index (1-based) to be open on load
	} else if (firstOpen === parseInt(firstOpen)) {
		$(activator+':not(:eq('+(firstOpen-1)+'))').addClass('closed').next().hide();
	// if firstOpen is true, the first item will be open on load
	} else if (firstOpen === true) {
		$(activator).filter(':not(:first)').addClass('closed').next().hide();
	// otherwise firstOpen will be accepted as a css selector for the item (or items) to be open on load, and where none are present, all items will be closed on load
	} else {
		$(activator+':not('+firstOpen+')').addClass('closed').next().hide();
	}
}

// cookies

function getCookie(Name) {
	var aCookie = document.cookie.split("; ");

	for ( var i=0 ; i < aCookie.length ; i++ )
	{
		var aCval = aCookie[i].split("=");
		if ( ( Name == aCval[0]) && ( aCval.length > 1 ) ) return unescape( aCval[1] ) ;
	}

	return false ;
};
function setCookie(Name,Value,Expires) {
	var pvalue   = escape(Value) ;
	var pExpires = Expires ;

	var pPath    = ';Path=/' ;

	// Get subdomain if more than one "." in the host name
	var pDomain  = document.URL;
	pDomain = pDomain.substring( pDomain.indexOf( '//' ) + 2 );
	idx = pDomain.indexOf( ':' );
	if ( idx >= 0 )
		pDomain = pDomain.substring( 0, idx );
	idx = pDomain.indexOf( '/' );
	if ( idx >= 0 )
		pDomain = pDomain.substring( 0, idx );
	idx = pDomain.indexOf( '.' );
	if ( idx != pDomain.lastIndexOf( '.' ) )
		pDomain = ';domain=' + pDomain.substring( idx );
	else
		pDomain = '';

	pExpires = pExpires == "never" ? 'Fri, 31 Dec 2099 23:59:59 GMT;' : (pExpires || '');
	document.cookie = (Name + '=' + pvalue + ';expires=' + pExpires + pPath + pDomain);
};

function animateAdminBar() {
	$('html').addClass('hide-wpadminbar');
	$('#wpadminbar').animate({
		'top':'-=27'
	}, 2000).hover(
		function(){
			$('#wpadminbar').stop().css('top','0').toggleClass('wpadminbar-shown');
		},
		function(){
			$('#wpadminbar').animate({
				'top':'-=27'
			}, 2000).toggleClass('wpadminbar-shown');
		}
	).append('<div class="wpadminbar-activator"></div>');
}
function is_int(value){
	if((parseFloat(value) == parseInt(value)) && !isNaN(value)){
		return true;
	} else {
		return false;
	}
}
// Equal Heights
// group must be a jQuery object
function equalHeight(group) {
	var tallest = 0;
	group.each(function() {
		var thisHeight = $(this).height();
		if(thisHeight > tallest) {
			tallest = thisHeight;
		}
	});
	group.height(tallest);
}


// Picasa Gallery functions
function picasaGallery() {
	$('a.picasa-source').each(function() {
		var thisSource = $(this);
		$(thisSource).wrap('<div class="picasa-gallery-container"></div>');
		var thisGalleryContainer = $(thisSource).parents('.picasa-gallery-container');
		thisGalleryContainer.data({
			'origWidth':thisGalleryContainer.width(),
			'origHeight':thisGalleryContainer.height()
		});
		$.ajax({ 
			url: $(this).attr('href'),
			success: function (data,status){
				var albums = data.feed.entry;
				$(thisSource).wrap('<div class="picasa-gallery"></div>').parent('.picasa-gallery').append('<div class="thumb-carousel"></div><ul class="gallery"></ul><div class="gallery-controls"></div><a class="prevSlide">Previous</a><a class="nextSlide">Next</a>').find('.gallery-controls').append('<a class="play-control">Play</a><a class="pause-control">Pause</a>').siblings('.thumb-carousel').append('<ul/>');
				var thisGallery = $(thisSource).parent('.picasa-gallery');
				$.each(albums,function(){
					var thisDescription = (this.media$group.media$description.$t.length > 0)?'<p class="caption">'+this.media$group.media$description.$t+'</p>':'';
					$('<li class="img_'+this.gphoto$id.$t+'">'+thisDescription+'<img style="margin-left:'+(800-this.media$group.media$content[0].width)/2+'px;margin-top:'+(800-this.media$group.media$content[0].height)/2+'px;" src='+this.content.src+' alt="Image" /></li>').appendTo($(thisGallery).children('ul'));
					$('<li class="img_'+this.gphoto$id.$t+'"><img src='+this.media$group.media$thumbnail[0].url+' alt="Image" /></li>').appendTo($(thisGallery).find('.thumb-carousel > ul'));
				});
				/* Show first slide */
				$(thisGallery).find('.gallery li:first-child').addClass('picasaRotatorActive').fadeIn();
				$(thisGallery).find('.thumb-carousel li:first-child').addClass('picasaRotatorActive').fadeIn();
				/* Start animated gallery rotator */
				picasaRotator(5000,($(thisGallery).find('.gallery')));
				smartScroll(($(thisGallery).find('.thumb-carousel')));
				/* Change slide on thumbnail click */
				$(thisGallery).find('.thumb-carousel li').click(function(){
					$(thisGallery).find('.gallery li.'+$(this).attr('class')).fadeIn().addClass('picasaRotatorActive').siblings().fadeOut().removeClass('picasaRotatorActive');
					$(this).addClass('picasaRotatorActive').siblings().removeClass('picasaRotatorActive');
					$(thisGallery).find('.gallery-controls .pause-control').click();
				});
				$(thisGallery).find('.prevSlide').click(function(){
					goAdjacentSlide('previous',($(thisGallery).find('.gallery')));
					$(thisGallery).find('.gallery-controls .pause-control').addClass('clicked').click();
				});
				$(thisGallery).find('.nextSlide').click(function(){
					goAdjacentSlide('next',($(thisGallery).find('.gallery')));
					$(thisGallery).find('.gallery-controls .pause-control').click();
				});
				$('.prevSlide,.nextSlide').mousedown(function(){
					$(this).addClass('mousedown');
				});
				$('.prevSlide,.nextSlide').mouseup(function(){
					$(this).removeClass('mousedown');
				});
				$(document).keydown(function(e){ // events for keyboard actions
					if(e.keyCode == '37'){ // left arrow
						$('.gallery-active .prevSlide').trigger('click');
					} else if (e.keyCode == '39') { // right arrow
						$('.gallery-active .nextSlide').trigger('click');
					} else if (e.keyCode == '27') { // escape key
						$('.gallery-active .reduce-gallery').trigger('click');
					}
				});
			},
			timeout: 10000,
			error: showErrorMessage,
			dataType: 'jsonp'
		});
		$(thisGalleryContainer).append('<a class="expand-gallery"><span>View Gallery</span></a><a class="reduce-gallery">Hide Gallery</a>');
		$('.picasa-gallery-container .expand-gallery,.picasa-gallery-container .reduce-gallery').click(function(){
			$(this).fadeOut().siblings('a').fadeIn();
			$(this).parent('.picasa-gallery-container').add($(this).siblings('.picasa-gallery')).animate({
				'height':$(this).hasClass('reduce-gallery')?thisGalleryContainer.data('origHeight'):800,
				'width':$(this).hasClass('reduce-gallery')?thisGalleryContainer.data('origWidth'):800,
				'margin-left':$(this).hasClass('reduce-gallery')?0:35
			}, function(){
				$(this).find('.thumb-carousel ul').fadeOut(1000);
			}).toggleClass('gallery-active');
		});
	});
}
picasaRotator = function (interval,container){
	var galleryPause = true;
	// checks whether there is more than one slide before running animation
	if ($(container).children().length > 1) {
	//randomizes first slide if ".picasaRotatorActive" class hasn't been given to one of them
		if ($(container).find('.picasaRotatorActive').length < 1) {
			var numSlides = $(container).children().length;
			var firstSlideNumber = Math.floor(Math.random()*numSlides) + 1;
			var firstSlide = $(container).children('*:nth-child(' + firstSlideNumber + ')');
			//$(container).height(firstSlide.innerHeight());
			firstSlide.addClass('picasaRotatorActive');
		} else {
			//$(container).height($('.picasaRotatorActive').innerHeight());
		}
		$(container).siblings('.gallery-controls').find('.pause-control').click(function(){
			$(this).addClass('active').siblings().removeClass('active');
			clearInterval($(container).data('picasaRotatorInterval'));
			galleryPause = true;
		});
		$(container).siblings('.gallery-controls').find('.play-control').click(function(){
			$(this).addClass('active').siblings().removeClass('active');
			if (galleryPause){
				intervalSetter(interval,container);
			}
			galleryPause = false;
		});
		$('.picasa-gallery .gallery-controls .pause-control, .picasa-gallery .gallery-controls .play-control').mousedown(function(){
			$(this).addClass('mousedown');
		});
		$('.picasa-gallery .gallery-controls .pause-control, .picasa-gallery .gallery-controls .play-control').mouseup(function(){
			$(this).removeClass('mousedown');
		});
		$('.picasa-gallery .gallery-controls .play-control').click(); /* Starts animation on initial load */
	}
};
intervalSetter = function(interval,container) {
	$(container).data('picasaRotatorInterval', setInterval(function(){
		var active = $(container).children('.picasaRotatorActive');
		var next = (active.next()[0])?active.next():$(container).children('*:first-child');
		active.fadeOut(1000).removeClass('picasaRotatorActive');
		$('.thumb-carousel li.'+active.attr('class')).removeClass('picasaRotatorActive');
		$('.thumb-carousel li.'+next.attr('class')).addClass('picasaRotatorActive');
		next.fadeIn(1000).addClass('picasaRotatorActive');
		/*$(container).animate({
			height:next.innerHeight()
		},1000);*/
	},interval));
}
goAdjacentSlide = function(direction,container) {
	var active = $(container).children('.picasaRotatorActive');
	var next = (active.next()[0])?active.next():$(container).children('*:first-child');
	var previous = (active.prev()[0])?active.prev():$(container).children('*:last-child');
	var directionSlide = direction==='previous'?previous:next;
	//if (direction === 'previous'){ var directionSlide = previous } else
	active.fadeOut(1000).removeClass('picasaRotatorActive');
	$('.thumb-carousel li.'+active.attr('class')).removeClass('picasaRotatorActive');
	$('.thumb-carousel li.'+directionSlide.attr('class')).addClass('picasaRotatorActive');
	directionSlide.fadeIn(1000).addClass('picasaRotatorActive');
}
smartScroll = function (scrollContainer) {
	scrollContainer.bind('mouseenter',function(event){
		$(this).children().stop(true,true).fadeIn();
		var windowSize = $(window).width();
		var containerSize = scrollContainer.width();
		var thumbSize = scrollContainer.children().children().outerWidth();
		var carouselSize = thumbSize*scrollContainer.children().children().length;
		var nonScrollablePercent = thumbSize/containerSize;
		var scrollablePercent = 1 - (2*nonScrollablePercent);
		scrollContainer.children().css('width',carouselSize);
		var relativePositionX = event.clientX-scrollContainer.offset().left;
		var smartScroll = Math.round((((relativePositionX - nonScrollablePercent * containerSize) / (scrollablePercent * containerSize)) * (carouselSize - containerSize)));
		scrollContainer.animate({'scrollLeft':smartScroll},400, function(){
			scrollContainer.mousemove(function(event){
				var relativePositionX = event.clientX-scrollContainer.offset().left;
				var smartScroll = Math.round((((relativePositionX - nonScrollablePercent * containerSize) / (scrollablePercent * containerSize)) * (carouselSize - containerSize)));
				scrollContainer.scrollLeft(smartScroll);
			});
		});
	});
	scrollContainer.bind('mouseleave',function(event){
		$(this).unbind('mousemove').children().fadeOut();
	});
}
smartScrollSetter = function(scrollContainer,nonScrollablePercent,containerSize,scrollablePercent,carouselSize) {
	var relativePositionX = event.clientX-scrollContainer.offset().left;
	var smartScroll = Math.round((((relativePositionX - nonScrollablePercent * containerSize) / (scrollablePercent * containerSize)) * (carouselSize - containerSize)));
}
function showErrorMessage(){
	$('a#picasa-source').wrap('<div class="picasa-gallery"></div>');
	$('.picasa-gallery').append('<p>Gallery not available.</p>');
}

function fullPagePicasaGallery() {
	$('html').addClass('picasa-full-gallery');
	var fullPagePicasaGalleryObject = [];
	var numberOfAlbums = 0;
	var picasaRequestSize = 1600;
	var picasaImageSizes = [94, 110, 128, 200, 220, 288, 320, 400, 512, 576, 640, 720, 800, 912, 1024, 1152, 1280, 1440, 1600];
	picasaImageSizes.reverse();
	$.each(picasaImageSizes, function(key,value){
		if($(window).height() - 100 > value){
			picasaRequestSize = value;
			return false;
		} else {
			return true;
		}
	});
	console.log(picasaGalleryMaxResults);
	var maxResults = (picasaGalleryMaxResults > 0) ? '&max-results='+picasaGalleryMaxResults : '';
	for (var i = 0; i < picasaGalleryFullSource.length; i++) {
		$.ajax({
			url:'http://picasaweb.google.com/data/feed/api/user/'+picasaGalleryUser+'/album/'+picasaGalleryFullSource[i]+'?alt=json-in-script&imgmax='+picasaRequestSize+maxResults+'&q=',
			success: function(data,status) {
				$.each(data.feed.entry, function(key,value){
					fullPagePicasaGalleryObject.push(value);
				});
				numberOfAlbums ++;
				if (numberOfAlbums == picasaGalleryFullSource.length) {
					buildFullPagePicasaGallery(fullPagePicasaGalleryObject,picasaRequestSize);
				}
			},
			timeout:160000,
			dataType: 'jsonp'
		});
	}
}

function buildFullPagePicasaGallery(fullPagePicasaGalleryObject,picasaRequestSize) {
	var galleryContainer = $('ul.picasa-gallery-full').css({
		width:picasaRequestSize,
		marginTop:($(window).height() - (picasaRequestSize + 50)) / 2
	});
	var sortedGalleryObject = [];
	$.each(fullPagePicasaGalleryObject, function(key,value){
		sortedGalleryObject.push([value.updated.$t+'_'+value.gphoto$id.$t, {
			'albumTitle':value.gphoto$albumtitle.$t,
			'imgId':value.gphoto$id.$t,
			'imgTitle':value.title.$t,
			'imgUrl':value.media$group.media$content[0].url,
			'imgWidth':value.media$group.media$content[0].width,
			'imgHeight':value.media$group.media$content[0].height,
			'imgCaption':value.media$group.media$description.$t,
			'imgThumb':value.media$group.media$thumbnail[0].url
		}]);
	});
	sortedGalleryObject.sort();
	sortedGalleryObject.reverse();
	if (picasaGalleryRandomizer == 'true') {
		sortedGalleryObject.sort(function() {
			return 0.5 - Math.random()
		});
	}
	$.each(sortedGalleryObject, function(key,value){
		thisImg = $('<img />', {
			src:value[1].imgUrl,
			alt:value[1].imgTitle,
			css:{marginTop:(picasaRequestSize - value[1].imgHeight)/2}
		});
		thisCaption = value[1].imgCaption!==''?'<p class="caption">'+value[1].imgCaption+'</p>':'';
		thisLi = $('<li />', {
			'class':'img_'+value[1].imgId,
			css: {
				width:picasaRequestSize
			}
		}).append(thisImg).append('<h2 class="image-location">'+value[1].albumTitle+'</h2>'+thisCaption);
		galleryContainer.append(thisLi);
	});
	var initialSlide = galleryContainer.children('.initial');
	initialSlide.css({
		'margin-top':(picasaRequestSize - 417)/2,
		'width':picasaRequestSize
	}).fadeIn(1000).find('.controls .btn').click(function(e){
		e.preventDefault();
		initialSlide.fadeOut(1000, function(){
			$(this).remove();
		}).next().fadeIn(1000, function() {
			$(this).addClass('active');
		});
		picasaFullInterval($('#picasa-gallery-interval-selector').val()*1000,galleryContainer);
	});
}

function picasaFullInterval(interval,container) {
	var thisContainer = $(container);
	if(!thisContainer.data('thisInterval')) {
		thisContainer.data('thisInterval',setInterval(function(){
			thisContainer.children('.active').fadeOut(1000, function(){
				$(this).remove();
			}).next().fadeIn(1000, function() {
				$(this).addClass('active');
			});
			if (thisContainer.children().length < 20 ) {
				fullPagePicasaGallery();
			}
		},interval));
	}
}