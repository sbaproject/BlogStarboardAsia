<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Start_Magazine
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	  /**
	   * Hook - start_magazine_single_image.
	   *
	   * @hooked start_magazine_add_image_in_single_display - 10
	   */
	  do_action( 'start_magazine_single_image' );
	?>
	<div class="article-wrapper">
		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

			<div class="entry-meta">
				<?php start_magazine_posted_on(); ?>
			</div><!-- .entry-meta -->
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php the_content(); ?>
			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'start-magazine' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->

		<footer class="entry-footer entry-meta">
			<?php start_magazine_entry_footer(); ?>
		</footer><!-- .entry-footer -->
	</div> <!-- .article-wrapper -->
</article><!-- #post-## -->

