<?php
/**
 * codegrabber functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package codegrabber
 */
/**
 * Main functions
 */
require( get_template_directory() . '/framework/functions.php' );
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

// FTP on local
// if(is_admin()) {
// 	add_filter('filesystem_method', create_function('$a', 'return "direct";' ));
// 	define( 'FS_CHMOD_DIR', 0751 );
// }

/**
* browser-sync
*/
add_action( 'wp_footer', function () { ?>
<script id="__bs_script__">//<![CDATA[
	    document.write("<script async src='http://HOST:3000/browser-sync/browser-sync-client.js?v=2.24.6'><\/script>".replace("HOST", location.hostname));
	//]]></script>
<?php }, 999);
