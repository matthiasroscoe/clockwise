<?php
    $container_class = 'container cta-banner--small';
    $overlay_class = ($m['has_overlay']) ? ' has-overlay' : '';

    if ($m['style'] == 'full_width') {
        $container_class = 'container-fluid cta-banner--full-width';
    }
    if ($m['style'] == 'large') {
        $container_class .= ' container--medium cta-banner--medium';
    }
    if ($m['style'] == 'largest') {
        $container_class .= ' container--large cta-banner--large';
    }
?>

<section class="cta-banner js-hidden module module-<?php echo $mod_num . $overlay_class; ?>">
    <div class="<?php echo $container_class; if ($m['has_margins']) { echo ' has-margins'; } ?> u-rel">

        <div class="cta-banner__img | u-fluid">
            <?php if ($m['image']) : ?>
                <img class="u-fluid" src="<?php echo $m['image']['sizes']['hero']; ?>" srcset="<?php echo generate_srcset($m['image']['sizes']); ?>" alt="<?php echo $m['image']['alt']; ?>" loading="lazy">
            <?php endif; ?>
        </div>

        <div class="cta-banner__content | row justify-content-center u-rel">
            <div class="text-center col-md-10 col-lg-8 col-xl-6">
                <?php if ($m['heading']) : ?>
                    <h1 class="text-white"><?php echo $m['heading']; ?></h1>
                <?php endif; ?>

                <?php if ($m['text']) : ?>
                    <p class="text-white mb-4 mb-lg-5"><?php echo $m['text']; ?></p>
                <?php endif; ?>

                <?php if ($m['buttons']) : ?>
                    <div class="cta-banner__buttons">
                        <?php foreach($m['buttons'] as $btn) {
                            $link = $btn['button'];
                            if ($link['button_type'] != 'none') {
                                echo get_button('white', null, null, $link);
                            }
                        } ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>