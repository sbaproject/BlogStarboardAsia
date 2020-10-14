<?php
/**
 * Template for Magazine
 *
 * Template name: Magazine
 *
 * @package Start_Magazine
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			if ( is_active_sidebar( 'sidebar-front-page-widget-area' ) ) {
				echo '<div id="sidebar-front-page-widget-area" class="widget-area">';
				dynamic_sidebar( 'sidebar-front-page-widget-area' );
				echo '</div><!-- #sidebar-front-page-widget-area -->';
			}
			else {
				if ( current_user_can( 'edit_theme_options' ) ) {
					echo '<div id="sidebar-front-page-widget-area" class="widget-area">';
					start_magazine_message_front_page_widget_area();
					echo '</div><!-- #sidebar-front-page-widget-area -->';
				}
			}
			?>

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
