<?php
get_header();
?>

<style>
    html {
        scroll-behavior: smooth;
    }

	.nav a {
		margin-left:2rem;
		font-size:1.5rem;
	}
</style>

<main id="primary" class="site-main">

    <?php 
        echo '<h1>';
        echo the_title();
        echo '</h1>';
        echo '<p>';
        echo the_content();
        echo '</p>';
        ?>

    <div id="students">
        <?php
        $terms = get_terms( 
            array(
                'taxonomy' => 'fwd-students-category',
            ) 
        );
        if ( $terms && ! is_wp_error( $terms ) ) {
            foreach ( $terms as $term ) {
                $args = array(
                    'post_type' => 'fwd-students',
                    'posts_per_page' => -1,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'fwd-students-category',
                            'field' => 'slug',
                            'terms' => $term->slug,
                        ),
                    ),
                    'orderby' => 'title',
                    'order' => 'ASC'
                );

            }
        }
        ?>
    </div>

</main><!-- #primary -->

<?php
get_footer();
?>
