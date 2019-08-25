<?php
/**
 * Created by Sublime text 2.
 * User: ToanNgo92
 * Date: 26/10/17
 * Time: 10:00 AM
 */

if(!function_exists('tech888f_vc_advertisement'))
{
    function tech888f_vc_advertisement($attr,$content = false)
    {
        $html = $css_class = $css_class2 = '';
        $data_array = array_merge(array(
            'style'         => '',
            'image'         => '',
            'image2'        => '',
            'link'          => '',
            'animation'     => '',
            'el_class'      => '',
            'el_class2'     => '',
            'custom_css'    => '',
            'custom_css2'   => '',
            'size'          => '',
            'content'       => $content,
        ),tech888f_get_responsive_default_atts());
        $attr = shortcode_atts($data_array,$attr);
        extract($attr);
        $css_classes = vc_shortcode_custom_css_class( $custom_css );
        $css_class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', $css_classes, '', $attr ) );
        
        // Variable process vc_shortcodes_css_class
        if(!empty($css_class)) $el_class .= ' '.$css_class;
        
        $el_class .= ' '.$style.' '.$animation;
        if(!empty($custom_css2)) $el_class2 .= ' '.vc_shortcode_custom_css_class( $custom_css2 );
        if(!empty($size)) $size = explode('x', $size);
        else $size = 'full';
        $attr = array_merge($attr,array(
            'el_class'  => $el_class,
            'el_class2' => $el_class2,
            'size'      => $size,
            ));

        $html = tech888f_get_template_element('advertisement/advertisement',$style,$attr);

        return $html;
    }
}

tech888f_reg_shortcode('tech888f_advertisement','tech888f_vc_advertisement');

vc_map( array(
    "name"          => esc_html__("Advertisement", 'mptheme'),
    "base"          => "tech888f_advertisement",
    "icon"          => "icon-st",
    "category"      => esc_html__("Tech888-Elements", 'mptheme'),
    "description"   => esc_html__( 'Display a advertisement', 'mptheme' ),
    "params"        => array(        
        array(
            "type"          => "textarea_html",
            "holder"        => "div",
            "heading"       => esc_html__("Content Info",'mptheme'),
            "param_name"    => "content",
            "description"   => esc_html__( 'Enter info content of element.', 'mptheme' )
        ),
        array(
            "type"          => "dropdown",
            "admin_label"   => true,
            "heading"       => esc_html__("Style",'mptheme'),
            "param_name"    => "style",
            "value"         => array(
                esc_html__("Default",'mptheme')   => '',
                esc_html__("About",'mptheme')   => 'about',
            ),
            "description"   => esc_html__( 'Choose menu style to display.', 'mptheme' )
        ),
        array(
            "type"          => "attach_image",
            "admin_label"   => true,
            "heading"       => esc_html__("Image",'mptheme'),
            "param_name"    => "image",
            "description"   => esc_html__( 'Select image from media library.', 'mptheme' )
        ),
        array(
            "type"          => "textfield",
            "heading"       => esc_html__("Link",'mptheme'),
            "param_name"    => "link",
            "description"   => esc_html__( 'Enter URL redirect when click to image.', 'mptheme' )
        ),
        array(
            "type"          => "dropdown",
            "heading"       => esc_html__("Animation",'mptheme'),
            "param_name"    => "animation",
            "value"         => array(
                esc_html__("Default",'mptheme')                    => '',
                esc_html__("Zoom",'mptheme')                       => 'zoom-image',
                esc_html__("Zoom out",'mptheme')                   => 'zoom-out',
                esc_html__("Zoom out Overlay",'mptheme')           => 'zoom-out overlay-image',
                esc_html__("Fade out-in",'mptheme')                => 'fade-out-in',
                esc_html__("Zoom Fade out-in",'mptheme')           => 'zoom-image fade-out-in',
                esc_html__("Fade in-out",'mptheme')                => 'fade-in-out',
                esc_html__("Zoom rotate",'mptheme')                => 'zoom-rotate',
                esc_html__("Zoom rotate Fade out-in",'mptheme')    => 'zoom-rotate fade-out-in',
                esc_html__("Overlay",'mptheme')                    => 'overlay-image',
                esc_html__("Overlay Zoom",'mptheme')               => 'overlay-image zoom-image',
                esc_html__("Zoom image line",'mptheme')            => 'zoom-image line-scale',
                esc_html__("Gray image",'mptheme')                 => 'gray-image',
                esc_html__("Gray image line",'mptheme')            => 'gray-image line-scale',
                esc_html__("Pull curtain",'mptheme')               => 'pull-curtain',
                esc_html__("Pull curtain gray image",'mptheme')    => 'pull-curtain gray-image',
                esc_html__("Pull curtain zoom image",'mptheme')    => 'pull-curtain zoom-image',
            ),
            "description"   => esc_html__( 'Select type of animation for image.', 'mptheme' )
        ),
        array(
            "type"          => "attach_image",
            "heading"       => esc_html__("Image fade",'mptheme'),
            "param_name"    => "image2",
            "dependency"    => array(
                "element"       => "animation",
                "value"     => array("zoom-out","zoom-out overlay-image"),
            ),
            "description"   => esc_html__( 'Select image from media library.', 'mptheme' )
        ),
        array(
            "type"          => "textfield",
            "heading"       => esc_html__("Image custom size",'mptheme'),
            "param_name"    => "size",
            'description'   => esc_html__( 'Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height)).', 'mptheme' ),
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
        array(
            "type"          => "textfield",
            "heading"       => esc_html__("Extra class name",'mptheme'),
            "param_name"    => "el_class2",
            'group'         => esc_html__('Design Info Box','mptheme'),
            'description'   => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'mptheme' )
        ),
        array(
            "type"          => "css_editor",
            "heading"       => esc_html__("CSS box",'mptheme'),
            "param_name"    => "custom_css2",
            'group'         => esc_html__('Design Info Box','mptheme')
        ),
    )
));