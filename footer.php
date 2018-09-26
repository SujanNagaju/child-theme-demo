<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.2
 */

?>

		</div><!-- #content -->

		<footer id="colophon" class="site-footer" role="contentinfo">
			<div class="wrap">
				<?php
				get_template_part( 'template-parts/footer/footer', 'widgets' );

				if ( has_nav_menu( 'social' ) ) : ?>
					<nav class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Social Links Menu', 'twentyseventeen' ); ?>">
						<?php
							wp_nav_menu( array(
								'theme_location' => 'social',
								'menu_class'     => 'social-links-menu',
								'depth'          => 1,
								'link_before'    => '<span class="screen-reader-text">',
								'link_after'     => '</span>' . twentyseventeen_get_svg( array( 'icon' => 'chain' ) ),
							) );
						?>
					</nav><!-- .social-navigation -->
				<?php endif;
				//***************************
				//show or hide content from the customizer according to checkbox 
				$copyright = get_theme_mod('copyright_textbox');
				$copyright_hide = get_theme_mod('hide_copyright');

				if($copyright !== '' && $copyright_hide !== true){
					echo '© '.date('Y').' '.$copyright;
				}

				//radio button testing customizer 
				$logo = get_theme_mod('test_radio');
				if($logo != ''){
					switch ($logo){
						case 'left':
						//do nothing
						break;

						case 'right':
						echo '<style type="text/css">';
						echo '.zmdi{ float: right; }';
						echo '</style>';
						break;

						case 'center':
						echo '<style type="text/css">';
						echo '.zmdi{ float: none; margin-left: auto; margin-right: auto; }';
						echo '</style>';
					}
				}

				//*********************
				//$powered_by = get_theme_mod('test_select_dropdown');
				//echo 'Proudly powered by '.$powered_by;
				get_template_part( 'template-parts/footer/site', 'info' );
				//////////////////////////////////////////
				///
				///
				///
				///
				$twitter = get_theme_mod('twitter_field');
				$facebook = get_theme_mod('facebook_field');
				$linked_in = get_theme_mod('linked_in_field');
				$image = get_theme_mod('upload_image');
				$today = get_theme_mod('today_field');
			/*	echo '<pre>';
				var_dump($image);
				die;*/
				$checkbox = get_theme_mod('checkbox_field_male');
				echo $today;
				?>
				<a href="<?php echo $facebook; ?>"><i class="zmdi zmdi-facebook-box"></i></a>
				<a href="<?php echo $twitter; ?>"><i class="zmdi zmdi-twitter-box"></i></a>
				<a href="<?php echo $linked_in; ?>"><i class="zmdi zmdi-linkedin"></i></a>
				<img height="100" width="150" src="<?php echo get_theme_mod( 'upload_image' ); ?>">
				
				<?php
				
				//////////////////////////////////////////////////
				///
				///
				//
			?>

			</div><!-- .wrap -->

		</footer><!-- #colophon -->
	</div><!-- .site-content-contain -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
