<?php
/**
 * Created by PhpStorm.
 * User: toanngo92
 * Date: 2/2/2019
 * Time: 7:33 PM
 */

if(!function_exists('tech888f_default_config')){
    function tech888f_default_config(){
        /* declare global config and dir */

        global $tech888f_dir,$global_config,$tech888f_res;

        /* End declare global config and dir */

        $tech888f_dir = get_template_directory_uri() . '/888core';
        $tech888f_res = get_template_directory_uri() . '/resources';
        $global_config = array();
        $global_config['dir'] = $tech888f_dir;
        $global_config['css_url'] = $tech888f_dir . '/resources/css/';
        $global_config['js_url'] = $tech888f_dir . '/resources/js/';
        $global_config['bootstrap_version'] = '3';
        $global_config['nav_menu'] = array(
            'primary' => esc_html__( 'Primary Navigation', 'ripara' ),
        );
        $global_config['extra_page'] = '1';
        $global_config['sidebars']=array(
            array(
                'name'              => esc_html__( 'Blog Sidebar', 'ripara' ),
                'id'                => 'blog-sidebar',
                'description'       => esc_html__( 'Widgets in this area will be shown on all blog page.', 'ripara'),
                'before_title'      => '<h3 class="widget-title">',
                'after_title'       => '</h3>',
                'before_widget'     => '<div id="%1$s" class="sidebar-widget widget %2$s">',
                'after_widget'      => '</div>',
            )
        );
        if(class_exists("woocommerce")){
            $global_config['sidebars'][] = array(
                'name'              => esc_html__( 'Woocommerce Sidebar', 'ripara' ),
                'id'                => 'woocommerce-sidebar',
                'description'       => esc_html__( 'Widgets in this area will be shown on all woocommerce page.', 'ripara'),
                'before_title'      => '<h3 class="widget-title">',
                'after_title'       => '</h3>',
                'before_widget'     => '<div id="%1$s" class="sidebar-widget widget %2$s">',
                'after_widget'      => '</div>',
            );
        }
        $global_config['import_config'] = array(
            'demo_url'                  => 'http://7uptheme.com/wordpress/framework2',
            'homepage_default'          => 'Home',
            'blogpage_default'          => 'Blog',
            'menu_replace'              => 'Main Menu',
            'menu_locations'            => array("Main Menu" => "primary"),
            'set_woocommerce_page'      => 1
        );
        $global_config['import_theme_option'] = 'YToxMTI6e3M6MTc6InM3dXBmX2hlYWRlcl9wYWdlIjtzOjQ6IjIzODIiO3M6MTc6InM3dXBmX2Zvb3Rlcl9wYWdlIjtzOjM6Ijg5MSI7czoxNDoiczd1cGZfNDA0X3BhZ2UiO3M6MDoiIjtzOjIwOiJzN3VwZl80MDRfcGFnZV9zdHlsZSI7czowOiIiO3M6MTg6ImJlZm9yZV9hcHBlbmRfcGFnZSI7czowOiIiO3M6MTc6ImFmdGVyX2FwcGVuZF9wYWdlIjtzOjA6IiI7czoyMDoiczd1cGZfc2hvd19icmVhZHJ1bWIiO3M6Mjoib24iO3M6MTk6InM3dXBmX2JnX2JyZWFkY3J1bWIiO2E6Njp7czoxNjoiYmFja2dyb3VuZC1jb2xvciI7czowOiIiO3M6MTc6ImJhY2tncm91bmQtcmVwZWF0IjtzOjk6Im5vLXJlcGVhdCI7czoyMToiYmFja2dyb3VuZC1hdHRhY2htZW50IjtzOjc6ImluaGVyaXQiO3M6MTk6ImJhY2tncm91bmQtcG9zaXRpb24iO3M6MTM6ImNlbnRlciBjZW50ZXIiO3M6MTU6ImJhY2tncm91bmQtc2l6ZSI7czo1OiJjb3ZlciI7czoxNjoiYmFja2dyb3VuZC1pbWFnZSI7czo5ODoiaHR0cDovLzd1cHRoZW1lLmNvbS93b3JkcHJlc3MvcmlwYXJhL3dwLWNvbnRlbnQvdXBsb2Fkcy8yMDE5LzAxL2JhY2tncm91bmQtc2VjdGlvbi1lbWFpbC1obTEtMS5qcGciO31zOjE1OiJicmVhZGNydW1iX3RleHQiO2E6MTA6e3M6MTA6ImZvbnQtY29sb3IiO3M6NzoiI2ZmZmZmZiI7czoxMToiZm9udC1mYW1pbHkiO3M6MDoiIjtzOjk6ImZvbnQtc2l6ZSI7czowOiIiO3M6MTA6ImZvbnQtc3R5bGUiO3M6MDoiIjtzOjEyOiJmb250LXZhcmlhbnQiO3M6MDoiIjtzOjExOiJmb250LXdlaWdodCI7czowOiIiO3M6MTQ6ImxldHRlci1zcGFjaW5nIjtzOjA6IiI7czoxMToibGluZS1oZWlnaHQiO3M6MDoiIjtzOjE1OiJ0ZXh0LWRlY29yYXRpb24iO3M6MDoiIjtzOjE0OiJ0ZXh0LXRyYW5zZm9ybSI7czowOiIiO31zOjIxOiJicmVhZGNydW1iX3RleHRfaG92ZXIiO3M6MDoiIjtzOjEyOiJzaG93X3ByZWxvYWQiO3M6Mzoib2ZmIjtzOjEwOiJwcmVsb2FkX2JnIjtzOjA6IiI7czoxMzoicHJlbG9hZF9zdHlsZSI7czo2OiJzdHlsZTMiO3M6MTE6InByZWxvYWRfaW1nIjtzOjkxOiJodHRwOi8vN3VwdGhlbWUuY29tL3dvcmRwcmVzcy9yaXBhcmEvZnJhbWV3b3JrL3dwLWNvbnRlbnQvdXBsb2Fkcy8yMDE3LzExL1JvY2tldC0zRC0wMDEuZ2lmIjtzOjE0OiJzN3VwZl9pY29uX2xpYiI7czoxMToiZm9udGF3ZXNvbWUiO3M6MTU6InNob3dfc2Nyb2xsX3RvcCI7czoyOiJvbiI7czoyNjoic2hvd193aXNobGlzdF9ub3RpZmljYXRpb24iO3M6Mjoib24iO3M6MTQ6InNob3dfdG9vX3BhbmVsIjtzOjM6Im9mZiI7czoxNToidG9vbF9wYW5lbF9wYWdlIjtzOjM6IjU2NSI7czoxMjoic2Vzc2lvbl9wYWdlIjtzOjM6Im9mZiI7czo3OiJib2R5X2JnIjtzOjc6IiNmMmYyZjIiO3M6MTA6Im1haW5fY29sb3IiO3M6MDoiIjtzOjExOiJtYWluX2NvbG9yMiI7czowOiIiO3M6MTY6InM3dXBmX3BhZ2Vfc3R5bGUiO3M6MDoiIjtzOjE1OiJjb250YWluZXJfd2lkdGgiO3M6MDoiIjtzOjExOiJtYXBfYXBpX2tleSI7czowOiIiO3M6MTc6InBvc3Rfc2luZ2xlX3NoYXJlIjthOjI6e2k6MDtzOjQ6InBvc3QiO2k6MjtzOjc6InByb2R1Y3QiO31zOjIyOiJwb3N0X3NpbmdsZV9zaGFyZV9saXN0IjthOjc6e2k6MDthOjM6e3M6NToidGl0bGUiO3M6ODoiRmFjZWJvb2siO3M6Njoic29jaWFsIjtzOjg6ImZhY2Vib29rIjtzOjY6Im51bWJlciI7czozOiJvZmYiO31pOjE7YTozOntzOjU6InRpdGxlIjtzOjc6InR3aXR0ZXIiO3M6Njoic29jaWFsIjtzOjc6InR3aXR0ZXIiO3M6NjoibnVtYmVyIjtzOjM6Im9mZiI7fWk6MjthOjM6e3M6NToidGl0bGUiO3M6MTA6Ikdvb2dsZVBsdXMiO3M6Njoic29jaWFsIjtzOjY6Imdvb2dsZSI7czo2OiJudW1iZXIiO3M6Mzoib2ZmIjt9aTozO2E6Mzp7czo1OiJ0aXRsZSI7czo5OiJQaW50ZXJlc3QiO3M6Njoic29jaWFsIjtzOjk6InBpbnRlcmVzdCI7czo2OiJudW1iZXIiO3M6Mzoib2ZmIjt9aTo0O2E6Mzp7czo1OiJ0aXRsZSI7czo4OiJMaW5rZWRpbiI7czo2OiJzb2NpYWwiO3M6ODoibGlua2VkaW4iO3M6NjoibnVtYmVyIjtzOjM6Im9mZiI7fWk6NTthOjM6e3M6NToidGl0bGUiO3M6NjoiVHVtYmxyIjtzOjY6InNvY2lhbCI7czo2OiJ0dW1ibHIiO3M6NjoibnVtYmVyIjtzOjM6Im9mZiI7fWk6NjthOjM6e3M6NToidGl0bGUiO3M6NToiRW1haWwiO3M6Njoic29jaWFsIjtzOjg6ImVudmVsb3BlIjtzOjY6Im51bWJlciI7czozOiJvZmYiO319czoyMToiZGlzYWJsZV92ZXJpZnlfbm90aWNlIjtzOjM6Im9mZiI7czoxNjoic2Nyb2xsX3RvcF9zdHlsZSI7czo2OiJzdHlsZTEiO3M6MTM6InN2X21lbnVfY29sb3IiO3M6MDoiIjtzOjE5OiJzdl9tZW51X2NvbG9yX2hvdmVyIjtzOjA6IiI7czoyMDoic3ZfbWVudV9jb2xvcl9hY3RpdmUiO3M6MDoiIjtzOjE0OiJzdl9tZW51X2NvbG9yMiI7czowOiIiO3M6MjA6InN2X21lbnVfY29sb3JfaG92ZXIyIjtzOjA6IiI7czoyMToic3ZfbWVudV9jb2xvcl9hY3RpdmUyIjtzOjA6IiI7czoxODoiYmVmb3JlX2FwcGVuZF9wb3N0IjtzOjA6IiI7czoxNzoiYWZ0ZXJfYXBwZW5kX3Bvc3QiO3M6MDoiIjtzOjI3OiJzN3VwZl9zaWRlYmFyX3Bvc2l0aW9uX2Jsb2ciO3M6NToicmlnaHQiO3M6MTg6InM3dXBmX3NpZGViYXJfYmxvZyI7czoxMjoiYmxvZy1zaWRlYmFyIjtzOjE4OiJibG9nX2RlZmF1bHRfc3R5bGUiO3M6NDoibGlzdCI7czoxMDoiYmxvZ19zdHlsZSI7czowOiIiO3M6MTg6ImJsb2dfbnVtYmVyX2ZpbHRlciI7czoyOiJvbiI7czoxNjoiYmxvZ190eXBlX2ZpbHRlciI7czoyOiJvbiI7czoxNDoicG9zdF9saXN0X3NpemUiO3M6MDoiIjtzOjIwOiJwb3N0X2xpc3RfaXRlbV9zdHlsZSI7czowOiIiO3M6MTc6InBvc3RfbGlzdF9leGNlcnB0IjtzOjM6IjIwMCI7czoxNjoicG9zdF9ncmlkX2NvbHVtbiI7czoxOiIzIjtzOjE0OiJwb3N0X2dyaWRfc2l6ZSI7czowOiIiO3M6MTc6InBvc3RfZ3JpZF9leGNlcnB0IjtzOjI6IjgwIjtzOjIwOiJwb3N0X2dyaWRfaXRlbV9zdHlsZSI7czowOiIiO3M6MTQ6InBvc3RfZ3JpZF90eXBlIjtzOjA6IiI7czoyNzoiczd1cGZfc2lkZWJhcl9wb3NpdGlvbl9wb3N0IjtzOjU6InJpZ2h0IjtzOjE4OiJzN3VwZl9zaWRlYmFyX3Bvc3QiO3M6MTI6ImJsb2ctc2lkZWJhciI7czoyMToicG9zdF9zaW5nbGVfdGh1bWJuYWlsIjtzOjI6Im9uIjtzOjE2OiJwb3N0X3NpbmdsZV9zaXplIjtzOjA6IiI7czoxNjoicG9zdF9zaW5nbGVfbWV0YSI7czoyOiJvbiI7czoxODoicG9zdF9zaW5nbGVfYXV0aG9yIjtzOjI6Im9uIjtzOjIyOiJwb3N0X3NpbmdsZV9uYXZpZ2F0aW9uIjtzOjI6Im9uIjtzOjE5OiJwb3N0X3NpbmdsZV9yZWxhdGVkIjtzOjI6Im9uIjtzOjI1OiJwb3N0X3NpbmdsZV9yZWxhdGVkX3RpdGxlIjtzOjA6IiI7czoyNjoicG9zdF9zaW5nbGVfcmVsYXRlZF9udW1iZXIiO3M6MDoiIjtzOjI0OiJwb3N0X3NpbmdsZV9yZWxhdGVkX2l0ZW0iO3M6MDoiIjtzOjMwOiJwb3N0X3NpbmdsZV9yZWxhdGVkX2l0ZW1fc3R5bGUiO3M6MTM6InN0eWxlLXJlbGF0ZWQiO3M6Mjc6InM3dXBmX3NpZGViYXJfcG9zaXRpb25fcGFnZSI7czoyOiJubyI7czoxODoiczd1cGZfc2lkZWJhcl9wYWdlIjtzOjA6IiI7czozNToiczd1cGZfc2lkZWJhcl9wb3NpdGlvbl9wYWdlX2FyY2hpdmUiO3M6NToicmlnaHQiO3M6MjY6InM3dXBmX3NpZGViYXJfcGFnZV9hcmNoaXZlIjtzOjEyOiJibG9nLXNpZGViYXIiO3M6MzQ6InM3dXBmX3NpZGViYXJfcG9zaXRpb25fcGFnZV9zZWFyY2giO3M6NToicmlnaHQiO3M6MjU6InM3dXBmX3NpZGViYXJfcGFnZV9zZWFyY2giO3M6MTI6ImJsb2ctc2lkZWJhciI7czoxNzoiczd1cGZfYWRkX3NpZGViYXIiO2E6Mzp7aTowO2E6Mjp7czo1OiJ0aXRsZSI7czoxOToiV29vY29tbWVyY2UgU2lkZWJhciI7czoyMDoid2lkZ2V0X3RpdGxlX2hlYWRpbmciO3M6MjoiaDMiO31pOjE7YToyOntzOjU6InRpdGxlIjtzOjIwOiJFeHRyYSBGaWx0ZXIgU2lkZWJhciI7czoyMDoid2lkZ2V0X3RpdGxlX2hlYWRpbmciO3M6MjoiaDMiO31pOjI7YToyOntzOjU6InRpdGxlIjtzOjE1OiJQcm9kdWN0IFNpZGViYXIiO3M6MjA6IndpZGdldF90aXRsZV9oZWFkaW5nIjtzOjI6ImgzIjt9fXM6MTI6Imdvb2dsZV9mb250cyI7YToyOntpOjA7YTozOntzOjY6ImZhbWlseSI7czo2OiJyb2JvdG8iO3M6ODoidmFyaWFudHMiO2E6MTI6e2k6MDtzOjM6IjEwMCI7aToxO3M6OToiMTAwaXRhbGljIjtpOjI7czozOiIzMDAiO2k6MztzOjk6IjMwMGl0YWxpYyI7aTo0O3M6NzoicmVndWxhciI7aTo1O3M6NjoiaXRhbGljIjtpOjY7czozOiI1MDAiO2k6NztzOjk6IjUwMGl0YWxpYyI7aTo4O3M6MzoiNzAwIjtpOjk7czo5OiI3MDBpdGFsaWMiO2k6MTA7czozOiI5MDAiO2k6MTE7czo5OiI5MDBpdGFsaWMiO31zOjc6InN1YnNldHMiO2E6NTp7aTowO3M6NToibGF0aW4iO2k6MTtzOjg6ImN5cmlsbGljIjtpOjI7czoxMjoiY3lyaWxsaWMtZXh0IjtpOjM7czo5OiJsYXRpbi1leHQiO2k6NDtzOjEwOiJ2aWV0bmFtZXNlIjt9fWk6MTthOjM6e3M6NjoiZmFtaWx5IjtzOjY6Im9zd2FsZCI7czo4OiJ2YXJpYW50cyI7YTo2OntpOjA7czozOiIyMDAiO2k6MTtzOjM6IjMwMCI7aToyO3M6NzoicmVndWxhciI7aTozO3M6MzoiNTAwIjtpOjQ7czozOiI2MDAiO2k6NTtzOjM6IjcwMCI7fXM6Nzoic3Vic2V0cyI7YToyOntpOjA7czo5OiJsYXRpbi1leHQiO2k6MTtzOjEwOiJ2aWV0bmFtZXNlIjt9fX1zOjI2OiJzN3VwZl9zaWRlYmFyX3Bvc2l0aW9uX3dvbyI7czo1OiJyaWdodCI7czoxNzoiczd1cGZfc2lkZWJhcl93b28iO3M6MTk6Indvb2NvbW1lcmNlLXNpZGViYXIiO3M6MTg6InNob3BfZGVmYXVsdF9zdHlsZSI7czo0OiJncmlkIjtzOjE2OiJzaG9wX2dhcF9wcm9kdWN0IjtzOjA6IiI7czoxNToid29vX3Nob3BfbnVtYmVyIjtzOjI6IjEyIjtzOjE1OiJzdl9zZXRfdGltZV93b28iO3M6MDoiIjtzOjEwOiJzaG9wX3N0eWxlIjtzOjA6IiI7czo5OiJzaG9wX2FqYXgiO3M6Mzoib2ZmIjtzOjIwOiJzaG9wX3RodW1iX2FuaW1hdGlvbiI7czoxMToiZmxvYXQtdGh1bWIiO3M6MTg6InNob3BfbnVtYmVyX2ZpbHRlciI7czoyOiJvbiI7czoxNjoic2hvcF90eXBlX2ZpbHRlciI7czoyOiJvbiI7czoxNjoic2hvcF9hdHRyX2ZpbHRlciI7czozOiJvZmYiO3M6MTk6InNob3BfaGlkZGVuX3NpZGViYXIiO3M6Mzoib2ZmIjtzOjE0OiJzaG9wX2xpc3Rfc2l6ZSI7czowOiIiO3M6MjA6InNob3BfbGlzdF9pdGVtX3N0eWxlIjtzOjA6IiI7czoxNjoic2hvcF9ncmlkX2NvbHVtbiI7czoxOiIzIjtzOjE0OiJzaG9wX2dyaWRfc2l6ZSI7czowOiIiO3M6MjA6InNob3BfZ3JpZF9pdGVtX3N0eWxlIjtzOjA6IiI7czoxNDoic2hvcF9ncmlkX3R5cGUiO3M6MDoiIjtzOjIxOiJzN3VwZl9oZWFkZXJfcGFnZV93b28iO3M6MDoiIjtzOjIxOiJzN3VwZl9mb290ZXJfcGFnZV93b28iO3M6MDoiIjtzOjE3OiJiZWZvcmVfYXBwZW5kX3dvbyI7czowOiIiO3M6MTY6ImFmdGVyX2FwcGVuZF93b28iO3M6MDoiIjtzOjMwOiJzdl9zaWRlYmFyX3Bvc2l0aW9uX3dvb19zaW5nbGUiO3M6NToicmlnaHQiO3M6MjE6InN2X3NpZGViYXJfd29vX3NpbmdsZSI7czoxNToicHJvZHVjdC1zaWRlYmFyIjtzOjE4OiJwcm9kdWN0X2ltYWdlX3pvb20iO3M6MTE6Inpvb20tc3R5bGUyIjtzOjE4OiJwcm9kdWN0X3RhYl9kZXRhaWwiO3M6MTA6InRhYi1zdHlsZTIiO3M6MTk6InByb2R1Y3RfaW1hZ2Vfc3R5bGUiO3M6MDoiIjtzOjEyOiJzaG93X2V4Y2VycHQiO3M6Mjoib24iO3M6MTE6InNob3dfbGF0ZXN0IjtzOjM6Im9mZiI7czoxMToic2hvd191cHNlbGwiO3M6Mjoib24iO3M6MTI6InNob3dfcmVsYXRlZCI7czoyOiJvbiI7czoxODoic2hvd19zaW5nbGVfbnVtYmVyIjtzOjE6IjYiO3M6MTY6InNob3dfc2luZ2xlX3NpemUiO3M6MDoiIjtzOjE5OiJzaG93X3NpbmdsZV9pdGVtcmVzIjtzOjA6IiI7czoyMjoic2hvd19zaW5nbGVfaXRlbV9zdHlsZSI7czowOiIiO3M6MjQ6ImJlZm9yZV9hcHBlbmRfd29vX3NpbmdsZSI7czowOiIiO3M6MTc6ImJlZm9yZV9hcHBlbmRfdGFiIjtzOjA6IiI7czoxNjoiYWZ0ZXJfYXBwZW5kX3RhYiI7czowOiIiO3M6MjM6ImFmdGVyX2FwcGVuZF93b29fc2luZ2xlIjtzOjA6IiI7fQ==';
        $global_config['import_widget'] = '{"blog-sidebar":{"search-4":{"title":""},"categories-6":{"title":"","count":1,"hierarchical":0,"dropdown":0},"tag_cloud-6":{"title":"Browse Tags","count":0,"taxonomy":"post_tag"},"mc4wp_form_widget-2":{"title":"Newsletter"},"tech888f_listpostswidget-4":{"title":"Popular Post","posts_per_page":"5","category":"0","order":"desc","order_by":"none"},"text-2":{"title":"INSTAGRAM","text":"<div class=\"img-widg-wrap\"><a href=\"https:\/\/instagram.com\"><img class=\"alignnone size-medium wp-image-2359\" src=\"http:\/\/7uptheme.com\/wordpress\/ripara\/wp-content\/uploads\/2018\/10\/img-insta-4-300x300.jpg\" alt=\"\" width=\"300\" height=\"300\" \/><\/a> <a href=\"https:\/\/instagram.com\"><img class=\"alignnone size-medium wp-image-2358\" src=\"http:\/\/7uptheme.com\/wordpress\/ripara\/wp-content\/uploads\/2018\/10\/img-insta-3-300x300.jpg\" alt=\"\" width=\"300\" height=\"300\" \/><\/a> <a href=\"https:\/\/instagram.com\"><img class=\"alignnone size-medium wp-image-2357\" src=\"http:\/\/7uptheme.com\/wordpress\/ripara\/wp-content\/uploads\/2018\/10\/img-insta-2-300x300.jpg\" alt=\"\" width=\"300\" height=\"300\" \/><\/a> <a href=\"https:\/\/instagram.com\"><img class=\"alignnone size-medium wp-image-2356\" src=\"http:\/\/7uptheme.com\/wordpress\/ripara\/wp-content\/uploads\/2018\/10\/img-insta-1-300x300.jpg\" alt=\"\" width=\"300\" height=\"300\" \/><\/a><\/div>","filter":true,"visual":true}},"woocommerce-sidebar":{"woocommerce_product_search-2":{"title":""},"woocommerce_product_categories-3":{"title":"Categories","orderby":"name","dropdown":0,"count":1,"hierarchical":0,"show_children_only":0,"hide_empty":1,"max_depth":""},"woocommerce_product_tag_cloud-3":{"title":"Browse tags"},"tech888f_price_filter-6":{"title":"PRICE"},"tech888f_attribute_filter-6":{"title":"Filter by Color","attribute":"product-color"},"tech888f_list_products-3":{"title":"Top rated products","number":"3","product_type":"toprate"},"text-4":{"title":"INSTAGRAM","text":"<div class=\"img-widg-wrap\"><a href=\"https:\/\/instagram.com\"><img class=\"alignnone size-medium wp-image-2359\" src=\"http:\/\/7uptheme.com\/wordpress\/ripara\/wp-content\/uploads\/2018\/10\/img-insta-4-300x300.jpg\" alt=\"\" width=\"300\" height=\"300\" \/><\/a> <a href=\"https:\/\/instagram.com\"><img class=\"alignnone size-medium wp-image-2358\" src=\"http:\/\/7uptheme.com\/wordpress\/ripara\/wp-content\/uploads\/2018\/10\/img-insta-3-300x300.jpg\" alt=\"\" width=\"300\" height=\"300\" \/><\/a> <a href=\"https:\/\/instagram.com\"><img class=\"alignnone size-medium wp-image-2357\" src=\"http:\/\/7uptheme.com\/wordpress\/ripara\/wp-content\/uploads\/2018\/10\/img-insta-2-300x300.jpg\" alt=\"\" width=\"300\" height=\"300\" \/><\/a> <a href=\"https:\/\/instagram.com\"><img class=\"alignnone size-medium wp-image-2356\" src=\"http:\/\/7uptheme.com\/wordpress\/ripara\/wp-content\/uploads\/2018\/10\/img-insta-1-300x300.jpg\" alt=\"\" width=\"300\" height=\"300\" \/><\/a><\/div>","filter":true,"visual":true}},"extra-filter-sidebar":{"woocommerce_product_categories-4":{"title":"Product categories","orderby":"name","dropdown":0,"count":1,"hierarchical":1,"show_children_only":0,"hide_empty":1,"max_depth":""},"tech888f_attribute_filter-2":{"title":"Filter by size","attribute":"product-size"},"tech888f_attribute_filter-3":{"title":"Filter by Color","attribute":"product-color"},"tech888f_price_filter-4":{"title":"PRICE"}},"product-sidebar":{"woocommerce_product_categories-5":{"title":"Product categories","orderby":"name","dropdown":0,"count":1,"hierarchical":0,"show_children_only":0,"hide_empty":1,"max_depth":""},"tech888f_list_products-2":{"title":"Top rated products","number":"3","product_type":"toprate"}}}';
        $global_config['import_category'] = '{,"body-engine":{"thumbnail":"","parent":""},"car-furniture":{"thumbnail":"0","parent":""},"engine-frame":{"thumbnail":"0","parent":""},"lamps-light-car":{"thumbnail":"0","parent":""},"other-parts":{"thumbnail":"0","parent":""},"wheel-collection":{"thumbnail":"","parent":""}}';

        /**************************************** PLUGINS ****************************************/

        $global_config['require-plugin-begin'] = array(
            array(
                'name'      => esc_html__( 'Tech888 Framework', 'ripara'),
                'slug'      => 'tech888-framework',
                'required'  => true,
                'source'    =>get_template_directory().'/resources/plugins/tech888-framework.zip',
                'version'   => '1.0',
            ),
        );

        $global_config['require-plugin'] = array(
            array(
                'name'      => esc_html__( 'Tech888 Framework', 'ripara'),
                'slug'      => 'tech888-framework',
                'required'  => true,
                'source'    =>get_template_directory().'/resources/plugins/tech888-framework.zip',
                'version'   => '1.3',
            ),
            array(
                'name'      => esc_html__( 'WpBakery Page Builder', 'ripara'),
                'slug'      => 'js_composer',
                'required'  => true,
                'source'    => get_template_directory().'/resources/plugins/js_composer.zip',
                'version'   => '5.6',
            ),
            array(
                'name'      => esc_html__( 'WooCommerce', 'ripara'),
                'slug'      => 'woocommerce',
                'required'  => true,
            ),
            array(
                'name'      => esc_html__( 'Contact Form 7', 'ripara'),
                'slug'      => 'contact-form-7',
                'required'  => false,
            ),
            array(
                'name'      => esc_html__('MailChimp for WordPress Lite','ripara'),
                'slug'      => 'mailchimp-for-wp',
                'required'  => false,
            ),
            array(
                'name'      => esc_html__('Yith Woocommerce Compare','ripara'),
                'slug'      => 'yith-woocommerce-compare',
                'required'  => false,
            ),
            array(
                'name'      => esc_html__('Yith Woocommerce Wishlist','ripara'),
                'slug'      => 'yith-woocommerce-wishlist',
                'required'  => false,
            ),
            array(
                'name'      => esc_html__('Redux Framework','ripara'),
                'slug'      => 'yith-woocommerce-wishlist',
                'required'  => true,
            ),
        );

        /**************************************** PLUGINS ****************************************/
        /* Example define shop, product settings */
        if(class_exists( 'WooCommerce' )){
            $global_config['theme-option'] = array();
        }
    }
}
tech888f_default_config();