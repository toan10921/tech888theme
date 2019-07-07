<?php
/**
 * Created by PhpStorm.
 * User: toanngo92
 * Date: 2/7/2019
 * Time: 4:51 PM
 */

if (!class_exists('tech888f_theme_options')) {
    class tech888f_theme_options
    {
        public $args = array();
        public $sections = array();
        public $theme;
        public $Redux;

        /* Load Redux Framework */
        public function __construct()
        {
            if (!class_exists('ReduxFramework')) {
                return;
            }
            if (true == Redux_Helpers::isTheme(__FILE__)) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);
            }
        }
        // Tiếp tục thêm 4 function kế tiếp vào đây

        /**
         * Thiết lập các method muốn sử dụng
         * Method nào được khai báo trong này thì cũng phải được sử dụng
         **/
        public function initSettings()
        {
            // Set the default arguments
            $this->setArguments();
            // Set a few help tabs so you can see how it's done
            $this->setHelpTabs();
            // Create the sections and fields
            $this->setSections();
            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }
            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        /**
         * Thiết lập cho method setAgruments
         * Method này sẽ chứa các thiết lập cơ bản cho trang Options Framework như tên menu chẳng hạn
         **/

        public function setArguments()
        {
            $theme = wp_get_theme(); // Lưu các đối tượng trả về bởi hàm wp_get_theme() vào biến $theme để làm một số việc tùy thích.
            $opt_name = "tech888f_option";
            $this->args = array(
                'opt_name' => $opt_name,
                'display_name' => $theme->get('Name'), // Thiết lập tên theme hiển thị trong Theme Options
                'menu_type' => 'menu',
                'allow_sub_menu' => true,
                'menu_title' => $theme->get('Name') . ' ' . esc_html__('Options', 'mmolee'),
                'page_title' => $theme->get('Name') . ' ' . esc_html__('Options', 'mmolee'),
                'dev_mode' => false,
                'customizer' => true,
                'menu_icon' => '', // Đường dẫn icon của menu option
                /* Chức năng Hint tạo dấu chấm hỏi ở mỗi option để hướng dẫn người dùng */
                'hints' => array(
                    'icon' => 'icon-question-sign',
                    'icon_position' => 'right',
                    'icon_color' => 'lightgray',
                    'icon_size' => 'normal',
                    'tip_style' => array(
                        'color' => 'light',
                        'shadow' => true,
                        'rounded' => false,
                        'style' => '',
                    ),
                    'tip_position' => array(
                        'my' => 'top left',
                        'at' => 'bottom right',
                    ),
                    'tip_effect' => array(
                        'show' => array(
                            'effect' => 'slide',
                            'duration' => '500',
                            'event' => 'mouseover',
                        ),
                        'hide' => array(
                            'effect' => 'slide',
                            'duration' => '500',
                            'event' => 'click mouseleave',
                        ),
                    ),
                )
                // end Hints
            );
        }

        /**
         * Thiết lập khu vực Help để hướng dẫn người dùng
         **/
        public function setHelpTabs()
        {

            // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
            $this->args['help_tabs'][] = array(
                'id' => 'redux-help-tab-1',
                'title' => esc_html__('Theme Information 1', 'mmolee'),
                'content' => esc_html__('<p>This is the tab content, HTML is allowed.</p>', 'mmolee')
            );

            $this->args['help_tabs'][] = array(
                'id' => 'redux-help-tab-2',
                'title' => esc_html__('Theme Information 2', 'mmolee'),
                'content' => esc_html__('<p>This is the tab content, HTML is allowed.</p>', 'mmolee')
            );

            // Set the help sidebar
            $this->args['help_sidebar'] = esc_html__('<p>This is the sidebar content, HTML is allowed.</p>', 'mmolee');
        }

        /**
         * Setup Theme options
         * prefix: "opt-theme-"
         **/

        public function setSections()
        {
            /* Define Main setting tabs */
            $this->sections[] = array(
                'title' => esc_html__('Main', 'mmolee'),
                'id' => 'opt-theme-main-settings-tab',
                'desc' => esc_html__('Tech888Theme Main settings.', 'mmolee'),
                'icon' => 'el el-home'
            );
            $id_sec = 'main';
            $args = array(
                0 => 'general-settings-tab',
                1 => 'navigation-header-settings-tab',
                2 => 'preload-settings-tab',
                3 => 'other-settings-tab',
            );

            foreach ($args as $arg) {
                $this->sections[] = tech888f_get_theme_option_sub_section($arg,$id_sec);
            }
            /* End define Main setting tabs */

            /* Define Blog/Post Detail setting tabs */

            $this->sections[] = array(
                'title' => esc_html__('Blog/Post Detail', 'mmolee'),
                'id' => 'opt-theme-blog-detail-settings-tab',
                'desc' => esc_html__('Tech888Theme Navigation Header settings.', 'mmolee'),
                'icon' => 'el el-home'
            );
            $id_sec = 'blog';
            $args = array(
                0 => 'blog-main-settings-tab',
                1 => 'blog-list-settings-tab',
                2 => 'blog-grid-settings-tab',
                3 => 'blog-detail-settings-tab',
            );

            foreach ($args as $arg) {
                $this->sections[] = tech888f_get_theme_option_sub_section($arg,$id_sec);
            }

            /* End Define Blog/Post Detail setting tabs*/

            /* Define Layout setting tabs */


            $this->sections[] = array(
                'title' => esc_html__('Layout Settings', 'mmolee'),
                'id' => 'opt-theme-layout-settings-tab',
                'desc' => esc_html__('Tech888Theme Layout settings.', 'mmolee'),
                'icon' => 'el el-home',
            );

            $id_sec = 'layout';
            $args = array(
                0 => 'layout-settings-tab',
                1 => 'menu-settings-tab',
                3 => 'color-settings-tab',
            );

            foreach ($args as $arg) {
                $this->sections[] = tech888f_get_theme_option_sub_section($arg,$id_sec);
            }

            /* End define Layout setting tabs */

            if(class_exists('WooCommerce')){
                /* Define Shop setting tabs */

                $this->sections[] = array(
                    'title' => esc_html__('Shop Settings', 'mmolee'),
                    'id' => 'opt-theme-shop-settings-tab',
                    'desc' => esc_html__('Tech888Theme Shop settings.', 'mmolee'),
                    'icon' => 'el el-home',
                );

                $id_sec = 'shop';
                $args = array(
                    0 => 'shop-main-settings-tab',
                    1 => 'shop-grid-settings-tab',
                    2 => 'shop-list-settings-tab',
                    3 => 'shop-other-settings-tab',
                );
                foreach ($args as $arg) {
                    $this->sections[] = tech888f_get_theme_option_sub_section($arg,$id_sec);
                }

                /* End Define Shop setting tabs */

                /* Define Product Detail setting tabs */

                $this->sections[] = array(
                    'title' => esc_html__('Product Settings', 'mmolee'),
                    'id' => 'opt-theme-product-settings-tab',
                    'desc' => esc_html__('Tech888Theme Product settings.', 'mmolee'),
                    'icon' => 'el el-home',
                );

                $id_sec = 'shop/product';
                $args = array(
                    0 => 'product-main-settings-tab',
                    1 => 'product-advanced-settings-tab',
                );
                foreach ($args as $arg) {
                    $this->sections[] = tech888f_get_theme_option_sub_section($arg,$id_sec);
                }

                /* End Define Product Detail setting tabs */

            }
        }


    }


    global $reduxConfig;
    $reduxConfig = new tech888f_theme_options();
}

