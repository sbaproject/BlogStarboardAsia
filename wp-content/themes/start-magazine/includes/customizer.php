<?php
/**
 * Theme Customizer.
 *
 * @package Start_Magazine
 */

/**
 * Add Customizer options.
 *
 * @since 1.0.0
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function start_magazine_customize_register( $wp_customize ) {

	// Load custom controls.
	require_once trailingslashit( get_template_directory() ) . 'includes/customizer/control.php';

	// Register custom controls and sections.
	$wp_customize->register_control_type( 'Start_Magazine_Heading_Control' );
	$wp_customize->register_control_type( 'Start_Magazine_Message_Control' );
	$wp_customize->register_control_type( 'Start_Magazine_Dropdown_Taxonomies_Control' );
	$wp_customize->register_control_type( 'Start_Magazine_Dropdown_Sidebars_Control' );
	$wp_customize->register_section_type( 'Start_Magazine_Upsell_Section' );

	// Upsell section.
	$wp_customize->add_section(
		new Start_Magazine_Upsell_Section( $wp_customize, 'custom_theme_upsell',
			array(
				'title'    => esc_html__( 'Start Magazine Pro', 'start-magazine' ),
				'pro_text' => esc_html__( 'Buy Pro', 'start-magazine' ),
				'pro_url'  => 'https://axlethemes.com/wordpress-themes/start-magazine-pro/',
				'priority' => 1,
			)
		)
	);

	// Load helpers.
	require_once trailingslashit( get_template_directory() ) . 'includes/helpers.php';

	// Load customize sanitize.
	require_once trailingslashit( get_template_directory() ) . 'includes/customizer/sanitize.php';

	// Load customize callback.
	require_once trailingslashit( get_template_directory() ) . 'includes/customizer/callback.php';

	// Load customize option.
	require_once trailingslashit( get_template_directory() ) . 'includes/customizer/option.php';

	// Modify default customizer options.
	$wp_customize->get_control( 'background_color' )->description = __( 'Note: Background Color is applicable only if no image is set as Background Image.', 'start-magazine' );

}

add_action( 'customize_register', 'start_magazine_customize_register' );

/**
 * Register Customizer partials.
 *
 * @since 1.0.0
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function start_magazine_customizer_partials( WP_Customize_Manager $wp_customize ) {

	// Bail if selective refresh is not available.
	if ( ! isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->get_setting( 'blogname' )->transport        = 'refresh';
		$wp_customize->get_setting( 'blogdescription' )->transport = 'refresh';
		return;
	}

	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	// Register partial for blogname.
	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector'            => '.site-title a',
		'container_inclusive' => false,
		'render_callback'     => 'start_magazine_customize_partial_blogname',
	) );

	// Register partial for blogdescription.
	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector'            => '.site-description',
		'container_inclusive' => false,
		'render_callback'     => 'start_magazine_customize_partial_blogdescription',
	) );

}

add_action( 'customize_register', 'start_magazine_customizer_partials', 99 );

/**
 * Render the site title for the selective refresh partial.
 *
 * @since 1.0.0
 *
 * @return void
 */
function start_magazine_customize_partial_blogname() {

	bloginfo( 'name' );

}

/**
 * Render the site title for the selective refresh partial.
 *
 * @since 1.0.0
 *
 * @return void
 */
function start_magazine_customize_partial_blogdescription() {

	bloginfo( 'description' );

}

/**
 * Register customizer controls scripts.
 *
 * @since 1.0.0
 */
function start_magazine_customize_controls_register_scripts() {

	$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	wp_enqueue_script( 'start-magazine-customize-controls', get_template_directory_uri() . '/js/customize-controls' . $min . '.js', array( 'jquery', 'customize-controls' ), '2.0.1', true );
	wp_enqueue_style( 'start-magazine-customize-controls', get_template_directory_uri() . '/css/customize-controls' . $min . '.css', array(), '2.0.1' );

}

add_action( 'customize_controls_enqueue_scripts', 'start_magazine_customize_controls_register_scripts', 0 );
