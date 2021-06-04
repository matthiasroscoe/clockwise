<nav class="nav js-nav | text-white">
    <div class="nav__inner js-nav-bgs">
        <div class="container-xl d-flex flex-column justify-content-start">
            
            <div class="nav__links | u-rel d-flex flex-column">
                
                <?php 
                    include('locations-sub-menu.php');
                    include('membership-services-sub-menu.php');

                    foreach(get_field('overlay_menu', 'option') as $item) : ?>
                        <div class="nav__link">
                            <a class="text-white" href="<?php echo $item['menu_item']['url']; ?>" title="<?php echo $item['menu_item']['title']; ?>" target="<?php echo $item['menu_item']['target']; ?>"><?php echo $item['menu_item']['title']; ?></a>
                        </div>
                    <?php endforeach;
                ?>
                
            </div>
            <div class="nav__bottom | u-rel d-flex flex-column flex-lg-row align-items-start justify-content-end justify-content-lg-start flex-fill">
                <div class="d-flex flex-column">
                    <?php if (get_field('general_email', 'option')) : ?>
                        <a class="contact-link | text-white" href="mailto:<?php echo get_field('general_email', 'option'); ?>"><?php echo get_field('general_email', 'option'); ?></a>
                    <?php endif; ?>
                    <?php if (get_field('general_phone_number', 'option')) : ?>
                        <a class="contact-link | text-white" href="tel:<?php echo get_field('general_phone_number', 'option'); ?>"><?php echo get_field('general_phone_number', 'option'); ?></a>
                    <?php endif; ?>
                </div>
                
                <?php if (get_field('nav_cta', 'option')) {
                    $btn = get_field('nav_cta', 'option')['button'];
                    echo get_button(null, null, null, $btn);
                } ?>
            </div>
        </div>
    </div>
</nav>