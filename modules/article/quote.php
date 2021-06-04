<section class="article-quote module module--article module-<?php echo $mod_num; ?>">
    <div class="container-lg">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xxl-6 pl-lg-0">

                <div class="article-quote__quote u-rel u-bg-beige-2">
                    <img class="speechmarks" src="<?php echo get_icon('speechmarks.svg'); ?>" loading="lazy" alt="speechmarks">
                
                    <p class="quote"><?php echo $m['quote']; ?></p>
                    
                    <?php if ($m['name'] || $m['company']) : ?>
                        <div class="details">
                            <?php if ($m['name']) : ?>
                                <p class="name | fw-500"><?php echo $m['name']; ?></p>
                            <?php endif; ?>
                            <?php if ($m['company']) : ?>
                                <p class="company"><?php echo $m['company']; ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
                
            </div>
        </div>
    </div>
</section>