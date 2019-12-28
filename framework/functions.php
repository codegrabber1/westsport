<?php
if ( ! function_exists( 'codegrabber_setup' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function codegrabber_setup() {
	    /**
	     * Load up our required theme files.
	     */
        require( get_template_directory() . "/framework/options/widget_options.php" );
        require( get_template_directory() . "/framework/options/option_functions.php" );

        require( get_template_directory() . "/framework/meta/meta-featured.php" );
        require( get_template_directory() . "/framework/meta/meta-staff.php" );

        require( get_template_directory() . "/framework/widgets/widget_about.php" );
        require( get_template_directory() . "/framework/widgets/widget_facebook.php" );
        require( get_template_directory() . "/framework/widgets/widget_tags.php" );
        require( get_template_directory() . "/framework/widgets/widget_aboutcreation.php" );
        require( get_template_directory() . "/framework/widgets/widget_slider.php" );
        require( get_template_directory() . "/framework/widgets/widget_weather.php" );
        require( get_template_directory() . "/framework/widgets/widget_small_recent_posts.php" );
        require( get_template_directory() . "/framework/widgets/widget_square_recent_posts.php" );
        // require( get_template_directory() . "/framework/widgets/VerticalSlider/widget_verticalSlider.php" );

        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on codegrabber, use a find and replace
         * to change 'codegrabber' to the name of your theme in all the template files.
         */
        load_textdomain( 'codegrabber', get_template_directory() . '/languages' );

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support( 'post-thumbnails' );

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus( array(
            'menu-1' => esc_html__( 'Primary', 'codegrabber' ),
        ) );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ) );

        // Set up the WordPress core custom background feature.
        add_theme_support( 'custom-background', apply_filters( 'codegrabber_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        ) ) );

        // Add theme support for selective refresh for widgets.
        add_theme_support( 'customize-selective-refresh-widgets' );

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support( 'custom-logo', array(
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        ) );
    }
endif;
add_action( 'after_setup_theme', 'codegrabber_setup' );
/**
 * Enqueue scripts and styles.
 */

if( !is_admin() ) {
	add_action( 'wp_enqueue_scripts', 'codegrabber_scripts' );
}
add_action( 'wp_enqueue_scripts', 'codegrabber_scripts' );
if( !function_exists( 'codegrabber_scripts' ) ){
	function codegrabber_scripts() {

		wp_enqueue_script( 'codegrabber-jquery3', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js', array(), '20151215', false );

		wp_enqueue_script( 'codegrabber-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

		wp_enqueue_script( 'codegrabber-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

		wp_enqueue_script( 'codegrabber-superfishjs', 'https://cdnjs.cloudflare.com/ajax/libs/superfish/1.7.9/js/superfish.min.js', array( 'jquery' ), '20151215', true );

		wp_enqueue_script( 'codegrabber-mmenujs', 'https://cdnjs.cloudflare.com/ajax/libs/jQuery.mmenu/7.0.3/jquery.mmenu.all.js', array( 'jquery' ), '20151215', true );

		wp_enqueue_script( 'codegrabber-owljs', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.3/owl.carousel.min.js', array( 'jquery' ), '20151215', false );

		wp_enqueue_script( 'codegrabber-semanticjs', get_template_directory_uri() . '/libs/semantic/semantic.min.js', array( 'jquery' ), '20151215', true );

		// wp_enqueue_script( 'codegrabber-wowjs', 'https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js', array( 'jquery' ), '20151215', true );

    wp_enqueue_script( 'codegrabber-alljs', get_template_directory_uri() . '/js/all.js', array( 'jquery' ), '20151215', true );

    wp_enqueue_script( 'codegrabber-mixitupjs', get_template_directory_uri() . '/libs/jquery.mixitup.min.js', array( 'jquery' ), '', true );

		wp_enqueue_script( 'codegrabber-customjs', get_template_directory_uri() . '/js/theme/custom.js', array( 'jquery' ), '20151215', true );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
}

/**
 * Enqueues styles for front-end.
 *
 */
if ( !function_exists( 'codegrabber_css' ) ) {
	function codegrabber_css() {
		wp_enqueue_style( 'codegrabber-bootstrap', 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css' );

		wp_enqueue_style( 'codegrabber-mmenucss', 'https://cdnjs.cloudflare.com/ajax/libs/jQuery.mmenu/7.0.3/jquery.mmenu.css' );

		wp_enqueue_style( 'codegrabber-superfishcss', 'https://cdnjs.cloudflare.com/ajax/libs/superfish/1.7.9/css/superfish.min.css' );

		wp_enqueue_style( 'codegrabber-owlcss', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.3/assets/owl.carousel.min.css' );

		// wp_enqueue_style( 'codegrabber-animatecss', 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css' );

		wp_enqueue_style( 'codegrabber-fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' );

		wp_enqueue_style( 'codegrabber-newfontawesome', 'https://use.fontawesome.com/releases/v5.0.9/css/all.css' );

		wp_enqueue_style( 'codegrabber-semanticcss', get_template_directory_uri() . '/libs/semantic/semantic.min.css');

		wp_enqueue_style( 'codegrabber-semanticiconcss', 'https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/components/icon.min.css' );

		wp_enqueue_style( 'codegrabber-style', get_stylesheet_uri() );


    }
}
add_action( 'wp_enqueue_scripts', 'codegrabber_css' );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function codegrabber_content_width() {
    // This variable is intended to be overruled from themes.
    // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    $GLOBALS['content_width'] = apply_filters( 'codegrabber_content_width', 320 );
}
add_action( 'after_setup_theme', 'codegrabber_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
if ( function_exists('register_sidebar') ) {
    function codegrabber_widgets_init() {
        register_sidebar( array(
            'name'          => esc_html__( 'Sidebar', 'codegrabber' ),
            'id'            => 'sidebar-1',
            'description'   => esc_html__( 'Add widgets here.', 'codegrabber' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ) );

        register_sidebar( array(
            'name'              => __( 'Place for section widget', 'codegrabber' ),
            'id'                => 's_widget-1',
            'description'       => __( 'Footer widget area', 'codegrabber' ),
            'before_widget'     => '<aside id="%1$s" class="widget %2$s" data-animation="fadeInUp">',
            'after_widget'      => '</aside>',
            'before_title'      => '<div class="widget-title"><h4>',
            'after_title'       => '</h4></div>',
        ) );

    /**
     * Creates a sidebar
     * @param string|array  Builds Sidebar based off of 'name' and 'id' values.
     */
    $args = array(
        'name'              => __( 'Footer Middle place', 'codegrabber' ),
        'id'                => 'footer-2',
        'description'       => esc_html__( 'Footer widget area.', 'codegrabber' ),
        'class'             => '',
        'before_widget'     => '<aside id="%1$s" class="widget %2$s" data-animation="fadeInUp">',
        'after_widget'      => '</aside>',
        'before_title'      => '<div class="widget-title"><h4>',
        'after_title'       => '</h4></div>',
    );

    register_sidebar( $args );

    /**
     * Creates a sidebar
     * @param string|array  Builds Sidebar based off of 'name' and 'id' values.
     */
    $args = array(
        'name'          => __( 'Footer Right place', 'codegrabber' ),
        'id'            => 'footer-3',
        'description'   => esc_html__( 'Footer widget area.', 'codegrabber' ),
        'class'         => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s" data-animation="fadeInUp">',
        'after_widget'  => '</aside>',
        'before_title'  => '<div class="widget-title"><h4>',
        'after_title'   => '</h4></div>',
    );

    register_sidebar( $args );

    $args = array(
        'name'  => __( 'First feature place on the main page', 'codegrabber' ),
        'id'    => 'v-slider',
        'description'   => esc_html__( 'You can place some widget here. For example, slider.', 'codegrabber' ),
        'class' => '',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',

        );
    register_sidebar( $args );
    }

    add_action( 'widgets_init', 'codegrabber_widgets_init' );


}

/**
 * Pagination for archive, taxonomy, category, tag and search results pages
 *
 * @global $wp_query http://codex.wordpress.org/Class_Reference/WP_Query
 * @return Prints the HTML for the pagination if a template is $paged
 */
if ( ! function_exists( 'cg_pagination' ) ) :
function cg_pagination() {
    global $wp_query;

    $big = 999999999; // This needs to be an unlikely integer

    // For more options and info view the docs for paginate_links()
    // http://codex.wordpress.org/Function_Reference/paginate_links
    $paginate_links = paginate_links( array(
	    'base' => str_replace( $big, '%#%', get_pagenum_link($big) ),
	    'current' => max( 1, get_query_var('paged') ),
	    'total' => $wp_query->max_num_pages,
	    'type'  => 'list',
	    'mid_size' => 5
    ) );

    // Display the pagination if more than one page is found
    if ( $paginate_links ) {
        echo '<div class="b_pagination">';
        echo $paginate_links;
        echo '</div><!--// end .pagination -->';
    }
}
endif; // ends check for wt_pagination()

/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own codegrabber_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 */
if( !function_exists( 'codegrabber_comment' ) ) :
function codegrabber_comment( $comment, $args, $depth ) {


    $GLOBALS['comment'] = $comment;
    global $post;

    switch( $comment->comment_type ) :
        case '' :
            if( $comment->user_id == $post->post_author ){
                $author_text = '<div class="comment_author">WestSportCenter</div>';
            } else {
                $author_text = '';
            }
        ?>
            <li class="b_comments clearfix" id="li-comment-<?php comment_ID(); ?>">
                <article id="comment-<?php comment_ID(); ?>">
                    <div class="comRight clearfix">
                            <div class="comLeft clearfix">
                                <a href="<?php comment_author_url()?>"><?php echo get_avatar( $comment, 80 ); ?></a>
                            </div>
                            <?php echo $author_text; ?>
                            <span class="comment-time">
                                <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
                                <?php
                                    /* translators: 1: date, 2: time */
                                    printf( __( '%1$s at %2$s', 'codegrabber' ), get_comment_date(),  get_comment_time() ); ?></a>
                            </span>
                        <div class="comment-text ">
                            <?php comment_text(); ?>
                        </div>
                        <p class="m_button"><a href="#"><?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'codegrabber' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?> </a></p>
                    </div>
                </article>
            </li>
            <?php
            break;
        case 'pingback'  :
        case 'trackback' :
            ?>
        <li class="post pingback">
        <p><?php _e( 'Pingback:', 'codegrabber' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '[ Edit ]', 'codegrabber' ), '<span class="edit-link">', '</span>' ); ?></p>
        </li>
<?php
    break;
endswitch;
}
endif;//ends check for codegrabber_comment()


/**
 * Google fonts
 * https://fonts.google.com
 */
function codegrabber_google_fonts() {
    wp_enqueue_style( 'codegrabber-googleFontsHeader', 'https://fonts.googleapis.com/css?family=Oswald:400,700&amp;subset=cyrillic', false );
    wp_enqueue_style( 'codegrabber-googleMainFonts', 'https://fonts.googleapis.com/css?family=Roboto:400,700&amp;subset=cyrillic,cyrillic-ext', false );
}
add_action( 'wp_enqueue_scripts', 'codegrabber_google_fonts' );

/**
 * Create tags list
 *
 * @global https://codex.wordpress.org/Function_Reference/get_the_tags
 * @return The list of the tags
 */
function list_tags() {
    $tags= get_the_tags();
      $tag_str = null;
    if( $tags ) {
        foreach( $tags as $tag ) {
          $tag_str = '<a href="">' .$tag->name. '</a>, ';
        }
        $tag_str = rtrim( $tag_str, ', ' );
    }
    echo $tag_str;

}

/**
 * Custom breadcrumbs.
 *
 *
 */
function breadcrumbs( $separator = ' &raquo; ', $home = ' Головна ' ) {
    $path = array_filter( explode( '/', parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH ) ) );
    $base_url = ( $_SERVER['HTTPS'] ? 'https' : 'http' ) . '://' . $_SERVER['HTTP_HOST'] . '/';
    $breadcrumbs = array( "<a href=\"$base_url\"> $home </a> " );

    $last = end( array_keys( $path ) );

    foreach( $path as $x => $crumb ) {
        $title = ucwords( str_replace( array( '.php', '_' ), Array( '', ' ' ), $crumb ) );
        if( $x != $last ) {
            $breadcrumbs[] = '<a href="'.$base_url.$crumb.'">'. $title .'</a>' ;
        } else {
            $breadcrumbs[] = $title;
        }
    }

    return implode( $separator, $breadcrumbs );
}

/**
 * Main big slider on top.
 * @uses $wp_post_types Inserts new post type object into the list
 *
 * @param string  Post type key, must not exceed 20 characters
 * @param array|string  See optional args description above.
 * @return object|WP_Error the registered post type object, or an error object
 */
function slider_index() {

    $labels = array(
        'name'               => __( 'All slides', 'codegrabber' ),
        'singular_name'      => __( 'Singular Name', 'codegrabber' ),
        'add_new'            => __( 'Add New Singular Name', 'codegrabber' ),
        'add_new_item'       => __( 'Add New Singular Name', 'codegrabber' ),
        'edit_item'          => __( 'Edit Singular Name', 'codegrabber' ),
        'new_item'           => __( 'New Singular Name', 'codegrabber' ),
        'view_item'          => __( 'View Singular Name', 'codegrabber' ),
        'parent_item_colon'  => __( 'Parent Singular Name:', 'codegrabber' ),
        'menu_name'          => __( 'Big slider', 'codegrabber' ),
    );

    $args = array(
        'labels'              => $labels,
        'hierarchical'        => false,
        'description'         => 'description',
        'taxonomies'          => array(),
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 10,
        'menu_icon'           => admin_url( ) . '/images/media-button-video.gif',
        'show_in_nav_menus'   => true,
        'publicly_queryable'  => true,
        'exclude_from_search' => false,
        'has_archive'         => true,
        'query_var'           => true,
        'can_export'          => true,
        'rewrite'             => true,
        'capability_type'     => 'post',
        'supports'            => array(
            'title',
            'editor',
            'thumbnail',
            'excerpt',
            'custom-fields',
        ),
    );

    register_post_type( 'bigslider', $args );
}

add_action( 'init', 'slider_index' );

// Usage:
// get_id_by_slug('any-page-slug');

function get_id_by_slug($page_slug) {
  $page = get_page_by_path($page_slug);
  if ($page) {
    return $page->ID;
  } else {
    return null;
  }
}

/**
 * Facebook and Open Graph nameservers
 */

function doctype_opengraph( $output ) {
	return $output . '
    xmlns:og="http://opengraphprotocol.org/schema/"
    xmlns:fb="http://www.facebook.com/2008/fbml"';
}
add_filter('language_attributes', 'doctype_opengraph');

function cg_get_first_cat(){
	$category = get_the_category();

	if ($category){

		$output = "";
		if (isset($category[0]->term_id)){

			$cat1_id = $category[0]->term_id;
			$wt_category_meta = get_option( "wt_category_meta_color_$cat1_id" );
			$output .= '<span class="entry-cat-bg main-color-bg cat'.$cat1_id.'-bg">';
			$output .= '<i class="fa fa-folder"></i>';
			$output .= '<a href="' . get_category_link( $category[0]->term_id ) . '">' . $category[0]->name.'</a>';
			$output .= '</span>';
		}

		echo $output;

	}
}

function theme_subcategory_hierarchy() {
    $category = get_queried_object();

    $parent_id = $category->category_parent;

    $templates = array();

    if ( $parent_id == 0 ) {
      $templates[] = "category-{$category->slug}.php";
      $templates[] = "category-{$category->term_id}.php";
      $templates[] = 'category.php';
    } else {
      $parent = get_category( $parent_id );
      $templates[] = "category-{$category->slug}.php";
      $templates[] = "category-{$category->term_id}.php";

      $templates[] = "category-{$parent->slug}.php";
      $templates[] = "category-{$parent->term_id}.php";
      $templates[] = 'category.php';
    }
    return locate_template( $templates );
  }
add_action('template_redirect', 'wpds_parent_category_template');

/**
 * Получает термин верхнего уровня, для указанного или текущего поста в цикле
 * @param  string          $taxonomy      Название таксономии
 * @param  integer/object  [$post_id = 0] ID или объект поста
 * @return string/wp_error Объект термина или false
 */
function get_top_term( $taxonomy, $post_id = 0 ) {
  if( isset($post_id->ID) ) $post_id = $post_id->ID;
  if( ! $post_id )          $post_id = get_the_ID();

  $terms = get_the_terms( $post_id, $taxonomy );

  if( ! $terms || is_wp_error($terms) ) return $terms;

  // только первый
  $term = array_shift( $terms );

  // найдем ТОП
  $parent_id = $term->parent;
  while( $parent_id ){
    $term = get_term_by( 'id', $parent_id, $term->taxonomy );
    $parent_id = $term->parent;
  }

  return $term;
}

function wpds_parent_category_template()
{
    if (!is_category())
        return true;
    $catObj = get_queried_object();
    // Перезаписываем шаблон для определенной рубрики "design", чьей родительской рубрикой является "projects"
    if (is_category($catObj->category_nicename) && cat_is_ancestor_of($catObj->parent, $catObj->term_id)) {

        $top_term = get_top_term( $catObj->taxonomy );
        $temp_cat_name = $top_term->slug; // название термина
        $template = TEMPLATEPATH . "/category-{$temp_cat_name}.php";
      // загружаем, если файл шаблона существует.
        if (file_exists($template)) {
            load_template($template);
            exit;
        }
    }
}
