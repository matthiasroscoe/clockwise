<section class="article-image module module--article module-<?php echo $mod_num; ?>">
    <div class="container-lg">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xxl-8">
                
                <img class="d-block" src="<?php echo $m['image']['sizes']['big']; ?>" alt="<?php echo $m['image']['alt']; ?>" loading="lazy">

                <?php if ($m['caption']): ?>
                    <div class="caption">
                        <p class="mb-0 fw-500"><?php echo $m['caption']; ?></p>
                    </div>
                <?php endif; ?>
                
            </div>
        </div>
    </div>
</section>