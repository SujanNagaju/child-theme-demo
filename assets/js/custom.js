	jQuery(function($){
		//console.log('alert');
		//alert('message');
		$('#slider').slick({
			autoplay: true,
			autoplaySpeed: 5000,
			dots: true,
			// fade: true,	
			draggable: true,
			arrows: true,
			// infinite: false,
			// slidesToShow: 2,
			adaptiveHeight: false,
		});

		//ajax search
		jQuery('#search').submit(function(e){
			e.preventDefault();  
			var search = jQuery('#search #search_for').val();
			//the ajax begins now
			jQuery.ajax({  
    			type: 'POST',  
    			url: myAjax.ajax_url,
    			data: {action: 'my_ajax_handler',search_for:search}, 
    		beforeSend: function(){

			},
    		success: function(response){
    			//console.log(response);
    			jQuery('.message').html(response.output).show();
			},  
    		error: function(MLHttpRequest, textStatus, errorThrown){
    			console.log(errorThrown);  
			}  
		 	});
		});

		
	//infinite scroll 
/*	$(document).on('click', '.load-more', function(){
		var current_page = $(this).data('page');
		
		jQuery.ajax({
			type: 'POST',
			url: myAjax.ajax_url,
			data: {action: 'show_more_posts', current_page:current_page}, 
		
		error : function(response){
				console.log(response.result);
		} ,
		success : function(response){
			$('.load-more').data('page',response.current_page);
			$('.post-listing').append(response.result);
			if(response.result == 'NO MORE POSTS'){
				$('.load-more').hide();
			}
		}
		//console.log(page);
		});
	});*/

function isOnScreen(elem) {
		// if the element doesn't exist, abort
		if( elem.length == 0 ) {
			return;
		}
		var $window = jQuery(window)
		var viewport_top = $window.scrollTop()
		var viewport_height = $window.height()
		var viewport_bottom = viewport_top + viewport_height
		var $elem = jQuery(elem)
		var top = $elem.offset().top - 100
		var height = $elem.height()
		var bottom = top + height

		return (top >= viewport_top && top < viewport_bottom) ||
		(bottom > viewport_top && bottom <= viewport_bottom) ||
		(height > viewport_height && top <= viewport_top && bottom >= viewport_bottom)
	}
	
	var stop_loadmore = false;
	$(window).on('scroll', function(e) {
		var $load_more = $('.load-more'),
			current_page = $load_more.data('page');

		if( isOnScreen( $load_more ) && false === stop_loadmore ) {  
			stop_loadmore = true;
			// Pass element id/class you want to check 	
			jQuery.ajax({
				type: 'POST',
				url: myAjax.ajax_url,
				data: {action: 'show_more_posts', current_page:current_page}, 

				error : function(response){
					console.log(response.result);
				} ,
				success : function(response){
					$load_more.data('page', response.current_page);
					$('.post-listing').append(response.result);
					if(response.result == 'NO MORE POSTS'){
						$load_more.hide();
						stop_loadmore = true;
						return false;
					}
					stop_loadmore = false;
				}
			});

			
 		}
 		
	});

//trying jQuery 
	$('.game').mouseover(function(){
		alert('start game');
	});

	$('.game').mouseleave(function(){
		alert('You are out of the game');
	});
});