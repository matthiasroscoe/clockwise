<?php
/**
 * Template name: Legal Page Template
 */

get_header();

/**
* Hero
*/
$m = array();
$hero = get_field('hero');
$m['heading'] = $hero['heading'];
$m['text'] = $hero['text'];
$m['image'] = $hero['image'];
$m['mobile_image'] = $hero['mobile_image'];
include(get_stylesheet_directory() . '/modules/hero.php');

/**
 * Content
 */

?>
<div class="container-lg mt-4 mb-5 pt-lg-4 pb-lg-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="c-wysiwyg">
                <?php the_content(); ?>
            </div>
        </div>
    </div>
</div>

<?php

get_footer(); ?>