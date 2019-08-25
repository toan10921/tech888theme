<?php
/**
 * Created by Sublime text 2.
 * User: thanhhiep992
 * Date: 31/08/15
 * Time: 10:00 AM
 */
/************************************Main Carousel*************************************/
if(!function_exists('tech888f_vc_tabs')){
    function tech888f_vc_tabs($attr, $content = false){
        $html = $css_class = $css_class2 = '';
        $data_array = array_merge(array(
            'style'         => '7up-style',
            'active_section'=> '1',
            'title'         => '',
            'des'           => '',
            'tab_pos'       => 'top',
            'tab_align'     => 'text-left',
            'tab_ajax'      => 'off',
            'custom_css'    => '',
            'el_class'      => '',
            'custom_css2'   => '',
            'el_class2'     => '',
            'content'       => $content,
        ),tech888f_get_responsive_default_atts());
        $attr = shortcode_atts($data_array,$attr);
        extract($attr);
        $css_classes = vc_shortcode_custom_css_class( $custom_css );
        $css_class = preg_replace( '/\s+/', ' ', apply_filters( 'vc_shortcodes_css_class', $css_classes, '', $attr ) );
        
        // Variable process vc_shortcodes_css_class
        if(!empty($css_class)) $el_class .= ' '.$css_class;
        $default = array(
            'title'         => '',
            'tab_id'        => '',
            'i_type'        => 'fontawesome',
            'i_position'    => 'left',
            'add_icon'      => 'false',
            'i_icon_openiconic'      => 'vc-oi vc-oi-dial',
            'i_icon_typicons'      => 'typcn typcn-adjust-brightness',
            'i_icon_entypo'      => 'entypo-icon entypo-icon-note',
            'i_icon_linecons'      => 'vc_li vc_li-heart',
            'i_icon_monosocial'      => 'vc-mono vc-mono-fivehundredpx',
            'i_icon_material'      => 'vc-material vc-material-cake',
            'tab_ajax'      => $tab_ajax,
            'style'      => $style,
            );
        $tabs = tech888f_get_attr_content($content, $default);
        $tab_active = $tabs[$active_section - 1]['tab_id'];
        $content = tech888f_add_attr_content($content,'tab_ajax="'.$tab_ajax.'" style="'.$style.'" tab_active="'.$tab_active.'"');
        $el_class .= ' '.$style;
        if(!empty($custom_css2)) $css_class2 = vc_shortcode_custom_css_class( $custom_css2 );
        $el_class2 .= ' '.$css_class2;
        $attr = array_merge($attr,array(
            'el_class'  => $el_class,
            'el_class2' => $el_class2,
            'tabs'       => $tabs,
            'content'   => $content,
            'content2'   => $content,
            ));
        $html = tech888f_get_template_element('tabs/tab',$style,$attr);
        return $html;
    }
}
tech888f_reg_shortcode('tech888f_tabs','tech888f_vc_tabs');
vc_map(
    array(
        'name'          => esc_html__( 'Tabs', 'mptheme' ),
        'base'          => 'tech888f_tabs',
        "category"      => esc_html__("Tech888-Elements", 'mptheme'),
        "description"   => esc_html__( 'Display tabs block', 'mptheme' ),
        'icon'          => 'icon-st',
        'is_container'  => true,
        'show_settings_on_create' => false,
        'as_parent'     => array(
            'only' => 'vc_tta_section',
        ),
        'params'        => array(                       
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__( 'Style', 'mptheme' ),
                'param_name'    => 'style',
                'value'         => array(
                    esc_html__( 'Default', 'mptheme' ) => '',
                    )
            ),
            array(
                'heading'     => esc_html__( 'Title', 'mptheme' ),
                'type'        => 'textfield',
                'description' => esc_html__( 'Enter title of element.', 'mptheme' ),
                'param_name'  => 'title',
            ),
            array(
                'heading'     => esc_html__( 'Description', 'mptheme' ),
                'type'        => 'textfield',
                'description' => esc_html__( 'Enter description of element.', 'mptheme' ),
                'param_name'  => 'des',
            ),
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__( 'Tab Alighment', 'mptheme' ),
                'param_name'    => 'tab_align',
                'value'         => array(
                    esc_html__( 'Left', 'mptheme' ) => 'text-left',
                    esc_html__( 'Right', 'mptheme' ) => 'text-right',
                    esc_html__( 'Center', 'mptheme' ) => 'text-center',
                    )
            ),
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__( 'Tab Position', 'mptheme' ),
                'param_name'    => 'tab_pos',
                'value'         => array(
                    esc_html__( 'Top', 'mptheme' ) => 'top',
                    esc_html__( 'Bottom', 'mptheme' ) => 'bottom',
                    )
            ),
            array(
                'type'          => 'textfield',
                'heading'       => esc_html__( 'Active section', 'mptheme' ),
                'param_name'    => 'active_section',
                'description'   => esc_html__( 'Enter active section number. Default is 1.', 'mptheme' )
            ),
            array(
                'type'          => 'dropdown',
                'heading'       => esc_html__( 'Tab Ajax', 'mptheme' ),
                'param_name'    => 'tab_ajax',
                'value'         => array(
                    esc_html__( 'Off', 'mptheme' ) => 'off',
                    esc_html__( 'On', 'mptheme' ) => 'on',
                    )
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
                'group'         => esc_html__('Design tab content','mptheme'),
                'description'   => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'mptheme' )
                ),
            array(
                "type"          => "css_editor",
                "heading"       => esc_html__("CSS box",'mptheme'),
                "param_name"    => "custom_css2",
                'group'         => esc_html__('Design tab content','mptheme')
                ),
        ),
        'js_view' => 'VcBackendTtaTabsView',
        'custom_markup' => '
            <div class="vc_tta-container" data-vc-action="collapse">
                <div class="vc_general vc_tta vc_tta-tabs vc_tta-color-backend-tabs-white vc_tta-style-flat vc_tta-shape-rounded vc_tta-spacing-1 vc_tta-tabs-position-top vc_tta-controls-align-left">
                    <div class="vc_tta-tabs-container">'
                                   . '<ul class="vc_tta-tabs-list">'
                                   . '<li class="vc_tta-tab" data-vc-tab data-vc-target-model-id="{{ model_id }}" data-element_type="vc_tta_section"><a href="javascript:;" data-vc-tabs data-vc-container=".vc_tta" data-vc-target="[data-model-id=\'{{ model_id }}\']" data-vc-target-model-id="{{ model_id }}"><span class="vc_tta-title-text">{{ section_title }}</span></a></li>'
                                   . '</ul>
                    </div>
                    <div class="vc_tta-panels vc_clearfix {{container-class}}">
                      {{ content }}
                    </div>
                </div>
            </div>',
        'default_content' => '
            [vc_tta_section title="' . sprintf( '%s %d', esc_attr__( 'Tab', 'mptheme' ), 1 ) . '"][/vc_tta_section]
            [vc_tta_section title="' . sprintf( '%s %d', esc_attr__( 'Tab', 'mptheme' ), 2 ) . '"][/vc_tta_section]
                ',
        'admin_enqueue_js' => array(
            vc_asset_url( 'lib/vc_tabs/vc-tabs.min.js' ),
        ),
    )
);
//Load tab content
add_action( 'wp_ajax_load_tab_content', 'tech888f_load_tab_content' );
add_action( 'wp_ajax_nopriv_load_tab_content', 'tech888f_load_tab_content' );
if(!function_exists('tech888f_load_tab_content')){
    function tech888f_load_tab_content() {
        WPBMap::addAllMappedShortcodes();
        $tab_content = sanitize_text_field($_POST['tab_content']);
        $tab_content = str_replace('\"', '"', $tab_content);
        $tab_content = str_replace('\/', '/', $tab_content);
        $tab_content = preg_replace ( '/\[vc_tta_section(.*?)\]/s' , '' , $tab_content );
        echo apply_filters('the_content',$tab_content);
        die();
    }
}
?>