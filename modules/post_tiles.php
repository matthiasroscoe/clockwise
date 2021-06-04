<?php 
$args = array(
    'post_type' => $m['post_type'],
    'posts_per_page' => '5',
    'post_status' => 'publish',
);

$posts = get_posts($args);

// Don't show module if 5 posts aren't published
if (count($posts) < 5) {
    return;
}

$tile_data = array();
$i = 0; foreach($posts as $post) {
    $post_id = $post->ID;
    
    $img = get_field('thumbnail', $post_id)['sizes'];
    if (get_field('profile_img', $post_id)) {
        $img = get_field('profile_img', $post_id)['sizes'];
    }

    $excerpt = (get_field('excerpt', $post_id)) ? get_field('excerpt', $post_id) : get_field('description', $post_id);

    $tile_data[$i] = array(
        'title' => $post->post_title,
        'permalink' => get_permalink($post_id),
        'excerpt' => $excerpt,
        'img' => $img,
    );
    
    $i++;
}
?>

<section class="post-tiles module module-<?php echo $mod_num; ?>">
    
    <?php if ($m['heading']) : ?>
        <div class="post-tiles__heading js-hidden | container-lg">
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-6">
                    <h1 class="mb-0"><?php echo $m['heading']; ?></h1>
                </div>
                <div class="col-lg-6 text-right">
                    <?php if ($m['post_type'] == 'article' || $m['post_type'] == 'event') : 
                        $page = pll_get_post('490', pll_current_language()); ?>
                        <a href="<?php echo get_permalink($page); ?>" class="c-inline-link c-inline-link--arrow d-none d-lg-inline-block"><?php pll_e('Clockwise Community Feed'); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="js-hidden | container-fluid">
        <div class="row">
            <a class="tile tile--large | u-rel col-6" href="<?php echo $tile_data[0]['permalink']; ?>" title="<?php echo $tile_data[0]['title']; ?>">
                
                <div class="img-wrap | u-fluid">
                    <img class="u-fluid" src="<?php echo $tile_data[0]['img']['big']; ?>" alt="<?php echo $tile_data[0]['title']; ?>" loading="lazy">
                </div>
                
                <div class="details <?php echo $m['post_type']; ?> | text-white">
                    <h2><?php echo $tile_data[0]['title']; ?></h2>
                    <div class="excerpt d-none d-xl-block"><?php echo $tile_data[0]['excerpt']; ?></div>
                    <p class="c-inline-link d-none d-lg-block mb-0" href="<?php echo $tile_data[0]['permalink']; ?>" title="<?php echo $tile_data[0]['title']; ?>"><?php pll_e('Read More'); ?></p>
                </div>
            </a>
            <div class="post-tiles__small-tiles | col-6 pr-0">
                <div class="row flex-column flex-lg-row mx-0">
                    <?php $i = 1; foreach($tile_data as $tile) :
                        if ($i == 1) {
                            $i++;
                            continue;
                        } elseif ($i == 2) {
                            $tile_classlist = 'tile--left tile--top';
                        } elseif ($i == 3) {
                            $tile_classlist = 'tile--right tile--top';
                        } elseif ($i == 4) {
                            $tile_classlist = 'tile--left tile--bottom d-none d-lg-block';
                        } elseif ($i == 5) {
                            $tile_classlist = 'tile--right tile--bottom d-none d-lg-block';
                        }

                        ?>
                        <a class="tile tile--small <?php echo $tile_classlist; ?> | u-rel col-lg-6" href="<?php echo $tile['permalink']; ?>" title="<?php echo $tile['title']; ?>">
                            <div class="img-wrap | u-fluid">
                                <img class="u-fluid" src="<?php echo $tile['img']['cw_small']; ?>" alt="<?php echo $tile['title']; ?>" loading="lazy">
                            </div>
                            
                            <div class="details | text-white">
                                <h2><?php echo $tile['title']; ?></h2>
                                <p class="c-inline-link d-none d-lg-block mb-0" href="<?php echo $tile['permalink']; ?>" title="<?php echo $tile['title']; ?>"><?php pll_e('Read More'); ?></p>
                            </div>
                        </a>
                    <?php $i++; endforeach; ?>
                    
                </div>
            </div>
        </div>
        <div class="post-tiles__mobile-tiles | row d-lg-none justify-content-between">
            <?php $i = 1; foreach($tile_data as $tile) :
                if ($i < 4) { $i++; continue; }
                ?>
                <a class="tile tile--mobile | u-rel" href="<?php echo $tile['permalink']; ?>" title="<?php echo $tile['title']; ?>">
                    <div class="img-wrap | u-fluid">
                        <img class="u-fluid" src="<?php echo $tile['img']['cw_small']; ?>" alt="<?php echo $tile['title']; ?>" loading="lazy">
                    </div>
                    
                    <div class="details | text-white">
                        <h2><?php echo $tile['title']; ?></h2>
                        <p class="c-inline-link d-none d-lg-block mb-0" href="<?php echo $tile['permalink']; ?>" title="<?php echo $tile['title']; ?>"><?php pll_e('Read More'); ?></p>
                    </div>
                </a>
            <?php $i++; endforeach; ?>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col text-center">
                <?php if ($m['post_type'] == 'article' || $m['post_type'] == 'event') : 
                    $page = pll_get_post('490', pll_current_language()); ?>
                    <a href="<?php echo get_permalink($page); ?>" class="c-inline-link c-inline-link--arrow"><?php pll_e('Clockwise Community Feed'); ?></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>