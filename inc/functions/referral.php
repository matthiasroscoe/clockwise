<?php

/**
 * Create new referral post when Refer a Friend form is submitted
 */

add_action('wp_ajax_nopriv_create_referral_post', 'create_referral_post');
add_action('wp_ajax_create_referral_post', 'create_referral_post');

function create_referral_post() {
    $fname = (isset($_POST['first_name'])) ? $_POST['first_name'] : null;
    $lname = (isset($_POST['last_name'])) ? $_POST['last_name'] : null;
    $email = (isset($_POST['email'])) ? $_POST['email'] : null;
    $referral_code = (isset($_POST['referral_code'])) ? $_POST['referral_code'] : null;

    if ($fname == null || $lname == null || $referral_code == null) {
        echo 'Error: Could not create referral page. Check that the referral code, first name and last name are all valid.';
        wp_die();
    }

    $new_post = wp_insert_post(array(
        'post_type' => 'referral',
        'post_status' => 'publish',
        'post_title' => $fname . ' ' . $lname,
        'post_name' => $referral_code,
    ));
    
    if ($new_post) {
        update_field('referrer_email', $email, $new_post);
        echo 'success';
    } else {
        echo 'Error: Could not create referral page.';
    }

    wp_die();
}