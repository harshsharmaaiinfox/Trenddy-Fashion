<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro;


use \WC_Widget_Cart;

if ( ! RDTheme::$options['search_icon'] && ! ( RDTheme::$options['account_icon'] && class_exists( 'WooCommerce' ) ) && ! ( RDTheme::$options['cart_icon'] && class_exists( 'WooCommerce' ) ) ) {
	return;
}
?>
<div class="header-icon-area clearfix">
	<?php
	if ( RDTheme::$options['carticon'] !== 'hidden' && class_exists( 'WC_Widget_Cart' ) ) {
		get_template_part( 'template-parts/header/icon', 'cart' );
	}
	if ( RDTheme::$options['wishlist_icon'] && defined( 'RTSB_VERSION' ) ) {
		get_template_part( 'template-parts/header/icon', 'wishlist-2' );
	} elseif ( RDTheme::$options['wishlist_icon'] && defined( 'YITH_WCWL' ) ) {
		get_template_part( 'template-parts/header/icon', 'wishlist' );
	}
	if ( RDTheme::$options['account_icon'] && class_exists( 'WooCommerce' ) ) {
		get_template_part( 'template-parts/header/icon', 'account' );
	}
	if ( RDTheme::$options['search_icon'] ) {
		get_template_part( 'template-parts/header/icon', 'search' );
	}
	?>
</div>