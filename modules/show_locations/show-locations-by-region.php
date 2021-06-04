<section class="locations module module-<?php echo $mod_num . ' ' . $m['filter_type']; ?>">
    <div class="container-lg">
        <div class="row justify-content-center">
            <?php 
                $posts_per_page = ($m['filter_type'] == 'dropdown') ? '6' : '3';
                $subheading = ($m['subheading']) ? $m['subheading'] : pll__('Clockwise in:');
                $locations = (! $m['show_all_locations']) ? $m['locations'] : null;
                
                // Get region dropdown filter
                echo get_region_filter($m['default_region'], 'location', $subheading, $locations);
                
                // If displaying filter as buttons, also load pill buttons (dropdown filter still used on mobile)
                if ($m['filter_type'] == 'buttons') {
                    echo get_region_pill_buttons($m['default_region'], $subheading, $locations);
                }
            ?>
        </div>
    </div>

    <div class="container-lg js-locations-grid-container js-load-grid" 
        data-region="<?php echo $m['default_region']; ?>" 
        data-posts-per-page="<?php echo $posts_per_page; ?>"
        data-locations="<?php if (! $m['show_all_locations']) { echo json_encode($m['locations']); } ?>">
    </div>
</section>