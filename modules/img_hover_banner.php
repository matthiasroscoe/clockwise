<?php 
    $items = array();
    
    
    // Get locations data from post type
    if ($m['content_type']) {
        foreach($m['locations'] as $loc) {
            
            // Fallback images
            $mobile_image = wp_get_attachment_image_src('31', 'medium')[0];
            $desktop_image = wp_get_attachment_image_src('31', 'hero')[0];
            
            if (get_field('thumbnail', $loc)) {
                $mobile_image = get_field('thumbnail', $loc)['sizes']['cw_medium'];
                $desktop_image = get_field('thumbnail', $loc)['sizes']['hero'];
            } 
            if (get_field('landscape', $loc)) {
                $desktop_image = get_field('landscape', $loc)['sizes']['hero'];
            }

            $items[] = array(
                'heading' => get_the_title($loc),
                'mobile_image' => $mobile_image,
                'desktop_image' => $desktop_image,
                'coming_soon' => get_field('location_status', $loc),
                'text' => get_field('intro', $loc),
                'link' => get_the_permalink($loc),
                'link_target' => '_blank',
            );
        }
    } 
    // Get custom content data from ACF
    else {
        foreach($m['content'] as $c) {

            if ($c['image']['mobile_image']) {
                $mobile_image = $c['image']['mobile_image'];
            } else {
                $mobile_image = $c['image']['desktop_image'];
            }

            $items[] = array(
                'heading' => $c['heading'],
                'desktop_image' => $c['image']['desktop_image']['sizes']['hero'],
                'mobile_image' => $mobile_image['sizes']['cw_600'],
                'coming_soon' => true,
                'text' => $c['text'],
                'link' => $c['link']['url'],
                'link_target' => $c['link']['target'],
            );
        }
    }
?>


<section class="banner-carousel-wrap module module-<?php echo $mod_num; ?>">

    <?php
        include('img_hover_banner/hover-banner.php');
        include('img_hover_banner/mobile-slider.php'); 
    ?>
</section>