<?php
/**
 * Displays footer site info
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */
$powered_by = get_theme_mod('test_select_dropdown');
$comments = get_theme_mod ('text_textarea');
?>

<div class="site-info">
	<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'twentyseventeen' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'twentyseventeen' ), $powered_by ); ?></a>
</div><!-- .site-info -->
<div class="site-info">
	<p><?php echo $comments; ?></p>
</div>