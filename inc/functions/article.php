<?php // All events/articles related functions


function get_article_card($post_id = null) {
    if ($post_id == NULL) {
        return;
    }

    ob_start();
    ?>
        <div class="article-card js-matchHeight <?php echo get_post_type($post_id); ?> | col-md-6 col-xl-5">
            <a class="image-wrap | d-block u-rel" href="<?php echo get_permalink($post_id); ?>" title="<?php echo get_the_title($post_id); ?>">
                <img class="u-fluid" src="<?php echo get_field('thumbnail', $post_id)['sizes']['cw_600']; ?>" alt="<?php echo get_field('thumbnail', $post_id)['alt']; ?>" loading="lazy">
            </a>
            
            <div class="details">
                <?php $align_class = (get_post_type($post_id) == 'event') ? 'align-items-center' : 'align-items-end'; ?>
                <div class="name | d-flex justify-content-between <?php echo $align_class; ?>">
                    <p class="title <?php echo get_post_type($post_id); ?> | u-rel m-0 fw-500"><?php echo get_the_title($post_id); ?></p>
                    <span class="date | text-right fw-300"><?php echo get_time_since_published($post_id); ?></span>
                </div>
                
                <?php if (get_field('description', $post_id)) : ?>
                    <div class="description | fw-300"><?php echo get_field('description', $post_id); ?></div>
                <?php endif; ?>

                <a href="<?php echo get_permalink($post_id); ?>" title="<?php echo get_the_title($post_id); ?>" class="c-btn">
                    <span><?php pll_e('Read more'); ?></span>
                    <div class="icon">
                        <svg>
                            <circle class="bg-circle" r="50%" cx="50%" cy="50%" />
                            <circle class="fg-circle" r="50%" cx="50%" cy="50%" />
                        </svg>
                        <img src="<?php echo get_icon('arrow--white.svg'); ?>" alt="arrow">
                    </div>
                </a>
            </div>
        </div>
    <?php

    $html = ob_get_clean();
    return $html;
}

?>