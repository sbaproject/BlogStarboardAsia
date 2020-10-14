<?php
/**
 * Callback functions for active_callback.
 *
 * @package Start_Magazine
 */

if ( ! function_exists( 'start_magazine_is_breaking_news_active' ) ) :

	/**
	 * Check if breaking news ticker is active.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function start_magazine_is_breaking_news_active( $control ) {

		if ( $control->manager->get_setting( 'theme_options[show_breaking_news]' )->value() ) {
			return true;
		} else {
			return false;
		}

	}

endif;

if ( ! function_exists( 'start_magazine_is_image_in_archive_active' ) ) :

	/**
	 * Check if image in archive is active.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 *
	 * @return bool Whether the control is active to the current preview.
	 */
	function start_magazine_is_image_in_archive_active( $control ) {

		if ( 'disable' !== $control->manager->get_setting( 'theme_options[archive_image]' )->value() ) {
			return true;
		} else {
			return false;
		}

	}

endif;
