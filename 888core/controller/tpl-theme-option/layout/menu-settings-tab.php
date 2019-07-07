<?php
/**
 * Created by PhpStorm.
 * User: toanngo92
 * Date: 2/17/2019
 * Time: 4:36 PM
 */
$sub_section = array(
    'title'      => esc_html__( 'Menu Settings', 'mmolee' ),
    'desc'       => esc_html__( 'Tech888 Menu Settings', 'mmolee' ),
    'id'         => 'opt_menu_settings',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'tech888f_menu_typography',
            'type'     => 'typography',
            'title'    => __( 'Menu Typography', 'redux-framework-demo' ),
            'desc' => __( 'Customize your Menu Typography.', 'redux-framework-demo' )
        ),
        array(
            'id'       => 'tech888f_menu_hover_color',
            'type'     => 'color',
            'title'    => __( 'Menu hover color', 'redux-framework-demo' ),
            'desc' => __( 'Customize your menu text color when hover.', 'redux-framework-demo' ),
        ),
        array(
            'id'       => 'tech888f_menu_backgroud_hover_color',
            'type'     => 'color',
            'title'    => __( 'Menu item background hover color', 'redux-framework-demo' ),
            'desc' => __( 'Customize your Menu background color when hover.', 'redux-framework-demo' ),
        ),
        array(
            'id'       => 'tech888f_sub_menu_typography',
            'type'     => 'typography',
            'title'    => __( 'Sub Menu Typography', 'redux-framework-demo' ),
            'desc' => __( 'Customize your Sub Menu Typography.', 'redux-framework-demo' )
        ),
        array(
            'id'       => 'tech888f_sub_menu_hover_color',
            'type'     => 'color',
            'title'    => __( 'Sub Menu hover color', 'redux-framework-demo' ),
            'desc' => __( 'Customize your sub menu text color when hover.', 'redux-framework-demo' ),
        ),
        array(
            'id'       => 'tech888f_sub_menu_backgroud_hover_color',
            'type'     => 'color',
            'title'    => __( 'Sub Menu Item Background Hover Color', 'redux-framework-demo' ),
            'desc' => __( 'Customize your sub menu background color when hover.', 'redux-framework-demo' ),
        ),
    ),
);

return $sub_section;