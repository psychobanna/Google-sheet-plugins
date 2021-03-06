<?php
/**
 *
 * Template Name: Wider - 1350px
 *
 * The template for displaying pages with content width 1350px
 *
 * @package Booklium
 */

get_header();
?>

	<div id="primary" class="content-area wider">
		<main id="main" class="site-main">

			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();

