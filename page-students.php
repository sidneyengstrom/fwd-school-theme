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
        echo '<h1>The Class</h1>';
        ?>

    <div id="students">
        <?php
        $terms = get_terms( 
            array(
                'taxonomy' => 'fwd-student-category',
            ) 
        );
        if ( $terms && ! is_wp_error( $terms ) ) {
            foreach ( $terms as $term ) {
                $args = array(
                    'post_type' => 'fwd-students',
                    'posts_per_page' => -1,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'fwd-student-category',
                            'field' => 'slug',
                            'terms' => $term->slug,
                        ),
                    ),
                    'order' => 'ASC',
                    'orderby' => 'title',
                );

                $query = new WP_Query( $args );

                if ( $query->have_posts() ) {
                    while ( $query->have_posts() ) {
                        $query->the_post();
                        

                        ?>
                        <header class="entry-header">
            <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        </header>

        <div class="entry-content">
        <?php
                            $excerpt = wp_trim_words(get_the_excerpt(), 25, '');

                            $excerpt .= ' <a href="' . get_permalink() . '">Read More about the Student</a>';

                            echo $excerpt;
                            ?>
        </div>

        <?php if ( has_post_thumbnail() ) : ?>
            <div class="entry-thumbnail">
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail( 'student-portrait' );?>
                </a>
            </div>
        <?php endif; ?>
        <div class="entry-categories">
            <p> Specialty:
            <?php
            $terms = get_the_terms( get_the_ID(), 'fwd-student-category' ); 

            if ( $terms && ! is_wp_error( $terms ) ) {
                $category_links = array();
                foreach ( $terms as $term ) {
                    $category_links[] = '<a href="' . get_term_link( $term ) . '">' . $term->name . '</a>';
                }
                echo implode( ', ', $category_links );
            }
            ?>
            </p>
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
