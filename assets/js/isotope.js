jQuery(function($){

var $grid = $('.grid').isotope({
  // options
  itemSelector: '.grid-item',
  layoutMode: 'fitRows'
});

// filter items on button click
$('.filter-button-group').on( 'click', 'button', function() {
  var filterValue = $(this).attr('data-filter');
  $grid.isotope({ filter: filterValue });
});

$('.isotope').click(function(){
	var current_page = $('.isotope').data('page');
	//console.log (current_page);

	jQuery.ajax({
		type:'POST',
		url:isotope_Ajax.ajax_url,
		data: {action:'more_vehicles', current_page:current_page },
		error: function(response){
			console.log('error');
		},

		success: function(response){
			$('.isotope').data('page', response.current_page);
			if(response.result == 'That\'s it...'){
				$('#message').append(response.result).show();
				$('.isotope').hide();
			}else{
				$(response.result).each(function() {
					var $this = $(this);
					$grid.isotope()
					.append( $this )
					.isotope( 'appended', $this )
					.isotope('layout');
				});
			} 
		}
	});
});

});