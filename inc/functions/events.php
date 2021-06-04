<?php 

/**
 * Events filter
 */

add_action('wp_ajax_nopriv_filter_events', 'filter_events');
add_action('wp_ajax_filter_events', 'filter_events');

function filter_events() {
    $term = (isset($_POST['term'])) ? $_POST['term'] : null;

    $html = '';
    if ($term != null) {
        $args = array(
            'post_type' => 'event',
            'posts_per_page' => '6',
            'post_status' => 'publish',
            'field' => 'ids',
            'tax_query' => array(
                array(
                    'taxonomy' => 'event-location',
                    'terms' => $term,
                )
            )
        );

        $events = get_posts($args);
        
        foreach($events as $event) {
            $html .= get_article_card($event);
        }
    }
    
    echo $html;
    wp_die();
}


/**
 * Gets the description, full text and main image for an eventbrite event
 * Eventbrite API docs: https://www.eventbrite.com/platform/api#/reference/event/retrieve/retrieve-an-event
 */

function get_eventbrite_event_data($post_id) {
    
    // If event is not linked to eventbrite, do nothing
    if (! get_field('is_eventbrite', $post_id) || ! get_field('eventbrite_id', $post_id)) {
        return;
    }
    
    $eb_private_token = get_field('eb_private_token', 'option');
    
    /**
     * GET request on main event endpoint to get event summary, image and url.
     */
    
    $eb_event_endpoint = "https://www.eventbriteapi.com/v3/events/" . get_field('eventbrite_id', get_the_ID()) . '/?expand=venue';
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $eb_event_endpoint);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Authorization: Bearer " . $eb_private_token
    ));
    
    $response = curl_exec($ch);
    curl_close($ch);
    
    $event_data = json_decode($response);
    
    return $event_data;
}



/**
 * If event is linked to Eventbrite, get page content from eventbrite
 */

function get_event_content_from_eventbrite($post_id = null) {
    if ($post_id == null) {
        return;
    }

    $eb_description_endpoint = "https://www.eventbriteapi.com/v3/events/" . get_field('eventbrite_id', $post_id) . '/description/';
    $eb_private_token = get_field('eb_private_token', 'option');

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $eb_description_endpoint);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Authorization: Bearer " . $eb_private_token
    ));

    $response = curl_exec($ch);
    curl_close($ch);
    return json_decode($response)->description;
}