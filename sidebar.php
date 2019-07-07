<?php
/**
 * Created by PhpStorm.
 * User: toanngo92
 * Date: 2/1/2019
 * Time: 8:31 PM
 * The sidebar containing the main widget area.
 */
?>
<?php
$sidebar = tech888f_get_sidebar_pos();
if ( is_active_sidebar( $sidebar['id']) && $sidebar['position'] != 'no' ):?>
    <div class="col-md-3 col-sm-4 col-xs-12">
        <div class="sidebar sidebar-<?php echo esc_attr($sidebar['position'])?>">
            <?php dynamic_sidebar($sidebar['id']); ?>
        </div>
    </div>
<?php endif;?>