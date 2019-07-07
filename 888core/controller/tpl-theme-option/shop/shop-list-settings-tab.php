<?php
/**
 * Created by PhpStorm.
 * User: toanngo92
 * Date: 2/22/2019
 * Time: 8:57 PM
 */

$sub_section = array(
    'title'      => esc_html__( 'Shop List Settings', 'mmolee' ),
    'desc'       => esc_html__( 'Tech888 Shop List Settings', 'mmolee' ),
    'id'         => 'opt_shop_list_settings',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'tech888f_shop_list_size',
            'type'     => 'text',
            'title'    => esc_html__('Shop List Thumbnail Size', 'redux-framework-demo'),
            'subtitle' => esc_html__('Enter your shop list thumbnail size','redux-framework-demo'),
            'desc'     => esc_html__('This size use to crop your image before display to frontend.Structure: [width]x[height] (Example: 840x504)', 'redux-framework-demo'),
            'default'  => '840x504'
        ),
        array(
            'id' => 'tech888f_shop_list_excerpt',
            'type' => 'text',
            'title' => esc_html__('Product List Excerpt Length', 'redux-framework-demo'),
            'subtitle' => esc_html__('Number of characters you want to get from excerpt content', 'redux-framework-demo'),
            'desc' => esc_html__('Only accept number value. Example: 100', 'redux-framework-demo'),
            'validate' => 'numeric',
            'msg'     => 'Numeric value required',
            'default' => '100'
        ),
        array(
            'id' => 'tech888f_shop_list_item_specific',
            'type' => 'select',
            'title' => esc_html__('Sepicfy Shop List Item', 'redux-framework-demo'),
            'subtitle' => esc_html__('Choose your specific display of list item', 'redux-framework-demo'),
            'options' => tech888f_get_product_list_specific(),
            'select2' => array('allowClear' => false)
        ),
    ),
);

return $sub_section;