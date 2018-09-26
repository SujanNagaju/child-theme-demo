<?php 
/**
 * Template Name: Category Slider
 */
get_header();
?>
<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			echo do_shortcode('[instruments id="7"]');
			?> 
		</main>
	</div>
</div>
<?php
get_footer();