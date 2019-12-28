<?php
/**
 * The Theme Option Functions page
 *
 * This page is implemented using the Settings API.
 *
 * @package  codegraber
 * @file     option_functions.php
 * @author   codegrabber
 */

$options = get_option('cg_options');
/*
 * ==================
 * Set the animations.
 * ==================
*/
function codegrabber_animate_css() {
    $options = get_option('cg_options');
    $show_animation = $options['cg_enable_animation'];

    if( !empty($show_animation) ){
        wp_enqueue_style( 'codegrabber-animatecss', 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css' );
        wp_enqueue_script( 'codegrabber-wowjs', 'https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js', array( 'jquery' ), '20151215', true );
    }
}
add_action( 'wp_enqueue_scripts', 'codegrabber_animate_css' );
/*
 * ==================
 * Set custom CSS styles
 * ==================
*/
function cg_custom_styles() {
    $options = get_option( 'cg_options' );
    $cg_custom_style = '';
    wp_enqueue_style('style', get_template_directory_uri() . 'style.css');
    $cg_topheader_color = $options['cg_topheader_color'];
    $cg_links_color = $options['cg_links_color'];

    if( !empty( $cg_topheader_color ) ) {
      $cg_custom_style .= "nav, input[type='submit']{\n background-color: $cg_topheader_color;\n}\n\n";
      $cg_custom_style .= ".block_lstart, .s_title {\n border-bottom: 2px solid $cg_topheader_color;\n}\n\n";
      $cg_custom_style .= ".widget h3{\n border-bottom: 1px solid $cg_topheader_color;\n }\n\n";
      $cg_custom_style .= ".widget h3, .entry-title{\n border-left: 5px solid $cg_topheader_color;\n}\n\n";
      $cg_custom_style .= ".widget h3::after{\n border-left: 9px solid $cg_topheader_color;\n}\n\n";
      $cg_custom_style .= ".related-posts{\n border-top: 1px solid $cg_topheader_color;\n}\n\n";
      $cg_custom_style .= ".owl-nav .owl-next::after, .owl-nav .owl-prev::after {\n color: $cg_topheader_color;\n}\n\n";
      $cg_custom_style .= ".mainBlock .owl-dots .owl-dot.active {\n background: $cg_topheader_color;\n}\n\n";

    }

    if( !empty( $cg_links_color ) ) {
      $cg_custom_style .= "a,.entry-title a {\n color: $cg_links_color;\n}\n\n";
      $cg_custom_style .= ".breadcrumbs li a:hover::before {\n border-color: $cg_links_color transparent;\n}\n\n";
      $cg_custom_style .= ".breadcrumbs li a:hover::after {\n border-left-color: $cg_links_color;\n}\n\n";
      $cg_custom_style .= ".breadcrumbs li a:hover, .breadcrumbs .current, .breadcrumbs .current:hover {\n background: $cg_links_color;\n}\n\n";
      $cg_custom_style .= ".breadcrumbs .current::before, .breadcrumbs .current:hover::before {\n border-color: $cg_links_color transparent;\n}\n\n";
      $cg_custom_style .= ".breadcrumbs .current::after, .breadcrumbs .current:hover::after  {\n color: $cg_links_color;\n}\n\n";
    }

    wp_add_inline_style( 'style', $cg_custom_style );
}
add_action( 'wp_enqueue_scripts', 'cg_custom_styles' );
