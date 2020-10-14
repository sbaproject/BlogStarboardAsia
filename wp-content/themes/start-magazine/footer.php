<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Start_Magazine
 */

	/**
	 * Hook - start_magazine_action_after_content.
	 *
	 * @hooked start_magazine_content_end - 10
	 * @hooked start_magazine_add_front_page_bot_widget_area - 11
	 */
	do_action( 'start_magazine_action_after_content' );
?>

	<?php
	/**
	 * Hook - start_magazine_action_before_footer.
	 *
	 * @hooked start_magazine_add_footer_widgets - 5
	 * @hooked start_magazine_footer_start - 10
	 */
	do_action( 'start_magazine_action_before_footer' );
	?>
	<?php
	  /**
	   * Hook - start_magazine_action_footer.
	   *
	   * @hooked start_magazine_footer_copyright - 10
	   */
	  do_action( 'start_magazine_action_footer' );
	?>
	<?php
	/**
	 * Hook - start_magazine_action_after_footer.
	 *
	 * @hooked start_magazine_footer_end - 10
	 */
	do_action( 'start_magazine_action_after_footer' );
	?>

<?php
	/**
	 * Hook - start_magazine_action_after.
	 *
	 * @hooked start_magazine_page_end - 10
	 * @hooked start_magazine_footer_goto_top - 20
	 */
	do_action( 'start_magazine_action_after' );
?>

<?php wp_footer(); ?>
</body>
</html>
