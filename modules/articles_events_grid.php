<?php 
    $show_events = false;
    if ($_GET['show'] == 'events') {
        $show_events = true;
    } 
?>

<section class="ae-grid">
    <div class="container-lg">
        <div class="row">
            <div class="col-xl-10 offset-xl-1">
                <div class="filter-wrap | d-flex align-items-stretch">
                    <a href="#" class="filter js-ae-filter <?php if (! $show_events) { echo 'is-active'; } ?> | flex-fill d-flex flex-center px-3 px-xl-5" data-post-type="article" data-barba-prevent>
                        <p class="article | u-rel text-center mb-0 fw-500"><?php pll_e('Clockwise Articles'); ?></p>
                    </a>
                    <a href="#" class="filter js-ae-filter <?php if ($show_events) { echo 'is-active'; } ?> | flex-fill d-flex flex-center px-3 px-xl-5" data-post-type="event" data-barba-prevent>
                        <p class="event | u-rel text-center mb-0 fw-500"><?php pll_e('Clockwise Events'); ?></p>
                    </a>
                </div>
            </div>
        </div>

        <div class="posts-wrap">
            <div class="posts js-posts-container <?php if (! $show_events) { echo 'is-active'; } ?> | row" data-post-type="article">
                <?php 
                    $args = array(
                        'post_type' => 'article',
                        'posts_per_page' => '6',
                        'post_status' => 'publish',
                        'field' => 'ids',
                    );

                    $articles = get_posts($args);

                    foreach($articles as $article) {
                        echo get_article_card($article);
                    }
                ?>
            </div>
            <?php // TODO articles load more ?>
            
            <div class="posts js-posts-container <?php if ($show_events) { echo 'is-active'; } ?> row" data-post-type="event">
                <?php   
                    // Event locations filter
                    $ev_locations = get_terms(array(
                        'taxonomy' => 'event-location',
                        'parent' => 0,
                    ));

                    if ($ev_locations) : ?>
                        <div class="events-filter events-filter--desktop | col-lg-10 offset-lg-1 d-none d-md-block">
                            <div class="c-pills">
                                <div>
                                    <p class="c-pills__heading | text-center"><?php pll_e('Events for:'); ?></p>
                                    <?php // TODO reset button ?>
                                </div>
                                <div class="c-pills__inner | d-flex justify-content-center align-items-center">
                                    <?php $i = 1; foreach($ev_locations as $term) : ?>
                                        <a href="#" class="c-pill js-events-pill <?php if ($i == 1) { echo 'is-active'; } ?>" title="<?php echo $term->name; ?>" data-term-id="<?php echo $term->term_id; ?>" data-barba-prevent><?php echo $term->name; ?></a>
                                    <?php $i++; endforeach; ?>
                                </div>
                            </div>
                        </div>
                    
                        <div class="js-posts | d-flex flex-wrap">
                            <?php 
                                $args = array(
                                    'post_type' => 'event',
                                    'posts_per_page' => '6',
                                    'post_status' => 'publish',
                                    'field' => 'ids',
                                    'tax_query' => array(
                                        array(
                                            'taxonomy' => 'event-location',
                                            'terms' => $ev_locations[0]->term_id,
                                        )
                                    )
                                );

                                $events = get_posts($args);

                                foreach($events as $event) {
                                    echo get_article_card($event);
                                }
                            ?>
                        </div>
                    <?php else : ?>
                        <div class="no-events | col-lg-8 offset-lg-2">
                            <h3 class="text-center"><?php pll_e('Our events are currently on hold until we’re able to bring people together again.'); ?></h3>
                        </div>
                    <?php endif; ?>
                
                <?php // TODO events load more ?>
            </div>
        </div>

    </div>
</section>