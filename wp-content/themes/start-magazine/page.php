<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Start_Magazine
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php 
			while ( have_posts() ) : the_post(); 

				if ( is_active_sidebar( 'sidebar-front-page-widget-area' ) ) {
					echo '<div id="sidebar-front-page-widget-area" class="widget-area">';
					dynamic_sidebar( 'sidebar-front-page-widget-area' );
					echo '</div><!-- #sidebar-front-page-widget-area -->';
				}
				
				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
					
			endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
	/**
	 * Hook - start_magazine_action_sidebar.
	 *
	 * @hooked: start_magazine_add_sidebar - 10
	 */
	do_action( 'start_magazine_action_sidebar' );
?>

<?php get_footer(); ?>