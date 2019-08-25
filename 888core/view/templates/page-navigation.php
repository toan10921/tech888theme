<?php if ($links) :
    // Custom icon/text
    $links['prev_text'] = '<i class="fa fa-caret-left" aria-hidden="true"></i>';
    $links['next_text'] = '<i class="fa fa-caret-right" aria-hidden="true"></i>';
    ?>
    <div class="pagi-nav text-left <?php echo esc_attr($style)?>">
        <?php echo apply_filters('tech888foutput_content',paginate_links($links)); ?>
    </div>
<?php endif;?>