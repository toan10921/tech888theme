<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
$tabs = apply_filters( 'woocommerce_product_tabs', array() );
$tab_style = tech888f_get_opt('product_tab_detail','');

$tab_style_metabox = get_post_meta(get_the_ID(),'product_tab_style',true);
if(!empty($tab_style_metabox) && $tab_style_metabox != $tab_style){
    $tab_style = $tab_style_metabox;
}

//get single product sidebar information
$sidebar_return = tech888f_get_single_product_class_sidebar();
extract($sidebar_return);

if($sidebar_pos != 'no' && !empty($sidebar_pos) ){
    $tab_class = 'content-wrap col-content content-sidebar-'.esc_attr($sidebar_pos).' col-md-9 col-sm-8 col-xs-12';
}else{
    $tab_class = 'content-wrap col-content content-no-sidebar col-md-12 col-sm-12 col-xs-12';
}

if ( ! empty( $tabs ) ) : ?>
    <div class="row">
        <?php
        if($sidebar_pos == 'left' ){
            tech888f_output_sidebar('left');
        }
        if ($tab_style =="tab-style2"){
            ?>
            <div class="toggle-tab style2 <?php echo esc_attr($tab_class) ?> ">
                <?php
                $i = 1;
                foreach ( $tabs as $key => $tab ) :
                    if($i == 1) $active = 'active';
                    else $active = '';
                    $i++;
                    ?>
                    <div class="item-toggle-tab <?php echo esc_attr($active) ?>">
                        <h3 class="toggle-tab-title detail-tab-title no-margin title18 font-bold text-uppercase">
                            <span class="pst-relative black30"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?></span>
                        </h3>
                        <div class="toggle-tab-content detail-tab-content custom-scroll">
                            <div class="detail-tab-desc">
                                <?php if ( isset( $tab['callback'] ) ) { call_user_func( $tab['callback'], $key, $tab ); } ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php
        }else{
            ?>
            <div class="product-tab-desc <?php echo esc_attr($tab_class) ?>">
                <div class="detail-tab-title">
                    <ul class="list-tag-detail text-center list-none text-uppercase font-bold nav nav-pills nav-justified" role="tablist">
                        <?php
                        $i = 1;
                        foreach ( $tabs as $key => $tab ) :
                            if($i == 1) $active = 'active';
                            else $active = '';
                            $i++;
                            ?>
                            <li class="<?php echo esc_attr($active)?> <?php echo esc_attr( $key ); ?>_tab" id="tab-title-<?php echo esc_attr( $key ); ?>">
                                <a class="gray999" href="#tab-<?php echo esc_attr( $key ); ?>" data-target="#tab-<?php echo esc_attr( $key ); ?>" data-toggle="tab" aria-expanded="false">
                                    <?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="detail-tab-content">
                    <div class="tab-content">
                        <?php
                        $i = 1;
                        foreach ( $tabs as $key => $tab ) :
                            if($i == 1) $active = 'active';
                            else $active = '';
                            $i++;
                            ?>
                            <div id="tab-<?php echo esc_attr( $key ); ?>" class="tab-pane <?php echo esc_attr($active)?>">
                                <div class="detail-tab-desc">
                                    <?php if ( isset( $tab['callback'] ) ) { call_user_func( $tab['callback'], $key, $tab ); } ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
        <?php
        if($sidebar_pos == 'right' ){
            tech888f_output_sidebar('right');
        }
        ?>
    </div>
<?php endif; ?>
