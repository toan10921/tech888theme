<?php
/**
 * Created by PhpStorm.
 * User: toanngo92
 * Date: 2/22/2019
 * Time: 8:57 PM
 */

$sub_section = array(
    'title'      => esc_html__( 'Shop Grid Settings', 'mmolee' ),
    'desc'       => esc_html__( 'Tech888 Shop Grid Settings', 'mmolee' ),
    'id'         => 'opt_shop_grid_settings',
    'subsection' => true,
    'fields'     => array(
        array(
            'id' => 'tech888f_shop_grid_column',
            'type' => 'select',
            'title' => esc_html__('Grid Columns', 'redux-framework-demo'),
            'subtitle' => esc_html__('Choose your grid number of columns', 'redux-framework-demo'),
            'options' => array(
                '1' => esc_html__('1 columns', '7upframework'),
                '2' => esc_html__('2 columns', '7upframework'),
                '3' => esc_html__('3 columns', '7upframework'),
                '4' => esc_html__('4 columns', '7upframework'),
                '5' => esc_html__('5 columns', '7upframework'),
            ),
            'default' => '3',
            'select2' => array('allowClear' => false)
        ),
        array(
            'id' => 'tech888f_shop_grid_size',
            'type' => 'text',
            'title' => esc_html__('Grid thumbnail size', 'redux-framework-demo'),
            'subtitle' => esc_html__('Enter your Grid Thumbnail size', 'redux-framework-demo'),
            'desc' => esc_html__('This size use to crop your image before display to frontend.Structure: [width]x[height] (Example: 400x400)', 'redux-framework-demo'),
            'default' => '400x400'
        ),
        array(
            'id' => 'tech888f_shop_grid_item_specific',
            'type' => 'select',
            'title' => esc_html__('Sepicfy Shop Grid Item', 'redux-framework-demo'),
            'subtitle' => esc_html__('Choose your specific display of grid item', 'redux-framework-demo'),
            'options' => tech888f_get_product_grid_specific(),
            'default' => 'default',
            'select2' => array('allowClear' => false)
        ),
        array(
            'id' => 'tech888f_shop_grid_item_layout',
            'type' => 'select',
            'title' => esc_html__('Choose Shop Grid layout', 'redux-framework-demo'),
            'subtitle' => esc_html__('Default or mansory layout', 'redux-framework-demo'),
            'options' => array(
                'default' => esc_html__('Default layout', '7upframework'),
                'mansory' => esc_html__('Mansory layout', '7upframework')
            ),
            'default' => 'default',
            'select2' => array('allowClear' => false)
        )
    ),
);

return $sub_section;