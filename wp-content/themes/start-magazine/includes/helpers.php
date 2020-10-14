<?php
/**
 * Helper functions.
 *
 * @package Start_Magazine
 */

if ( ! function_exists( 'start_magazine_get_global_layout_options' ) ) :

	/**
	 * Returns global layout options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function start_magazine_get_global_layout_options() {
		$choices = array(
			'left-sidebar'  => esc_html__( 'Primary Sidebar - Content', 'start-magazine' ),
			'right-sidebar' => esc_html__( 'Content - Primary Sidebar', 'start-magazine' ),
			'three-columns' => esc_html__( 'Three Columns', 'start-magazine' ),
			'no-sidebar'    => esc_html__( 'No Sidebar', 'start-magazine' ),
		);
		return $choices;
	}

endif;

if ( ! function_exists( 'start_magazine_get_breadcrumb_type_options' ) ) :

	/**
	 * Returns breadcrumb type options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function start_magazine_get_breadcrumb_type_options() {
		$choices = array(
			'disabled' => esc_html__( 'Disabled', 'start-magazine' ),
			'enabled'  => esc_html__( 'Enabled', 'start-magazine' ),
		);
		return $choices;
	}

endif;

if ( ! function_exists( 'start_magazine_get_archive_layout_options' ) ) :

	/**
	 * Returns archive layout options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function start_magazine_get_archive_layout_options() {
		$choices = array(
			'full'    => esc_html__( 'Full Post', 'start-magazine' ),
			'excerpt' => esc_html__( 'Post Excerpt', 'start-magazine' ),
		);
		return $choices;
	}

endif;

if ( ! function_exists( 'start_magazine_get_image_sizes_options' ) ) :

	/**
	 * Returns image sizes options.
	 *
	 * @since 1.0.0
	 *
	 * @param bool  $add_disable    True for adding No Image option.
	 * @param array $allowed        Allowed image size options.
	 * @param bool  $show_dimension True for showing dimension.
	 * @return array Image size options.
	 */
	function start_magazine_get_image_sizes_options( $add_disable = true, $allowed = array(), $show_dimension = true ) {

		global $_wp_additional_image_sizes;

		$choices = array();

		if ( true === $add_disable ) {
			$choices['disable'] = esc_html__( 'No Image', 'start-magazine' );
		}

		$choices['thumbnail'] = esc_html__( 'Thumbnail', 'start-magazine' );
		$choices['medium']    = esc_html__( 'Medium', 'start-magazine' );
		$choices['large']     = esc_html__( 'Large', 'start-magazine' );
		$choices['full']      = esc_html__( 'Full (original)', 'start-magazine' );

		if ( true === $show_dimension ) {
			foreach ( array( 'thumbnail', 'medium', 'large' ) as $key => $_size ) {
				$choices[ $_size ] = $choices[ $_size ] . ' (' . get_option( $_size . '_size_w' ) . 'x' . get_option( $_size . '_size_h' ) . ')';
			}
		}

		if ( ! empty( $_wp_additional_image_sizes ) && is_array( $_wp_additional_image_sizes ) ) {
			foreach ( $_wp_additional_image_sizes as $key => $size ) {
				$choices[ $key ] = $key;
				if ( true === $show_dimension ) {
					$choices[ $key ] .= ' (' . $size['width'] . 'x' . $size['height'] . ')';
				}
			}
		}

		if ( ! empty( $allowed ) ) {
			foreach ( $choices as $key => $value ) {
				if ( ! in_array( $key, $allowed, true ) ) {
					unset( $choices[ $key ] );
				}
			}
		}

		return $choices;

	}

endif;

if ( ! function_exists( 'start_magazine_get_image_alignment_options' ) ) :

	/**
	 * Returns image options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Options array.
	 */
	function start_magazine_get_image_alignment_options() {
		$choices = array(
			'none'   => esc_html_x( 'None', 'alignment', 'start-magazine' ),
			'left'   => esc_html_x( 'Left', 'alignment', 'start-magazine' ),
			'center' => esc_html_x( 'Center', 'alignment', 'start-magazine' ),
			'right'  => esc_html_x( 'Right', 'alignment', 'start-magazine' ),
		);
		return $choices;
	}

endif;
