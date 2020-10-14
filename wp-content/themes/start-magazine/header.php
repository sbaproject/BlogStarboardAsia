<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Start_Magazine
 */

?><?php
	/**
	 * Hook - start_magazine_action_doctype.
	 *
	 * @hooked start_magazine_doctype - 10
	 */
	do_action( 'start_magazine_action_doctype' );
?>
<head>
	<?php
	/**
	 * Hook - start_magazine_action_head.
	 *
	 * @hooked start_magazine_head - 10
	 */
	do_action( 'start_magazine_action_head' );
	?>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php
	/**
	 * Hook - start_magazine_action_before.
	 *
	 * @hooked start_magazine_add_top_head_content - 5
	 * @hooked start_magazine_page_start - 10
	 * @hooked start_magazine_skip_to_content - 15
	 */
	do_action( 'start_magazine_action_before' );
	?>

	<?php
	  /**
	   * Hook - start_magazine_action_before_header.
	   *
	   * @hooked start_magazine_header_start - 10
	   */
	  do_action( 'start_magazine_action_before_header' );
	?>
		<?php
		/**
		 * Hook - start_magazine_action_header.
		 *
		 * @hooked start_magazine_site_branding - 10
		 */
		do_action( 'start_magazine_action_header' );
		?>
	<?php
	  /**
	   * Hook - start_magazine_action_after_header.
	   *
	   * @hooked start_magazine_header_end - 10
	   * @hooked start_magazine_add_primary_navigation - 20
	   */
	  do_action( 'start_magazine_action_after_header' );
	?>
	<?php
	/**
	 * Hook - start_magazine_action_before_content.
	 *
	 * @hooked start_magazine_add_breadcrumb - 7
	 * @hooked start_magazine_add_top_magazine_widget_area - 8
	 * @hooked start_magazine_content_start - 10
	 */
	do_action( 'start_magazine_action_before_content' );
	?>
	<?php
	  /**
	   * Hook - start_magazine_action_content.
	   */
	  do_action( 'start_magazine_action_content' );
