<?php 
/**
 * Template Name: Slider
 */
get_header();
?>

		
	<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php 
				echo do_shortcode('[slider]');
			 ?>
		</main>
	</div>
</div>
 
<?php 
get_footer();