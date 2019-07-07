<?php
/**
 * Created by PhpStorm.
 * User: toanngo92
 * Date: 2/23/2019
 * Time: 1:36 AM
 */

$sub_section = array(
    'title'      => esc_html__( 'Preload', 'mmolee' ),
    'desc'       => esc_html__( 'Tech888 Preload Settings', 'mmolee' ),
    'id'         => 'opt-main-other-settings',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'tech888f_preload_stats',
            'type'     => 'switch',
            'title'    => __( 'Preload Status', 'redux-framework-demo' ),
            'desc' => __( 'Show/Hide Preload. Default is on.', 'redux-framework-demo' ),
            'default'  => true,
        ),
        array(
            'id'       => 'tech888f_preload_background',
            'type'     => 'background',
            'title'    => __( 'Preload Background', 'redux-framework-demo' ),
            'desc' => __( 'Customize your Preload Background.', 'redux-framework-demo' ),
            'required' => array('tech888f_preload_stats', '=', true)
        ),
        array(
            'id' => 'tech888f_preload_style',
            'type' => 'select',
            'title' => esc_html__('Preload Style', 'redux-framework-demo'),
            'subtitle' => esc_html__('Choose your preload style', 'redux-framework-demo'),
            'options' => array(
                'default' => esc_html__('Default', '7upframework'),
                'style2' => esc_html__('Style 2', '7upframework'),
            ),
            'default' => 'default',
            'select2' => array('allowClear' => false)
        ),
    )
);