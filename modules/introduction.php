<section class="introduction u-rel module module-<?php echo $mod_num; ?>">
    
    <?php if ($m['image']) : ?>
        <img class="img js-hidden | d-none d-xl-block" src="<?php echo $m['image']['sizes']['cw_small']; ?>" alt="<?php echo $m['image']['alt']; ?>" loading="lazy">
    <?php endif; ?>
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="js-hidden | col-md-10 col-lg-8 ">
                <?php if ($m['heading']): ?>
                    <h1><?php echo $m['heading']; ?></h1>
                <?php endif; ?>
                
                <?php if ($m['content']): ?>
                    <div><?php echo $m['content']; ?></div>
                <?php endif; ?>
                
                <?php echo get_button(null, null, null, $m['button']); ?>
            </div>
        </div>
    </div>

</section>