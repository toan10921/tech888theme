<?php
/**
 * Created by PhpStorm.
 * User: toanngo92
 * Date: 2/10/2019
 * Time: 3:41 PM
 */
$sub_section = array(
    'title' => esc_html__('Blog Detail Settings', 'mmolee'),
    'desc' => esc_html__('Tech888 Blog Detail Settings', 'mmolee'),
    'id' => 'opt_blog_detail_settings',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'tech888f_post_sidebar_pos',
            'type' => 'select',
            'title' => esc_html__('Sidebar Post Detail Position', 'redux-framework-demo'),
            'subtitle' => esc_html__('Choose your sidebar Post Detail position', 'redux-framework-demo'),
            'desc' => esc_html__('Setup sidebar position for your post detail. Left, Right, or No sidebar.', 'redux-framework-demo'),
            'options' => array(
                'no' => esc_html__('No', '7upframework'),
                'left' => esc_html__('Left Sidebar', '7upframework'),
                'right' => esc_html__('Right Sidebar', '7upframework'),
            ),
            'default' => 'right',
            'select2' => array('allowClear' => false)
        ),
        array(
            'id' => 'tech888f_post_sidebar_id',
            'type' => 'select',
            'title' => esc_html__('Choose Post Detail Sidebar', 'redux-framework-demo'),
            'subtitle' => esc_html__('Choose your specific Post Detail sidebar', 'redux-framework-demo'),
            'data' => 'sidebar',
            'required' => array('tech888f_post_sidebar_pos', '=', array('left', 'right'))
        ),
        array(
            'id'       => 'tech888f_post_media_stats',
            'type'     => 'switch',
            'title'    => __( 'Thumbnail/media', 'redux-framework-demo' ),
            'desc' => __( 'Show/Hide thumbnail image, gallery, media on post detail. Default is on.', 'redux-framework-demo' ),
            'default'  => true,
        ),
        array(
            'id' => 'tech888f_post_image_size',
            'type' => 'text',
            'title' => esc_html__('Post Detail thumbnail size', 'redux-framework-demo'),
            'subtitle' => esc_html__('Enter your (Top Image) Thumbnail size', 'redux-framework-demo'),
            'desc' => esc_html__('This size use to crop your image before display to frontend.Structure: [width]x[height] (Example: 400x400)', 'redux-framework-demo'),
            'default' => '400x400'
        ),
        array(
            'id'       => 'tech888f_post_meta_data_stats',
            'type'     => 'switch',
            'title'    => __( 'Meta Data', 'redux-framework-demo' ),
            'desc' => __( 'Show/hide meta data(author, date, comments, categories, tags) on your post detail.', 'redux-framework-demo' ),
            'default'  => true,
        ),
        array(
            'id'       => 'tech888f_post_author_box_stats',
            'type'     => 'switch',
            'title'    => __( 'Author Box', 'redux-framework-demo' ),
            'desc' => __( 'Show/hide author box on post detail.', 'redux-framework-demo' ),
            'default'  => false,
        ),
        array(
            'id'       => 'tech888f_post_navi_post_stats',
            'type'     => 'switch',
            'title'    => __( 'Navigation Post', 'redux-framework-demo' ),
            'desc' => __( 'Show/hide navigation to next post or previous post on the post detail.', 'redux-framework-demo' ),
            'default'  => true,
        ),
        array(
            'id'       => 'tech888f_post_related_post_stats',
            'type'     => 'switch',
            'title'    => __( 'Related Post', 'redux-framework-demo' ),
            'desc' => __( 'Show/hide related post on the post detail.', 'redux-framework-demo' ),
            'default'  => true,
        ),
        array(
            'id' => 'tech888f_post_related_title',
            'type' => 'text',
            'title' => esc_html__('Related title', 'redux-framework-demo'),
            'subtitle' => esc_html__('Enter title of related section.', 'redux-framework-demo'),
            'default'  => 'Related Post',
            'required' => array( 'tech888f_post_related_post_stats', '=', true )
        ),
        array(
            'id' => 'tech888f_post_related_post_number',
            'type' => 'text',
            'title' => esc_html__('Related post number', 'redux-framework-demo'),
            'subtitle' => esc_html__('Enter number of related post to display.', 'redux-framework-demo'),
            'validate' => 'numeric',
            'default'  => 4,
            'required' => array( 'tech888f_post_related_post_stats', '=', true )
        ),
        array(
            'id' => 'tech888f_post_related_responsive_format',
            'type' => 'text',
            'title' => esc_html__('Related Post Responsive Format', 'redux-framework-demo'),
            'subtitle' => esc_html__('Enter post custom number of item responsive.', 'redux-framework-demo'),
            'desc' => __( 'Enter item for screen width(px) format is width:value and separate values by ",". Example is 0:2,600:3,1000:4. Default is auto.', 'redux-framework-demo' ),
            'default'  => '0:2,600:3,1000:4',
            'required' => array( 'tech888f_post_related_post_stats', '=', true )
        ),
        array(
            'id' => 'tech888f_post_related_item_specific',
            'type' => 'select',
            'title' => esc_html__('Sepicfy Related Post Item', 'redux-framework-demo'),
            'subtitle' => esc_html__('Choose your specific display of related post item.', 'redux-framework-demo'),
            'options' => tech888f_get_post_grid_specific(),
            'default' => '',
            'select2' => array('allowClear' => false),
            'required' => array( 'tech888f_post_related_post_stats', '=', true )
        ),
        array(
            'id' => 'tech888f_post_related_thumbnail_size',
            'type' => 'text',
            'title' => esc_html__('Related Post thumbnail size', 'redux-framework-demo'),
            'subtitle' => esc_html__('Enter your Related Post Thumbnail size', 'redux-framework-demo'),
            'desc' => esc_html__('This size use to crop your image before display to frontend.Structure: [width]x[height] (Example: 400x400)', 'redux-framework-demo'),
            'default' => '400x400'
        ),
    ),
);