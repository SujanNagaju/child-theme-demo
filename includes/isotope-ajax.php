<?php 
add_action("wp_ajax_more_vehicles", "show_more_vehicles");
add_action("wp_ajax_nopriv_more_vehicles", "show_more_vehicles");
function show_more_vehicles(){
	$current_page = $_POST['current_page'];
	$next_page = $current_page +1 ;
	$vehicles = new WP_Query(array(
		'post_type' => 'vehicles',
		'post_status' => 'publish',
		'paged' => $next_page,
		'posts_per_page' =>4,
	));
	if($vehicles->have_posts()){
		ob_start();
		while ($vehicles->have_posts()){
			$vehicles->the_post();
			$terms = get_the_terms(get_the_ID(), 'brand');
			foreach ($terms as $term){
				?>
				<div class="grid-item <?php echo $term->slug ; ?>" >
					<a href="<?php the_permalink(); ?>" class="h5"><?php echo get_the_title().' '. $term->slug; ?></a><br/>
					<?php 

					if(has_post_thumbnail(get_the_ID())){
						echo get_the_post_thumbnail(get_the_ID());
					}
					echo get_the_excerpt(get_the_ID());
					?>
				</div>
				<?php
			}
		}
		wp_reset_postdata();
		$result = ob_get_clean();
		wp_send_json(array('result' => $result, 'current_page' => $next_page));
		
		die();

	}
	else{
		wp_send_json(array('result' => 'That\'s it...' ) );
		die();
	}	
}