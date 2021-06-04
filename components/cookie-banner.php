<div id="cookie-banner" class="c-cookie-banner d-flex flex-column flex-lg-row align-items-center justify-content-between">
    <div class="c-cookie-banner__text">
        <?php if (get_field('cook_bar_heading', 'option')) : ?>
            <h2 class="text-white mb-2"><?php the_field('cook_bar_heading', 'option'); ?></h2>
        <?php endif; ?>
        <?php if (get_field('cook_bar_text', 'option')) : ?>
            <div class="text-white"><?php the_field('cook_bar_text', 'option'); ?></div>
        <?php endif; ?>
    </div>
    <div class="c-cookie-banner__buttons">
        <a href="#" class="c-btn c-btn--white js-cookie-banner-close">Accept</a>
    </div>
</div>