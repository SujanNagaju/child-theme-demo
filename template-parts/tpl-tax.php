<?php 
/**
 * Template name: Taxonomy
 */

get_header();
?>
<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			$vehicle_taxonomy = get_terms(array(
				'taxonomy' => 'brand',
				'parent' => 0,
				'hide_empty' => false,
			));
			/*echo '<pre>';
			var_dump($vehicle_taxonomy);
			die;*/
			foreach($vehicle_taxonomy as $vehicle){
				echo '<h1>'.$vehicle->name .'</h1>';
				$query = new WP_query(
					array(
						'post_type' => 'vehicles',
						'tax_query' => array(
							array(
								'taxonomy' => 'brand',
								'field' => 'term_id',
								'terms' => $vehicle->term_id,
							)
						),
					)
				);
				while($query->have_posts()){
					$query->the_post();
					echo '<p>'.  get_the_title(). '</p>';
					if(has_post_thumbnail()){
						the_post_thumbnail('twentyseventeen-featured-images');
					}
					else{
						echo '<p>No Preview available</p>';
					}
					echo '<p>'.get_the_content() .'</p>';

				}
				wp_reset_postdata();


	/*$vehicle_id = $vehicle->term_id;
	$vehicle_taxonomy = $vehicle->taxonomy;
	*/

 //wp_query to list the posts in the taxonomy

}
?>
		</main>
	</div>
</div>
<?php
get_footer();