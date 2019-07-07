<?php
/**
 * Created by PhpStorm.
 * User: toanngo92
 * Date: 2/22/2019
 * Time: 9:07 PM
 */

$sub_section = array(
    'title'      => esc_html__( 'Product Advanced Settings', 'mmolee' ),
    'desc'       => esc_html__( 'Tech888 Product Advanced Settings', 'mmolee' ),
    'id'         => 'opt_product_advanced_settings',
    'subsection' => true,
    'fields'     => array(
        array(
            'id' => 'tech888f_product_related_prd_stats',
            'type'     => 'switch',
            'title'    => __( 'Product Detail Related Product Section Status', 'redux-framework-demo' ),
            'desc' => __( 'Show/Hide Product Detail related product section. Default is on.', 'redux-framework-demo' ),
            'default'  => true,
        ),
        array(
            'id' => 'tech888f_product_latest_prd_stats',
            'type'     => 'switch',
            'title'    => __( 'Product Detail latest product section Status', 'redux-framework-demo' ),
            'desc' => __( 'Show/Hide Product Detail latest product. Default is off.', 'redux-framework-demo' ),
            'default'  => false,
        ),
        array(
            'id' => 'tech888f_product_upsell_prd_stats',
            'type'     => 'switch',
            'title'    => __( 'Product Detail Upsell Product Section Status', 'redux-framework-demo' ),
            'desc' => __( 'Show/Hide Product Detail upsell product section. Default is off.', 'redux-framework-demo' ),
            'default'  => false,
        ),
        array(
            'id' => 'tech888f_extra_sec_product_number',
            'type'     => 'text',
            'title'    => __( 'Product Extra Section Item Number', 'redux-framework-demo' ),
            'desc' => __( 'Product Detail Related/Upsell/Latest Products Number.Only accept number value. Default is 4.', 'redux-framework-demo' ),
            'validate' => 'numeric',
            'msg'     => 'Numeric value required',
            'default'  => 4,
        ),
        array(
            'id' => 'tech888f_product_extra_sec_image_size',
            'type'     => 'text',
            'title'    => __( 'Product Extra Section Item Image Size', 'redux-framework-demo' ),
            'default'  => '400x400',
        ),
        array(
            'id' => 'tech888f_product_extra_sec_responsive',
            'type'     => 'text',
            'title'    => __( 'Product Extra Section Responsive Format', 'redux-framework-demo' ),
            'desc'     => esc_html__('Enter item for screen width(px) format is width:value and separate values by ",".Example: 0:1,414:2,768:3,1000:4','tech888td'),
            'default'  => '0:1,414:2,768:3,1000:4',

        ),
        array(
            'id' => 'tech888f_product_extra_sec_item_specific',
            'type' => 'select',
            'title' => esc_html__('Specify Product Extra Section Item', 'redux-framework-demo'),
            'subtitle' => esc_html__('Choose your specific Product Extra Section item', 'redux-framework-demo'),
            'options' => tech888f_get_product_grid_specific(),
            'default' => 'default',
            'select2' => array('allowClear' => false)
        ),
    ),
);

return $sub_section;