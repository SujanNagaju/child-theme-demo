<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.2
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	if ( is_sticky() && is_home() ) :
		echo twentyseventeen_get_svg( array( 'icon' => 'thumb-tack' ) );
	endif;
	?>
	<header class="entry-header">
		<?php
		if ( 'post' === get_post_type() ) {
			echo '<div class="entry-meta">';
				if ( is_single() ) {
					twentyseventeen_posted_on();
				} else {
					echo twentyseventeen_time_link();
					twentyseventeen_edit_link();
				};
			echo '</div><!-- .entry-meta -->';
		};

		if ( is_single() ) {
			the_title( '<h1 class="entry-title">', '</h1>' );


			//inserted image here /*/*//*/****/*/*/*/*/*/*/*/**/*/*/*/*/*/**/*/*/
			if(has_post_thumbnail() && is_singular('vehicles') ){
				the_post_thumbnail('twentyseventeen-featured-images');
				echo '<br/>';
			

			//add link from metabox
			$status_meta = get_post_meta($post->ID, 'status_meta_key', true);
			$direction_meta = get_post_meta($post->ID, 'direction_meta_key', true);

			//check box 
			$check_boxes = array('above', 'below');
			$test = get_post_meta($post->ID, 'check_meta_key', true);
			$check_meta = ( $test ) ? $test : array();
			/*var_dump($direction_meta);
			die;*/
			?>
				<a href="<?php the_permalink() ?>" style="color:blue;"><?php echo $status_meta; ?></a><br/>
				
			<?php
			
			if($direction_meta == 'up'){
				echo $direction_meta.'<br/>';
			}
			//show checkbox
			if(in_array('above', $check_meta)){
			foreach ( $check_boxes as $checkbox ) {
			?>
			<input type="checkbox" name="checkbox[]" value="<?php echo $checkbox; ?>" <?php checked( ( in_array( $checkbox, $check_meta ) ) ? $checkbox : '', $checkbox ); ?> /><?php echo $checkbox; ?> <br />
			<?php
			}
		}
		}
		} elseif ( is_front_page() && is_home() ) {
			the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
		} else {
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		}
		?>
	</header><!-- .entry-header -->

	<?php if ( '' !== get_the_post_thumbnail() && ! is_single() ) : ?>
		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'twentyseventeen-featured-image' ); ?>
			</a>
		</div><!-- .post-thumbnail -->
	<?php endif; ?>

	<div class="entry-content">
		<?php
		/* translators: %s: Name of current post */
		the_content( sprintf(
			__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'twentyseventeen' ),
			get_the_title()
		) );
			wp_link_pages( array(
			'before'      => '<div class="page-links">' . __( 'Pages:', 'twentyseventeen' ),
			'after'       => '</div>',
			'link_before' => '<span class="page-number">',
			'link_after'  => '</span>',
		) );
		?>
	</div><!-- .entry-content -->
	<?php if(is_singular('vehicles')){ ?>
	<!-- $status_meta = get_post_meta($post->ID, 'status_meta_key', true); -->
	<a href="<?php the_permalink() ?>" style="color:blue;"><?php echo $status_meta; ?></a><br/>

	<?php
	if($direction_meta == 'down'){
				echo $direction_meta.'<br/>';
			}
	if(in_array('below', $check_meta)){
	foreach ( $check_boxes as $checkbox ) {
		?>
		<input type="checkbox" name="checkbox[]" value="<?php echo $checkbox; ?>" <?php checked( ( in_array( $checkbox, $check_meta ) ) ? $checkbox : '', $checkbox ); ?> /><?php echo $checkbox; ?> <br />
		<?php
	 }
	}
	}
	if ( is_single() ) {
		twentyseventeen_entry_footer();
	}
	?>

</article><!-- #post-## -->
