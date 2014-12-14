<?php
/**
 * Loop Price
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product;
?>

<?php if ( $price_html = $product->get_price_html() ) : ?>
<div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
<span class="price" itemprop="price"><?php echo $price_html; ?></span></div>
<?php endif; ?>