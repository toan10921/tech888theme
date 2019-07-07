<?php
/**
 * Created by PhpStorm.
 * User: toanngo92
 * Date: 2/2/2019
 * Time: 7:33 PM
 */

if (!defined('ABSPATH')) return;


if (!class_exists('Tech888f_Controller')) {
    class Tech888f_Controller
    {


        static function _init()
        {
            //Default Framwork Hooked
            add_filter('wp_title', array(__CLASS__, '_wp_title'), 10, 2);
            add_action('wp', array(__CLASS__, '_setup_author'));
            add_action('after_setup_theme', array(__CLASS__, '_after_setup_theme'));
            add_action('widgets_init', array(__CLASS__, '_add_sidebars'));
            add_action('wp_enqueue_scripts', array(__CLASS__, '_add_scripts_head_tag'));

            //Custom hooked
            add_filter('tech888f_get_sidebar_pos', array(__CLASS__, '_blog_filter_sidebar'));
            add_filter('tech888f_header_page_id', array(__CLASS__, '_header_id'));
            add_filter('tech888f_footer_page_id', array(__CLASS__, '_footer_id'));
            add_action('admin_enqueue_scripts', array(__CLASS__, '_add_admin_scripts'));

            if (class_exists("woocommerce") && !is_admin()) {
                add_action('woocommerce_product_query', array(__CLASS__, '_woocommerce_product_query'), 20);
            }
            add_action('after_switch_theme', array(__CLASS__, 'tech888f_setup_options'));
            //add_filter('body_class', array(__CLASS__,'tech888f_body_classes'));

            // 7up hook
            add_action('pre_get_posts', array(__CLASS__, 'tech888f_custom_posts_per_page'));
            add_action('tech888f_before_content', array(__CLASS__, 'tech888f_display_breadcrumb'), 20);
            // Before/After append settings
            $terms = array('product_cat', 'product_tag', 'category', 'post_tag');
            foreach ($terms as $term_name) {
                add_action($term_name . '_add_form_fields', array(__CLASS__, 'tech888f_product_cat_metabox_add'), 10, 1);
                add_action($term_name . '_edit_form_fields', array(__CLASS__, 'tech888f_product_cat_metabox_edit'), 10, 1);
                add_action('created_' . $term_name, array(__CLASS__, 'tech888f_product_save_category_metadata'), 10, 1);
                add_action('edited_' . $term_name, array(__CLASS__, 'tech888f_product_save_category_metadata'), 10, 1);
            }
            // Before/After append display
            add_action('tech888f_before_content', array(__CLASS__, 'tech888f_append_content_before'), 10);
            add_action('tech888f_after_content', array(__CLASS__, 'tech888f_append_content_after'), 10);

            /*gutenberg optimized hook */
            add_action('enqueue_block_editor_assets', array(__CLASS__, 'tech888f_add_gutenberg_assets'));
            add_filter('the_content', array(__CLASS__, 'tech888f_filter_content'), 99);
        }

        static function _add_scripts_head_tag()
        {

            global $tech888f_option;

            $css_url = get_template_directory_uri() . '/resources/css/';
            $js_url = get_template_directory_uri() . '/resources/js/';

            global $global_config;

            /*
             * Javascript
            */
            if (is_singular() && comments_open()) {
                wp_enqueue_script('comment-reply');
            }
            if (class_exists("woocommerce")) {
                wp_enqueue_script('wc-add-to-cart-variation');
            }

            //ENQUEUE JS

            // Load boostrap script lib version
            if ($global_config['bootstrap_version'] == '4') {
                if (is_rtl()) wp_enqueue_script('bootstrap', $js_url . 'libs/bootstrap4.0.rtl.min.js', array('jquery'), null, true);
                else wp_enqueue_script('bootstrap', $js_url . 'libs/bootstrap4.0.min.js', array('jquery'), null, true);
            } else wp_enqueue_script('bootstrap', $js_url . 'libs/bootstrap.min.js', array('jquery'), null, true);

            // Load script form wp lib
            wp_enqueue_script('jquery-masonry');
            wp_enqueue_script('jquery-ui-tabs');
            wp_enqueue_script('jquery-ui-slider');

            // Load lib
            wp_enqueue_script('jquery-fancybox', $js_url . 'libs/jquery.fancybox.min.js', array('jquery'), null, true);
            wp_enqueue_script('owl-carousel', $js_url . 'libs/owl.carousel.min.js', array('jquery'), null, true);
            wp_enqueue_script('jquery-jcarousellite', $js_url . 'libs/jquery.jcarousellite.min.js', array('jquery'), null, true);
            wp_enqueue_script('jquery-mCustomScrollbar', $js_url . 'libs/jquery.mCustomScrollbar.min.js', array('jquery'), null, true);
            wp_enqueue_script('jquery-elevatezoom', $js_url . 'libs/jquery.elevatezoom.min.js', array('jquery'), null, true);
            wp_enqueue_script('timecircles', $js_url . 'libs/TimeCircles.min.js', array('jquery'), null, true);
            wp_enqueue_script('numscroller', $js_url . 'libs/numscroller.js', array('jquery'), null, true);
            wp_enqueue_script('hoverdirection', $js_url . 'libs/hoverdirection.js', array('jquery'), null, true);
            // Custom script
            wp_enqueue_script('tech888f-main-script', $js_url . 'main.js', array('jquery'), null, true);
            //AJAX
            wp_enqueue_script('tech888f-ajax', $js_url . 'ajax.js', array('jquery'), null, true);
            wp_localize_script('tech888f-ajax', 'ajax_process', array('ajaxurl' => admin_url('admin-ajax.php')));


            // ENQUEUE CSS

            /* load icon lib visual composer */
            if(!empty($tech888f_option['tech888f_icon_libs'])){
                $icon_lib = $tech888f_option['tech888f_icon_libs'];
            }

            if (function_exists('vc_icon_element_fonts_enqueue')) vc_icon_element_fonts_enqueue($icon_lib);

            /* End load icon lib visual composer*/

            // Load font
            wp_enqueue_style('tech888f-google-fonts', tech888f_get_google_fonts());

            // Load bootstrap style lib version
            if ($global_config['bootstrap_version'] == '4') {
                if (is_rtl()) wp_enqueue_style('bootstrap', $css_url . 'libs/bootstrap4.0.rtl.min.css');
                else wp_enqueue_style('bootstrap', $css_url . 'libs/bootstrap4.0.min.css');
            } else wp_enqueue_style('bootstrap', $css_url . 'libs/bootstrap.min.css');

            // Load libs css
            /* wishlist plugins has default font-awesome css */
            if (!class_exists('YITH_WCWL_Init')) {
                wp_enqueue_style('front-end-font-awesome', $css_url . 'libs/font-awesome.min.css');
            }
            wp_enqueue_style('bootstrap-theme', $css_url . 'libs/bootstrap-theme.min.css');
            wp_enqueue_style('jquery-fancybox', $css_url . 'libs/jquery.fancybox.min.css');
            wp_enqueue_style('jquery-ui', $css_url . 'libs/jquery-ui.min.css');
            wp_enqueue_style('owl-carousel', $css_url . 'libs/owl.carousel.min.css');
            wp_enqueue_style('owl-theme', $css_url . 'libs/owl.theme.default.min.css');
            wp_enqueue_style('owl-transitions', $css_url . 'libs/owl.transitions.min.css');
            wp_enqueue_style('animate-css');
            wp_enqueue_style('jquery-mCustomScrollbar', $css_url . 'libs/jquery.mCustomScrollbar.min.css');
            wp_enqueue_style('tech888f-theme', $css_url . 'libs/main-theme.css');
            wp_enqueue_style('tech888f-main-response', $css_url . 'libs/main-responsive.css');
            wp_enqueue_style('tech888f-hover', $css_url . 'libs/hover.min.css');
            wp_enqueue_style('tech888f-theme-style', $css_url . 'custom-style.css');
            wp_enqueue_style('tech888f-responsive', $css_url . 'responsive.css');
            wp_enqueue_style('tech888f-color', $css_url . 'libs/color.min.css');
            /* Using for change css main color */
            $custom_style = Tech888f_Template::load_template_view('custom-style-inline');
            if (!empty($custom_style)) {
                wp_add_inline_style('tech888f-theme-style', $custom_style);
            }
            // Default style
            wp_enqueue_style('tech888f-theme-default', get_stylesheet_uri());

        }

        /* define filter sidebar */

        static function _blog_filter_sidebar($sidebar)
        {
            global $tech888f_option;
            if ((!is_front_page() && is_home()) || (is_front_page() && is_home())) {
                $pos = $tech888f_option['tech888f_blog_sidebar_pos'];
                $sidebar_id = $tech888f_option['tech888f_blog_sidebar_id'];
            } else {
                if (is_single()) {
                    $pos = tech888f_get_opt('tech888f_post_sidebar_pos');
                    $sidebar_id = tech888f_get_opt('tech888f_post_sidebar_id');
                } else {
                    $pos = tech888f_get_opt('tech888f_page_sidebar_pos');
                    $sidebar_id = tech888f_get_opt('tech888f_page_sidebar_id');
                }
            }
            if (class_exists('WooCommerce')) {
                if (tech888f_is_woocommerce_page()) {
                    $pos = tech888f_get_opt('tech888f_sidebar_position_woo');
                    $sidebar_id = tech888f_get_opt('tech888f_sidebar_woo');
                    if (is_single()) {
                        $pos = tech888f_get_opt('sv_sidebar_position_woo_single');
                        $sidebar_id = tech888f_get_opt('sv_sidebar_woo_single');
                    }
                }
            }
            if (is_archive() && !tech888f_is_woocommerce_page()) {
                $pos = tech888f_get_opt('tech888f_sidebar_position_page_archive');
                $sidebar_id = tech888f_get_opt('tech888f_sidebar_page_archive');
            } else {
                if (!is_home()) {
                    $id = tech888f_get_current_id();
                    $sidebar_pos = get_post_meta($id, 'tech888f_sidebar_position', true);
                    $id_side_post = get_post_meta($id, 'tech888f_select_sidebar', true);
                    if (!empty($sidebar_pos)) {
                        $pos = $sidebar_pos;
                        if (!empty($id_side_post)) $sidebar_id = $id_side_post;
                    }
                }
            }
            if (is_search()) {
                $post_type = '';
                if (isset($_GET['post_type'])) $post_type = $_GET['post_type'];
                if ($post_type != 'product') {
                    $pos = tech888f_get_opt('tech888f_sidebar_position_page_search', 'right');
                    $sidebar_id = tech888f_get_opt('tech888f_sidebar_page_search', 'blog-sidebar');
                }
            }
            if ($sidebar_id) $sidebar['id'] = $sidebar_id;
            if ($pos) $sidebar['position'] = $pos;
            return $sidebar;
        }

        static function _header_id($page_id)
        {
            if (tech888f_is_woocommerce_page()) {
                $id = tech888f_get_current_id();
                $meta_value = get_post_meta($id, 'tech888f_header_page', true);
                $id_woo = tech888f_get_opt('tech888f_header_page_wc');
                if (empty($meta_value) && !empty($id_woo)) $page_id = $id_woo;
            }
            return $page_id;
        }

        static function _footer_id($page_id)
        {
            if (tech888f_is_woocommerce_page()) {
                $id = tech888f_get_current_id();
                $meta_value = get_post_meta($id, 'tech888f_footer_page', true);
                $id_woo = tech888f_get_opt('tech888f_footer_page_woo');
                if (empty($meta_value) && !empty($id_woo)) $page_id = $id_woo;
            }
            return $page_id;
        }


        // -----------------------------------------------------
        // Default Hooked, Do not edit

        /**
         * Hook setup theme
         *
         *
         * */

        static function _after_setup_theme()
        {
            /*
             * Make theme available for translation.
             * Translations can be filed in the /languages/ directory.
             * If you're building a theme based on stframework, use a find and replace
             * to change LANGUAGE to the name of your theme in all the template files
             */

            // This theme uses wp_nav_menu() in one location.
            global $global_config;
            $menus = $global_config['nav_menu'];
            if (is_array($menus) and !empty($menus)) {
                register_nav_menus($menus);
            }


            add_theme_support("title-tag");
            add_theme_support('automatic-feed-links');
            add_theme_support('post-thumbnails');
            add_theme_support('html5', array(
                'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
            ));
            add_theme_support('post-formats', array(
                'image', 'video', 'gallery', 'audio', 'quote'
            ));
            add_theme_support('custom-header');
            add_theme_support('custom-background');
            add_theme_support('woocommerce');
            add_theme_support('wc-product-gallery-slider');
            add_theme_support('woocommerce', array(
                'gallery_thumbnail_image_width' => 150,
            ));
            /*gutenberg optimized add theme support */
            add_theme_support('wp-block-styles');
        }

        /**
         * Add default sidebar to website
         *
         *
         * */
        static function _add_sidebars()
        {
            // From config file
            global $global_config;
            $sidebars = $global_config['sidebars'];
            if (is_array($sidebars) and !empty($sidebars)) {
                foreach ($sidebars as $value) {
                    register_sidebar($value);
                }
            }
            /* Get Sidebar Declare in theme option */
            $add_sidebars_opt = tech888f_get_opt('tech888f_add_sidebar');

            $add_sidebars = array();

            if ($add_sidebars_opt == '') {
                $add_sidebars = array();
            }
            else {
                $i = 0;
                foreach ($add_sidebars_opt as $add_sidebar_opt) {
                    if ($add_sidebar_opt != ''){
                        array_push($add_sidebars,
                            array(
                                'title' => esc_html($add_sidebar_opt),
                                'widget_title_heading' => 'h3',
                            )
                        );
                        $i++;
                    }
                }
            }
            /* Get Sidebar Declare in theme option */

            if (is_array($add_sidebars) and !empty($add_sidebars)) {
                foreach ($add_sidebars as $sidebar) {
                    if (!empty($sidebar['title'])) {
                        $id = strtolower(str_replace(' ', '-', $sidebar['title']));
                        $custom_add_sidebar = array(
                            'name' => $sidebar['title'],
                            'id' => $id,
                            'description' => esc_html__('SideBar created by add sidebar in theme options.', 'ripara'),
                            'before_title' => '<' . $sidebar['widget_title_heading'] . ' class="widget-title">',
                            'after_title' => '</' . $sidebar['widget_title_heading'] . '>',
                            'before_widget' => '<div id="%1$s" class="sidebar-widget widget %2$s">',
                            'after_widget' => '</div>',
                        );
                        register_sidebar($custom_add_sidebar);
                        unset($custom_add_sidebar);
                    }
                }
            }

        }

        static function tech888f_setup_options()
        {
            update_option('tech888f_woo_widgets', 'false');
        }

        /**
         * Set up author data
         *
         * */
        static function _setup_author()
        {
            global $wp_query;

            if ($wp_query->is_author() && isset($wp_query->post)) {
                $GLOBALS['authordata'] = get_userdata($wp_query->post->post_author);
            }
        }


        /**
         * Hook to wp_title
         *
         * */
        static function _wp_title($title, $sep)
        {
            return $title;
        }


        static function _add_admin_scripts()
        {
            global $global_config;
            $css_url = get_template_directory_uri() . '/resources/css/';
            $js_url = get_template_directory_uri() . '/resources/js/';
            $admin_url = get_template_directory_uri() . '/resources/admin/';
            wp_enqueue_media();
            add_editor_style();
            wp_enqueue_script('tech888f-admin-js', $admin_url . 'js/admin.js', array('jquery'), null, true);
            wp_enqueue_style('font-awesome', $css_url . 'libs/font-awesome.min.css');
            wp_enqueue_style('tech888f-custom-admin', $admin_url . 'css/admin-style.css');
        }

        static function _woocommerce_product_query($query)
        {
            if ($query->get('post_type') == 'product') {
                $query->set('post__not_in', '');
            }
        }

        /*gutenberg optimized hook function */
        static function tech888f_add_gutenberg_assets()
        {
            wp_enqueue_style('tech888f-gutenberg', get_theme_file_uri('/resources/css/gutenberg-editor-style.css'), false);
            //wp_enqueue_style('tech888f-google-fonts',tech888f_get_google_link() );
        }

        static function tech888f_filter_content($content)
        {
            $content = str_replace('width="640"', 'width="740"', $content);
            $content = str_replace('height="360"', 'height="416"', $content);
            return $content;
        }

        static function tech888f_body_classes($classes)
        {
            $page_style = tech888f_get_value_by_id('tech888f_page_style');
            $menu_fixed = tech888f_get_value_by_id('tech888f_menu_fixed');
            $shop_ajax = tech888f_get_opt('shop_ajax');
            $show_preload = tech888f_get_opt('show_preload');
            $theme_info = wp_get_theme();
            if (!empty($page_style)) $classes[] = $page_style;
            if (is_rtl()) $classes[] = 'rtl-enable';
            if ($show_preload == 'on') $classes[] = 'preload';
            if ($shop_ajax == 'on' && tech888f_is_woocommerce_page()) $classes[] = 'shop-ajax-enable';
            if (!empty($theme_info['Template'])) $theme_info = wp_get_theme($theme_info['Template']);
            $classes[] = 'theme-ver-' . $theme_info['Version'];
            global $post;
            if (isset($post->post_content)) {
                if (strpos($post->post_content, '[tech888f_shop')) {
                    $classes[] = 'woocommerce';
                    if (strpos($post->post_content, 'shop_ajax="on"')) $classes[] = 'shop-ajax-enable';
                }
            }
            return $classes;
        }

        // theme function
        static function tech888f_display_breadcrumb()
        {
            echo tech888f_get_template('breadcrumb');
        }

        static function tech888f_product_cat_metabox_add($tag)
        {
            ?>
            <div class="form-field">
                <label><?php esc_html_e('Append Content Before', 'ripara'); ?></label>
                <div class="wrap-metabox">
                    <select name="before_append" id="before_append">
                        <?php
                        $mega_pages = tech888f_list_post_type('tech888f_mega_item', false);
                        foreach ($mega_pages as $key => $value) {
                            echo '<option value="' . esc_attr($key) . '">' . esc_html($value) . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-field">
                <label><?php esc_html_e('Append Content After', 'ripara'); ?></label>
                <div class="wrap-metabox">
                    <select name="after_append" id="after_append">
                        <?php
                        foreach ($mega_pages as $key => $value) {
                            echo '<option value="' . esc_attr($key) . '">' . esc_html($value) . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>
        <?php }

        static function tech888f_product_cat_metabox_edit($tag)
        { ?>
            <tr class="form-field">
                <th scope="row" valign="top">
                    <label><?php esc_html_e('Append Content Before', 'ripara'); ?></label>
                </th>
                <td>
                    <div class="wrap-metabox">
                        <select name="before_append" id="before_append">
                            <?php
                            $page = get_term_meta($tag->term_id, 'before_append', true);
                            $mega_pages = tech888f_list_post_type('tech888f_mega_item', false);
                            foreach ($mega_pages as $key => $value) {
                                $selected = selected($key, $page, false);
                                echo '<option ' . $selected . ' value="' . esc_attr($key) . '">' . esc_html($value) . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </td>
            </tr>
            <tr class="form-field">
                <th scope="row" valign="top">
                    <label><?php esc_html_e('Append Content After', 'ripara'); ?></label>
                </th>
                <td>
                    <div class="wrap-metabox">
                        <select name="after_append" id="after_append">
                            <?php
                            $page = get_term_meta($tag->term_id, 'after_append', true);
                            foreach ($mega_pages as $key => $value) {
                                $selected = selected($key, $page, false);
                                echo '<option ' . $selected . ' value="' . esc_attr($key) . '">' . esc_html($value) . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </td>
            </tr>
        <?php }

        static function tech888f_product_save_category_metadata($term_id)
        {
            if (isset($_POST['before_append'])) update_term_meta($term_id, 'before_append', $_POST['before_append']);
            if (isset($_POST['after_append'])) update_term_meta($term_id, 'after_append', $_POST['after_append']);
        }

        static function tech888f_append_content_before()
        {
            global $tech888f_option;
            $post_id = $tech888f_option['tech888f_before_append'];
            if (tech888f_is_woocommerce_page()) {
                $page_id = tech888f_get_opt('before_append_woo');
                if (is_single()) $page_id = tech888f_get_opt('before_append_woo_single');
            } elseif (is_home() || is_archive() || is_search() || is_singular('post')) $page_id = $post_id;
            else $page_id = $tech888f_option['tech888f_before_append'];
            $id = tech888f_get_curr_id();
            $meta_id = get_post_meta($id, 'before_append', true);
            if (!empty($meta_id)) $page_id = $meta_id;
            if (function_exists('is_shop')) $is_shop = is_shop();
            else $is_shop = false;
            if (is_archive() && !$is_shop) {
                global $wp_query;
                $term = $wp_query->get_queried_object();
                if (isset($term->term_id)) $cat_id = get_term_meta($term->term_id, 'before_append', true);
                else $cat_id = '';
                if (!empty($cat_id)) $page_id = $cat_id;
            }
            if (!empty($page_id)) echo '<div class="content-append-before"><div class="container">' . tech888f_Template::get_vc_pagecontent($page_id) . '</div></div>';
        }

        static function tech888f_append_content_after()
        {
            global $tech888f_option;
            $post_id = $tech888f_option['tech888f_after_append'];
            if (tech888f_is_woocommerce_page()) {
                $page_id = tech888f_get_opt('after_append_woo');
                if (is_single()) $page_id = tech888f_get_opt('after_append_woo_single');
            } elseif (is_home() || is_archive() || is_search() || is_singular('post')) $page_id = $post_id;
            else $page_id = $tech888f_option['tech888f_before_append'];
            $id = tech888f_get_curr_id();
            $meta_id = get_post_meta($id, 'after_append', true);
            if (!empty($meta_id)) $page_id = $meta_id;
            if (function_exists('is_shop')) $is_shop = is_shop();
            else $is_shop = false;
            if (is_archive() && !$is_shop) {
                global $wp_query;
                $term = $wp_query->get_queried_object();
                if (isset($term->term_id)) $cat_id = get_term_meta($term->term_id, 'after_append', true);
                else $cat_id = '';
                if (!empty($cat_id)) $page_id = $cat_id;
            }
            if (!empty($page_id)) echo '<div class="content-append-after"><div class="container">' . tech888f_Template::get_vc_pagecontent($page_id) . '</div></div>';
        }

        static function tech888f_custom_posts_per_page($query)
        {
            if ($query->is_main_query() && !is_admin() && $query->get('post_type') != 'product') {
                $number = get_option('posts_per_page');
                if (isset($_GET['number'])) $number = $_GET['number'];
                $query->set('posts_per_page', $number);
            }
        }
    }

    Tech888f_Controller::_init();
}

if (!function_exists('Tech888f_default_widget_demo')) {
    function tech888f_default_widget_demo()
    {
        $tech888f_woo_widgets = get_option('tech888f_woo_widgets');
        $active_widgets = get_option('sidebars_widgets');
        if ($tech888f_woo_widgets != 'true' && isset($active_widgets['woocommerce-sidebar']) && empty($active_widgets['woocommerce-sidebar'])) {
            update_option('tech888f_woo_widgets', 'true');
            $widgets = array(
                'woocommerce_product_categories' => array(
                    'title' => esc_html__('Product categories', 'ripara'),
                    'orderby' => 'name',
                    'dropdown' => 0,
                    'count' => 0,
                    'hierarchical' => 1,
                    'show_children_only' => 0,
                    'hide_empty' => 0,
                    'max_depth' => ''
                ),
                'woocommerce_price_filter' => array(
                    'title' => esc_html__('Filter by price', 'ripara'),
                ),
                'woocommerce_products' => array(
                    'title' => esc_html__('Products', 'ripara'),
                    'number' => 5,
                    'show' => '',
                    'orderby' => 'date',
                    'order' => 'desc',
                    'hide_free' => 0,
                    'show_hidden' => 0,
                ),
                'woocommerce_product_search' => array(
                    'title' => ''
                ),
            );
            $woo_active_widgets = array();
            foreach ($widgets as $widget_id => $widget) {
                $w_data = get_option('widget_' . $widget_id);
                $w_data[1] = $widget;
                update_option('widget_' . $widget_id, $w_data);
                $woo_active_widgets[] = $widget_id . '-1';
            }
            $active_widgets['woocommerce-sidebar'] = $woo_active_widgets;
            update_option('sidebars_widgets', $active_widgets);
        }
    }
}
Tech888f_default_widget_demo();