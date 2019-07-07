<?php
/**
 * Created by PhpStorm.
 * User: toanngo92
 * Date: 2/17/2019
 * Time: 4:34 PM
 */
global $tech888f_res;
$sub_section = array(
    'title'      => esc_html__( 'Layout Settings', 'mmolee' ),
    'desc'       => esc_html__( 'Tech888 Layout Settings', 'mmolee' ),
    'id'         => 'opt_layout_settings',
    'subsection' => true,
    'fields'     => array(
        array(
            'id' => 'tech888f_page_sidebar_pos',
            'type' => 'image_select',
            'title' => esc_html__('Sidebar Page Position', 'redux-framework-demo'),
            'subtitle' => esc_html__('Choose your sidebar page position', 'redux-framework-demo'),
            'desc' => esc_html__('Setup sidebar position for your page. Left, Right, or No sidebar.', 'redux-framework-demo'),
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
            'default' => 'no',
            'select2' => array('allowClear' => false)
        ),
        array(
            'id' => 'tech888f_page_sidebar_id',
            'type' => 'select',
            'title' => esc_html__('Choose Page Sidebar', 'redux-framework-demo'),
            'subtitle' => esc_html__('Choose your specific page sidebar', 'redux-framework-demo'),
            'data' => 'sidebar',
            'required' => array('tech888f_page_sidebar_pos', '=', array('left', 'right'))
        ),
        'fields'     => array(
            array(
                'id' => 'tech888f_archives_sidebar_pos',
                'type' => 'select',
                'title' => esc_html__('Sidebar Archives Position', 'redux-framework-demo'),
                'subtitle' => esc_html__('Choose your sidebar archives position', 'redux-framework-demo'),
                'desc' => esc_html__('Setup sidebar position for your archives. Left, Right, or No sidebar.', 'redux-framework-demo'),
                'options' => array(
                    'no' => esc_html__('No', '7upframework'),
                    'left' => esc_html__('Left Sidebar', '7upframework'),
                    'right' => esc_html__('Right Sidebar', '7upframework'),
                ),
                'default' => 'right',
                'select2' => array('allowClear' => false)
            ),
        ),
        array(
            'id' => 'tech888f_archives_sidebar_id',
            'type' => 'select',
            'title' => esc_html__('Choose Archives Sidebar', 'redux-framework-demo'),
            'subtitle' => esc_html__('Choose your specific archives sidebar', 'redux-framework-demo'),
            'data' => 'sidebar',
            'required' => array('tech888f_archives_sidebar_pos', '=', array('left', 'right'))
        ),
        array(
            'id'       => 'tech888f_add_sidebar',
            'type'     => 'multi_text',
            'validate' => 'no-html',
            'default'  => array(),
            'title'    => __( 'Add New Sidebar', 'redux-framework-demo' ),
            'subtitle' => esc_html__('Enter your sidebar name you want to create', 'redux-framework-demo'),
            'desc' => __( 'Your own sidebar will be created automatically. Example: Your side bar name is: Sidebar Default -> slug of sidebar is: sidebar-default ', 'redux-framework-demo' ),
        ),
    ),
);

return $sub_section;