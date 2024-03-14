<?php
	
	$terms = get_terms( 
    array(
        'taxonomy' => 'fwd-staff-category',
    ) 
);
if ( $terms && ! is_wp_error($terms) ) : ?>
    <section>
        <h2><?php esc_html_e( 'Our Staff', 'fwd' ); ?></h2>
        <ul>
        <?php foreach ( $terms as $term ) : ?>
            <li><a href="<?php echo get_term_link( $term ); ?>"><?php echo esc_html( $term->name ); ?></a></li>
        <?php endforeach; ?>
        </ul>
    </section>
<?php endif; ?>