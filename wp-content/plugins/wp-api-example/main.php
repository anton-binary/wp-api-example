<?php
/*
Plugin Name:  Deriv API example
Plugin URI:   https://api.deriv.com
Description:  Example plugin
Version:      1.0
Author:       Deriv 
Author URI:   https://www.deriv.com
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  wp-api-example
Domain Path:  /languages
*/

include "tick-stream.php";
include "tradingview.php";
include "logging-in-to-deriv.php";

function get_current_page_slug() {
    global $wp;
    $current_page = explode("/",home_url($wp->request));
    return end($current_page);
}

function insert_content($content,$page_content,$slug) {
    if($slug == '') return $content;
    if($content == '') return $page_content;
    $tag = '<!-- wp-api-example:' . $slug . ' -->';
    if (strpos($content, $tag) !== false) {
        return str_replace($tag, $page_content, $content);
    } else {
        return $content . $page_content;
    }
}

function add_code_after_content($content) {
    $slug = get_current_page_slug();
    switch($slug) {
        case "tick-stream":
            return insert_content($content,tickStream_content(),$slug);
            break;
        case "tradingview-chart":
            return insert_content($content,TradingView_content(),$slug);
            break;
        case "logging-in-to-deriv":
            return insert_content($content,loggingIn_content(),$slug);
            break;
        default:
            return $content;
    }
}
add_filter('the_content','add_code_after_content');

function wpb_hook_head($wp_head) {
    switch(get_current_page_slug()) {
        case "tick-stream":
            $js_head = tickStream_js_head();
            break;
        case "tradingview-chart":
            $js_head = TradingView_js_head();
            break;
        case "logging-in-to-deriv":
            $js_head = loggingIn_js_head();
            break;
        default:
            return $wp_head;
        }
        return $wp_head . $js_head;
}
add_action('wp_head', 'wpb_hook_head');

function wpb_hook_footer($footer_content) {
    switch(get_current_page_slug()) {
        case "tick-stream":
            // $js_footer = tickStream_js_footer() ;
            // break;
        case "tradingview-chart":
            $js_footer = TradingView_js_footer();
            break;
        case "logging-in-to-deriv":
            $js_footer = loggingIn_js_footer();
            break;
        default:
            return $footer_content;
        }
    return $footer_content . $js_footer;
}

add_action('wp_footer','wpb_hook_footer');