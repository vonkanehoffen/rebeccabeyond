<?php
/**
 * WP Customisation for Rebecca Beyond site
 */
add_action('init', 'rebeccabeyond_custom');

function rebeccabeyond_custom() {

  // Simplify header
  remove_action('storefront_header', 'storefront_product_search', 40);
  remove_action('storefront_header', 'storefront_header_cart', 60);
  remove_action('storefront_header', 'storefront_secondary_navigation', 30);

  // Remove sorting dropdown on shop loop
  remove_action( 'woocommerce_before_shop_loop',       'storefront_sorting_wrapper',             9 );
  remove_action( 'woocommerce_before_shop_loop',       'woocommerce_catalog_ordering',           10 );
  remove_action( 'woocommerce_before_shop_loop',       'woocommerce_result_count',               20 );
  remove_action( 'woocommerce_before_shop_loop',       'storefront_woocommerce_pagination',      30 );
  remove_action( 'woocommerce_before_shop_loop',       'storefront_sorting_wrapper_close',       31 );

  remove_action( 'woocommerce_after_shop_loop',        'storefront_sorting_wrapper',             9 );
  remove_action( 'woocommerce_after_shop_loop',        'woocommerce_catalog_ordering',           10 );
  remove_action( 'woocommerce_after_shop_loop',        'woocommerce_result_count',               20 );
  // remove_action( 'woocommerce_after_shop_loop',        'woocommerce_pagination',                 30 );
  remove_action( 'woocommerce_after_shop_loop',        'storefront_sorting_wrapper_close',       31 );

}

// add_action('wp_enqueue_scripts', 'rebeccabeyond_scripts', 20);
//
// function rebeccabeyond_scripts() {
//   wp_dequeue_style('storefront-style');
// }

function storefront_site_branding() {
  ?>
  <div class="site-branding">
    <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
  </div>
  <?php
}

add_filter('storefront_google_font_families', 'rebeccabeyond_font_families');

function rebeccabeyond_font_families($fonts) {
  $fonts['raleway'] = 'Raleway:300';
  error_log(print_r( $fonts, true));
  return $fonts;
}
