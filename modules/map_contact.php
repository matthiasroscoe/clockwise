<?php 
$loc = $m['location'][0]; 

if (get_field('google_maps', $loc)) : 
    $map = get_field('google_maps', $loc);
    ?>
        <section class="map-contact u-rel module module-<?php echo $mod_num; ?>">
            
            <?php if ($m['image']) : ?>
                <img class="map-contact__img js-hidden | d-none d-lg-block" src="<?php echo $m['image']['sizes']['cw_medium']; ?>" alt="<?php echo $m['image']['alt']; ?>" loading="lazy">
            <?php endif; ?>

            <div class="container-lg">
                <div class="row">
                    <div class="col-md-10 offset-md-1 offset-lg-2">
                        
                        <div class="map-contact__inner | d-flex flex-column flex-lg-row">
                            <div class="map-contact__map js-hidden | u-rel">
                                <div class="map js-map-contact-container"
                                    data-zoom="<?php echo $map['zoom']; ?>" 
                                    data-lat="<?php echo $map['lat']; ?>" 
                                    data-lng="<?php echo $map['lng']; ?>" 
                                    data-marker="<?php echo get_icon('map-marker.svg'); ?>">
                                </div>
                                <div class="zoom-controls">
                                    <div class="js-map-zoom-in js-hov"></div>
                                    <div class="js-map-zoom-out js-hov"></div>
                                </div>
                            </div>

                            <div class="map-contact__content js-hidden">
                                <?php if ($m['heading']): ?>
                                    <h1 class="map-contact__heading"><?php echo $m['heading']; ?></h1>
                                <?php endif; ?>
                                
                                <?php if (get_field('address', $loc)) : ?>
                                    <h2 class="map-contact__subheading"><?php pll_e('Address'); ?></h2>
                                    <a class="map-contact__address | fw-300" href="<?php echo get_field('google_maps_link', $loc); ?>" title="<?php pll_e('Address'); ?>"><?php echo get_field('address'); ?></a>
                                <?php endif; ?>

                                <?php if (get_field('nearest_station', $loc)) : ?>
                                    <h2 class="map-contact__subheading"><?php pll_e('Nearest Station'); ?></h2>
                                    <p><?php echo get_field('nearest_station', $loc); ?></p>
                                <?php endif; ?>

                                <?php if (get_field('phone_number', $loc) || get_field('email', $loc)) : ?>
                                    <div class="map-contact__contact">
                                        <h2 class="map-contact__subheading"><?php pll_e('Contact Info'); ?></h2>
                                        <?php if (get_field('email', $loc)) : ?>
                                            <p class="mb-0">E: <a href="mailto:<?php echo get_field('email', $loc); ?>" target="_blank"><?php echo get_field('email', $loc); ?></a></p>
                                        <?php endif; ?>
                                        <?php if (get_field('phone_number', $loc)) : ?>
                                            <p class="mb-0">T: <a href="tel:<?php echo get_field('phone_number', $loc); ?>" target="_blank"><?php echo get_field('phone_number', $loc); ?></a></p>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if (get_field('socials', 'option')) : ?>
                                    <div class="map-contact__socials | d-flex align-items-center">
                                        <?php foreach(get_field('socials', 'option') as $soc) : 
                                            // Icons
                                            if ($soc['account'] == 'facebook') {
                                                $icon_url = get_icon('facebook--cream.svg');
                                            } else if ($soc['account'] == 'linkedin') {
                                                $icon_url = get_icon('linkedin--cream.svg');
                                            } else if ($soc['account'] == 'instagram') {
                                                $icon_url = get_icon('instagram--cream.svg');
                                            } else if ($soc['account'] == 'twitter') {
                                                $icon_url = get_icon('twitter--cream.svg');
                                            }
                                            ?>
                                                <a class="d-block" href="<?php echo $soc['url']; ?>" title="<?php echo $soc['account']; ?>" target="_blank">
                                                    <img src="<?php echo $icon_url; ?>" alt="<?php echo $soc['account']; ?>" loading="lazy">
                                                </a>
                                            <?php 
                                        endforeach; ?>
                                    </div>
                                <?php endif; ?>

                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>

        </section>
    <?php 
endif; ?>