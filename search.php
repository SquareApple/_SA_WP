<?php
/**
 * The template for displaying search results pages.
 *
 * @package square_apple
 */

get_header(); ?>

		<?php if ( have_posts() ) : ?>

			<header>
				<h2 class="page-title"><?php printf( __( 'Search Results for: %s', 'square_apple' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'content', 'search' );
				?>

			<?php endwhile; ?>

			<?php square_apple_paging_nav( 'nav-below' ); ?>

		<?php else : ?>

			<?php get_template_part( 'no-results', 'search' ); ?>

		<?php endif; ?>


<?php get_sidebar(); ?>
<?php get_footer(); ?>
