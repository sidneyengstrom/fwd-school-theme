<?php
/*
Template Name: Single Student Template
*/

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <?php
        while (have_posts()) : the_post();
        ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                <div class="entry-content">
                    <div class="student-info">
                        <h2><?php echo esc_html(get_the_title()); ?></h2>
                        <div class="student-content">
                            <?php the_content(); ?>
                        </div>
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="student-thumbnail">
                                <?php the_post_thumbnail('medium'); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="related-students">
                        <h2>Meet Other Designer Students:</h2>
                            <?php
                            $terms = get_the_terms(get_the_ID(), 'fwd-student-category');
                            if ($terms && !is_wp_error($terms)) {
                                $term_ids = wp_list_pluck($terms, 'term_id');
								$args = array(
                                    'post_type' => 'fwd-students',
                                    'post__not_in' => array(get_the_ID()),
                                    'tax_query' => array(
                                        array(
                                            'taxonomy' => 'fwd-student-category',
                                            'field' => 'term_id',
                                            'terms' => $term_ids
                                        )
                                    )
                                );
                                $related_students = new WP_Query($args);
                                if ($related_students->have_posts()) {
                                    while ($related_students->have_posts()) {
                                        $related_students->the_post();
                            ?>
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            <?php
                                    }
                                    wp_reset_postdata();
                                }
                            }
                            ?>
                    </div>
                </div><!-- .entry-content -->
            </article><!-- #post-<?php the_ID(); ?> -->
        <?php
        endwhile;
        ?>
    </div><!-- .container -->
</main><!-- #main -->

<?php
get_footer();
?>
