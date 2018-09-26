<?php 
/**
 * Template Name: isotope
 */
get_header();
?>
<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<div class="button-group filter-button-group">
				<button data-filter="*" id="show_all">show all</button>
			<?php 
			$vehicle_brands = get_terms('brand');
			foreach ($vehicle_brands as $brand){
				?>
				<button data-filter=".<?php echo $brand->slug ?>"><?php echo $brand->name; ?></button>
				<?php
			}
			 ?>
		</div>

			<div class="grid">	
				<?php 
				$paged = ( get_query_var('paged') ? absint( get_query_var('paged') ) : 1);
				$vehicles = new WP_Query(array(
						'post_type' => 'vehicles',
						'post_status' => 'publish',
						'paged' => $paged,
						'posts_per_page' =>4,
					));
				if($vehicles->have_posts()){

						
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
					
				}
				 ?>
			</div>
			
			<?php
			//echo next_posts_link( ) ;
			/*$big = 99999;
			

				echo paginate_links( array(
				'base' => str_replace($big, '%#%', get_pagenum_link($big)),
				'format' => '?paged=%#%',
				'paged' => $paged,
				'current' => max(1, get_query_var('paged')),
				'total' => $vehicles->max_num_pages
			) );*/
			 ?>
			<center><div id="message"></div></center>
			<button class="btn btn-primary isotope" data-page="1" >Show More Vehicles</button>
		</main>
	</div>
</div>
<?php
get_footer();