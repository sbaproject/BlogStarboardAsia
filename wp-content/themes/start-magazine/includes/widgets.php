<?php
/**
 * Custom Theme widgets.
 *
 * @package Start_Magazine
 */

// Load widget helper.
require_once get_template_directory() . '/vendors/widget-helper/widget-helper.php';

if ( ! function_exists( 'start_magazine_register_widgets' ) ) :

	/**
	 * Register widgets.
	 *
	 * @since 1.0.0
	 */
	function start_magazine_register_widgets() {

		// Social widget.
		register_widget( 'Start_Magazine_Social_Widget' );

		// Call To Action widget.
		register_widget( 'Start_Magazine_Call_To_Action_Widget' );

		// Recent Posts extended widget.
		register_widget( 'Start_Magazine_Recent_Posts_Extended_Widget' );

		// News block widget.
		register_widget( 'Start_Magazine_News_Block_Widget' );

		// Posts Slider widget.
		register_widget( 'Start_Magazine_Posts_Slider_Widget' );

		// Tabbed widget.
		register_widget( 'Start_Magazine_Tabbed_Widget' );

	}

endif;

add_action( 'widgets_init', 'start_magazine_register_widgets' );

if ( ! class_exists( 'Start_Magazine_Social_Widget' ) ) :

	/**
	 * Social widget class.
	 *
	 * @since 1.0.0
	 */
	class Start_Magazine_Social_Widget extends Start_Magazine_Widget_Helper {

		/**
		 * Constructor.
		 *
		 * @since 1.0.0
		 */
		function __construct() {
			$args['id']    = 'start-magazine-social';
			$args['label'] = esc_html__( 'SM: Social', 'start-magazine' );

			$args['widget'] = array(
				'classname'                   => 'start_magazine_widget_social',
				'description'                 => esc_html__( 'Social Icons Widget', 'start-magazine' ),
				'customize_selective_refresh' => true,
			);

			$args['fields'] = array(
				'title' => array(
					'label' => esc_html__( 'Title:', 'start-magazine' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				);

			parent::create_widget( $args );
		}

		/**
		 * Echo the widget content.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments including before_title, after_title,
		 *                        before_widget, and after_widget.
		 * @param array $instance The settings for the particular instance of the widget.
		 */
		function widget( $args, $instance ) {

			$values = $this->get_field_values( $instance );
			$values['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

			echo $args['before_widget'];

			// Render widget title.
			if ( ! empty( $values['title'] ) ) {
				echo $args['before_title'] . esc_html( $values['title'] ) . $args['after_title'];
			}

			if ( has_nav_menu( 'social' ) ) {
				wp_nav_menu( array(
					'theme_location' => 'social',
					'container'      => false,
					'depth'          => 1,
					'link_before'    => '<span class="screen-reader-text">',
					'link_after'     => '</span>',
				) );
			}

			echo $args['after_widget'];

		}

	}

endif;

if ( ! class_exists( 'Start_Magazine_Call_To_Action_Widget' ) ) :

	/**
	 * Call To Action widget class.
	 *
	 * @since 1.0.0
	 */
	class Start_Magazine_Call_To_Action_Widget extends Start_Magazine_Widget_Helper {

		/**
		 * Constructor.
		 *
		 * @since 1.0.0
		 */
		function __construct() {
			$args['id']    = 'start-magazine-call-to-action';
			$args['label'] = esc_html__( 'SM: Call To Action', 'start-magazine' );

			$args['widget'] = array(
				'classname'   => 'start_magazine_widget_call_to_action',
				'description' => esc_html__( 'Call To Action Widget', 'start-magazine' ),
			);

			$args['fields'] = array(
				'title' => array(
					'label' => esc_html__( 'Title:', 'start-magazine' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'text' => array(
					'label' => esc_html__( 'Text:', 'start-magazine' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'primary_button_text' => array(
					'label' => esc_html__( 'Primary Button Text:', 'start-magazine' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'primary_button_url' => array(
					'label' => esc_html__( 'Primary Button URL:', 'start-magazine' ),
					'type'  => 'url',
					'class' => 'widefat',
					),
				'secondary_button_text' => array(
					'label' => esc_html__( 'Secondary Button Text:', 'start-magazine' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'secondary_button_url' => array(
					'label' => esc_html__( 'Secondary Button URL:', 'start-magazine' ),
					'type'  => 'url',
					'class' => 'widefat',
					),
				);

			parent::create_widget( $args );
		}

		/**
		 * Echo the widget content.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments including before_title, after_title,
		 *                        before_widget, and after_widget.
		 * @param array $instance The settings for the particular instance of the widget.
		 */
		function widget( $args, $instance ) {

			$values = $this->get_field_values( $instance );
			$values['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

			echo $args['before_widget'];
			?>
			<div class="cta-content">
				<?php
				// Render widget title.
				if ( ! empty( $values['title'] ) ) {
					echo $args['before_title'] . esc_html( $values['title'] ) . $args['after_title'];
				}
				?>

				<?php echo wp_kses_post( wpautop( $values['text'] ) ); ?>

				<?php if ( ( ! empty( $values['primary_button_text'] ) && ! empty( $values['primary_button_url'] ) ) || ( ! empty( $values['secondary_button_text'] ) && ! empty( $values['secondary_button_url'] ) ) ) : ?>
					<div class="call-to-action-buttons">
						<?php if ( ! empty( $values['primary_button_url'] ) && ! empty( $values['primary_button_text'] ) ) : ?>
							<a href="<?php echo esc_url( $values['primary_button_url'] ); ?>" class="button cta-button cta-button-primary"><?php echo esc_attr( $values['primary_button_text'] ); ?></a>
						<?php endif; ?>
						<?php if ( ! empty( $values['secondary_button_url'] ) && ! empty( $values['secondary_button_text'] ) ) : ?>
							<a href="<?php echo esc_url( $values['secondary_button_url'] ); ?>" class="button cta-button cta-button-secondary"><?php echo esc_attr( $values['secondary_button_text'] ); ?></a>
						<?php endif; ?>
					</div><!-- .call-to-action-buttons -->
				<?php endif; ?>
			</div><!-- .cta-content -->

			<?php

			echo $args['after_widget'];

		}

	}

endif;

if ( ! class_exists( 'Start_Magazine_Recent_Posts_Extended_Widget' ) ) :

	/**
	 * Recent posts extended widget class.
	 *
	 * @since 1.0.0
	 */
	class Start_Magazine_Recent_Posts_Extended_Widget extends Start_Magazine_Widget_Helper {

		/**
		 * Constructor.
		 *
		 * @since 1.0.0
		 */
		function __construct() {
			$args['id']    = 'start-magazine-recent-posts-extended';
			$args['label'] = esc_html__( 'SM: Recent Posts Extended', 'start-magazine' );

			$args['widget'] = array(
				'classname'                   => 'start_magazine_widget_recent_posts_extended',
				'description'                 => esc_html__( 'Recent posts extended widget', 'start-magazine' ),
				'customize_selective_refresh' => true,
			);

			$args['fields'] = array(
				'title' => array(
					'label' => esc_html__( 'Title:', 'start-magazine' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'post_category' => array(
					'label'           => esc_html__( 'Select Category:', 'start-magazine' ),
					'type'            => 'dropdown-taxonomies',
					'show_option_all' => esc_html__( 'All Categories', 'start-magazine' ),
					),
				'post_number' => array(
					'label'   => esc_html__( 'Number of Posts:', 'start-magazine' ),
					'type'    => 'number',
					'default' => 5,
					'min'     => 1,
					'max'     => 100,
					),
				'image_width' => array(
					'label'       => esc_html__( 'Image Width:', 'start-magazine' ),
					'type'        => 'number',
					'description' => esc_html__( 'px', 'start-magazine' ),
					'default'     => 90,
					'min'         => 1,
					'max'         => 200,
					),
				'disable_thumbnail' => array(
					'label'   => esc_html__( 'Disable Thumbnail', 'start-magazine' ),
					'type'    => 'checkbox',
					'default' => false,
					),
				'disable_date' => array(
					'label'   => esc_html__( 'Disable Date', 'start-magazine' ),
					'type'    => 'checkbox',
					'default' => false,
					),
				);

			parent::create_widget( $args );
		}

		/**
		 * Echo the widget content.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments including before_title, after_title,
		 *                        before_widget, and after_widget.
		 * @param array $instance The settings for the particular instance of the widget.
		 */
		function widget( $args, $instance ) {

			$values = $this->get_field_values( $instance );
			$values['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

			echo $args['before_widget'];

			// Render widget title.
			if ( ! empty( $values['title'] ) ) {
				echo $args['before_title'] . esc_html( $values['title'] ) . $args['after_title'];
			}

			?>
			<?php
			$qargs = array(
				'posts_per_page'      => absint( $values['post_number'] ),
				'no_found_rows'       => true,
				'ignore_sticky_posts' => true,
				);

			if ( absint( $values['post_category'] ) > 0 ) {
				$qargs['cat'] = absint( $values['post_category'] );
			}

			$the_query = new WP_Query( $qargs );
			?>
			<?php if ( $the_query->have_posts() ) : ?>

				<div class="recent-posts-extended-widget">

					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
						<div class="recent-posts-extended-item">

							<?php if ( false === $values['disable_thumbnail'] && has_post_thumbnail() ) : ?>
								<div class="recent-posts-extended-thumb">
									<a href="<?php the_permalink(); ?>">
										<?php
										$img_attributes = array(
											'class' => 'alignleft',
											'style' => 'max-width:' . absint( $values['image_width'] ) . 'px;',
											);
										the_post_thumbnail( 'thumbnail', $img_attributes );
										?>
									</a>
								</div>
							<?php endif; ?>
							<div class="recent-posts-extended-text-wrap">
								<h3 class="recent-posts-extended-title">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h3>

								<?php if ( false === $values['disable_date'] ) : ?>
									<div class="recent-posts-extended-meta entry-meta">
										<span class="posted-on"><?php the_time( get_option( 'date_format' ) ); ?></span>
									</div>
								<?php endif; ?>

							</div><!-- .recent-posts-extended-text-wrap -->

						</div><!-- .recent-posts-extended-item -->
					<?php endwhile; ?>

				</div><!-- .recent-posts-extended-widget -->

				<?php wp_reset_postdata(); ?>

			<?php endif; ?>

			<?php

			echo $args['after_widget'];

		}

	}

endif;

if ( ! class_exists( 'Start_Magazine_News_Block_Widget' ) ) :

	/**
	 * News block widget class.
	 *
	 * @since 1.0.0
	 */
	class Start_Magazine_News_Block_Widget extends Start_Magazine_Widget_Helper {

		/**
		 * Constructor.
		 *
		 * @since 1.0.0
		 */
		function __construct() {
			$args['id']    = 'start-magazine-news-block';
			$args['label'] = esc_html__( 'SM: News Block', 'start-magazine' );

			$args['widget'] = array(
				'classname'                   => 'start_magazine_widget_news_block',
				'description'                 => esc_html__( 'News block Widget', 'start-magazine' ),
				'customize_selective_refresh' => true,
			);

			$args['fields'] = array(
				'title' => array(
					'label' => esc_html__( 'Title:', 'start-magazine' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'news_category' => array(
					'label'           => esc_html__( 'Select Category:', 'start-magazine' ),
					'type'            => 'dropdown-taxonomies',
					'show_option_all' => esc_html__( 'All Categories', 'start-magazine' ),
					),
				'news_number' => array(
					'label'   => esc_html__( 'Number of Posts:', 'start-magazine' ),
					'type'    => 'number',
					'default' => 3,
					'min'     => 1,
					'max'     => 8,
					),
				'news_column' => array(
					'label'   => esc_html__( 'Select Column:', 'start-magazine' ),
					'type'    => 'select',
					'default' => 3,
					'choices' => array( '1' => 1,'2' => 2, '3' => 3, '4' => 4 ),
					),
				'news_image' => array(
					'label'   => esc_html__( 'Select Image:', 'start-magazine' ),
					'type'    => 'select',
					'default' => 'start-magazine-thumb',
					'choices' => start_magazine_get_image_sizes_options( false ),
					),
				'excerpt_length' => array(
					'label'   => esc_html__( 'Excerpt Length:', 'start-magazine' ),
					'type'    => 'number',
					'default' => 12,
					'min'     => 0,
					'max'     => 100,
					),
				'news_layout' => array(
					'label'   => esc_html__( 'Select News Layout:', 'start-magazine' ),
					'type'    => 'select',
					'default' => 2,
					'choices' => array( '1' => 1, '2' => 2 ),
					),
				);

			parent::create_widget( $args );
		}

		/**
		 * Echo the widget content.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments including before_title, after_title,
		 *                        before_widget, and after_widget.
		 * @param array $instance The settings for the particular instance of the widget.
		 */
		function widget( $args, $instance ) {

			$values = $this->get_field_values( $instance );
			$values['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

			echo $args['before_widget'];

			// Render widget title.
			if ( ! empty( $values['title'] ) ) {
				echo $args['before_title'] . esc_html( $values['title'] ) . $args['after_title'];
			}

			$qargs = array(
				'posts_per_page'      => esc_attr( $values['news_number'] ),
				'no_found_rows'       => true,
				'ignore_sticky_posts' => true,
			);

			if ( absint( $values['news_category'] ) > 0 ) {
				$qargs['cat'] = absint( $values['news_category'] );
			}

			$the_query = new WP_Query( $qargs );
			?>
			<?php if ( $the_query->have_posts() ) : ?>

				<div class="news-block-widget news-block-layout-<?php echo esc_attr( $values['news_layout'] ); ?> news-block-column-<?php echo esc_attr( $values['news_column'] ); ?>">

					<div class="inner-wrapper">

						<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

							<div class="news-block-item">
								<div class="news-block-wrapper">
									<?php if ( has_post_thumbnail() ) : ?>
										<div class="news-block-thumb">
											<a href="<?php the_permalink(); ?>">
												<?php
												$img_attributes = array( 'class' => 'aligncenter' );
												the_post_thumbnail( esc_attr( $values['news_image'] ), $img_attributes );
												?>
											</a>
											<?php $cat_detail = start_magazine_get_single_post_category( get_the_ID() ); ?>
											<?php if ( ! empty( $cat_detail ) ) : ?>
												<span class="news-categories"> <a href="<?php echo esc_url( $cat_detail['url'] ); ?>"><?php echo esc_html( $cat_detail['name'] ); ?></a></span>
											<?php endif; ?>
										</div><!-- .news-block-thumb -->

									<?php endif; ?>
									<div class="news-block-text-wrap">
										<div class="news-block-meta entry-meta">
											<span class="posted-on"><?php the_time( get_option( 'date_format' ) ); ?></span>
											<?php
											if ( comments_open( get_the_ID() ) ) {
												echo '<span class="comments-link">';
												comments_popup_link( '0', '1', '%' );
												echo '</span>';
											}
											?>
										</div><!-- .news-block-meta -->
										<h3 class="news-block-title">
											<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
										</h3>

										<?php if ( absint( $values['excerpt_length'] ) > 0 ) : ?>
											<div class="news-block-summary">
												<?php
												$excerpt = start_magazine_get_the_excerpt( absint( $values['excerpt_length'] ) );
												echo wp_kses_post( wpautop( $excerpt ) );
												?>
											</div><!-- .news-block-summary -->
										<?php endif; ?>

									</div><!-- .news-block-text-wrap -->
								</div><!-- .news-block-wrapper -->
							</div><!-- .news-block-item -->

						<?php endwhile; ?>

					</div><!-- .inner-wrapper -->
				</div><!-- .news-block-widget -->

				<?php wp_reset_postdata(); ?>

			<?php endif; ?>
			<?php

			echo $args['after_widget'];

		}

	}

endif;

if ( ! class_exists( 'Start_Magazine_Posts_Slider_Widget' ) ) :

	/**
	 * Posts slider widget class.
	 *
	 * @since 1.0.0
	 */
	class Start_Magazine_Posts_Slider_Widget extends Start_Magazine_Widget_Helper {

		/**
		 * Constructor.
		 *
		 * @since 1.0.0
		 */
		function __construct() {
			$args['id']    = 'start-magazine-posts-slider';
			$args['label'] = esc_html__( 'SM: Posts Slider', 'start-magazine' );

			$args['widget'] = array(
				'classname'                   => 'start_magazine_widget_posts_slider',
				'description'                 => esc_html__( 'Posts Slider Widget', 'start-magazine' ),
				'customize_selective_refresh' => true,
			);

			$args['fields'] = array(
				'title' => array(
					'label' => esc_html__( 'Title:', 'start-magazine' ),
					'type'  => 'text',
					'class' => 'widefat',
					),
				'slider_heading' => array(
					'label' => esc_html__( 'Slider Settings', 'start-magazine' ),
					'type'  => 'heading',
					),
				'post_category' => array(
					'label'           => esc_html__( 'Select Category:', 'start-magazine' ),
					'type'            => 'dropdown-taxonomies',
					'show_option_all' => esc_html__( 'All Categories', 'start-magazine' ),
					),
				'post_number' => array(
					'label'   => esc_html__( 'Number of Posts:', 'start-magazine' ),
					'type'    => 'number',
					'default' => 4,
					'min'     => 2,
					'max'     => 10,
					),
				'featured_image' => array(
					'label'   => esc_html__( 'Select Image:', 'start-magazine' ),
					'type'    => 'select',
					'default' => 'start-magazine-featured',
					'choices' => start_magazine_get_image_sizes_options( false ),
					),
				'disable_category' => array(
					'label'   => esc_html__( 'Disable Category', 'start-magazine' ),
					'type'    => 'checkbox',
					'default' => false,
					),
				'disable_date' => array(
					'label'   => esc_html__( 'Disable Date', 'start-magazine' ),
					'type'    => 'checkbox',
					'default' => false,
					),
				'excerpt_length' => array(
					'label'   => esc_html__( 'Excerpt Length:', 'start-magazine' ),
					'type'    => 'number',
					'default' => 15,
					'min'     => 0,
					'max'     => 100,
					),
				'list_heading' => array(
					'label' => esc_html__( 'Posts List Settings', 'start-magazine' ),
					'type'  => 'heading',
					),
				'disable_listing' => array(
					'label'   => esc_html__( 'Disable Posts List', 'start-magazine' ),
					'type'    => 'checkbox',
					'default' => false,
					),
				'post_category_2' => array(
					'label'           => esc_html__( 'Select Category:', 'start-magazine' ),
					'type'            => 'dropdown-taxonomies',
					'show_option_all' => esc_html__( 'All Categories', 'start-magazine' ),
					),
				'post_number_2' => array(
					'label'   => esc_html__( 'Number of Posts:', 'start-magazine' ),
					'type'    => 'number',
					'default' => 5,
					'min'     => 1,
					'max'     => 20,
					),
				);

			parent::create_widget( $args );
		}

		/**
		 * Echo the widget content.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments including before_title, after_title,
		 *                        before_widget, and after_widget.
		 * @param array $instance The settings for the particular instance of the widget.
		 */
		function widget( $args, $instance ) {

			$values = $this->get_field_values( $instance );
			$values['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

			// Add listing class.
			if ( true === $values['disable_listing'] ) {
				$listing_class = 'listing-disabled';
				$args['before_widget'] = implode( ' class="' . $listing_class . ' ', explode( 'class="', $args['before_widget'], 2 ) );
			}

			echo $args['before_widget'];

			// Render widget title.
			if ( ! empty( $values['title'] ) ) {
				echo $args['before_title'] . esc_html( $values['title'] ) . $args['after_title'];
			}

			$qargs = array(
				'posts_per_page' => absint( $values['post_number'] ),
				'no_found_rows'  => true,
				'meta_key'       => '_thumbnail_id',
			);

			if ( absint( $values['post_category'] ) > 0 ) {
				$qargs['cat'] = absint( $values['post_category'] );
			}

			$the_query = new WP_Query( $qargs );

			if ( $the_query->have_posts() ) { ?>
				<div class="inner-wrapper">
					<div class="posts-slider">
						<div class="cycle-slideshow" data-cycle-slides="article" data-cycle-auto-height="container" data-pager-template='<span class="pager-box"></span>'>

							<div class="cycle-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></div>
							<div class="cycle-next"><i class="fa fa-angle-right" aria-hidden="true"></i></div>

							<?php $count = 1; ?>
							<?php while ( $the_query->have_posts() ) { ?>
								<?php $the_query->the_post(); ?>

								<?php $class_text = ( 1 === $count ) ? 'first' : ''; ?>

								<article class="<?php echo esc_attr( $class_text ); ?>">
									<?php the_post_thumbnail( esc_attr( $values['featured_image'] ) ); ?>
									<div class="slide-caption">

										<?php if ( true !== $values['disable_category'] ) : ?>
											<?php $cat_detail = start_magazine_get_single_post_category( get_the_ID() ); ?>
											<?php if ( ! empty( $cat_detail ) ) : ?>
												<span class="posts-slider-category"> <a href="<?php echo esc_url( $cat_detail['url'] ); ?>"><?php echo esc_html( $cat_detail['name'] ); ?></a></span>
											<?php endif; ?>
										<?php endif; ?>

										<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
										<?php if ( true !== $values['disable_date'] ) : ?>
											<div class="post-slider-meta entry-meta">
												<span class="posted-on"><?php the_time( get_option( 'date_format' ) ); ?></span>
											</div><!-- .post-slider-meta -->
										<?php endif; ?>

										<?php if ( absint( $values['excerpt_length'] ) > 0 ) : ?>
											<?php
											$excerpt = start_magazine_get_the_excerpt( absint( $values['excerpt_length'] ) );
											echo wp_kses_post( wpautop( $excerpt ) );
											?>
										<?php endif; ?>
									</div><!-- .slide-caption -->
								</article>

								<?php $count++; ?>

							<?php } // End while.

							// Reset
							wp_reset_postdata(); ?>

							<div class="cycle-pager"></div>

						</div><!-- .cycle-slideshow -->

					</div><!-- .posts-slider -->

					<?php if ( true !== $values['disable_listing'] ) : ?>

						<?php
						$qargs = array(
							'posts_per_page' => absint( $values['post_number_2'] ),
							'no_found_rows'  => true,
						);

						if ( absint( $values['post_category_2'] ) > 0 ) {
							$qargs['cat'] = absint( $values['post_category_2'] );
						}

						$the_query_2 = new WP_Query( $qargs );

						?>
						<?php if ( $the_query_2->have_posts() ) : ?>

							<div class="recent-posts-list">
								<div class="recent-posts-list-extended">

									<?php while ( $the_query_2->have_posts() ) { ?>
										<?php $the_query_2->the_post(); ?>

										<div class="recent-posts-list-extended-item">
											<?php if ( has_post_thumbnail() ) : ?>
												<div class="recent-posts-list-extended-thumb">
													<a href="<?php the_permalink(); ?>">
														<?php the_post_thumbnail( 'thumbnail' ); ?>
													</a>
												</div><!-- .recent-posts-list-extended-thumb -->
											<?php endif; ?>
											<div class="recent-posts-list-extended-text-wrap">
												<h3 class="recent-posts-list-extended-title">
													<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
												</h3>
												<div class="recent-posts-list-extended-meta entry-meta">
													<span class="posted-on"><?php the_time( get_option( 'date_format' ) ); ?></span>
												</div>
											</div><!-- .recent-posts-list-extended-text-wrap -->
										</div><!-- .recent-posts-list-extended-item -->

									<?php } ?>
									<?php
									// Reset
									wp_reset_postdata();
									?>

								</div><!-- .recent-posts-list-extended -->
							</div><!-- .recent-posts-list -->

						<?php endif; ?>

					<?php endif; ?>

				</div><!-- .inner-wrapper -->

				<?php

			} // End if have posts.

			echo $args['after_widget'];

		}

	}

endif;

if ( ! class_exists( 'Start_Magazine_Tabbed_Widget' ) ) :

	/**
	 * Tabbed widget class.
	 *
	 * @since 1.0.0
	 */
	class Start_Magazine_Tabbed_Widget extends Start_Magazine_Widget_Helper {

		/**
		 * Constructor.
		 *
		 * @since 1.0.0
		 */
		function __construct() {
			$args['id']    = 'start-magazine-tabbed';
			$args['label'] = esc_html__( 'SM: Tabbed', 'start-magazine' );

			$args['widget'] = array(
				'classname'   => 'start_magazine_widget_tabbed',
				'description' => esc_html__( 'Tabbed Widget', 'start-magazine' ),
			);

			$args['fields'] = array(
				'popular_heading' => array(
					'label'   => esc_html__( 'POPULAR', 'start-magazine' ),
					'type'    => 'heading',
					),
				'popular_number' => array(
					'label'   => esc_html__( 'No of Posts:', 'start-magazine' ),
					'type'    => 'number',
					'default' => 5,
					'min'     => 1,
					'max'     => 20,
					),
				'popular_thumbnail' => array(
					'label'   => esc_html__( 'Show Thumbnail', 'start-magazine' ),
					'type'    => 'checkbox',
					'default' => true,
					),
				'recent_heading' => array(
					'label'   => esc_html__( 'RECENT', 'start-magazine' ),
					'type'    => 'heading',
					),
				'recent_number' => array(
					'label'   => esc_html__( 'No of Posts:', 'start-magazine' ),
					'type'    => 'number',
					'default' => 5,
					'min'     => 1,
					'max'     => 20,
					),
				'recent_thumbnail' => array(
					'label'   => esc_html__( 'Show Thumbnail', 'start-magazine' ),
					'type'    => 'checkbox',
					'default' => true,
					),
				'comment_heading' => array(
					'label'   => esc_html__( 'COMMENT', 'start-magazine' ),
					'type'    => 'heading',
					),
				'comment_number' => array(
					'label'   => esc_html__( 'No of Comments:', 'start-magazine' ),
					'type'    => 'number',
					'default' => 5,
					'min'     => 1,
					'max'     => 20,
					),
				'comment_thumbnail' => array(
					'label'   => esc_html__( 'Show Thumbnail', 'start-magazine' ),
					'type'    => 'checkbox',
					'default' => true,
					),
				);

			parent::create_widget( $args );
		}

		/**
		 * Echo the widget content.
		 *
		 * @since 1.0.0
		 *
		 * @param array $args     Display arguments including before_title, after_title,
		 *                        before_widget, and after_widget.
		 * @param array $instance The settings for the particular instance of the widget.
		 */
		function widget( $args, $instance ) {

			$values = $this->get_field_values( $instance );
			$instance_number = $this->number;

			echo $args['before_widget'];

			?>
			<div class="tabs">
				<ul class="tab-links">
					<li class="tab tab-popular active"><a href="<?php echo esc_url( '#tab' . $instance_number . '-1' ); ?>"><i class="fa fa-fire"></i></a></li>
					<li class="tab tab-recent"><a href="<?php echo esc_url( '#tab' . $instance_number . '-2' ); ?>"><i class="fa fa-list"></i></a></li>
					<li class="tab tab-comments"><a href="<?php echo esc_url( '#tab' . $instance_number . '-3' ); ?>"><i class="fa fa-comment"></i></a></li>
				</ul>

				<div class="tab-content">
					<div id="<?php echo esc_attr( 'tab' . $instance_number . '-1' ); ?>" class="tab active">
						<?php
						$qargs = array(
							'posts_per_page'      => absint( $values['popular_number'] ),
							'orderby'             => 'comment_count',
							'no_found_rows'       => true,
							'ignore_sticky_posts' => true,
						);

						$the_query = new WP_Query( $qargs );
						?>
						<?php if ( $the_query->have_posts() ) : ?>

							<div class="popular-list">

								<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
									<div class="popular-item">

										<?php if ( true === $values['popular_thumbnail'] && has_post_thumbnail() ) : ?>
											<div class="popular-item-thumb">
												<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'thumbnail' ); ?></a>
											</div><!-- .popular-item-thumb -->
										<?php endif; ?>
										<div class="popular-item-text-wrap">
											<h3 class="popular-item-title">
												<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
											</h3>
											<div class="popular-item-meta entry-meta">
												<span class="posted-on"><?php the_time( get_option( 'date_format' ) ); ?></span>
											</div>
										</div><!-- .popular-item-text-wrap -->
									</div><!-- .popular-item -->
								<?php endwhile; ?>

							</div><!-- .popular-list -->

							<?php wp_reset_postdata(); ?>

						<?php endif; ?>
					</div>

					<div id="<?php echo esc_attr( 'tab' . $instance_number . '-2' ); ?>" class="tab">
						<?php
						$qargs = array(
							'posts_per_page'      => absint( $values['recent_number'] ),
							'no_found_rows'       => true,
							'ignore_sticky_posts' => true,
						);

						$the_query = new WP_Query( $qargs );
						?>
						<?php if ( $the_query->have_posts() ) : ?>

							<div class="latest-list">

								<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
									<div class="latest-item">

										<?php if ( true === $values['recent_thumbnail'] && has_post_thumbnail() ) : ?>
											<div class="latest-item-thumb">
												<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'thumbnail' ); ?></a>
											</div><!-- .latest-item-thumb -->
										<?php endif; ?>
										<div class="latest-item-text-wrap">
											<h3 class="latest-item-title">
												<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
											</h3>
											<div class="latest-item-meta entry-meta">
												<span class="posted-on"><?php the_time( get_option( 'date_format' ) ); ?></span>
											</div>
										</div><!-- .latest-item-text-wrap -->
									</div><!-- .latest-item -->
								<?php endwhile; ?>

							</div><!-- .latest-list -->

							<?php wp_reset_postdata(); ?>

						<?php endif; ?>
					</div>

					<div id="<?php echo esc_attr( 'tab' . $instance_number . '-3' ); ?>" class="tab">
						<?php
						$qargs = array(
							'number'    => absint( $values['comment_number'] ),
							'post_type' => 'post',
							'status'    => 'approve',
						);
						$comments_query = new WP_Comment_Query;
						$comments = $comments_query->query( $qargs );
						?>
						<?php if ( $comments ) : ?>

							<div class="comment-list">

								<?php foreach ( $comments as $comment ) : ?>
									<div class="comment-item">

										<?php if ( true === $values['comment_thumbnail'] ) : ?>
											<div class="comment-item-thumb">
												<?php echo get_avatar( $comment->comment_author_email, 100 ); ?>
											</div><!-- .comment-item-thumb -->
										<?php endif; ?>

										<div class="comment-item-text-wrap">
											<h3 class="comment-item-title">
												<?php $author_url = get_comment_author_url( $comment ); ?>
												<?php if ( ! empty( $author_url ) ) : ?>
													<strong>	<a href="<?php echo esc_url( $author_url ); ?>">
														<?php echo esc_html( $comment->comment_author ); ?>
													</a></strong>
													<?php esc_html_e( 'on', 'start-magazine' ); ?>
												<?php else : ?>
													<strong><?php echo esc_html( $comment->comment_author ); ?></strong>
													<?php esc_html_e( 'on', 'start-magazine' ); ?>
												<?php endif; ?>
												<?php if ( absint( $comment->comment_post_ID ) > 0 ) : ?>
													<a href="<?php echo esc_url( get_comment_link( $comment ) ); ?>">
													<?php echo esc_html( get_the_title( $comment->comment_post_ID ) ); ?>
													</a>
												<?php endif; ?>
											</h3>
										</div><!-- .comment-item-text-wrap -->
									</div><!-- .comment-item -->

								<?php endforeach; ?>

							</div><!-- .comment-list -->

						<?php endif; ?>
					</div>

				</div>
			</div>

			<?php

			echo $args['after_widget'];

		}

	}

endif;
