<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package School_Theme
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="footer-logo">
    		<?php
    		$footer_image = get_theme_mod('footer_img');
   		 		if ($footer_image) {
        			
        			echo '<a href="' . esc_url(home_url('/')) . '"><img src="' . esc_url($footer_image) . '" alt="Footer Logo"></a>';
    		}
    		?>
		</div>
		<div class="footer-menu">
			<?php wp_nav_menu( array( 'theme_location' => 'footer') ); ?>
		</div>
		<div class="site-info">
			<span class="sep">  </span>
			<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s', 'fwd-school-theme' ), 'fwd-school-theme', '<a href="https://sidney-engstrom.com/school-site">Sidney Engstrom, Braden Murao</a>' );
				?>
		</div><!-- site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
