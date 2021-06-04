<?php if (get_field('enable_topbar', 'option')) : ?>
    <div class="c-site-topbar <?php if (! is_front_page()) { echo 'd-none d-lg-block'; } ?> | u-rel">
        <div class="c-site-topbar__content text-center">
            <p class="m-0"><?php echo get_field('topbar_text', 'option'); ?>
                <?php if (get_field('topbar_cta','option')) : $link = get_field('topbar_cta','option'); ?>
                    <a href="<?php echo $link['url']; ?>" class="fw-300" target="<?php echo $link['target']; ?>" title="<?php echo $link['title']; ?>"><?php echo $link['title']; ?></a>
                <?php endif; ?>
            </p>
            <div class="c-site-topbar__close js-close-topbar js-hov"></div>
        </div>
    </div>
<?php endif; ?>