<?php
/**
 * The template part for displaying results in search pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package square_apple
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<span class="author-link" itemscope="itemscope" itemtype="http://schema.org/Person" itemprop="author"><?php square_apple_posted_on(); ?></span>
<time class="entry-date" datetime="<?php the_date('F jS, Y'); ?>" itemprop="datePublished" pubdate><?php the_date('F jS, Y'); ?></time>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-summary" itemprop="text">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->

	<footer class="entry-footer">
		<?php square_apple_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
