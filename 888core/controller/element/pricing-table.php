<?php
/**
 * Created by Sublime text 2.
 * User: thanhhiep992
 * Date: 26/10/17
 * Time: 10:00 AM
 */

if(!function_exists('tech888f_vc_pricing_table')){
    function tech888f_vc_pricing_table($attr, $content = false){
        $html = $css_class = '';
        $data_array = array_merge(array(
            'style'         => '',
            'title'         => '',
            'des'           => '',
            'price'         => '',
            'unit'          => '$',
            'duration'      => '',
            'color'         => '',
            'link'          => '',
            'el_class'      => '',
            'custom_css'    => '',
            'content'       => $content,
        ),tech888f_get_responsive_default_atts());
        $attr = shortcode_atts($data_array,$attr);
        extract($attr);
        $css_classes = vc_shortcode_custom_css_class( $custom_css );
        $css_class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', $css_classes, '', $attr ) );
        
        // Variable process vc_shortcodes_css_class
        if(!empty($css_class)) $el_class .= ' '.$css_class;

        // Variable process
        $el_class .= ' '.$style;

        // Add variable to data
        $attr = array_merge($attr,array(
            'el_class' => $el_class,
            ));

        // Call function get template
        $html = tech888f_get_template_element('pricing-table/table',$style,$attr);

        return $html;
    }
}

tech888f_reg_shortcode('tech888f_pricing_table','tech888f_vc_pricing_table');

vc_map( array(
    "name"          => esc_html__("Pricing table", 'mptheme'),
    "base"          => "tech888f_pricing_table",
    "icon"          => "icon-st",
    "category"      => esc_html__("Tech888-Elements", 'mptheme'),
    "description"   => esc_html__( 'Display pricing table', 'mptheme' ),
    "params"        => array(
        array(
            "type"          => "dropdown",
            "admin_label"   => true,
            "heading"       => esc_html__("Style",'mptheme'),
            "param_name"    => "style",
            "value"         => array(
                esc_html__("Default",'mptheme')     => '',
                esc_html__("Color",'mptheme')     => 'pricing-color',
            ),
            "description"   => esc_html__( 'Choose style to display.', 'mptheme' )
        ),
        array(
            "type"          => "colorpicker",
            "heading"       => esc_html__("Color",'mptheme'),
            "param_name"    => "color",
            "dependency"    =>  array(
                "element"       => "style",
                "value"         => "pricing-color",
            ),
            "description"   => esc_html__( 'Choose color.', 'mptheme' )
        ),
        array(
            "type"          => "textfield",
            "admin_label"   => true,
            "heading"       => esc_html__("Title",'mptheme'),
            "param_name"    => "title",
            "description"   => esc_html__( 'Enter title.', 'mptheme' )
        ),
        array(
            "type"          => "textfield",
            "heading"       => esc_html__("Description",'mptheme'),
            "param_name"    => "des",
            "description"   => esc_html__( 'Enter description.', 'mptheme' )
        ),
        array(
            "type"          => "textfield",
            "heading"       => esc_html__("Price",'mptheme'),
            "param_name"    => "price",
            "description"   => esc_html__( 'Enter price.', 'mptheme' )
        ),
        array(
            "type"          => "textfield",
            "heading"       => esc_html__("Unit",'mptheme'),
            "param_name"    => "unit",
            "description"   => esc_html__( 'Enter unit of price. Default is $.', 'mptheme' )
        ),
        array(
            "type"          => "textfield",
            "heading"       => esc_html__("Duration",'mptheme'),
            "param_name"    => "duration",
            "description"   => esc_html__( 'Enter duration of pricing table.', 'mptheme' )
        ),
        array(
            "type"          => "vc_link",
            "heading"       => esc_html__("Link",'mptheme'),
            "param_name"    => "link",
            "description"   => esc_html__( 'Link view detail.', 'mptheme' )
        ),
        array(
            "type"          => "textarea_html",
            "admin_label"   => true,
            "heading"       => esc_html__("Content",'mptheme'),
            "param_name"    => "content",
            "description"   => esc_html__( 'Enter content to display.', 'mptheme' )
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
));