<?php
/**
 * Created by PhpStorm.
 * User: toanngo92
 * Date: 2/23/2019
 * Time: 1:55 AM
 */
$sub_section = array(
    'title'      => esc_html__( 'Color Settings', 'mmolee' ),
    'desc'       => esc_html__( 'Tech888 Color Settings', 'mmolee' ),
    'id'         => 'opt-main-other-settings',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'tech888f_body_background_color',
            'type'     => 'color',
            'title'    => __( 'Body background color', 'redux-framework-demo' ),
            'desc' => __( 'Change your body background color.', 'redux-framework-demo' ),
        ),
        array(
            'id'       => 'tech888f_mmain_color',
            'type'     => 'color',
            'title'    => __( 'Main color', 'redux-framework-demo' ),
            'desc' => __( 'Change your main color.This color is the most popular color using in your website.', 'redux-framework-demo' ),
        ),
        array(
            'id'       => 'tech888f_color_second',
            'type'     => 'color',
            'title'    => __( 'Main color #2', 'redux-framework-demo' ),
            'desc' => __( 'Change your main color.This color is the second most popular color using in your website.', 'redux-framework-demo' ),
        ),
    )
);

return $sub_section;