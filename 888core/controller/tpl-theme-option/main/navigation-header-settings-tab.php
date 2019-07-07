<?php
/**
 * Created by PhpStorm.
 * User: toanngo92
 * Date: 2/9/2019
 * Time: 1:22 AM
 */

$sub_section = array(
    'title'      => esc_html__( 'Navigation Header', 'mmolee' ),
    'desc'       => esc_html__( 'Tech888 Navigation Header Settings', 'mmolee' ),
    'id'         => 'opt-main-navigation-header-settings',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'tech888f_navigation_header_stats',
            'type'     => 'switch',
            'title'    => __( 'Navigation Header Status', 'redux-framework-demo' ),
            'desc' => __( 'Show/Hide Navigation Header. Default is on.', 'redux-framework-demo' ),
            'default'  => true,
        ),
        array(
            'id'       => 'tech888f_navigation_header_background',
            'type'     => 'background',
            'title'    => __( 'Navigation Header Background', 'redux-framework-demo' ),
            'desc' => __( 'Customize your Navigation Header Background.', 'redux-framework-demo' ),
            'required' => array('tech888f_navigation_header_stats', '=', true)
        ),
        array(
            'id'       => 'tech888f_navigation_header_typography',
            'type'     => 'typography',
            'title'    => __( 'Navigation Header Typography', 'redux-framework-demo' ),
            'desc' => __( 'Customize your Navigation Header Typography.', 'redux-framework-demo' ),
            'required' => array('tech888f_navigation_header_stats', '=', true)
        ),
        array(
            'id'       => 'tech888f_navigation_header_hover_color',
            'type'     => 'color',
            'title'    => __( 'Navigation Header hover color', 'redux-framework-demo' ),
            'desc' => __( 'Customize your Navigation Header text color when hover.', 'redux-framework-demo' ),
            'required' => array('tech888f_navigation_header_stats', '=', true)
        ),
    )
);

return $sub_section;