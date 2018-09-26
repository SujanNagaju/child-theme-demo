<?php 
/**
 * Template Name: Custom Post Types
 */
get_header();
?>
<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			
			<?php

			$custom_posts = new WP_Query( array( 
				'post_type' => 'vehicles',
				'posts_per_page' => 1
			) );
	
			if($custom_posts->have_posts()){?>
			<div class="post-listing">
			<?php

			while($custom_posts->have_posts()){
				$custom_posts->the_post();
				echo '<h1>'.get_the_title().get_the_ID(). '</h1>';
				the_post_thumbnail();
				the_content();
			}
			//paginations 
		
			 } 
			/*$big = 99999;
			echo paginate_links( array(

				'base' => str_replace($big, '%#%', get_pagenum_link($big)),
				'format' => '?paged=%#%',
				'current' => max(1, get_query_var('paged')),
				'total' => $custom_posts->max_num_pages
			) );*/

			wp_reset_postdata();
		
			?> 
			</div>
			 <div class="container text-center load-more" data-page="1">
				<!-- <a class="btn btn-primary load-more" data-page="2">Load More </a> -->
			</div>
			
		</main>

	</div>
</div>
<?php
get_footer();

