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

  // Remove homepage stuff (there's a plugin for this too)
  remove_action( 'homepage', 'storefront_homepage_content', 10);
  remove_action( 'homepage', 'storefront_recent_products', 30);
  remove_action( 'homepage', 'storefront_popular_products', 50);
  remove_action( 'homepage', 'storefront_on_sale_products', 60);
  remove_action( 'homepage', 'storefront_best_selling_products', 70);

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
  return $fonts;
}

// Homepage --------------------------------------------------------------------

// 3 column products
add_filter('storefront_featured_products_args', function($args) {
  $args['columns'] = 3;
  $args['title'] = 'Featured Pieces';
  return $args;
});

// add_action('homepage', 'rebeccabeyond_home_splash', 9);
add_action('storefront_before_content', 'rebeccabeyond_home_splash', 10);

function rebeccabeyond_home_splash() {
  error_log(print_r( "dfgdfgdfgdfg", true));
  if(is_front_page()) {
    ?>
    <div id="home-splash" class="site-content">
      <div class="col-full">
        <img src="<?php bloginfo('stylesheet_directory'); ?>/assets/images/logo.svg" alt="" class="home-splash-logo"/>
        <h1>Rebecca Beyond</h1>
        <h2 class="site-description"><?php echo bloginfo( 'description' ); ?></h2>
      </div>
    </div>
    <!-- <svg viewbox="0 0 100 100">
      <defs>
        <clipPath id="clip4">
            <ellipse cx="50" cy="50" rx="100" ry="100"></ellipse>
        </clipPath>
      </defs>
    </svg> -->
    <?php
  }
}
