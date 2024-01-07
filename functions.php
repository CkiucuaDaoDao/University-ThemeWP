<?php
require get_theme_file_path( '/inc/rest-api.php' );

// Nhúng css, bootstrap, font, scripts vào wp
add_action("wp_enqueue_scripts", "load_assets");
function load_assets()
{
    wp_enqueue_style("font", "//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i", array(), "1.0", 'all');
    wp_enqueue_style("bootstrapcss", "//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css", array(), "1.1", 'all');
    wp_enqueue_style("maincss", get_theme_file_uri() . '/build/index.css', array(), '1.0.2', 'all');
    wp_enqueue_style("mainstylecss", get_theme_file_uri() . '/build/style-index.css', array(), '1.0.3', 'all');

    wp_enqueue_script("university_scripts", get_theme_file_uri() . '/build/index.js', array('jquery'), '1.0.4', true);
    wp_localize_script('university_scripts', 'universityData', array(
        'root_url' => get_site_url()
    ));
}

// Thêm field vào rest api WP
add_action( "rest_api_init", "registerField" );
function registerField() {
    register_rest_field( 'post', 'authorName', array(
        'get_callback' => function () {return get_author_name();}
    ));
}

// Thêm menu vào wp footer
add_action("init", "add_menu");
function add_menu()
{
    add_theme_support('menus');
    register_nav_menus(array(
        'themeLocationOne' => 'Theme Footer One',
        'themeLocationTwo' => 'Theme Footer Two'
    ));
}

// Giới hạn ký tự bài viết
add_filter('excerpt_length', 'wpdocs_custom_excerpt_length');
function wpdocs_custom_excerpt_length($length)
{
    return 25;
}

// Tạo mới một cái main query
add_action('pre_get_posts', 'university_create_query');
function university_create_query($query)
{
    // Tạo custom query cho Archive Programmes
    if (!is_admin() and is_post_type_archive('programmes') and $query->is_main_query()) {
        $query->set('post_type', 'programmes');
        $query->set('posts_per_page', -1);
        $query->set('order', 'ASC');
    }
    // Tạo custom query cho Archive Events
    if (!is_admin() and is_post_type_archive('event') and $query->is_main_query()) {
        $today = date('Ymd');
        $query->set('post_type', 'event');
        $query->set('posts_per_page', 2);
        $query->set('meta_key', 'events_date');
        $query->set('orderby', 'meta_value_num');
        $query->set('order', 'ASC');
        $query->set('meta_query', array(
            array(
                "key" => 'events_date',
                "compare" => '>=',
                "value" => $today,
                "type" => 'numeric'
            )
        ));
    }
}

///Xử lý hình ảnh cho post type = professor 
add_action('after_setup_theme', 'wpdocs_theme_setup');
function wpdocs_theme_setup()
{
    // add_theme_support('post-thumbnails');
    add_image_size('professorLandscape', 400, 260, true);
    add_image_size('professorPortrail', 480, 650, true);
    add_image_size('pageBanner', 1500, 350, true);
}

// Khai báo pageBanner
function getBanner($args = NULL)
{
    if (!isset($args["title"])) {
        $args["title"] = get_the_title();
    }
    if (!isset($args["subtitle"])) {
        $args["subtitle"] = get_field("page_banner_subtitle");
    }
    if (!isset($args["photo"])) {
        if (get_field("page_banner_background_image")) {
            $args["photo"] = get_field("page_banner_background_image")['sizes']['pageBanner'];
        } else {
            $args["photo"] = get_theme_file_uri('/images/ocean.jpg');
        }
    }
?>
    <div class="page-banner">
        <div class="page-banner__bg-image" style="background-image: url(<?php echo $args["photo"]; ?>);"></div>
        <div class="page-banner__content container container--narrow">
            <h1 class="page-banner__title"><?php echo $args["title"]; ?></h1>
            <div class="page-banner__intro">
                <p><?php echo $args["subtitle"]; ?></p>
            </div>
        </div>
    </div>
<?php
}

// Redirect homepage when guest login 
add_action('admin_init','redirectHomePage');

function redirectHomePage() {
    $guests = wp_get_current_user();
    if($guests->roles[0] == 'subscriber') {
        wp_redirect( site_url( '/') );
        exit;
    }
}

//Ẩn thanh topbar
add_action('wp_loaded','noAdminBar');

function noAdminBar() {
    $guests = wp_get_current_user();
    if($guests->roles[0] == 'subscriber') {
        show_admin_bar( false );
    }
}

// Chuyển về trang chủ khi ng dùng click vào biểu tượng Wordpress của form login 
add_filter('login_headerurl','chuyenTrangHomePage');
function chuyenTrangHomePage() {
    return esc_url(site_url('/'));
}