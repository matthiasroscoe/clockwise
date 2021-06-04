<section class="article-text-image module module--article module-<?php echo $mod_num; ?>">
    <div class="container-lg">
        <div class="row">
            
            <div class="img-col | col-lg-6 col-xxl-5 offset-xxl-1 pr-lg-0">
                <img class="d-block" src="<?php echo $m['image']['sizes']['big']; ?>" alt="<?php echo $m['image']['alt']; ?>" loading="lazy">
            </div>

            <div class="text-col | col-lg-6 col-xxl-5">
                <?php if ($m['section_heading']) : ?>    
                    <h2><?php echo $m['section_heading']; ?></h2>
                <?php endif; ?>

                <?php if ($m['text']) : ?>
                    <div><?php echo $m['text']; ?></div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</section>