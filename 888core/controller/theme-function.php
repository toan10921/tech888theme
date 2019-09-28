<?php
/**
 * Created by PhpStorm.
 * User: toanngo92
 * Date: 2/2/2019
 * Time: 7:33 PM
 */

/* Get theme option */
if (!function_exists('tech888f_get_opt')) {
    function tech888f_get_opt($id,$args = null)
    {
        global $tech888f_option;
        if(!empty($tech888f_option[$id])){
            return $tech888f_option[$id];
        }
        else{
            return null;
        }
    }
}

if(!function_exists('tech888f_get_meta')){
    function tech888f_get_meta($field_id){
        $obj = rwmb_meta( $field_id);
        return $obj;
    }
}
if(!function_exists('tech888f_get_meta_args')){
    function tech888f_get_meta_args($field_id,$args,$post_id){
        $obj = rwmb_meta( $field_id,$args,$post_id);
        return $obj;
    }
}

if (!function_exists('tech888f_get_theme_option_sub_section')) {
    function tech888f_get_theme_option_sub_section($arg = null, $id_sec = null)
    {
        if (!empty($arg) && !empty($id_sec)) {
            $view_name = $id_sec . '/' . $arg;
            $sub_section = tech888f_get_theme_option_template($view_name);
        }
        return $sub_section;
    }
}

//Get list post type
if (!function_exists('tech888f_get_list_post_type')) {
    function tech888f_get_list_post_type($post_type = 'page', $type = true)
    {
        global $post;
        $post_temp = $post;
        $page_list = array();
        if ($type) {
            $page_list[] = array();
        } else $page_list[] = esc_html__('-- Default value --', 'savemart');
        if (is_admin()) {
            $pages = get_posts(array('post_type' => $post_type, 'posts_per_page' => -1, 'orderby' => 'title', 'order' => 'ASC'));
            if (is_array($pages)) {
                foreach ($pages as $page) {
                    if ($type) {
                        $page_list[] = array(
                            'value' => $page->ID,
                            'label' => $page->post_title,
                        );
                    } else $page_list[$page->ID] = $page->post_title;
                }
            }
        }
        $post = $post_temp;
        return $page_list;
    }
}

// parse list page to select box theme options

if (!function_exists('tech888f_get_select_box_data')) {
    function tech888f_get_select_box_data($post_type = '')
    {
        $lst_option = array();
        $page_list = tech888f_get_list_post_type($post_type);
        var_dump($page_list);
        foreach ($page_list as $page) {
            array_push($lst_option, array(
                $page['value'] => $page['label']
            ));
        }
        var_dump($lst_option);
        return $lst_option;
    }
}

if (!function_exists('tech888f_get_post_list_specific')) {
    function tech888f_get_post_list_specific($style = 'element')
    {
        $list = apply_filters('tech888f_get_post_list_specific', array(
            '' => esc_html__('Default', 'ripara'),
            'style2' => esc_html__('Post list #2', 'ripara'),
        ));
        if ($style != 'element') {
            $temp = array();
            foreach ($list as $key => $value) {
                $temp[] = array(
                    'value' => $value,
                    'label' => $key,
                );
            }
            $list = $temp;
        }
        return $list;
    }
}
if (!function_exists('tech888f_get_post_grid_specific')) {
    function tech888f_get_post_grid_specific($style = 'element')
    {
        $list = apply_filters('tech888f_get_post_grid_specific', array(
            'default' => esc_html__('Default', 'ripara'),
            'style2' => esc_html__('Post grid #2', 'ripara'),
            'style3' => esc_html__('Post grid #3', 'ripara'),
            'related' => esc_html__('Post grid Related', 'ripara'),
        ));
        if ($style != 'element') {
            $temp = array();
            foreach ($list as $key => $value) {
                $temp[] = array(
                    'value' => $value,
                    'label' => $key,
                );
            }
            $list = $temp;
        }
        return $list;
    }
}

if (!function_exists('tech888f_get_product_list_specific')) {
    function tech888f_get_product_list_specific($style = 'element')
    {
        $list = apply_filters('tech888f_get_product_list_specific', array(
            '' => esc_html__('Default', 'ripara'),
            'style2' => esc_html__('Product List #2', 'ripara'),
        ));
        if ($style != 'element') {
            $temp = array();
            foreach ($list as $key => $value) {
                $temp[] = array(
                    'value' => $value,
                    'label' => $key,
                );
            }
            $list = $temp;
        }
        return $list;
    }
}
if (!function_exists('tech888f_get_product_grid_specific')) {
    function tech888f_get_product_grid_specific($style = 'element')
    {
        $list = apply_filters('tech888f_get_product_grid_specific', array(
            'default' => esc_html__('Default', 'ripara'),
            'style2' => esc_html__('Product grid 2', 'ripara'),
            'style3' => esc_html__('Product grid 3', 'ripara'),
        ));
        if ($style != 'element') {
            $temp = array();
            foreach ($list as $key => $value) {
                $temp[] = array(
                    'value' => $value,
                    'label' => $key,
                );
            }
            $list = $temp;
        }
        return $list;
    }
}

if (!function_exists('tech888f_get_product_thumb_animation')) {
    function tech888f_get_product_thumb_animation($style = 'element')
    {
        $list = apply_filters('tech888f_product_item_style', array(
            esc_html__('None', 'ripara') => '',
            esc_html__('Zoom', 'ripara') => 'zoom-thumb',
            esc_html__('Rotate', 'ripara') => 'rotate-thumb',
            esc_html__('Zoom Out', 'ripara') => 'zoomout-thumb',
            esc_html__('Translate', 'ripara') => 'translate-thumb',
            esc_html__('Float', 'ripara') => 'float-thumb',
        ));
        if ($style != 'element') {
            $temp = array();
            foreach ($list as $key => $value) {
                $temp[] = array(
                    'value' => $value,
                    'label' => $key,
                );
            }
            $list = $temp;
        }
        return $list;
    }
}

if (!function_exists('tech888f_add_html_attr')) {
    function tech888f_add_html_attr($value, $echo = false, $attr = 'style')
    {
        $output = '';
        if (!empty($attr)) {
            $output = $attr . '="' . $value . '"';
        }
        if ($echo) echo apply_filters('tech888f_output_content', $output);
        else return $output;
    }
}

if (!function_exists('tech888f_substr')) {
    function tech888f_substr($string = '', $start = 0, $end = 1)
    {
        $output = '';
        if (!empty($string)) {
            $string = strip_tags($string);
            if ($end < strlen($string)) {
                if ($string[$end] != ' ') {
                    for ($i = $end; $i < strlen($string); $i++) {
                        if ($string[$i] == ' ' || $string[$i] == '.' || $i == strlen($string) - 1) {
                            $end = $i;
                            break;
                        }
                    }
                }
            }
            $output = substr($string, $start, $end);
        }
        return $output;
    }
}

// Get sidebar position

if (!function_exists('tech888f_get_sidebar_pos')) {
    function tech888f_get_sidebar_pos($default = null)
    {
        //check default parameter and filter sidebar args

        if (empty($default)) {
            $default = array(
                'id' => 'blog-sidebar',
                'position' => 'right'
            );
        }
        if ($default['position'] = '') {
            $default = array(
                'id' => 'blog-sidebar',
                'position' => 'right'
            );
        }
        if (class_exists("woocommerce") && tech888f_is_woocommerce_page()) $default['id'] = 'woocommerce-sidebar';
        return apply_filters('tech888f_get_sidebar_pos', $default);
    }
}

// Option display Metabox

if(!function_exists('tech888f_display_metabox')){
    function tech888f_display_metabox($type =''){
        switch ($type) {
            case 'blog':
                break;
            default:
                ?>
                <ul class="list-inline-block post-meta-data">
                    <li><i class="fa fa-user gray" aria-hidden="true"></i><a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php echo get_the_author(); ?></a></li>
                    <li><i class="fa fa-calendar gray"></i><span class="silver"><?php echo get_the_date()?></span></li>
                    <li><i aria-hidden="true" class="fa fa-comment gray"></i>
                        <a href="<?php echo esc_url( get_comments_link() ); ?>"><?php echo get_comments_number(); ?>
                            <?php
                            if(get_comments_number() != 1) esc_html_e('Comments', '7upframework') ;
                            else esc_html_e('Comment', '7upframework') ;
                            ?>
                        </a>
                    </li>
                    <?php
                    $cats = get_the_category_list(' ');
                    if($cats):?>
                        <li><i class="fa fa-folder-open gray" aria-hidden="true"></i>
                            <?php echo apply_filters('tech888foutput_content',$cats);?>
                        </li>
                    <?php endif;?>
                    <?php
                    $tags = get_the_tag_list(' ',' ',' ');
                    if($tags):?>
                        <li><i class="fa fa-tags gray" aria-hidden="true"></i>
                            <?php $tags = get_the_tag_list(' ',' ',' ');?>
                            <?php if($tags) echo apply_filters('tech888foutput_content',$tags); else esc_html_e("No Tag",'7upframework');?>
                        </li>
                    <?php endif;?>
                </ul>
                <?php
                break;
        }
    }
}

// Set main class template

if (!function_exists('tech888f_set_main_class')) {
    function tech888f_get_main_class()
    {
        $sidebar = tech888f_get_sidebar_pos();
        $sidebar_pos = $sidebar['position'];
        $main_class = 'content-wrap col-md-12 col-sm-12 col-xs-12';
        //default template
        if ($sidebar_pos != 'no' && is_active_sidebar($sidebar['id']) && !is_product()) $main_class = 'content-wrap content-sidebar-' . $sidebar_pos . ' col-md-9 col-sm-8 col-xs-12';
        //product template
        elseif ($sidebar_pos != 'no' && is_active_sidebar($sidebar['id']) && is_product()) $main_class = 'content-wrap content-sidebar-' . $sidebar_pos . ' col-md-9 col-sm-8 col-xs-12';
        return apply_filters('tech888f_main_class', $main_class);
    }
}

if (!function_exists('tech888f_get_list_icons')) {
    function tech888f_get_list_icons()
    {
        $list_icon = array(
            'fontawesome' => 'Font Awesome',
            'openiconic' => 'Open Iconic',
            'typicons' => 'Type Icons',
        );
        return $list_icon;
    }
}

if (!function_exists('tech888f_get_google_fonts')) {
    function tech888f_get_google_fonts()
    {
        $font_url = '';
        $fonts = array(
            'Open Sans:300,400,700',
        );
        if ('off' !== _x('on', 'Google font: on or off', 'savemart')) {
            $fonts_url = add_query_arg(array(
                'family' => urlencode(implode('|', $fonts)),
            ), "//fonts.googleapis.com/css");
        }

        return $fonts_url;
    }
}

if (!function_exists('tech888f_filter_size_crop')) {
    function tech888f_filter_size_crop($size = '', $default = '')
    {
        if (!empty($size) && strpos($size, 'x')) {
            $size = str_replace('|', 'x', $size);
            $size = str_replace(',', 'x', $size);
            $size = explode('x', $size);
        }
        if (empty($size) && !empty($default)) $size = $default;
        return $size;
    }
}

//Check woocommerce page

if (!function_exists('tech888f_is_woocommerce_page')) {
    function tech888f_is_woocommerce_page()
    {
        if (function_exists("is_woocommerce") && is_woocommerce()) {
            return true;
        }
        $woocommerce_keys = array("woocommerce_shop_page_id",
            "woocommerce_terms_page_id",
            "woocommerce_cart_page_id",
            "woocommerce_checkout_page_id",
            "woocommerce_pay_page_id",
            "woocommerce_thanks_page_id",
            "woocommerce_myaccount_page_id",
            "woocommerce_edit_address_page_id",
            "woocommerce_view_order_page_id",
            "woocommerce_change_password_page_id",
            "woocommerce_logout_page_id",
            "woocommerce_lost_password_page_id");
        foreach ($woocommerce_keys as $wc_page_id) {
            if (get_the_ID() == get_option($wc_page_id, 0)) {
                return true;
            }
        }
        return false;
    }
}

//navigation
if (!function_exists('tech888f_get_page_navi')) {
    function tech888f_get_page_navi($query = false, $style = '', $echo = true)
    {
        if ($query) {
            $big = 999999999;
            $paged = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;
            $links = array(
                'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                'format' => '&page=%#%',
                'current' => max(1, $paged),
                'total' => $query->max_num_pages,
                'end_size' => 2,
                'mid_size' => 1
            );
        } else {
            if ($GLOBALS['wp_query']->max_num_pages < 2) {
                return;
            }

            $paged = get_query_var('paged') ? intval(get_query_var('paged')) : 1;
            $pagenum_link = html_entity_decode(get_pagenum_link());
            $query_args = array();
            $url_parts = explode('?', $pagenum_link);

            if (isset($url_parts[1])) {
                wp_parse_str($url_parts[1], $query_args);
            }

            $pagenum_link = remove_query_arg(array_keys($query_args), $pagenum_link);
            $pagenum_link = trailingslashit($pagenum_link) . '%_%';

            $format = $GLOBALS['wp_rewrite']->using_index_permalinks() && !strpos($pagenum_link, 'index.php') ? 'index.php/' : '';
            $format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit('page/%#%', 'paged') : '?paged=%#%';

            // Set up paginated links.
            $links = array(
                'base' => $pagenum_link,
                'format' => $format,
                'total' => $GLOBALS['wp_query']->max_num_pages,
                'current' => $paged,
                'end_size' => 2,
                'mid_size' => 1,
                'add_args' => array_map('urlencode', $query_args),
            );
        }
        $data = array(
            'links' => $links,
            'style' => $style,
        );
        $html = tech888f_get_template('page-navigation', false, $data, $echo);
        if (!$echo) return $html;
    }
}

/* Get current ID of page */

if (!function_exists('tech888f_get_curr_id')) {
    function tech888f_get_curr_id()
    {
        $id = get_the_ID();
        if (is_front_page() && is_home()) $id = (int)get_option('page_on_front');
        if (!is_front_page() && is_home()) $id = (int)get_option('page_for_posts');
        if (is_archive() || is_search()) $id = 0;
        if (class_exists('woocommerce')) {
            if (is_shop()) $id = (int)get_option('woocommerce_shop_page_id');
            if (is_cart()) $id = (int)get_option('woocommerce_cart_page_id');
            if (is_checkout()) $id = (int)get_option('woocommerce_checkout_page_id');
            if (is_account_page()) $id = (int)get_option('woocommerce_myaccount_page_id');
        }
        return $id;
    }
}

// Get sidebar
if (!function_exists('tech888f_get_template_sidebar')) {
    function tech888f_get_template_sidebar($position)
    {
        $sidebar = tech888f_get_sidebar_pos();
        $sidebar_pos = $sidebar['position'];
        if ($sidebar_pos == $position) {
            get_sidebar();
        }

    }
}


//Get current post/page ID

if(!function_exists('tech888f_get_current_id')){
    function tech888f_get_current_id(){
        $id = get_the_ID();
        if(is_front_page() && is_home()) $id = (int)get_option( 'page_on_front' );
        if(!is_front_page() && is_home()) $id = (int)get_option( 'page_for_posts' );
        if(is_archive() || is_search()) $id = 0;
        if (class_exists('woocommerce')) {
            if(is_shop()) $id = (int)get_option('woocommerce_shop_page_id');
            if(is_cart()) $id = (int)get_option('woocommerce_cart_page_id');
            if(is_checkout()) $id = (int)get_option('woocommerce_checkout_page_id');
            if(is_account_page()) $id = (int)get_option('woocommerce_myaccount_page_id');
        }
        return $id;
    }
}

// load icon lib

if(!function_exists('tech888f_default_icon_lib')){
    function tech888f_default_icon_lib(){
        $lib = tech888f_get_opt('tech888f_icon_lib','fontawesome');
        return $lib;
    }
}

//get roles wp
if(!function_exists('tech888f_get_list_role')){
    function tech888f_get_list_role(){
        global $wp_roles;
        $roles = array();
        if(isset($wp_roles->roles)){
            $roles_data = $wp_roles->roles;
            if(is_array($roles_data)){
                foreach ($roles_data as $key => $value) {
                    $roles[$value['name']] = $key;
                }
            }
        }
        return $roles;
    }
}
if(!function_exists('tech888f_get_post_style')){
    function tech888f_get_post_style($style = 'element'){
        $list = apply_filters('tech888f_post_item_style',array(
            esc_html__('Default','mptheme')      => 'default',
            esc_html__('Post grid 2','mptheme')      => 'style2',
            esc_html__('Post grid 3','mptheme')      => 'style3',
            esc_html__('Post grid 4','mptheme')      => 'style4',
            esc_html__('Post grid 5','mptheme')      => 'style5',
            esc_html__('Post Flex 1','mptheme')      => 'flex1',
        ));
        if($style != 'element'){
            $temp = array();
            foreach ($list as $key => $value) {
                $temp[] =   array(
                    'value' => $value,
                    'label' => $key,
                );
            }
            $list = $temp;
        }
        return $list;
    }
}
if(!function_exists('tech888f_get_post_list_style')){
    function tech888f_get_post_list_style($style = 'element'){
        $list = apply_filters('tech888f_post_list_item_style',array(
            esc_html__('Default','mptheme')      => '',
            esc_html__('Post list 1','mptheme')      => 'style1',
            esc_html__('Post list 2','mptheme')      => 'style2',
        ));
        if($style != 'element'){
            $temp = array();
            foreach ($list as $key => $value) {
                $temp[] =   array(
                    'value' => $value,
                    'label' => $key,
                );
            }
            $list = $temp;
        }
        return $list;
    }
}
// get list taxonomy
if(!function_exists('tech888f_list_taxonomy'))
{
    function tech888f_list_taxonomy($taxonomy,$show_all = true)
    {
        if($show_all) $list = array( esc_html__('--Select--','mptheme') => '' );
        else $list = array();
        if(!isset($taxonomy) || empty($taxonomy)) $taxonomy = 'category';
        $tags = get_terms($taxonomy);
        if(is_array($tags) && !empty($tags)){
            foreach ($tags as $tag) {
                $list[$tag->name] = $tag->slug;
            }
        }
        return $list;
    }
}

//Get order list
if(!function_exists('tech888f_get_order_list')){
    function tech888f_get_order_list($current=false,$extra=array(),$return='array'){
        $default = array(
            esc_html__('None','mptheme')               => 'none',
            esc_html__('ID','mptheme')                 => 'ID',
            esc_html__('Author','mptheme')             => 'author',
            esc_html__('Title','mptheme')              => 'title',
            esc_html__('Name','mptheme')               => 'name',
            esc_html__('Date','mptheme')               => 'date',
            esc_html__('Last Modified Date','mptheme') => 'modified',
            esc_html__('Post Parent','mptheme')        => 'parent',
        );

        if(!empty($extra) and is_array($extra))
        {
            $default=array_merge($default,$extra);
        }

        if($return=="array")
        {
            return $default;
        }elseif($return=='option')
        {
            $html='';
            if(!empty($default)){
                foreach($default as $key=>$value){
                    $selected=selected($key,$current,false);
                    $html.="<option {$selected} value='{$value}'>{$key}</option>";
                }
            }
            return $html;
        }
    }
}
//Get all page
if(!function_exists('tech888f_list_all_page')){
    function tech888f_list_all_page($complete = false){
        global $post;
        if(!$complete){
            $page_list = array(
                esc_html__('-- Choose One --','mptheme') => '',
            );
        }
        else $page_list = array();
        $pages = get_pages();
        foreach ($pages as $page) {
            if(!$complete) $page_list[$page->post_title] = $page->ID;
            else{
                $page_list[] = array(
                    'value' => $page->ID,
                    'label' => $page->post_title,
                );
            }
        }
        return $page_list;
    }
}
// Get list menu
if(!function_exists('tech888f_list_menu_name')){
    function tech888f_list_menu_name(){
        $menu_nav = wp_get_nav_menus();
        $menu_list = array('Default' => '');
        if(is_array($menu_nav) && !empty($menu_nav)){
            foreach($menu_nav as $item){
                if(is_object($item)){
                    $menu_list[$item->name] = $item->slug;
                }
            }
        }
        return $menu_list;
    }
}
if(!function_exists('tech888f_get_list_taxonomy')){
    function tech888f_get_list_taxonomy($taxonomy = 'product_cat') {
        $result = array();
        $tags = get_terms($taxonomy);
        if(is_array($tags) && !empty($tags)){
            foreach ($tags as $tag) {
                $list[$tag->name] = $tag->slug;
                $result[] = array(
                    'value' => $tag->slug,
                    'label' => $tag->name,
                );
            }
        }
        return $result;
    }
}
if(!function_exists('tech888f_get_portfolio_style')){
    function tech888f_get_portfolio_style($style = 'element'){
        $list = apply_filters('tech888f_portfolio_item_style',array(
            esc_html__('Default','mptheme')      => '',
            esc_html__('Portfolio flex','mptheme')      => 'flex',
        ));
        if($style != 'element'){
            $temp = array();
            foreach ($list as $key => $value) {
                $temp[] =   array(
                    'value' => $value,
                    'label' => $key,
                );
            }
            $list = $temp;
        }
        return $list;
    }
}
if(!function_exists('tech888f_get_product_style')){
    function tech888f_get_product_style($style = 'element'){
        $list = apply_filters('tech888f_product_item_style',array(
            esc_html__('Default','mptheme')      => '',
            esc_html__('Product grid 2','mptheme')      => 'style2',
            esc_html__('Product grid 3','mptheme')      => 'style3',
            esc_html__('Product grid 4','mptheme')      => 'style4',
            esc_html__('Product grid 5','mptheme')      => 'style5',
        ));
        if($style != 'element'){
            $temp = array();
            foreach ($list as $key => $value) {
                $temp[] =   array(
                    'value' => $value,
                    'label' => $key,
                );
            }
            $list = $temp;
        }
        return $list;
    }
}
if(!function_exists('tech888f_get_product_list_style')){
    function tech888f_get_product_list_style($style = 'element'){
        $list = apply_filters('tech888f_product_list_item_style',array(
            esc_html__('Default','mptheme')      => '',
            esc_html__('Product list 2','mptheme')      => 'style2',
        ));
        if($style != 'element'){
            $temp = array();
            foreach ($list as $key => $value) {
                $temp[] =   array(
                    'value' => $value,
                    'label' => $key,
                );
            }
            $list = $temp;
        }
        return $list;
    }
}
if(!function_exists('tech888f_get_list_attribute')){
    function tech888f_get_list_attribute() {
        $result = array();
        $attributes = wc_get_attribute_taxonomies();
        if(!empty($attributes)){
            foreach ($attributes as $attribute) {
                $result[$attribute->attribute_label] = $attribute->attribute_name;
            }
        }
        return $result;
    }
}
if(!function_exists('tech888f_get_sidebar_list')){
    function tech888f_get_sidebar_list(){
        global $wp_registered_sidebars;
        $sidebars = array(
            esc_html__('--Select--','mptheme') => ''
        );
        foreach( $wp_registered_sidebars as $id=>$sidebar ) {
            $sidebars[ $sidebar[ 'name' ] ] = $id;
        }
        return $sidebars;
    }
}

//responsive option page builder

if(!function_exists('tech888f_get_responsive_default_atts')){
    function tech888f_get_responsive_default_atts(){
        $default = array(
            'bb_tab_container' =>  '',
            'tech888f_x_large_css' =>  '',
            'tech888f_x_large_csstypo' =>  '',
            'tech888f_x_large_cssshow_hide' =>  'yes',
            'tech888f_large_css' =>  '',
            'tech888f_large_csstypo' =>  '',
            'tech888f_large_cssshow_hide' =>  'yes',
            'tech888f_medium_css' =>  '',
            'tech888f_medium_csstypo' =>  '',
            'tech888f_medium_cssshow_hide' =>  'yes',
            'tech888f_small_css' =>  '',
            'tech888f_small_csstypo' =>  '',
            'tech888f_small_cssshow_hide' =>  'yes',
            'tech888f_s_small_css' =>  '',
            'tech888f_s_small_csstypo' =>  '',
            'tech888f_s_small_cssshow_hide' =>  'yes',
        );
        return apply_filters('tech888f_responsive_default_atts',$default);
    }
}

/* get template section */

if (!function_exists('tech888f_get_template')) {
    function tech888f_get_template($view_name, $slug = false, $data = array(), $echo = false)
    {
        $html = Tech888f_Template::load_template_view($view_name, $slug, $data, $echo);
        if (!$echo) return $html;
    }
}
if (!function_exists('tech888f_get_template_post')) {
    function tech888f_get_template_post($view_name, $slug = false, $data = array(), $echo = FALSE)
    {
        $view_name = 'blog/' . $view_name;
        $html = Tech888f_Template::load_template_view($view_name, $slug, $data, $echo);
        if (!$echo) return $html;
    }
}
if(!function_exists('tech888f_get_template_portfolio')){
    function tech888f_get_template_portfolio( $view_name,$slug=false,$data=array(),$echo=FALSE ){
        $view_name = 'portfolios/'.$view_name;
        $html = Tech888f_Template::load_template_view($view_name,$slug,$data,$echo);
        if(!$echo) return $html;
    }
}
if(!function_exists('tech888f_get_template_element')){
    function tech888f_get_template_element( $view_name,$slug=false,$data=array(),$echo=FALSE ){
        $view_name = 'elements/'.$view_name;
        $html = Tech888f_Template::load_template_view($view_name,$slug,$data,$echo);
        if(!$echo) return $html;
    }
}
if(!function_exists('tech888f_get_template_product')){
    function tech888f_get_template_product( $view_name,$slug=false,$data=array(),$echo=FALSE ){
        $view_name = 'products/'.$view_name;
        $html = Tech888f_Template::load_template_view($view_name,$slug,$data,$echo);
        if(!$echo) return $html;
    }
}
if(!function_exists('tech888f_get_template_portfolio')){
    function tech888f_get_template_portfolio( $view_name,$slug=false,$data=array(),$echo=FALSE ){
        $view_name = 'portfolios/'.$view_name;
        $html = Tech888f_Template::load_template_view($view_name,$slug,$data,$echo);
        if(!$echo) return $html;
    }
}
if(!function_exists('tech888f_get_template_woocommerce')){
    function tech888f_get_template_woocommerce( $view_name,$slug=false,$data=array(),$echo=FALSE ){
        $view_name = 'woocommerce/'.$view_name;
        $html = Tech888f_Template::load_template_view($view_name,$slug,$data,$echo);
        if(!$echo) return $html;
    }
}
if(!function_exists('tech888f_get_template_widget')){
    function tech888f_get_template_widget( $view_name,$slug=false,$data=array(),$echo=FALSE ){
        $view_name = 'widgets/'.$view_name;
        $html = Tech888f_Template::load_template_view($view_name,$slug,$data,$echo);
        if(!$echo) return $html;
    }
}

if (!function_exists('tech888f_get_theme_option_template')) {
    function tech888f_get_theme_option_template($view_name, $echo = false)
    {
        $sub_section = Tech888f_Template::load_them_option_data($view_name, $echo);
        if (!$echo) return $sub_section;
    }
}

// theme library function

// cropsize format '100x100'

if(!function_exists('tech888f_get_size_crop')){
    function tech888f_get_size_crop($size='',$default=''){
        if(!empty($size) && strpos($size, 'x')){
            $size = str_replace('|', 'x', $size);
            $size = str_replace(',', 'x', $size);
            $size = explode('x', $size);
        }
        if(empty($size) && !empty($default)) $size = $default;
        return $size;
    }
}

// check is vendor page
if(!function_exists('tech888f_is_vendor_page')){
    function tech888f_is_vendor_page(){
        $check  = false;
        if(class_exists('WCV_Vendors')){
            $vendor_shop = urldecode( get_query_var( 'vendor_shop' ) );
            $vendor_id   = WCV_Vendors::get_vendor_id( $vendor_shop );
            if ( $vendor_id ) {
                $check = true;
            }
        }
        return $check;
    }
}

//Set post view
if(!function_exists('tech888f_set_post_view')){
    function tech888f_set_post_view($post_id=false){
        if(!$post_id) $post_id=get_the_ID();
        $view=(int)get_post_meta($post_id,'post_views',true);
        $view++;
        update_post_meta($post_id,'post_views',$view);
    }
}

// product single function

if(!function_exists('tech888f_get_single_product_class_sidebar')){
    function tech888f_get_single_product_class_sidebar(){
        //check sidebar position according theme option
        $sidebar_pos = tech888f_get_opt('sv_sidebar_position_woo_single');
        $sidebar_id = tech888f_get_opt('sv_sidebar_woo_single');

        //check sidebar position according product metabox

        $sidebar_post_mtb = tech888f_get_opt('tech888f_sidebar_position');

        if(!empty($sidebar_post_mtb) && $sidebar_pos != $sidebar_post_mtb){
            $sidebar_pos = $sidebar_post_mtb;
            $sidebar_id_mtb = tech888f_get_opt('tech888f_select_sidebar');
            if(!empty($sidebar_id_mtb) && $sidebar_id != $sidebar_id_mtb){
                $sidebar_id = $sidebar_id_mtb;
            }
        }
        if(tech888f_is_vendor_page()){
            $sidebar_pos = 'no';
        }
        if(($sidebar_pos) != 'no' && is_active_sidebar( $sidebar_id) && is_product()):
            $detail_prd_class = 'col-md-9 col-sm-8 col-xs-12';
        else: $detail_prd_class = 'col-md-12 col-sm-12 col-xs-12';
        endif;
        $sidebar_info = array(
            'detail_prd_class' => $detail_prd_class,
            'sidebar_pos'      => $sidebar_pos,
            'sidebar_id'       => $sidebar_id,
        );
        return apply_filters('tech888f_single_product_class',$sidebar_info);
    }
}