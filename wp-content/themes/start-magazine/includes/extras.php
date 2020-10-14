<?php
/**
 * Functions hooked to core hooks.
 *
 * @package Start_Magazine
 */

if ( ! function_exists( 'start_magazine_customize_search_form' ) ) :

	/**
	 * Customize search form.
	 *
	 * @since 1.0.0
	 *
	 * @return string The search form HTML output.
	 */
	function start_magazine_customize_search_form() {

		$form = '<form role="search" method="get" class="search-form" action="' . esc_url( home_url( '/' ) ) . '">
			<label>
			<span class="screen-reader-text">' . _x( 'Search for:', 'label', 'start-magazine' ) . '</span>
			<input type="search" class="search-field" placeholder="' . esc_attr__( 'Search&hellip;', 'start-magazine' ) . '" value="' . get_search_query() . '" name="s" title="' . esc_attr_x( 'Search for:', 'label', 'start-magazine' ) . '" />
			</label>
			<input type="submit" class="search-submit" value="&#xf002;" /></form>';

		return $form;

	}

endif;

add_filter( 'get_search_form', 'start_magazine_customize_search_form', 15 );

if ( ! function_exists( 'start_magazine_exclude_category_in_blog_page' ) ) :

	/**
	 * Exclude category in blog page.
	 *
	 * @since 1.0.0
	 *
	 * @param WP_Query $query WP_Query instance.
	 * @return WP_Query Modified instance.
	 */
	function start_magazine_exclude_category_in_blog_page( $query ) {

		if ( $query->is_home && $query->is_main_query() ) {
			$exclude_categories = start_magazine_get_option( 'exclude_categories' );
			if ( ! empty( $exclude_categories ) ) {
				$cats = explode( ',', $exclude_categories );
				$cats = array_filter( $cats, 'is_numeric' );
				$string_exclude = '';
				if ( ! empty( $cats ) ) {
					$string_exclude = '-' . implode( ',-', $cats );
					$query->set( 'cat', $string_exclude );
				}
			}
		}
		return $query;
	}

endif;

add_filter( 'pre_get_posts', 'start_magazine_exclude_category_in_blog_page' );

if ( ! function_exists( 'start_magazine_implement_excerpt_length' ) ) :

	/**
	 * Implement excerpt length.
	 *
	 * @since 1.0.0
	 *
	 * @param int $length The number of words.
	 * @return int Excerpt length.
	 */
	function start_magazine_implement_excerpt_length( $length ) {

		if ( is_admin() ) {
			return $length;
		}

		$excerpt_length = start_magazine_get_option( 'excerpt_length' );
		$excerpt_length = apply_filters( 'start_magazine_filter_excerpt_length', $excerpt_length );

		if ( absint( $excerpt_length ) > 0 ) {
			$length = absint( $excerpt_length );
		}

		return $length;

	}

endif;

add_filter( 'excerpt_length', 'start_magazine_implement_excerpt_length', 999 );

if ( ! function_exists( 'start_magazine_implement_read_more' ) ) :

	/**
	 * Implement read more in excerpt.
	 *
	 * @since 1.0.0
	 *
	 * @param string $more The string shown within the more link.
	 * @return string The excerpt.
	 */
	function start_magazine_implement_read_more( $more ) {

		return '&hellip;';

	}

endif;

add_filter( 'excerpt_more', 'start_magazine_implement_read_more' );

if ( ! function_exists( 'start_magazine_content_more_link' ) ) :

	/**
	 * Implement read more in content.
	 *
	 * @since 1.0.0
	 *
	 * @param string $more_link Read More link element.
	 * @param string $more_link_text Read More text.
	 * @return string Link.
	 */
	function start_magazine_content_more_link( $more_link, $more_link_text ) {

		return '&hellip;';

	}

endif;

add_filter( 'the_content_more_link', 'start_magazine_content_more_link', 10, 2 );

if ( ! function_exists( 'start_magazine_custom_body_class' ) ) :

	/**
	 * Custom body class.
	 *
	 * @since 1.0.0
	 *
	 * @param string|array $input One or more classes to add to the class list.
	 * @return array Array of classes.
	 */
	function start_magazine_custom_body_class( $input ) {

		// Adds a class of group-blog to blogs with more than 1 published author.
		if ( is_multi_author() ) {
			$input[] = 'group-blog';
		}

		// Global layout.
		global $post;
		$global_layout = start_magazine_get_option( 'global_layout' );
		$global_layout = apply_filters( 'start_magazine_filter_theme_global_layout', $global_layout );

		// Check if single template.
		if ( $post && is_singular() ) {
			$post_options = get_post_meta( $post->ID, 'start_magazine_settings', true );
			if ( isset( $post_options['post_layout'] ) && ! empty( $post_options['post_layout'] ) ) {
				$global_layout = $post_options['post_layout'];
			}
		}

		$input[] = 'global-layout-' . esc_attr( $global_layout );

		// Common class for three columns.
		switch ( $global_layout ) {
			case 'three-columns':
				$input[] = 'three-columns-enabled';
			break;

			default:
			break;
		}

		// Header add status class.
		if ( is_active_sidebar( 'sidebar-header-right-widget-area' ) ) {
			$input[] = 'header-ads-enabled';
		} else {
			$input[] = 'header-ads-disabled';
		}

		return $input;
	}
endif;

add_filter( 'body_class', 'start_magazine_custom_body_class' );

if ( ! function_exists( 'start_magazine_custom_content_width' ) ) :

	/**
	 * Custom content width.
	 *
	 * @since 1.0.0
	 */
	function start_magazine_custom_content_width() {

		global $post, $wp_query, $content_width;

		$global_layout = start_magazine_get_option( 'global_layout' );
		$global_layout = apply_filters( 'start_magazine_filter_theme_global_layout', $global_layout );

		// Check if single template.
		if ( $post  && is_singular() ) {
			$post_options = get_post_meta( $post->ID, 'start_magazine_settings', true );
			if ( isset( $post_options['post_layout'] ) && ! empty( $post_options['post_layout'] ) ) {
				$global_layout = $post_options['post_layout'];
			}
		}
		switch ( $global_layout ) {

			case 'no-sidebar':
				$content_width = 1220;
				break;

			case 'three-columns':
				$content_width = 570;
				break;

			case 'left-sidebar':
			case 'right-sidebar':
				$content_width = 895;
				break;

			default:
				break;
		}

	}
endif;

add_filter( 'template_redirect', 'start_magazine_custom_content_width' );
