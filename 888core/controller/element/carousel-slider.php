<?php
/**
 * Created by Sublime text 2.
 * User: thanhhiep992
 * Date: 31/08/15
 * Time: 10:00 AM
 */
/************************************Main Carousel*************************************/
if(!function_exists('tech888f_vc_slide_carousel'))
{
    function tech888f_vc_slide_carousel($attr, $content = false)
    {
        $html = $css_class = '';
        $data_array = array_merge(array(
            'item'          => '1',
            'speed'         => '',
            'itemres'       => '',
            'navigation'    => '',
            'pagination'    => '',
            'nav_next'      => '',
            'nav_prev'      => '',
            'banner_bg'     => '',
            'animation_out' => '',
            'animation_in'  => '',
            'margin'        => '',
            'stage_padding' => '',
            'start_position'=> '',
            'loop'          => '',
            'mousewheel'    => '',
            'custom_css'    => '',
            'el_class'      => '',
            'content'       => $content,
        ),tech888f_get_responsive_default_atts());
        $attr = shortcode_atts($data_array,$attr);
        extract($attr);
        $css_classes = vc_shortcode_custom_css_class( $custom_css );
        $css_class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', $css_classes, '', $attr ) );

        // Variable process vc_shortcodes_css_class
        if(!empty($css_class)) $el_class .= ' '.$css_class;
        $el_class .= ' '.$banner_bg;

        $attr = array_merge($attr,array(
            'el_class' => $el_class,
        ));
        $html = tech888f_get_template_element('slide-carousel/carousel','',$attr);
        return $html;
    }
}
tech888f_reg_shortcode('slide_carousel','tech888f_vc_slide_carousel');
vc_map(
    array(
        'name'          => esc_html__( 'Carousel Slider', 'mptheme' ),
        'base'          => 'slide_carousel',
        "category"      => esc_html__("Tech888-Elements", 'mptheme'),
        "description"   => esc_html__( 'Display banner slider', 'mptheme' ),
        'icon'          => 'icon-st',
        'as_parent'     => array( 'only' => 'vc_column_text,vc_single_image,slide_banner_item,tech888f_advertisement,tech888f_team' ),
        'content_element' => true,
        'js_view'       => 'VcColumnView',
        'params'        => array(
            array(
                'heading'     => esc_html__( 'Item slider display', 'mptheme' ),
                'type'        => 'textfield',
                'description' => esc_html__( 'Enter number of item. Default is 1.', 'mptheme' ),
                'param_name'  => 'item',
            ),
            array(
                'type'        => 'dropdown',
                'heading'     => esc_html__( 'Image style', 'mptheme' ),
                'param_name'  => 'banner_bg',
                'value'       => array(
                    esc_html__( 'Default', 'mptheme' )                        => '',
                    esc_html__( 'Banner Background', 'mptheme' )              => 'bg-slider',
                    esc_html__( 'Banner Background Parallax', 'mptheme' )     => 'bg-slider parallax-slider',
                ),
            ),
            array(
                'heading'     => esc_html__( 'Speed', 'mptheme' ),
                'type'        => 'textfield',
                'description' => esc_html__( 'Enter time slider go to next item. Unit (ms). Example 5000. If empty this field autoPlay is false.', 'mptheme' ),
                'param_name'  => 'speed',
            ),
            array(
                'type'        => 'dropdown',
                'heading'     => esc_html__( 'Navigation', 'mptheme' ),
                'param_name'  => 'navigation',
                'value'       => array(
                    esc_html__( 'Hidden', 'mptheme' )                  => '',
                    esc_html__( 'Default Navigation', 'mptheme' )      => 'navi-nav-style',
                    esc_html__( 'Group Navigation', 'mptheme' )        => 'group-navi',
                    esc_html__( 'Style 2 Navigation', 'mptheme' )      => 'navi-nav-style2',
                    esc_html__( 'Style 3 Navigation', 'mptheme' )      => 'navi-nav-style3',
                    esc_html__( 'Style 4 Navigation', 'mptheme' )      => 'navi-nav-style4',
                    esc_html__( 'Style 5 Navigation', 'mptheme' )      => 'navi-nav-style5',
                ),
            ),
            array(
                'heading'     => esc_html__( 'Text prev', 'mptheme' ),
                'type'        => 'textfield',
                'description' => esc_html__( 'Enter text/html previous button slider', 'mptheme' ),
                'param_name'  => 'nav_prev',
                'dependency'  => array(
                    'element'   => 'navigation',
                    'not_empty' => true,
                )
            ),
            array(
                'heading'     => esc_html__( 'Text next', 'mptheme' ),
                'type'        => 'textfield',
                'description' => esc_html__( 'Enter text/html next button slider', 'mptheme' ),
                'param_name'  => 'nav_next',
                'dependency'  => array(
                    'element'   => 'navigation',
                    'not_empty' => true,
                )
            ),
            array(
                'type'        => 'dropdown',
                'heading'     => esc_html__( 'Pagination', 'mptheme' ),
                'param_name'  => 'pagination',
                'value'       => array(
                    esc_html__( 'Hidden', 'mptheme' )                  => '',
                    esc_html__( 'Default Pagination', 'mptheme' )      => 'pagi-nav-style',
                    esc_html__( 'Pagination Style 2', 'mptheme' )      => 'pagi-nav-style2',
                ),
            ),
            array(
                'heading'     => esc_html__( 'Custom Item', 'mptheme' ),
                'type'        => 'textfield',
                'description'   => esc_html__( 'Enter item for screen width(px) format is width:value and separate values by ",". Example is 0:2,600:3,1000:4. Default is auto.', 'mptheme' ),
                'group'         => esc_html__('Advanced','mptheme'),
                'param_name'  => 'itemres',
            ),
            array(
                'type'          => 'animation_style',
                'heading'       => esc_html__( 'Item Out Animation', 'mptheme' ),
                'param_name'    => 'animation_out',
                'admin_label'   => true,
                'value'         => '',
                'settings'      => array(
//                    'type'          => 'in',
                    'custom'        =>  array(
                        array(
                            'label'     => esc_html__( 'Default', 'mptheme' ),
                            'values'    => array(
                                esc_html__( 'Top to bottom', 'mptheme' ) => 'top-to-bottom',
                                esc_html__( 'Bottom to top', 'mptheme' ) => 'bottom-to-top',
                                esc_html__( 'Left to right', 'mptheme' ) => 'left-to-right',
                                esc_html__( 'Right to left', 'mptheme' ) => 'right-to-left',
                                esc_html__( 'Appear from center', 'mptheme' ) => 'appear',
                            ),
                        ),
                    ),
                ),
                'group'         => esc_html__('Advanced','mptheme'),
                'description' => esc_html__( 'Select type of animation for element to be animated when it enters the browsers viewport (Note: works only in modern browsers).', 'mptheme' ),
            ),
            array(
                'type'          => 'animation_style',
                'heading'       => esc_html__( 'Item In Animation', 'mptheme' ),
                'param_name'    => 'animation_in',
                'admin_label'   => true,
                'value'         => '',
                'settings'      => array(
//                    'type'          => 'in',
                    'custom'        =>  array(
                        array(
                            'label'     => esc_html__( 'Default', 'mptheme' ),
                            'values'    => array(
                                esc_html__( 'Top to bottom', 'mptheme' ) => 'top-to-bottom',
                                esc_html__( 'Bottom to top', 'mptheme' ) => 'bottom-to-top',
                                esc_html__( 'Left to right', 'mptheme' ) => 'left-to-right',
                                esc_html__( 'Right to left', 'mptheme' ) => 'right-to-left',
                                esc_html__( 'Appear from center', 'mptheme' ) => 'appear',
                            ),
                        ),
                    ),
                ),
                'group'         => esc_html__('Advanced','mptheme'),
                'description' => esc_html__( 'Select type of animation for element to be animated when it enters the browsers viewport (Note: works only in modern browsers).', 'mptheme' ),
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__("Margin",'mptheme'),
                "param_name"    => "margin",
                'group'         => esc_html__('Advanced','mptheme'),
                'description'   => esc_html__( 'Enter number margin-right(px) on item.', 'mptheme' )
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__("Stage Padding",'mptheme'),
                "param_name"    => "stage_padding",
                'group'         => esc_html__('Advanced','mptheme'),
                'description'   => esc_html__( 'Padding left and right on stage (can see neighbours).', 'mptheme' )
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__("Start Position",'mptheme'),
                "param_name"    => "start_position",
                'group'         => esc_html__('Advanced','mptheme'),
                'description'   => esc_html__( 'Enter number of start position. Default is 0', 'mptheme' )
            ),
            array(
                "type"          => "dropdown",
                "heading"       => esc_html__("Loop",'mptheme'),
                "param_name"    => "loop",
                'value'       => array(
                    esc_html__( 'Off', 'mptheme' )         => '',
                    esc_html__( 'On', 'mptheme' )          => 'true',
                ),
                'group'         => esc_html__('Advanced','mptheme'),
                'description'   => esc_html__( 'Infinity loop. Duplicate last and first items to get loop illusion.', 'mptheme' )
            ),
            array(
                "type"          => "dropdown",
                "heading"       => esc_html__("Mousewheel",'mptheme'),
                "param_name"    => "mousewheel",
                'value'       => array(
                    esc_html__( 'Off', 'mptheme' )         => '',
                    esc_html__( 'On', 'mptheme' )          => 'true',
                ),
                'group'         => esc_html__('Advanced','mptheme'),
                'description'   => esc_html__( 'Infinity loop. Duplicate last and first items to get loop illusion.', 'mptheme' )
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__("Extra class name",'mptheme'),
                "param_name"    => "el_class",
                'group'         => esc_html__('Design Options','mptheme'),
                'description'   => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'mptheme' )
            ),
            array(
                "type"          => "css_editor",
                "heading"       => esc_html__("CSS box",'mptheme'),
                "param_name"    => "custom_css",
                'group'         => esc_html__('Design Options','mptheme')
            ),

        )
    )
);

/*******************************************END MAIN*****************************************/


/**************************************BEGIN ITEM************************************/
//Banner item Frontend
if(!function_exists('tech888f_vc_slide_banner_item'))
{
    function tech888f_vc_slide_banner_item($attr, $content = false)
    {
        $html = $css_class = '';
        $data_array = array_merge(array(
            'style'             => '',
            'image'             => '',
            'size'              => '',
            'link'              => '',
            'pos_x'              => '',
            'pos_y'              => '',
            'prd_id'            => '',
            'info_animation'    => '',
            'info_style'        => '',
            'info_align'        => '',
            'info_transform'    => '',
            'merge'             => '1',
            'custom_css'        => '',
            'el_class'          => '',
            'content'           => $content,
        ),tech888f_get_responsive_default_atts());
        $attr = shortcode_atts($data_array,$attr);
        extract($attr);
        $css_classes = vc_shortcode_custom_css_class( $custom_css );
        $css_class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', $css_classes, '', $attr ) );

        $el_class .= ' '.$style.' '.$css_class;
        $info_class = $info_style.' '.$info_align.' '.$info_transform;
        if(!empty($info_animation)) $info_class .= ' animated';
        if(!empty($size)) $size = explode('x', $size);
        else $size = 'full';
        $attr = array_merge($attr,array(
            'el_class'      => $el_class,
            'info_class'    => $info_class,
            'size'          => $size,
        ));
        if(!empty($image)){
            $html = tech888f_get_template_element('slide-carousel/item',$style,$attr);
        }
        return $html;
    }
}
tech888f_reg_shortcode('slide_banner_item','tech888f_vc_slide_banner_item');

// Banner item
vc_map(
    array(
        'name'     => esc_html__( 'Banner Item', 'mptheme' ),
        'base'     => 'slide_banner_item',
        'icon'     => 'icon-st',
        'content_element' => true,
        'as_child' => array('only' => 'slide_carousel'),
        'params'   => array(
            array(
                "type"          => "textarea_html",
                "holder"        => "div",
                "heading"       => esc_html__("Content",'mptheme'),
                "param_name"    => "content",
            ),
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__( 'Style', 'mptheme' ),
                'param_name'    => 'style',
                'value'         => array(
                    esc_html__( 'Default', 'mptheme' ) => '',
                    esc_html__( 'Coordinates', 'mptheme' ) => 'coordinates',
                )
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__("X axis coordinates",'mptheme'),
                "param_name"    => "pos_x",
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__("Y axis coordinates",'mptheme'),
                "param_name"    => "pos_y",
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__("Product Id",'mptheme'),
                "param_name"    => "prd_id",
            ),
            array(
                'type'          => 'attach_image',
                'heading'       => esc_html__( 'Image', 'mptheme' ),
                'param_name'    => 'image',
            ),
            array(
                'type'          => 'textfield',
                'heading'       => esc_html__( 'Link Banner', 'mptheme' ),
                'param_name'    => 'link',
            ),
            array(
                'type'          => 'animation_style',
                'heading'       => esc_html__( 'Info Animation', 'mptheme' ),
                'param_name'    => 'info_animation',
                'admin_label'   => true,
                'value'         => '',
                'settings'      => array(
                    'type'          => 'in',
                    'custom'        =>  array(
                        array(
                            'label'     => esc_html__( 'Default', 'mptheme' ),
                            'values'    => array(
                                esc_html__( 'Top to bottom', 'mptheme' ) => 'top-to-bottom',
                                esc_html__( 'Bottom to top', 'mptheme' ) => 'bottom-to-top',
                                esc_html__( 'Left to right', 'mptheme' ) => 'left-to-right',
                                esc_html__( 'Right to left', 'mptheme' ) => 'right-to-left',
                                esc_html__( 'Appear from center', 'mptheme' ) => 'appear',
                            ),
                        ),
                    ),
                ),
                'description' => esc_html__( 'Select type of animation for element to be animated when it enters the browsers viewport (Note: works only in modern browsers).', 'mptheme' ),
            ),
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__( 'Info Style', 'mptheme' ),
                'param_name'    => 'info_style',
                'value'         => array(
                    esc_html__( 'None', 'mptheme' )     => '',
                    esc_html__( 'Black', 'mptheme' )    => 'black',
                    esc_html__( 'White', 'mptheme' )    => 'white',
                    esc_html__( 'Navi', 'mptheme' )     => 'navi',
                )
            ),
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__( 'Info Align', 'mptheme' ),
                'param_name'    => 'info_align',
                'value'         => array(
                    esc_html__( 'Default', 'mptheme' )    => '',
                    esc_html__( 'Left', 'mptheme' )       => 'text-left',
                    esc_html__( 'Right', 'mptheme' )      => 'text-right',
                    esc_html__( 'Center', 'mptheme' )     => 'text-center',
                )
            ),
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__( 'Info Transform', 'mptheme' ),
                'param_name'    => 'info_transform',
                'value'         => array(
                    esc_html__( 'Default', 'mptheme' )     => '',
                    esc_html__( 'Uppercase', 'mptheme' )   => 'text-uppercase',
                )
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__("Merge",'mptheme'),
                "param_name"    => "merge",
                'description'   => esc_html__( 'Enter number item merge. Default is 1.', 'mptheme' )
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__("Extra class name",'mptheme'),
                "param_name"    => "el_class",
                'group'         => esc_html__('Design Options','mptheme'),
                'description'   => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'mptheme' )
            ),
            array(
                "type"          => "css_editor",
                "heading"       => esc_html__("CSS box",'mptheme'),
                "param_name"    => "custom_css",
                'group'         => esc_html__('Design Options','mptheme')
            ),
        )
    )
);

/**************************************END ITEM************************************/

/**************************************BEGIN ITEM************************************/
//Banner item Frontend
if(!function_exists('tech888f_vc_slide_testimonial_item'))
{
    function tech888f_vc_slide_testimonial_item($attr, $content = false)
    {
        $html = $view_html = $view_html2 = '';
        extract(shortcode_atts(array(
            'style'         => '',
            'image'         => '',
            'name'          => '',
            'position'      => '',
            'des'           => '',
            'link'          => '',
        ),$attr));
        switch ($style) {
            case 'about-page':
                $html .=    '<div class="item-about-client">
                                <div class="client-thumb"><a href="'.esc_url($link).'">'.wp_get_attachment_image($image,'full').'</a></div>
                                <div class="client-info">
                                    <p class="desc">'.esc_html($des).'</p>
                                    <h3 class="title14"><a href="'.esc_url($link).'" class="color">'.esc_html($name).'</a></h3>
                                    <span class="silver">'.esc_html($position).'</span>
                                </div>
                            </div>';
                break;

            default:
                $html .=    '<div class="item-testimo4 table">
                                <div class="testimo-thumb">
                                    <a href="'.esc_url($link).'">'.wp_get_attachment_image($image,'full',0,array("class"=>"round")).'</a>
                                </div>
                                <div class="testimo-info">
                                    <ul class="list-inline-block">
                                        <li><a href="'.esc_url($link).'" class="color text-uppercase">'.esc_html($name).'</a></li>
                                        <li><span>'.esc_html($position).'</span></li>
                                    </ul>
                                    <p class="desc">'.esc_html($des).'</p>
                                </div>
                            </div>';
                break;
        }
        return $html;
    }
}
tech888f_reg_shortcode('slide_testimonial_item','tech888f_vc_slide_testimonial_item');

// Banner item
vc_map(
    array(
        'name'     => esc_html__( 'Testimonial Item', 'mptheme' ),
        'base'     => 'slide_testimonial_item',
        'icon'     => 'icon-st',
        'content_element' => true,
        'as_child' => array('only' => 'slide_carousel'),
        'params'   => array(
            array(
                'type'        => 'dropdown',
                'heading'     => esc_html__( 'Style', 'mptheme' ),
                'param_name'  => 'style',
                'value'       => array(
                    esc_html__( 'Default', 'mptheme' ) => '',
                    esc_html__( 'About style', 'mptheme' ) => 'about-page',
                )
            ),
            array(
                'type'        => 'attach_image',
                'heading'     => esc_html__( 'Image', 'mptheme' ),
                'param_name'  => 'image',
            ),
            array(
                'type'        => 'textfield',
                "holder"        => "h3",
                'heading'     => esc_html__( 'Name', 'mptheme' ),
                'param_name'  => 'name',
            ),

            array(
                'type'        => 'textfield',
                'heading'     => esc_html__( 'Position', 'mptheme' ),
                'param_name'  => 'position',
            ),
            array(
                'type'        => 'textfield',
                'heading'     => esc_html__( 'Link', 'mptheme' ),
                'param_name'  => 'link',
            ),
            array(
                "type"          => "textarea",
                "holder"        => "p",
                "heading"       => esc_html__("Description",'mptheme'),
                "param_name"    => "des",
            ),
        )
    )
);

/**************************************END ITEM************************************/

//Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Slide_Carousel extends WPBakeryShortCodesContainer {}
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_Slide_Banner_Item extends WPBakeryShortCode {}
}