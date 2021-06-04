<div class="nav__link nav__link--dropdown">
    <a class="js-has-sub-menu | text-white" href="#" data-barba-prevent><?php pll_e('Membership & Services'); ?></a>
    
    <div class="nav__sub-menu nav__membership js-sub-menu">
        <div class="nav__sub-menu__inner | d-flex flex-column flex-lg-row flex-wrap">
            <?php 
                // Get membership page in current language
                // $cl = pll_current_language();
                $cl = 'en';
                $memb_page_id = 112;
                $cl_memb_page_id = pll_get_post($memb_page_id, $cl);
                
                // Display membership overview page link
                ?>
                    <a class="membership-link | text-white" href="<?php echo get_permalink($cl_memb_page_id); ?>"><?php pll_e('Overview'); ?></a>
                <?php 

                // Get membership plans
                $memb_plans = get_posts(array(
                    'post_type' => 'membership-plans',
                    'posts_per_page' => -1,
                    'lang' => 'en',
                    'orderby' => 'title',
                    'order' => 'ASC',
                    'fields' => 'ids',
                ));

                // Display membership plan individual pages
                foreach($memb_plans as $page) { ?>
                    <a class="membership-link | text-white" href="<?php echo get_permalink($page); ?>"><?php echo get_the_title($page); ?></a>
                <?php }
            ?>
        </div>
    </div>
</div>