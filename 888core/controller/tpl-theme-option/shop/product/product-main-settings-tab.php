<?php
/**
 * Created by PhpStorm.
 * User: toanngo92
 * Date: 2/22/2019
 * Time: 9:07 PM
 */
global $tech888f_res;
$sub_section = array(
    'title'      => esc_html__( 'Product Main Settings', 'mmolee' ),
    'desc'       => esc_html__( 'Tech888 Product Detail Main Settings', 'mmolee' ),
    'id'         => 'opt_product_main_settings',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'tech888f_before_product_append',
            'type'     => 'select',
            'title'    => esc_html__('Content Before Product Page', 'redux-framework-demo'),
            'subtitle' => esc_html__('Choose your before extra content', 'redux-framework-demo'),
            'desc'     => esc_html__('Choose an extra content append to before product detail page.', 'redux-framework-demo'),
            'data'     => 'posts',
            'args' => array(
                'post_type' => 'tech888f_extra',
            ),
        ),
        array(
            'id'       => 'tech888f_after_product_append',
            'type'     => 'select',
            'title'    => esc_html__('Content After Product template', 'redux-framework-demo'),
            'subtitle' => esc_html__('Choose your after extra content', 'redux-framework-demo'),
            'desc'     => esc_html__('Choose an extra content append to after product detail page.', 'redux-framework-demo'),
            'data'     => 'posts',
            'args' => array(
                'post_type' => 'tech888f_extra',
            ),
        ),
        array(
            'id'       => 'tech888f_before_product_des_tab_append',
            'type'     => 'select',
            'title'    => esc_html__('Content Before Product Description Tab', 'redux-framework-demo'),
            'subtitle' => esc_html__('Choose your before extra content', 'redux-framework-demo'),
            'desc'     => esc_html__('Choose an extra content append to before product description tab.', 'redux-framework-demo'),
            'data'     => 'posts',
            'args' => array(
                'post_type' => 'tech888f_extra',
            ),
        ),
        array(
            'id'       => 'tech888f_after_product_append',
            'type'     => 'select',
            'title'    => esc_html__('Content After Product Description Tab', 'redux-framework-demo'),
            'subtitle' => esc_html__('Choose your after extra content', 'redux-framework-demo'),
            'desc'     => esc_html__('Choose an extra content append to before product description tab.', 'redux-framework-demo'),
            'data'     => 'posts',
            'args' => array(
                'post_type' => 'tech888f_extra',
            ),
        ),
        array(
            'id' => 'tech888f_product_sidebar_pos',
            'type' => 'image_select',
            'title' => esc_html__('Sidebar Product Position', 'redux-framework-demo'),
            'subtitle' => esc_html__('Choose your sidebar position of product detail page', 'redux-framework-demo'),
            'desc' => esc_html__('Setup sidebar position for your Product Detail Page. Left, Right, or No sidebar.', 'redux-framework-demo'),
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
            'id' => 'tech888f_product_sidebar_id',
            'type' => 'select',
            'title' => esc_html__('Choose Product Sidebar', 'redux-framework-demo'),
            'subtitle' => esc_html__('Choose your specific product sidebar', 'redux-framework-demo'),
            'data' => 'sidebar',
            'required' => array('tech888f_product_sidebar_pos', '=', array('left', 'right'))
        ),
        array(
            'id' => 'tech888f_product_top_image_zoom_effect',
            'type' => 'select',
            'title' => esc_html__('Product Detail Top Image Zoom Style', 'redux-framework-demo'),
            'subtitle' => esc_html__('Choose your product detail top image zoom style in product page.', 'redux-framework-demo'),
            'options' => array(
                '1' => esc_html__('No Zoom', '7upframework'),
                '2' => esc_html__('Style 1', '7upframework'),
                '3' => esc_html__('Style 2', '7upframework'),
            ),
            'default' => '1',
            'select2' => array('allowClear' => false)
        ),
        array(
            'id' => 'tech888f_product_tab_specs',
            'type' => 'select',
            'title' => esc_html__('Sepicfy Product Detail Description Tab Item', 'redux-framework-demo'),
            'subtitle' => esc_html__('Choose your specific display of product detail description tab item.', 'redux-framework-demo'),
            'options' => array(
                '1' => esc_html__('default', '7upframework'),
                '3' => esc_html__('Style 2', '7upframework'),
            ),
            'default' => '1',
            'select2' => array('allowClear' => false)
        ),
        array(
            'id' => 'tech888f_product_excerpt',
            'type'     => 'switch',
            'title'    => __( 'Product Detail Excerpt Status', 'redux-framework-demo' ),
            'desc' => __( 'Show/Hide Product Detail Excerpt. Default is on.', 'redux-framework-demo' ),
            'default'  => true,
        ),
    ),
);

return $sub_section;