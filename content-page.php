<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package square_apple
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header>
		<h1 class="page-title entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content" itemprop="text">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'square_apple' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

<?php edit_post_link( __( 'Edit', 'square_apple' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>
</article><!-- #post-## -->
