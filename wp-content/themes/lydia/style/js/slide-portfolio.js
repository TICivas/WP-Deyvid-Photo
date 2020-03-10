/*-----------------------------------------------------------------------------------*/
/*	19. SLIDE PORTFOLIO
/*-----------------------------------------------------------------------------------*/
jQuery(document).ready(function($){
	var is_firefox = navigator.userAgent.indexOf('Firefox') > -1;

	//open team-member bio
	$('#slide-portfolio').find('ul a').on('click', function(event){
		event.preventDefault();
		var selected_member = $(this).data('type');
		$('.slide-portfolio-item-content.'+selected_member+' img').each(function(){
			jQuery(this).attr('src', jQuery(this).attr('data-src'));
		});
		$('.slide-portfolio-item-content.'+selected_member+'').addClass('slide-in');
		$('.slide-portfolio-item-content-close').addClass('is-visible');

		// firefox transitions break when parent overflow is changed, so we need to wait for the end of the trasition to give the body an overflow hidden
		if( is_firefox ) {
			$('main').addClass('slide-out').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
				$('body').addClass('overflow-hidden');
			});
		} else {
			$('main').addClass('slide-out');
			$('body').addClass('overflow-hidden');
		}

	});

	//close team-member bio
	$(document).on('click', '.slide-portfolio-overlay, .slide-portfolio-item-content-close', function(event){
		event.preventDefault();
		$('.slide-portfolio-item-content').removeClass('slide-in');
		$('.slide-portfolio-item-content-close').removeClass('is-visible');

		if( is_firefox ) {
			$('main').removeClass('slide-out').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
				$('body').removeClass('overflow-hidden');
			});
		} else {
			$('main').removeClass('slide-out');
			$('body').removeClass('overflow-hidden');
		}
	});
});