<?php if (get_field('show_rel_articles')) : ?>
    <section class="related-articles u-bg-beige-2">
        <div class="container-lg">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <h1 class="related-articles__heading"><?php pll_e('Related articles'); ?></h1>
                </div>
            </div>

            <div class="row">
                <?php 
                    // If no related articles selected, display most recent posts in same post type
                    if (! get_field('related_articles')) {
                        $args = array(
                            'post_type' => get_post_type(),
                            'posts_per_page' => 2,
                            'post_status' => 'publish',
                            'field' => 'ids',
                        );
                        
                        $articles = get_posts($args);
                        
                        foreach($articles as $article) {
                            echo get_article_card($article);
                        }
                    } 
                    // If related articles set in ACF field, display.
                    else {
                        foreach(get_field('related_articles') as $article) {
                            echo get_article_card($article);
                        }
                    }
                ?>
            </div>
        </div>
    </section>
<?php endif; ?>