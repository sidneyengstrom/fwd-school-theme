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
        echo '<p class="staff-excerpt">Our dedicated staff is here to help our students succeed. You will find the faculty and administrative staff listed below. Please contact the appropriate individual with any questions. Vestibulum pretium neque leo, nec euismod ex interdum vitae. Etiam viverra, lorem sed lobortis mattis, lectus enim eleifend nisi, non dapibus nulla purus malesuada risus. Donec consectetur neque turpis, vitae varius lectus commodo vel.</p>';
        ?>

    <div id="staff">
        <?php
        $terms = get_terms( 
            array(
                'taxonomy' => 'fwd-staff-category',
            ) 
        );
        if ( $terms && ! is_wp_error( $terms ) ) {
            foreach ( $terms as $term ) {
                $args = array(
                    'post_type' => 'fwd-staff',
                    'posts_per_page' => -1,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'fwd-staff-category',
                            'field' => 'slug',
                            'terms' => $term->slug,
                        ),
                    ),
                    'orderby' => 'title',
                    'order' => 'ASC'
                );

                $query = new WP_Query( $args );

                if ( $query->have_posts() ) {
                    echo '<div id="' . esc_attr( $term->slug ) . '">';
                    echo '<h2 class="staff-category-heading">' . esc_html( $term->name ) . '</h2>';
                    while ( $query->have_posts() ) {
                        $query->the_post();
                        ?>
                        <div id="<?php echo esc_attr( get_post_field( 'post_name' ) ); ?>">
                            <h3><?php echo esc_html( get_the_title() ); ?></h3>
                            <div class="content"><?php
                                if ( function_exists ( 'get_field' ) ) {

                                if ( get_field( 'staff_bio' ) ) {
                                echo '<p>' . esc_html( get_field( 'staff_bio' ) ) . '</p>';
                                }
                                if ( get_field( 'courses' ) ) {
                                    echo '<p>' . esc_html( get_field( 'courses' ) ) . '</p>';
                                    }
                                if ( get_field( 'instructor_website' ) ) {
                                    echo '<a href="' . esc_url(get_field('instructor_website')) . '">Instructor\'s Website</a>';
                                        }
                            }
?></div>
                        </div>
                        <?php
                    }
                    echo '</div>';
                    wp_reset_postdata();
                }
            }
        }
        ?>
    </div>

</main><!-- #primary -->

<?php
get_footer();
?>
