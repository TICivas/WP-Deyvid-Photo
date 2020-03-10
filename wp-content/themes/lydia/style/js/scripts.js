jQuery(document).ready(function() {
    'use strict';
    
    /*-----------------------------------------------------------------------------------*/
    /*	WordPress Stuff
    /*-----------------------------------------------------------------------------------*/
    jQuery('.slide-portfolio-item-content').appendTo('body');
    jQuery('p:empty').remove();
    
    /*-----------------------------------------------------------------------------------*/
    /*	SCROLL NAVIGATION HIGHLIGHT
    /*-----------------------------------------------------------------------------------*/
    var headerWrapper = parseInt(jQuery('.navbar').height(), 10);
    var header_height = jQuery('.navbar').height();
    var shrinked_header_height = 70;
    var offsetTolerance = -(header_height);
    //Detecting user's scroll
    jQuery(window).scroll(function() {
        //Check scroll position
        var scrollPosition = parseInt(jQuery(this).scrollTop(), 10);
        //Move trough each menu and check its position with scroll position then add current-menu-parent class
        jQuery('.navbar ul a[href^="#"]').not('.navbar ul a[href="#"], .navbar ul a[href="#!"]').each(function() {
            var thisHref = jQuery(this).attr('href');
            
            if( jQuery(thisHref).length ){
                var thisTruePosition = parseInt(jQuery(thisHref).offset().top, 10);
                var thisPosition = thisTruePosition - headerWrapper - offsetTolerance;
                if (scrollPosition >= ( thisPosition - 70 ) ) {
                    jQuery('.current-menu-parent').removeClass('current-menu-parent');
                    jQuery('.navbar ul a[href="' + thisHref + '"]').parent('li').addClass('current-menu-parent');
                }
            }
            
        });
        //If we're at the bottom of the page, move pointer to the last section
        var bottomPage = parseInt(jQuery(document).height(), 10) - parseInt(jQuery(window).height(), 10);
        if (scrollPosition == bottomPage || scrollPosition >= bottomPage) {
        	if( jQuery(jQuery('.navbar ul a[href^="#"]:last').attr('href')).length ){
          	    jQuery('.current-menu-parent').removeClass('current-menu-parent');
            	jQuery('.navbar ul a[href^="#"]:last').parent('li').addClass('current-menu-parent');
        	}
        }
    });
    /*-----------------------------------------------------------------------------------*/
    /*	MENU
	/*-----------------------------------------------------------------------------------*/
    jQuery('.js-activated').dropdownHover({
        instantlyCloseOthers: false,
        delay: 0
    }).dropdown();
    jQuery('.btn.responsive-menu').on('click', function() {
        jQuery(this).toggleClass('opn');
    });
    jQuery('.onepage .navbar .nav li a').on('click', function() {
        jQuery('.navbar .navbar-collapse.in').collapse('hide');
        jQuery('.btn.responsive-menu').removeClass('opn');
    });
    jQuery('.offset').css('padding-top', jQuery('.navbar').height() + 'px');
    /*-----------------------------------------------------------------------------------*/
	/*	STICKY FILTER HIGHLIGHT
	/*-----------------------------------------------------------------------------------*/
		var stickyWrapper		= parseInt(jQuery('#sticky-filter').height(), 10);
		var stickyOffsetTolerance	= 70;		
		//Detecting user's scroll
		jQuery(window).scroll(function() {		
			//Check scroll position
			var stickyScrollPosition	= parseInt(jQuery(this).scrollTop(), 10);			
			//Move trough each menu and check its position with scroll position then add current class
			jQuery('#sticky-filter a').each(function() {	
				var stickyThisHref				= jQuery(this).attr('href');
				var stickyThisTruePosition	= parseInt(jQuery(stickyThisHref).offset().top, 10);
				var stickyThisPosition 		= stickyThisTruePosition - stickyWrapper - stickyOffsetTolerance;				
				if(stickyScrollPosition >= stickyThisPosition) {					
					jQuery('.current').removeClass('current');
					jQuery('#sticky-filter a[href="'+ stickyThisHref +'"]').parent('li').addClass('current');					
				}
			});
			//If we're at the bottom of the page, move pointer to the last section
			var stickyBottomPage	= parseInt(jQuery(document).height(), 10) - parseInt(jQuery(window).height(), 10);			
			if(stickyScrollPosition == stickyBottomPage || stickyScrollPosition >= stickyBottomPage) {			
				jQuery('.current').removeClass('current');
				jQuery('#sticky-filter a:last').parent('li').addClass('current');
			}
		});
    /*-----------------------------------------------------------------------------------*/
    /*	LOCALSCROLL
	/*-----------------------------------------------------------------------------------*/
    jQuery('.navbar, .scroll').localScroll({
        hash: true,
        offset: {top:-70, left:0}
    });
    jQuery('#sticky-filter ul').localScroll({
	    offset: {top:-134, left:0}
    });
    /*-----------------------------------------------------------------------------------*/
	/*	STICKY FILTER
	/*-----------------------------------------------------------------------------------*/
	if( jQuery('body').hasClass('admin-bar') ){
		var theSpacing = 102;
	} else {
		var theSpacing = 70;
	}
	jQuery("#sticky-filter").sticky({ topSpacing: theSpacing, className:"sfilter", responsiveBreakpoint: 0 });
    /*-----------------------------------------------------------------------------------*/
    /*	CUBE PORTFOLIO
    /*-----------------------------------------------------------------------------------*/
    jQuery('.cbp-onepage-grid').cubeportfolio({
        filters: '#js-filters-full-width',
        loadMore: '#cbp-onepage-grid-more',
        loadMoreAction: 'click',
        layoutMode: 'mosaic',
        sortToPreventGaps: true,
        defaultFilter: '*',
        animationType: 'quicksand',
        gapHorizontal: 10,
        gapVertical: 10,
        gridAdjustment: 'responsive',
        mediaQueries: [{
            width: 768,
            cols: 3
        }, {
            width: 767,
            cols: 1
        }],
        caption: 'fadeIn',
        displayType: 'lazyLoading',
        displayTypeSpeed: 100,

        // lightbox
        lightboxDelegate: '.cbp-lightbox',
        lightboxGallery: true,
        lightboxTitleSrc: 'data-title',
        lightboxCounter: '<div class="cbp-popup-lightbox-counter">{{current}} of {{total}}</div>',
        // singlePageInline
        singlePageInlineDelegate: '.cbp-singlePageInline',
        singlePageInlinePosition: 'top',
        singlePageDeeplinking: true,
        singlePageInlineInFocus: true,
        offsetValue: 100,
        singlePageInlineCallback: function(url, element) {
            // to update singlePageInline content use the following method: this.updateSinglePageInline(yourContent)
            var t = this;
            jQuery.ajax({
                url: url,
                type: 'GET',
                dataType: 'html',
                timeout: 10000
            }).done(function(result) {
            	result = jQuery(result).find('.ebor-single-post').addClass('cbp-l-inline');
            	t.updateSinglePageInline(result);
            }).fail(function() {
                t.updateSinglePageInline('AJAX Error! Please refresh the page!');
            });
        }
    });
    jQuery('#js-grid-full-width').cubeportfolio({
        filters: '#js-filters-full-width',
        loadMore: '#js-grid-full-width-more',
        loadMoreAction: 'click',
        layoutMode: 'mosaic',
        sortToPreventGaps: true,
        defaultFilter: '*',
        animationType: 'quicksand',
        gapHorizontal: 0,
        gapVertical: 0,
        gridAdjustment: 'responsive',
        mediaQueries: [{
            width: 2560,
            cols: 6
        }, {
            width: 1920,
            cols: 5
        }, {
            width: 1450,
            cols: 4
        }, {
            width: 1024,
            cols: 3
        }, {
            width: 768,
            cols: 2
        }, {
            width: 650,
            cols: 1
        }],
        caption: 'fadeIn',
        displayType: 'lazyLoading',
        displayTypeSpeed: 100,

        // lightbox
        lightboxDelegate: '.cbp-lightbox',
        lightboxGallery: true,
        lightboxTitleSrc: 'data-title',
        lightboxCounter: '<div class="cbp-popup-lightbox-counter">{{current}} of {{total}}</div>',
        // singlePageInline
        singlePageInlineDelegate: '.cbp-singlePageInline',
        singlePageInlinePosition: 'top',
        singlePageDeeplinking: true,
        singlePageInlineInFocus: true,
        offsetValue: 100,
        singlePageInlineCallback: function(url, element) {
            // to update singlePageInline content use the following method: this.updateSinglePageInline(yourContent)
            var t = this;
            jQuery.ajax({
                url: url,
                type: 'GET',
                dataType: 'html',
                timeout: 10000
            }).done(function(result) {
            	result = jQuery(result).find('.ebor-single-post').addClass('cbp-l-inline');
            	
            	result.find('.light-wrapper').removeClass('light-wrapper').addClass('dark-wrapper').remove();
            	result.find('.inner.bp0').addClass('tp0');
            	
            	result.imagesLoaded(function(){
            		
            		t.updateSinglePageInline(result);
            		
	            	jQuery('.cbp-l-inline .swiper-container.gallery').each(function(){
	            		  jQuery(this).swiper({
	            		    grabCursor: true,
	            		    slidesPerView: 'auto',
	            		    wrapperClass: 'swiper',
	            		    slideClass: 'item',
	            		    offsetPxBefore: 0,
	            		    offsetPxAfter: 0
	            		  });
	            		
	            		  var $swipers = jQuery(this);
	            		
	            		$swipers.siblings('.arrow-left').on( "click", function(){
	            		$swipers.data('swiper').swipeTo($swipers.data('swiper').activeIndex-1);
	            		return false;
	            		});
	            		$swipers.siblings('.arrow-right').on( "click", function(){
	            		$swipers.data('swiper').swipeTo($swipers.data('swiper').activeIndex+1);
	            		return false;
	            		});
	            	});
	            	
	            	jQuery('.cbp-l-inline .basic-slider').owlCarousel({
	            	    items: 1,
	            	    nav: true,
	            	    navText: ['', ''],
	            	    dots: true,
	            	    autoHeight: false,
	            	    loop: true,
	            	    margin: 0
	            	});
            	
            	});
            	
            }).fail(function() {
                t.updateSinglePageInline('AJAX Error! Please refresh the page!');
            });
        }
    });
    jQuery('#js-grid-mosaic').cubeportfolio({
        filters: '#js-filters-mosaic',
        loadMore: '#js-grid-mosaic-more',
        loadMoreAction: 'click',
        layoutMode: 'mosaic',
        sortToPreventGaps: true,
        defaultFilter: '*',
        animationType: 'quicksand',
        gapHorizontal: 0,
        gapVertical: 0,
        gridAdjustment: 'responsive',
        mediaQueries: [{
            width: 768,
            cols: 4
        }, {
            width: 767,
            cols: 2
        }],
        caption: 'fadeIn',
        displayType: 'lazyLoading',
        displayTypeSpeed: 100,

        // lightbox
        lightboxDelegate: '.cbp-lightbox',
        lightboxGallery: true,
        lightboxTitleSrc: 'data-title',
        lightboxCounter: '<div class="cbp-popup-lightbox-counter">{{current}} of {{total}}</div>',
        // singlePageInline
        singlePageInlineDelegate: '.cbp-singlePageInline',
        singlePageInlinePosition: 'top',
        singlePageDeeplinking: true,
        singlePageInlineInFocus: true,
        offsetValue: 100,
        singlePageInlineCallback: function(url, element) {
            // to update singlePageInline content use the following method: this.updateSinglePageInline(yourContent)
            var t = this;
            jQuery.ajax({
                url: url,
                type: 'GET',
                dataType: 'html',
                timeout: 10000
            }).done(function(result) {
            	result = jQuery(result).find('.ebor-single-post').addClass('cbp-l-inline');
            	t.updateSinglePageInline(result);
            }).fail(function() {
                t.updateSinglePageInline('AJAX Error! Please refresh the page!');
            });
        }
    });
    
    jQuery('.cbp-l-loadMore-link').on('click.cbp', function(e) {
        e.preventDefault();
        var clicks, me = jQuery(this),
            oMsg;
    
        if (me.hasClass('cbp-l-loadMore-button-stop')) {
            return;
        }
    
        // set loading status
        oMsg = me.text();
        me.text(me.attr('data-loading-text'));
    
        // perform ajax request
        jQuery.ajax({
            url: me.attr('href'),
            type: 'GET',
            dataType: 'HTML'
        }).done(function(result) {
            var items = jQuery(result).find('.ebor-load-more');
            jQuery('#js-grid-mosaic').cubeportfolio('appendItems', items.html());
            me.remove();
        }).fail(function() {
            alert('fail');
        });
    
    });
    /*-----------------------------------------------------------------------------------*/
    /*	OWL CAROUSEL
	/*-----------------------------------------------------------------------------------*/
    jQuery('.carousel-boxed').owlCarousel({
        loop: false,
        margin: 30,
        nav: true,
        navText: ['', ''],
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 2
            },
            992: {
                items: 3
            }
        }
    });
    jQuery('.basic-slider').owlCarousel({
        items: 1,
        nav: true,
        navText: ['', ''],
        dots: true,
        autoHeight: false,
        loop: true,
        margin: 0
    });
    jQuery('.blog-carousel').owlCarousel({
	    items: 5,
	    nav: true,
	    navText: ['', ''],
	    dots: false,
	    loop: false,
	    margin: 0,
	    autoWidth: false,
	    responsive: {
	        0: {
	            items: 1
	        },
	        600: {
	            items: 2
	        },
	        1441: {
	            items: 3
	        },
	        1921: {
	            items: 4
	        }
	    }
	});
    jQuery('.clients').owlCarousel({
        autoplay: true,
        autoplayTimeout: 3000,
        loop: true,
        margin: 50,
        nav: false,
        dots: false,
        responsive: {
            0: {
                items: 3
            },
            768: {
                items: 5
            },
            1200: {
                items: 6
            }
        }
    });
    if( jQuery('.testimonials > div').length > 1 ){
	    jQuery('.testimonials').owlCarousel({
	        items: 1,
	        nav: false,
	        dots: false,
	        autoHeight: true,
	        autoplay: true,
	        autoplayTimeout: 5000,
	        loop: true,
	        margin: 0
	    });
    }
    /*-----------------------------------------------------------------------------------*/
    /*	SWIPER
	/*-----------------------------------------------------------------------------------*/
    jQuery('.swiper-container.gallery').each(function(){
		  jQuery(this).swiper({
		    grabCursor: true,
		    slidesPerView: 'auto',
		    wrapperClass: 'swiper',
		    slideClass: 'item',
		    offsetPxBefore: 0,
		    offsetPxAfter: 0
		  });
		
		  var $swipers = jQuery(this);
		
		$swipers.siblings('.arrow-left').on( "click", function(){
			$swipers.data('swiper').swipeTo($swipers.data('swiper').activeIndex-1);
			return false;
		});
		$swipers.siblings('.arrow-right').on( "click", function(){
			$swipers.data('swiper').swipeTo($swipers.data('swiper').activeIndex+1);
			return false;
		});
	});
    /*-----------------------------------------------------------------------------------*/
    /*	FITVIDS VIDEO
	/*-----------------------------------------------------------------------------------*/
    jQuery('.player').fitVids();
    /*-----------------------------------------------------------------------------------*/
    /*	IMAGE ICON HOVER
	/*-----------------------------------------------------------------------------------*/
    jQuery('.icon-overlay a').prepend('<span class="icn-more"></span>');
    /*-----------------------------------------------------------------------------------*/
    /*	FANCYBOX
	/*-----------------------------------------------------------------------------------*/
    jQuery(".fancybox-media").fancybox({
        arrows: true,
        padding: 0,
        closeBtn: true,
        openEffect: 'fade',
        closeEffect: 'fade',
        prevEffect: 'fade',
        nextEffect: 'fade',
        helpers: {
            media: {},
            overlay: {
                locked: false
            },
            buttons: false,
            thumbs: false,
            title: {
                type: 'inside'
            }
        },
        beforeLoad: function() {
            var el, id = jQuery(this.element).data('title-id');
            if (id) {
                el = jQuery('#' + id);
                if (el.length) {
                    this.title = el.html();
                }
            }
        }
    });
    /*-----------------------------------------------------------------------------------*/
    /*	PROGRESS BAR
	/*-----------------------------------------------------------------------------------*/
    jQuery('.progress-list .progress .bar').progressBar({
			shadow : false,
			percentage : false,
			animation : true,
			height: 15
	});
    /*-----------------------------------------------------------------------------------*/
    /*	BACKGROUND VIDEO PARALLAX
	/*-----------------------------------------------------------------------------------*/
    jQuery('#video-office').backgroundVideo({
        $outerWrap: jQuery('.outer-wrap'),
        pauseVideoOnViewLoss: false,
        parallaxOptions: {
            effect: 1.9
        }
    });
    /*-----------------------------------------------------------------------------------*/
    /*	PARALLAX MOBILE
	/*-----------------------------------------------------------------------------------*/
    if (navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i) || navigator.userAgent.match(/BlackBerry/i)) {
        jQuery('.parallax').addClass('mobile');
    }
    /*-----------------------------------------------------------------------------------*/
    /*	DATA REL
	/*-----------------------------------------------------------------------------------*/
    jQuery('a[data-rel]').each(function() {
        jQuery(this).attr('rel', jQuery(this).data('rel'));
    });
    /*-----------------------------------------------------------------------------------*/
    /*	TOOLTIP
    /*-----------------------------------------------------------------------------------*/
    if (jQuery("[rel=tooltip]").length) {
        jQuery("[rel=tooltip]").tooltip();
    }
    /*-----------------------------------------------------------------------------------*/
    /* INPUT FOCUS
	/*-----------------------------------------------------------------------------------*/
    jQuery('.comment-form input[title], .comment-form textarea').each(function () {
        if (jQuery(this).val() === '') {
            jQuery(this).val(jQuery(this).attr('title'));
        }

        jQuery(this).focus(function () {
            if (jQuery(this).val() == jQuery(this).attr('title')) {
                jQuery(this).val('').addClass('focused');
            }
        });
        jQuery(this).blur(function () {
            if (jQuery(this).val() === '') {
                jQuery(this).val(jQuery(this).attr('title')).removeClass('focused');
            }
        });
    });
    /*-----------------------------------------------------------------------------------*/
    /* WIDTH CLASS
	/*-----------------------------------------------------------------------------------*/
    assign_bootstrap_mode();
    jQuery(window).resize(function() {
        assign_bootstrap_mode();
    });
    function assign_bootstrap_mode() {
        var width = jQuery(window).width();
        var mode = '';
        if (width < 768) {
            mode = "mode-xs";
        } else if (width < 992) {
            mode = "mode-sm";
        } else if (width < 1200) {
            mode = "mode-md";
        } else if (width > 1200) {
            mode = "mode-lg";
        }
        jQuery("body").removeClass("mode-xs").removeClass("mode-sm").removeClass("mode-md").removeClass("mode-lg").addClass(mode);
    }
    
    var instagramFeed2 = new Instafeed({
        target: 'instafeed-widget',
        get: 'user',
        limit: 6,
        userId: 1215763826,
        accessToken: '1215763826.467ede5.aa54392aa9eb46f0b9e7191f7211ec3a',
        resolution: 'low_resolution',
        template: '<div class="item"><figure class="icon-overlay"><a href="{{link}}"><img src="{{image}}" /></a></figure></div>',
        after: function() {
            jQuery('#instafeed-widget .item .icon-overlay a').prepend('<span class="icn-more"></span>');
            var $portfoliogrid = jQuery('.image-grid .isotope');
            $portfoliogrid.isotope({
                itemSelector: '.item',
                transitionDuration: '0.7s',
                masonry: {
                    columnWidth: $portfoliogrid.width() / 12
                },
                layoutMode: 'masonry'
            });
            jQuery(window).resize(function() {
                $portfoliogrid.isotope({
                    masonry: {
                        columnWidth: $portfoliogrid.width() / 12
                    }
                });
            });
            $portfoliogrid.imagesLoaded(function() {
                $portfoliogrid.isotope('layout');
            });
        },
        success: function(response){
        	response.data.forEach(function(e){
        		e.images.thumbnail = {
        			url: e.images.thumbnail.url,
        			width: 600,
        			height: 600
        		};
        	});
        }
    });
    jQuery('#instafeed-widget').each(function() {
        instagramFeed2.run();
    });
    /*-----------------------------------------------------------------------------------*/
    /*	ISOTOPE GRID VIEW COL3
    /*-----------------------------------------------------------------------------------*/
    var $gridviewcol3 = jQuery('.grid-view.col3 .isotope');
    $gridviewcol3.isotope({
        itemSelector: '.grid-view-post',
        transitionDuration: '0.6s',
        masonry: {
            columnWidth: '.col-sm-6.col-md-4'
        },
        layoutMode: 'masonry'
    });
    jQuery(window).resize(function() {
        $gridviewcol3.isotope({
            masonry: {
                columnWidth: '.col-sm-6.col-md-4'
            }
        });
    });
    $gridviewcol3.imagesLoaded(function() {
        $gridviewcol3.isotope('layout');
    });
    /*-----------------------------------------------------------------------------------*/
    /*	ISOTOPE GRID VIEW COL2
    /*-----------------------------------------------------------------------------------*/
    var $gridviewcol2 = jQuery('.grid-view.col2 .isotope');
    $gridviewcol2.isotope({
        itemSelector: '.grid-view-post',
        transitionDuration: '0.6s',
        masonry: {
            columnWidth: '.col-md-6.col-sm-12'
        },
        layoutMode: 'masonry'
    });
    jQuery(window).resize(function() {
        $gridviewcol2.isotope({
            masonry: {
                columnWidth: '.col-md-6.col-sm-12'
            }
        });
    });
    $gridviewcol2.imagesLoaded(function() {
        $gridviewcol2.isotope('layout');
    });
    /*-----------------------------------------------------------------------------------*/
    /*	ISOTOPE PORTFOLIO GRID
    /*-----------------------------------------------------------------------------------*/
    var $portfoliogrid = jQuery('.image-grid .isotope');
    $portfoliogrid.isotope({
        itemSelector: '.item',
        transitionDuration: '0.7s',
        masonry: {
            columnWidth: $portfoliogrid.width() / 12
        },
        layoutMode: 'masonry'
    });
    jQuery(window).resize(function() {
        $portfoliogrid.isotope({
            masonry: {
                columnWidth: $portfoliogrid.width() / 12
            }
        });
    });
    $portfoliogrid.imagesLoaded(function() {
        $portfoliogrid.isotope('layout');
    });
    
    jQuery(window).trigger('resize');
});
/*-----------------------------------------------------------------------------------*/
/*	LOADING
/*-----------------------------------------------------------------------------------*/
jQuery(window).load(function() {
    jQuery('#status').fadeOut();
    jQuery('#preloader').delay(350).fadeOut('slow');
    jQuery('#preloader .textload').delay(0).fadeOut('slow');
    
    jQuery(window).trigger('resize');
});
/*-----------------------------------------------------------------------------------*/
/*	STICKY HEADER
/*-----------------------------------------------------------------------------------*/
function init() {
"use strict";
        window.addEventListener('scroll', function(e){
            var distanceY = window.pageYOffset || document.documentElement.scrollTop,
                shrinkOn = 100,
                header = document.querySelector(".navbar");
            if (distanceY > shrinkOn) {
                classie.add(header,"fixed");
            } else {
                if (classie.has(header,"fixed")) {
                    classie.remove(header,"fixed");
                }
            }
        });
    }
    window.onload = init();
jQuery(window).resize(function() {
	jQuery('.offset').css('padding-top', jQuery('.navbar').height() + 'px');        
}); 