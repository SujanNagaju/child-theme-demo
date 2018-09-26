<?php 
function term_shortcodes($atts){
	$a = shortcode_atts( array ( 
		'taxonomy' 	=> 'brand',
		'field' => '',
		'terms' => '',
	),$atts );
	
/*	$vehicle_taxonomy = get_terms(array(
		'taxonomy' => $a['taxonomy'],
		// 'parent' => 0,
		'include' => $a['terms'],
		'hide_empty' => false,
		//'exclude' => array(4,3), //$a,
	));*/
	//$counter = 0;

	//foreach($vehicle_taxonomy as $vehicle){
		ob_start();

		/*echo '<h1><u><b><i>'.$vehicle->name .'</i></b></u></h1>';
		$vehicle_id = $vehicle->term_id;*/
		$vehicle_term = get_term( $a['terms'], $a['taxonomy'] );
		echo '<h1><u><b><i>'.$vehicle_term->name .'</i></b></u></h1>';
		$query = new WP_query(
			array(
				'post_type' => 'vehicles',
				'tax_query' => array(
					array(
						'taxonomy' => $a['taxonomy'],
						'field' => 'term_id',
						'terms' => $a['terms'],
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

		}// end $query while loop
		wp_reset_postdata();

		$content = ob_get_clean();
		//$counter += 1;
	//} // end foreach $vehicle_taxonomy

	return $content;

} // end function term_shortcodes
add_shortcode('term', 'term_shortcodes');


//slider shortcode 
function slider_create_shortcode(){
	ob_start();
	?>
	<div class="row">
		<div id="slider" class="slick-slides col col-12">
			<?php 
			$query = new WP_Query(
				array(
					'post_type' => 'slide'
				)
			);
			while($query->have_posts()){
				$query->the_post();
				echo get_the_post_thumbnail();

			}
			wp_reset_postdata();
			?>
		</div>
	</div>
<?php
$content = ob_get_clean();
return $content;
}
add_shortcode('slider', 'slider_create_shortcode');



//select from post category
//create shortcode to display slider category wise
function shortcode_category_slider($atts){
	ob_start();
		$a = shortcode_atts( array ( 
			'category' => 'phone',
		),$atts );
		?>

		<div class="row">
			<div id="slider" class="slick-slides col col-12">
				<?php
				$query = new WP_Query( array(
					'category_name' => $a['category'],
					'post_type' => 'post',
				) );

				if($query->have_posts()){
					while($query->have_posts()){
						$query->the_post();
						?>

						<?php if(has_post_thumbnail()){ 
							echo get_the_post_thumbnail(); 
						} ?>

						<?php
					}
					wp_reset_postdata();
				}
				?>
			</div>
		</div>

		<?php
	}
add_shortcode('catslider', 'shortcode_category_slider');

//select from taxonomy instrument 
//shortcode to display the slider category wise inside the taxnomy
function taxonomy_slider_shortcode($atts){
	$a = shortcode_atts( array(
		'id' => 5,
	),$atts );
	ob_start();
	?>
	<div class="row">
		<div class="slick-slides col col-12" id="slider">
			<?php  
				$instrument_taxonomy = get_terms( array(
					'taxonomy' => 'instrument',
					'include' => $a['id'],
					'hide_empty' => true,
				));
				foreach ($instrument_taxonomy as $instrument){
					$query = new WP_Query(
						array(
							'post_type' => 'slide',
							'tax_query' => array(
								array(
									'taxonomy' => 'instrument',
									'field'=>'name',
									'terms' => $instrument->name
								)
							),
						)
					);
					while($query->have_posts()){
						$query->the_post();
						the_post_thumbnail();
					}
					wp_reset_postdata(); //while loop ends here 
				}//end foreach loop here 
				//var_dump($instrument_taxonomy);
			?>
			
		</div>
	</div>
	
	<?php
	$content = ob_get_clean();
	return $content;
}
add_shortcode('instruments', 'taxonomy_slider_shortcode');

//shortcode to display slider category wise 

function sujans_shortcode($atts){
	$a = shortcode_atts(array(
		'id' => 5,
		),$atts
	);
	ob_start();
	?>
		<div class="row">
			<div id = "slider" class="slick-slides col col-12">
				<?php
					$instrument_taxonomy = get_terms(
						array(
							'taxonomy' => 'instrument',
							'include' => $a['id'],

						)
					);
					foreach($instrument_taxonomy as $instrument){
						$query = new WP_Query(
							array(
								'post_type' => 'slide',
								'tax_query' => array(
									array(
										'taxonomy' => 'instrument',
										'field' => 'name',
										'terms' => $instrument->name,
									)
								),
							)
						);
						while($query->have_posts()){
							$query->the_post();
							the_post_thumbnail();
						}
						wp_reset_postdata();
					
				?>
			</div>
		</div>
		<?php
		$content = ob_get_clean();
		return $content;
	}
}
add_shortcode('sujan', 'sujans_shortcode');