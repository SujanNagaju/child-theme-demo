<?php 
/**
 * Template Name: Shortcodes
 */
get_header();
?>
<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			echo do_shortcode('[term taxonomy="brand" field="term_id" terms="4"]');
			?>
		</main>
	</div>
</div>
<?php
get_footer();