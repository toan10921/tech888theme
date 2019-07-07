<?php
/**
 * Created by PhpStorm.
 * User: toanngo92
 * Date: 2/9/2019
 * Time: 9:54 PM
 */

global $tech888f_option;
if(isset( $tech888f_option['tech888f_footer_content'])){
    $page_id = apply_filters('tech888f_footer_page_id',$tech888f_option['tech888f_footer_content']);
}
if(!empty($page_id)) {?>
    <div id="footer" class="footer-page">
        <div class="container">
            <?php echo Tech888f_Template::get_vc_pagecontent($page_id);?>
        </div>
    </div>
    <?php
}
else{
    ?>
    <div id="footer" class="footer-default">
        <div class="container">
            <p class="copyright fixlh white no-margin"><?php esc_html_e("© Tech888 Framework, 2019. All Rights Reserved.","ripara")?></p>
        </div>
    </div>
    <?php
}