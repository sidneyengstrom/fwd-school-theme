<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package School_Theme
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );


		endwhile; // End of the loop.
		?>
		 <section class="latest-news">
        <div class="container">
            <h2>News</h2>
            <div class="row">
                <?php
                $latest_posts_query = new WP_Query(array(
                    'post_type' => 'post',
                    'posts_per_page' => 3,
                ));

                if ($latest_posts_query->have_posts()) :
                    while ($latest_posts_query->have_posts()) : $latest_posts_query->the_post();
                ?>
                        <div class="col-md-4">
                            <a href="<?php the_permalink(); ?>" class="latest-news-item">
                                <div class="latest-news-thumbnail" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>');">
                                    <div class="overlay"></div>
                                    <h3 class="latest-news-title"><?php the_title(); ?></h3>
                                </div>
                            </a>
                        </div>
                <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div><!-- .row -->
        </div><!-- .container -->
    </section><!-- .latest-news -->

	</main><!-- #main -->

<?php
get_footer();
