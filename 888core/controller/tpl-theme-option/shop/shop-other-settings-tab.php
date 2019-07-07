<?php
/**
 * Created by PhpStorm.
 * User: toanngo92
 * Date: 2/22/2019
 * Time: 8:58 PM
 */
$sub_section = array(
    'title'      => esc_html__( 'Shop Other Settings', 'mmolee' ),
    'desc'       => esc_html__( 'Tech888 Shop Other Settings', 'mmolee' ),
    'id'         => 'opt_shop_other_settings',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'tech888f_header_page_wc',
            'type'     => 'select',
            'title'    => esc_html__('Choose Woocommerce Header', 'redux-framework-demo'),
            'subtitle' => esc_html__('Choose a header page according dropdown', 'redux-framework-demo'),
            'desc'     => esc_html__('Go to menu name "Tech888 Header" in admin menu to edit/create your own header. This header appear in all pages of your site, If you have any page/single page need display another content, you can set specific header for it.', 'redux-framework-demo'),
            'data'     => 'posts',
            'args' => array(
                'post_type' => 'tech888f_header',
            ),
        ),
        array(
            'id' => 'tech888f_product_spacing',
            'type' => 'spacing',
            'title' => esc_html__('Products Spacing', 'redux-framework-demo'),
            'subtitle' => esc_html__('Choose your product spacing', 'redux-framework-demo'),
        ),
        array(
            'id' => 'tech888f_product_per_page_number',
            'type' => 'text',
            'title' => esc_html__('Product Per Page Number', 'redux-framework-demo'),
            'subtitle' => esc_html__('Enter number of product per page.', 'redux-framework-demo'),
            'validate' => 'numeric',
            'default'  => 12,
        ),
        array(
            'id' => 'tech888f_product_new_day',
            'type' => 'text',
            'title' => esc_html__('Product new in(days)', 'redux-framework-demo'),
            'subtitle' => esc_html__('Enter number to set time for product is new.Number Required', 'redux-framework-demo'),
            'validate' => 'numeric',
            'default'  => 30,
        ),

    ),
);

return $sub_section;