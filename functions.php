<?php
/**
 * WP Customisation for Rebecca Beyond site
 */
add_action('init', 'rebeccabeyond_custom');

function rebeccabeyond_custom() {
  remove_action('storefront_header', 'storefront_product_search', 40);
  remove_action('storefront_header', 'storefront_header_cart', 60);
  remove_action('storefront_header', 'storefront_secondary_navigation', 30);
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
