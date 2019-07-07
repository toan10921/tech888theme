<?php
/**
 * Created by PhpStorm.
 * User: toanngo92
 * Date: 2/10/2019
 * Time: 3:40 PM
 */
$sub_section = array(
    'title' => esc_html__('Blog List Settings', 'mmolee'),
    'desc' => esc_html__('Tech888 Blog List Settings - Only affect when you choice List style in Default Blog Style', 'mmolee'),
    'id' => 'opt_blog_list_settings',
    'subsection' => true,
    'fields' => array(
        array(
            'id'       => 'tech888f_post_list_size',
            'type'     => 'text',
            'title'    => esc_html__('List thumbnail size', 'redux-framework-demo'),
            'subtitle' => esc_html__('Enter your List Thumbnail size','redux-framework-demo'),
            'desc'     => esc_html__('This size use to crop your image before display to frontend.Structure: [width]x[height] (Example: 840x504)', 'redux-framework-demo'),
            'default'  => '840x504'
        ),
        array(
            'id' => 'tech888f_post_list_excerpt',
            'type' => 'text',
            'title' => esc_html__('List Excerpt Length', 'redux-framework-demo'),
            'subtitle' => esc_html__('Number of characters you want to get from excerpt content', 'redux-framework-demo'),
            'desc' => esc_html__('Only accept number value. Example: 100', 'redux-framework-demo'),
            'validate' => 'numeric',
            'msg'     => 'Numeric value required',
            'default' => '100'
        ),
        array(
            'id' => 'tech888f_post_list_item_specific',
            'type' => 'select',
            'title' => esc_html__('Sepicfy Blog List Item', 'redux-framework-demo'),
            'subtitle' => esc_html__('Choose your specific display of list item', 'redux-framework-demo'),
            'options' => tech888f_get_post_list_specific(),
            'select2' => array('allowClear' => false)
        ),
    )
);