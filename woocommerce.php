<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package square_apple
 */

get_header(); ?>


			<?php woocommerce_content(); ?>



<?php get_sidebar(); ?>
<?php get_footer(); ?>
