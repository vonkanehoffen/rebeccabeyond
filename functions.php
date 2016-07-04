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
  remove_action( 'woocommerce_after_shop_loop',        'storefront_sorting_wrapper_close',       31 );

  // Remove handheld footer bar
  remove_action( 'storefront_footer',                  'storefront_handheld_footer_bar',         999 );


}

// add_action('wp_enqueue_scripts', 'rebeccabeyond_scripts', 20);
//
// function rebeccabeyond_scripts() {
//   wp_dequeue_style('storefront-style');
// }

// Header ---------------------------------------------------------------------

function storefront_site_branding() {
  ?>
  <div class="site-branding">
    <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
      <span class="rb-logo"></span>
      <span class="text"><?php bloginfo( 'name' ); ?></span>
    </a></h1>
  </div>
  <?php
}

add_filter('storefront_google_font_families', 'rebeccabeyond_font_families');

function rebeccabeyond_font_families($fonts) {
  $fonts['raleway'] = 'Raleway:300,600';
  return $fonts;
}

function storefront_primary_navigation() {

  $cart_count = wp_kses_data( WC()->cart->get_cart_contents_count() );
  ?>
  <nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_html_e( 'Primary Navigation', 'storefront' ); ?>">
    <?php // Note: Taken from storefront_handheld_footer_bar_cart_link ?>
    <div class="header-cart">
      <a class="header-cart-contents <?php echo $cart_count > 0 ? 'has-items' : ''; ?>" href="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'storefront' ); ?>">
        <span class="count"><?php echo $cart_count;?></span>
        <i class="fa fa-shopping-basket"></i>
      </a>
    </div>
    <?php
    wp_nav_menu(
      array(
        'theme_location'	=> 'primary',
        'container_class'	=> 'primary-navigation',
        )
    );
    ?>
  </nav><!-- #site-navigation -->
  <?php
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

// Footer ----------------------------------------------------------------------

/**
 * Display the theme credit
 *
 * @return void
 */
function storefront_credit() {
  ?>
  <div class="site-info">
    <?php echo esc_html( apply_filters( 'storefront_copyright_text', $content = '&copy; ' . get_bloginfo( 'name' ) . ' ' . date( 'Y' ) ) ); ?>.
    Site design by <a href="http://kanec.co.uk/">Kane Clover</a>
  </div><!-- .site-info -->
  <?php
}
