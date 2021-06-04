<?php 
    $share_text = pll__('Share article');
    if (get_post_type() == 'job_vacancy') {
        $share_text = pll__('Share vacancy');
    } 
?>

<section class="share-article">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xxl-6">
                <div class="share-article__inner">
                    <h3 class="text-center text-upper fw-500"><?php echo $share_text; ?></h3>
                    
                    <?php 
                        $sl_data = get_sharing_link_data();
                        
                        if (! empty($sl_data)) : ?>
                            <div class="share-article__links | d-flex justify-content-center">
                                <?php foreach($sl_data as $key => $link) : ?>
                                    <a href="<?php echo $link['url']; ?>" class="link" target="_blank" title="<?php echo $key; ?>">
                                        <img src="<?php echo $link['icon_circle']; ?>" loading="lazy" alt="share">
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        <?php endif;
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>