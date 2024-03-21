<?php
/**
 * The template for displaying the Course Schedule page.
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
		<table>
		<?php
		if ( function_exists ( 'get_field' ) ) {
			if( get_field( 'course_schedule' ) ) {
				if( have_rows( 'course_schedule' ) ) {
					?>
					<th><strong>Date:</strong></th>
					<th><strong>Course:</strong></th>
					<th><strong>Instructor:</strong></th>
					<?php

					while( have_rows( 'course_schedule' ) ) :
						the_row();
						echo "<tr>";

						if( get_sub_field( 'date' ) ) {
							
							$date = get_sub_field('date');
							echo "<td>$date</td>";
						}

						if( get_sub_field( 'course' ) ) {
							$course = get_sub_field('course');
							echo "<td>$course</td>";
						}

						if( get_sub_field( 'instructor' ) ) {
							$instructor = get_sub_field('instructor');
							echo "<td>$instructor</td>";
						}
						echo "</tr>";
					endwhile;
				}
			}
		}
		?>
		</table>
	</main><!-- #main -->

<?php
get_footer();
