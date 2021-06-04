<?php 

function get_link_item($item = null) {
    if ($item == NULL) {
        return;
    }

    ob_start();
    // If sub-region, show dropdown
    if (isset($item['locations'])) : ?>
        <div class="region__subregion">
            <a href="#" class="title js-nav-sub-region | d-inline-block text-white u-rel" title="<?php echo $item['name']; ?>" data-barba-prevent><?php echo $item['name']; ?></a>
            <div class="region__subregion--locations">
                <?php foreach($item['locations'] as $loc) : ?>
                    <a href="<?php echo get_permalink($loc); ?>" class="region__subregion__location d-block | text-white" title="<?php echo get_the_title($loc); ?>">- <?php echo get_the_title($loc); ?></a>
                <?php endforeach; ?>
            </div>
        </div>
    <?php 
    // If location has no sub-region, show normal link
    else : ?>
        <a href="<?php echo get_permalink($item['id']); ?>" class="region__item | text-white" title="<?php echo get_the_title($item['id']); ?>"><?php echo get_the_title($item['id']); ?></a>
    <?php endif;  

    $html = ob_get_clean();
    return $html;
}

?>

<!-- Locations menu/sub-menu -->
<div class="nav__link nav__link--dropdown">
    <a class="js-has-sub-menu | text-white" href="#" data-barba-prevent><?php pll_e('Locations'); ?></a>
    
    <div class="nav__sub-menu nav__locations js-sub-menu">
        <div class="nav__sub-menu__inner | d-flex flex-column flex-lg-row align-items-lg-start justify-content-lg-start flex-wrap">
            <?php 
                // Combine locations and sub-regions into one array
                // Sub-regions will have a separate dropdown to list locations
                $regions = get_terms('regions', array(
                    'parent' => 0,
                    'lang' => 'en',
                ));

                foreach($regions as $reg) :
                    $locations_and_subregion_locations = array();
                    $all_sub_locations = array();

                    $sub_regions = get_term_children($reg->term_id, 'regions');
                    foreach($sub_regions as $subreg) {
                        $term = get_term($subreg, 'regions');
                        if ($term->count > 0) {
                            
                            // Get post ids of any sub-locations, 
                            // These will be excluded from main locations query
                            $sub_locations = get_locations_by_region($subreg);
                            foreach($sub_locations as $subloc) {
                                $all_sub_locations[] = $subloc;
                            }

                            // Get active sub-regions
                            $locations_and_subregion_locations[] = array(
                                'id' => $subreg,
                                'name' => $term->name,
                                'locations' => $sub_locations,
                            );
                        }
                    }

                    $args = array(
                        'post_type' => 'location',
                        'post_status' => 'publish',
                        'lang' => 'en',
                        'posts_per_page' => -1,
                        'orderby' => 'title',
                        'order' => 'ASC',
                        'fields' => 'ids',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'regions',
                                'terms' => $reg->term_id,
                            ),
                        ),
                    );

                    if (! empty($all_sub_locations)) {
                        $args['post__not_in'] = $all_sub_locations;
                    }

                    // Combine locations and sub-regions into one array
                    $locations_without_sublocations = get_posts($args);
                    foreach($locations_without_sublocations as $loc) {
                        $locations_and_subregion_locations[] = array(
                            'id' => $loc,
                            'name' => get_the_title($loc),
                        );
                    }

                    // Sort array by name
                    usort($locations_and_subregion_locations, function($a, $b) {
                        return strcmp($a['name'], $b['name']);
                    });

                    // If more than three links, separate links into two columns
                    $num_links = count($locations_and_subregion_locations);
                    $two_cols = ($num_links > 3) ? true : false;
                    
                    // After this many links, start a new column
                    $link_split_after_index = 3;
                    if ($two_cols) {
                        $link_split_after_index = round($num_links / 2);
                    }
                    ?>
                    <div class="region <?php if ($two_cols) { echo 'two-cols'; } ?>">
                        <a href="<?php echo get_term_link($reg->term_id); ?>" class="region__name | text-white" title="<?php echo $reg->name; ?>"><?php echo $reg->name; ?></a>
                        
                        <div class="region__items <?php if ($two_cols) { echo 'region__items--1'; } ?>">
                            <?php for ($i=0; $i < $link_split_after_index; $i++) { 
                                echo get_link_item($locations_and_subregion_locations[$i]);
                            } ?>
                        </div>      

                        <?php if ($two_cols) : ?>
                            <div class="region__items region__items--2">
                                <?php for ($i=$link_split_after_index; $i < $num_links; $i++) { 
                                    echo get_link_item($locations_and_subregion_locations[$i]);
                                } ?>
                            </div>      
                        <?php endif; ?>
                    </div>
                <?php endforeach;
            ?>
        </div>
    </div>
</div>