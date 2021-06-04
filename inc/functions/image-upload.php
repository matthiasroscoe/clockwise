<?php

/**
 * On uploading an image populate alt text with image title.
 */

add_action( 'add_attachment', 'add_alt_text_after_image_upload' );

function add_alt_text_after_image_upload( $attachment_id ) {
    $alt = get_post_meta($attachment_id, '_wp_attachment_image_alt', true);
    $title = get_the_title($attachment_id);
    if ($alt == '') {
        update_post_meta($attachment_id, '_wp_attachment_image_alt', $title);
    }
}

?>