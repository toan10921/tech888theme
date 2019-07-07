<?php
/**
 * Created by PhpStorm.
 * User: toanngo92
 * Date: 2/22/2019
 * Time: 8:57 PM
 */
global $tech888f_res;
$sub_section = array(
    'title'      => esc_html__( 'Main Settings', 'mmolee' ),
    'desc'       => esc_html__( 'Tech888 Shop Main Settings', 'mmolee' ),
    'id'         => 'opt_shop_main_settings',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'tech888f_header_shop_content',
            'type'     => 'select',
            'title'    => esc_html__('Choose Shop Header', 'redux-framework-demo'),
            'subtitle' => esc_html__('Choose a header page according dropdown', 'redux-framework-demo'),
            'desc'     => esc_html__('Go to menu name "Tech888 Header" in admin menu to edit/create your own header. This header appear in all pages of your site, If you have any page/single page need display another content, you can set specific header for it.', 'redux-framework-demo'),
            'data'     => 'posts',
            'args' => array(
                'post_type' => 'tech888f_header',
            ),
        ),
        array(
            'id'       => 'tech888f_footer_shop_content',
            'type'     => 'select',
            'title'    => esc_html__('Choose Shop Footer', 'redux-framework-demo'),
            'subtitle' => esc_html__('Choose a footer page according dropdown', 'redux-framework-demo'),
            'desc'     => esc_html__('Go to menu name "Tech888 Footer" in admin menu to edit/create your own header. This footer appear in all pages of your site, If you have any page/single page need display another content, you can set specific footer for it.', 'redux-framework-demo'),
            'data'     => 'posts',
            'args' => array(
                'post_type' => 'tech888f_footer',
            ),
        ),
        array(
            'id'       => 'tech888f_shop_before_append',
            'type'     => 'select',
            'title'    => esc_html__('Content Before Shop template', 'redux-framework-demo'),
            'subtitle' => esc_html__('Choose your before shop extra content', 'redux-framework-demo'),
            'desc'     => esc_html__('Choose an extra content append to before main content of page with template default.', 'redux-framework-demo'),
            'data'     => 'posts',
            'args' => array(
                'post_type' => 'tech888f_extra',
            ),
        ),
        array(
            'id'       => 'tech888f_shop_after_append',
            'type'     => 'select',
            'title'    => esc_html__('Content After Shop template', 'redux-framework-demo'),
            'subtitle' => esc_html__('Choose your after shop extra content', 'redux-framework-demo'),
            'desc'     => esc_html__('Choose an extra content append to before main content of page with template default.', 'redux-framework-demo'),
            'data'     => 'posts',
            'args' => array(
                'post_type' => 'tech888f_extra',
            ),
        ),
        array(
            'id' => 'tech888f_shop_sidebar_pos',
            'type' => 'image_select',
            'title' => esc_html__('Sidebar Blog Position', 'redux-framework-demo'),
            'subtitle' => esc_html__('Choose your sidebar shop position', 'redux-framework-demo'),
            'desc' => esc_html__('Setup sidebar position for your Shop Page. Left, Right, or No sidebar.', 'redux-framework-demo'),
            'options' => array(
                'right' => array(
                    'title' => esc_html__('Right Sidebar','tech888td'),
                    'alt' => esc_html__('Right Sidebar','tech888td'),
                    'img' => $tech888f_res . '/images/right-sidebar.jpg'
                ),
                'left' => array(
                    'title' => esc_html__('Left Sidebar','tech888td'),
                    'alt' => esc_html__('Left Sidebar','tech888td'),
                    'img' => $tech888f_res . '/images/left-sidebar.jpg'
                ),
                'no' => array(
                    'title' => esc_html__('No Sidebar','tech888td'),
                    'alt' => esc_html__('No Sidebar','tech888td'),
                    'img' => $tech888f_res . '/images/no-sidebar.jpg'
                ),
            ),
            'default' => 'right',
            'select2' => array('allowClear' => false)
        ),
        array(
            'id' => 'tech888f_shop_sidebar_id',
            'type' => 'select',
            'title' => esc_html__('Choose Shop Sidebar', 'redux-framework-demo'),
            'subtitle' => esc_html__('Choose your specific shop sidebar', 'redux-framework-demo'),
            'data' => 'sidebar',
            'required' => array('tech888f_shop_sidebar_pos', '=', array('left', 'right'))
        ),
        array(
            'id' => 'tech888f_shop_default_style',
            'type' => 'image_select',
            'title' => esc_html__('Default Shop Style', 'redux-framework-demo'),
            'subtitle' => esc_html__('Choose your shop listing style List or Grid', 'redux-framework-demo'),
            'options' => array(
                'list' => array(
                    'title' => esc_html__('List','tech888td'),
                    'alt' => esc_html__('List','tech888td'),
                    'img' => $tech888f_res . '/images/list-layout.jpg'
                ),
                'grid' => array(
                    'title' => esc_html__('Grid','tech888td'),
                    'alt' => esc_html__('Grid','tech888td'),
                    'img' => $tech888f_res . '/images/grid-layout.jpg'
                ),
            ),
            'default' => 'list',
        ),
        array(
            'id' => 'tech888f_shop_pagi_style',
            'type' => 'select',
            'title' => esc_html__('Shop Pagination Style', 'redux-framework-demo'),
            'subtitle' => esc_html__('Choose your shop pagination style', 'redux-framework-demo'),
            'options' => array(
                'default' => esc_html__('Default', '7upframework'),
                'load-more' => esc_html__('Load more', '7upframework'),
            ),
            'default' => 'default',
            'select2' => array('allowClear' => false)
        ),
        array(
            'id'       => 'tech888f_shop_ajax_stats',
            'type'     => 'switch',
            'title'    => __( 'Shop Ajax Status', 'redux-framework-demo' ),
            'desc' => __( 'Enable/Disable ajax feature of shop page. Default is off.', 'redux-framework-demo' ),
            'default'  => true,
        ),
        array(
            'id' => 'tech888f_shop_thumbnail_hover_effect',
            'type' => 'select',
            'title' => esc_html__('Shop Thumbnail Hover Effect', 'redux-framework-demo'),
            'subtitle' => esc_html__('Choose your product thumbnail hover effect in shop page.', 'redux-framework-demo'),
            'options' => array(
                '1' => esc_html__('No Effect', '7upframework'),
                '2' => esc_html__('Zoom Image', '7upframework'),
                '3' => esc_html__('Rolate Image', '7upframework'),
                '4' => esc_html__('Translate Image', '7upframework'),
                '5' => esc_html__('Zoom Out Effect', '7upframework'),
            ),
            'default' => '1',
            'select2' => array('allowClear' => false)
        ),
        array(
            'id'       => 'tech888f_shop_post_per_page_filter',
            'type'     => 'switch',
            'title'    => __( 'Product Per Page Filter', 'redux-framework-demo' ),
            'desc' => __( 'Show/Hide Product per page menu filter. Default is on.', 'redux-framework-demo' ),
            'default'  => true,
        ),
        array(
            'id'       => 'tech888f_shop_post_style_filter',
            'type'     => 'switch',
            'title'    => __( 'Product Style Filter', 'redux-framework-demo' ),
            'desc' => __( 'Show/Hide Product style menu filter. Default is on.', 'redux-framework-demo' ),
            'default'  => true,
        ),
    ),
);

return $sub_section;