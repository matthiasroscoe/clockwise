<section class="neighbourhood module module-<?php echo $mod_num; ?> | u-rel">
    <div class="js-neighbourhood-intro neighbourhood__top | container">
        <div class="row justify-content-center">
            <div class="col-lg-7 text-center">
                <h1 class="neighbourhood__heading"><?php echo $m['heading']; ?></h1>
                <?php if ($m['introduction']) : ?>
                    <p class="neighbourhood__intro"><?php echo $m['introduction']; ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="neighbourhood__panels | container-lg">
        <div class="row justify-content-center">
            <div class="js-neighbourhood-slider | col-xxl-10 d-flex flex-wrap">
                <?php $i = 1; foreach($m['panels'] as $panel) : ?>
                    <div class="neighbourhood__panel">
                        <div class="neighbourhood__panel__inner | u-rel">
                            <img class="neighbourhood__panel__img | u-lg-fluid" src="<?php echo $panel['image']['sizes']['cw_600']; ?>" alt="<?php echo $panel['name']; ?>" loading="lazy">
                            <div class="neighbourhood__panel__content">
                                <?php // TODO replace with correct icons
                                    switch ($panel['label']['value']) {
                                        case 'art_culture':
                                            $icon = get_icon('art-culture.svg');
                                            break;
                                        case 'bars_restos':
                                            $icon = get_icon('art-culture.svg');
                                            // $icon = get_icon('food-drink.svg');
                                            break;
                                        case 'shopping':
                                            $icon = get_icon('art-culture.svg');
                                            // $icon = get_icon('shopping.svg');
                                            break;
                                        
                                        default:
                                            $icon = get_icon('art-culture.svg');
                                            // $icon = get_icon('place-of-interest.svg');
                                            break;
                                    }
                                ?>
                                <div class="label | d-flex align-items-center mb-lg-3">
                                    <img class="d-none d-lg-block" src="<?php echo $icon; ?>" loading="lazy" alt="<?php echo $panel['label']['label']; ?>">
                                    <p class="fw-300 text-upper mb-0 ml-lg-3"><?php echo $panel['label']['label']; ?></p>
                                </div>
                                
                                <?php if ($panel['external_link']) : ?>
                                    <a class="external-link" href="<?php echo $panel['external_link']; ?>" target="_blank"><h2 class="name"><?php echo $panel['name']; ?></h2></a>
                                <?php else: ?>
                                    <h2 class="name"><?php echo $panel['name']; ?></h2>
                                <?php endif; ?>
                                
                                <?php if ($panel['distance']) : ?>
                                    <p class="distance | fw-300 mb-3"><?php echo $panel['distance']; echo pll_e('km away'); ?></p>
                                <?php endif; ?>

                                <?php if ($panel['description']) : ?>
                                    <p class="description | fw-300 mb-0"><?php echo $panel['description']; ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php $i++; endforeach; ?>
            </div>
        </div>
    </div>
</section>