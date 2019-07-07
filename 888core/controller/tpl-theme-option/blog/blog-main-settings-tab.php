<?php
/**
 * Created by PhpStorm.
 * User: toanngo92
 * Date: 2/10/2019
 * Time: 3:40 PM
 */

global $tech888f_res;
$sub_section = array(
    'title' => esc_html__('Main Settings', 'mmolee'),
    'desc' => esc_html__('Tech888 Blog/Post Main Settings', 'mmolee'),
    'id' => 'opt_blog_main_settings',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'tech888f_before_append_post',
            'type' => 'select',
            'title' => esc_html__('Content before Blog/Detail template', 'redux-framework-demo'),
            'subtitle' => esc_html__('Choose your before content', 'redux-framework-demo'),
            'desc' => esc_html__('Choose an extra content append to before main content of blog/post detail with template default.', 'redux-framework-demo'),
            'data' => 'posts',
            'args' => array(
                'post_type' => 'tech888f_extra',
            ),
        ),
        array(
            'id' => 'tech888f_after_append_post',
            'type' => 'select',
            'title' => esc_html__('Content after Blog/Detail template', 'redux-framework-demo'),
            'subtitle' => esc_html__('Choose your after content', 'redux-framework-demo'),
            'desc' => esc_html__('Choose an extra content append to before main content of blog/post detail with template default.', 'redux-framework-demo'),
            'data' => 'posts',
            'args' => array(
                'post_type' => 'tech888f_extra',
            ),
        ),
        array(
            'id' => 'tech888f_blog_sidebar_pos',
            'type' => 'image_select',
            'title' => esc_html__('Sidebar Blog Position', 'redux-framework-demo'),
            'subtitle' => esc_html__('Choose your sidebar blog position', 'redux-framework-demo'),
            'desc' => esc_html__('Setup sidebar position for your blog page. Left, Right, or No sidebar.', 'redux-framework-demo'),
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
            'default' => 'right',
            'select2' => array('allowClear' => false)
        ),
        array(
            'id' => 'tech888f_blog_sidebar_id',
            'type' => 'select',
            'title' => esc_html__('Choose Blog Sidebar', 'redux-framework-demo'),
            'subtitle' => esc_html__('Choose your specific blog sidebar', 'redux-framework-demo'),
            'data' => 'sidebar',
            'required' => array('tech888f_blog_sidebar_pos', '=', array('left', 'right'))
        ),
        array(
            'id' => 'tech888f_blog_default_style',
            'type' => 'image_select',
            'title' => esc_html__('Default Blog Style', 'redux-framework-demo'),
            'subtitle' => esc_html__('Choose your blog listing style List or Grid', 'redux-framework-demo'),
            'options' => array(
                'list' => array(
                    'title' => esc_html__('List','tech888td'),
                    'alt' => esc_html__('List','tech888td'),
                    'img' => $tech888f_res . '/images/list-layout.jpg'
                ),
                'grid' => array(
                    'title' => esc_html__('Grid','tech888td'),
                    'alt' => esc_html__('Grid','tech888td'),
                    'img' => $tech888f_res . '/images/grid-layout.jpg'
                ),
            ),
            'default' => 'list',
        ),
        array(
            'id' => 'tech888f_blog_pagi_style',
            'type' => 'select',
            'title' => esc_html__('Blog Pagination Style', 'redux-framework-demo'),
            'subtitle' => esc_html__('Choose your blog pagination style', 'redux-framework-demo'),
            'options' => array(
                'default' => esc_html__('Default', '7upframework'),
                'load-more' => esc_html__('Load more', '7upframework'),
            ),
            'default' => 'default',
            'select2' => array('allowClear' => false)
        ),
        array(
            'id'       => 'tech888f_blog_post_per_page_filter',
            'type'     => 'switch',
            'title'    => __( 'Post Per Page Filter', 'redux-framework-demo' ),
            'desc' => __( 'Show/Hide Post per page menu filter. Default is on.', 'redux-framework-demo' ),
            'default'  => true,
        ),
        array(
            'id'       => 'tech888f_blog_post_style_filter',
            'type'     => 'switch',
            'title'    => __( 'Post style Filter', 'redux-framework-demo' ),
            'desc' => __( 'Show/Hide Post style menu filter. Default is on.', 'redux-framework-demo' ),
            'default'  => true,
        ),
    )
);