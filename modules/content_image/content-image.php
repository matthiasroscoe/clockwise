<?php 
    $module_class = 'cont-img--style-1';
    $column_class = 'col-md-10 offset-md-1 offset-lg-2';
    if ($m['style'] == '2') { 
        $module_class = 'cont-img--style-2'; 
        $column_class = 'col-md-10 offset-md-1';
    } else if ($m['style'] == '3') {
        $module_class = 'cont-img--style-3';
        $column_class = 'col-md-10 offset-md-1 offset-lg-0 col-xxl-9 offset-xxl-1';
    }

    if ($m['mob_bg']) {
        $module_class .= ' has-mob-bg';
    }
?>
<section class="cont-img <?php echo $module_class; ?> u-rel module module-<?php echo $mod_num; ?>">
    
    <?php if ($m['image_2']) : ?>
        <img class="secondary-img js-hidden | d-none d-lg-block" src="<?php echo $m['image_2']['sizes']['cw_medium']; ?>" alt="<?php echo $m['image_2']['alt']; ?>" loading="lazy">
    <?php endif; ?>

    <div class="container-lg">
        <div class="row">
            <div class="<?php echo $column_class; ?>">
                
                <div class="cont-img__inner | d-flex flex-column flex-lg-row">
                    <div class="img-col | u-rel">
                        <?php if ($m['image_2']) : ?>
                            <img class="img js-hidden | u-lg-fluid" src="<?php echo $m['image']['sizes']['big']; ?>" alt="<?php echo $m['image']['alt']; ?>" loading="lazy">
                        <?php endif; ?>
                    </div>

                    <div class="content-col js-hidden">
                        <?php if ($m['heading']): ?>
                            <h1><?php echo $m['heading']; ?></h1>
                        <?php endif; ?>
                        
                        <?php if ($m['content']): ?>
                            <div><?php echo $m['content']; ?></div>
                        <?php endif; ?>

                        <?php if ($m['icons']): ?>
                            <div class="icons">
                                <?php foreach($m['icons'] as $icon) : ?>
                                    <div class="d-flex align-items-start mb-4">
                                        <div class="icon">
                                            <img class="mt-1" src="<?php echo $icon['icon']; ?>" alt="<?php echo $icon['alt']; ?>" loading="lazy">
                                        </div>
                                        <div class="text">
                                            <?php if ($icon['subheading'] && $m['style'] == '3') : ?>
                                                <p class="subheading | text-upper fw-500 my-1"><?php echo $icon['subheading']; ?></p>
                                            <?php endif; ?>
                                            <p class="description | mb-0"><?php echo $icon['text']; ?></p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                        
                        <?php 
                            if (count($m['buttons']) > 0) {
                                foreach($m['buttons'] as $btn) {
                                    echo get_button(null, null, null, $btn['button']);
                                }    
                            } 
                        ?>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

</section>