<?php
/**
 * Core functions.
 *
 * @package Start_Magazine
 */

if ( ! function_exists( 'start_magazine_get_option' ) ) :

	/**
	 * Get theme option.
	 *
	 * @since 1.0.0
	 *
	 * @param string $key Option key.
	 * @return mixed Option value.
	 */
	function start_magazine_get_option( $key ) {

		$start_magazine_default_options = start_magazine_get_default_theme_options();

		if ( empty( $key ) ) {
			return;
		}

		$default = ( isset( $start_magazine_default_options[ $key ] ) ) ? $start_magazine_default_options[ $key ] : '';
		$theme_options = get_theme_mod( 'theme_options', $start_magazine_default_options );
		$theme_options = array_merge( $start_magazine_default_options, $theme_options );
		$value = '';

		if ( isset( $theme_options[ $key ] ) ) {
			$value = $theme_options[ $key ];
		}

		return $value;

	}

endif;

if ( ! function_exists( 'start_magazine_get_default_theme_options' ) ) :

	/**
	 * Get default theme options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Default theme options.
	 */
	function start_magazine_get_default_theme_options() {

		$defaults = array();

		// Header.
		$defaults['show_title']            = true;
		$defaults['show_tagline']          = true;
		$defaults['show_social_in_header'] = false;
		$defaults['show_search_in_header'] = true;

		// Breaking News.
		$defaults['show_breaking_news']     = true;
		$defaults['breaking_news_text']     = esc_html__( 'Breaking News', 'start-magazine' );
		$defaults['breaking_news_category'] = '';
		$defaults['breaking_news_number']   = 4;

		// Layout.
		$defaults['global_layout']           = 'right-sidebar';
		$defaults['archive_layout']          = 'excerpt';
		$defaults['archive_image']           = 'large';
		$defaults['archive_image_alignment'] = 'center';

		// Single Post.
		$defaults['show_related_posts'] = true;

		// Footer.
		$defaults['copyright_text'] = esc_html__( 'Copyright &copy; All rights reserved.', 'start-magazine' );

		// Blog.
		$defaults['excerpt_length']     = 40;
		$defaults['exclude_categories'] = '';

		// Breadcrumb.
		$defaults['breadcrumb_type'] = 'enabled';

		return apply_filters( 'start_magazine_filter_default_theme_options', $defaults );
	}

endif;
