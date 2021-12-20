<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div class="container">
 *
 * @package SKT Minimal
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' ) ); ?>">
<?php endif; ?>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php do_action( 'wp_body_open' ); ?>
<a class="skip-link screen-reader-text" href="#content_navigator">
<?php esc_html_e( 'Skip to content', 'skt-minimal' ); ?>
</a>
<?php
	$header_trans = get_theme_mod('one_header_transparent', 1);
	$showpagebanner = get_theme_mod('inner_page_banner_option', 1);
	$showpostbanner = get_theme_mod('inner_post_banner_option', 1);
	$pagethumb = get_theme_mod('inner_page_banner_thumb');
	$postthumb = get_theme_mod('inner_post_banner_thumb');
?>
<div class="header <?php if( !is_home() && is_front_page() && $header_trans == '') { echo esc_html('transheader'); } ?>">
  <div class="container">
    <div class="logo">
		<?php skt_minimal_the_custom_logo(); ?>
        <div class="clear"></div>
		<?php	
        $description = get_bloginfo( 'description', 'display' );
        ?>
        <div id="logo-main">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
        <h2 class="site-title"><?php bloginfo('name'); ?></h2>
        <?php if ( $description || is_customize_preview() ) :?>
        <p class="site-description"><?php echo esc_html($description); ?></p>                          
        <?php endif; ?>
        </a>
        </div>
    </div> 
        <div id="navigation"><nav id="site-navigation" class="main-navigation">
				<button type="button" class="menu-toggle">
					<span></span>
					<span></span>
					<span></span>
				</button>
		<?php wp_nav_menu( array('theme_location' => 'primary', 'container' => 'ul', 'menu_id' => 'primary', 'menu_class' => 'primary-menu menu' ) ); ?>
			</nav></div>
            <div class="header-extras">
            	<div class="header-search-toggle"><img src="<?php echo esc_url(get_template_directory_uri());?>/images/icon-search.png"/></div>
            	<div class="header-search-form">
                    <form method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                      <input type="search" class="search-field" placeholder="<?php esc_attr_e( 'Search', 'skt-minimal' ); ?>" name="s">
                      <input type="submit" class="search-submit" value="<?php esc_attr_e( 'Search', 'skt-minimal' ); ?>">
                    </form>
          		</div>
            	<?php if ( class_exists( 'WooCommerce' ) ) { ?>
    			<div class="header-cart">
				<a class="cart-customlocation" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'skt-minimal' ); ?>"> <img class="cart-customlocation" src="<?php echo esc_url( SKT_MINIMAL_SKTTHEMES_THEME_URI . 'images/cart-icon.png' ); ?>" /> <span class="custom-cart-count"><?php echo wp_kses_data( WC()->cart->get_cart_contents_count() ); ?></span> </a>  
    			</div>
    <?php } ?>
    		<div class="clear"></div>
            </div>
        <div class="clear"></div>    
    </div> <!-- container --> 
    <div class="clear"></div>  
  </div>
  <?php if( !is_home() && !is_front_page() && is_page() && $showpagebanner == '') {?>
      <div class="clear"></div>
      <div class="inner-banner-thumb">
        <?php 	if ( has_post_thumbnail() ) {
                    echo the_post_thumbnail('full');
                }else{
			if(!empty($pagethumb)){ ?>
            <img src="<?php echo esc_url($pagethumb); ?>" />
            <?php } } ?>
        <div class="banner-container"><h1><?php the_title(); ?></h1></div>
      </div>
  <?php } ?>
  
  <?php if( !is_home() && !is_front_page() && !is_page() && is_single() && 'post' == get_post_type() && $showpostbanner == '') {?>
      <div class="clear"></div>
      <div class="inner-banner-thumb">
        <?php 	if ( has_post_thumbnail() ) {
                    echo the_post_thumbnail('full');
                }else{
			if(!empty($postthumb)){ ?>
            <img src="<?php echo esc_url($postthumb); ?>" />
            <?php }  } ?>
        <div class="banner-container"><h1><?php the_title(); ?></h1></div>
      </div>
  <?php } ?>  
  
  <div class="clear"></div> 