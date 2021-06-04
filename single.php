<?php get_header();

// Get hero module
if (get_post_type() == 'event' && get_field('is_eventbrite')) {
	$event_data = get_eventbrite_event_data(get_the_ID());
	
	$event_image = array(
		'sizes' => array(
			'hero' => $event_data->logo->original->url,
			'medium' => $event_data->logo->original->url,
		)
	);
	$m = array(
		'heading' 		=> get_the_title(),
		'text' 			=> '<p>' . $event_data->description->text . '</p>',
		'mobile_image' 	=> $event_image,
		'image' 		=> $event_image,
		'actions' 		=> 'eventbrite',
		'eb_date'		=> date('D dS F',strtotime($event_data->start->local)),
		'eb_start'		=> date('H:i',strtotime($event_data->start->local)),
		'eb_end'		=> date('H:i',strtotime($event_data->end->local)),
		'eb_venue'		=> $event_data->venue->name. ',<br/>' .implode(",\n",$event_data->venue->address->localized_multi_line_address_display),
	);
} else {
	$m = array(
		'heading' => get_the_title(),
		'text' => get_field('description'),
		'mobile_image' => get_field('thumbnail'),
	);

	if (get_field('has_overlay')) {
		$m['has_overlay'] = true;
	}
	if (get_field('landscape')) {
		$m['image'] = get_field('landscape');
	} else {
		$m['image'] = get_field('thumbnail');
	}
}
include('modules/hero.php');
?>

	<div id="article-content" class="u-rel">
		<?php 

			if (get_post_type() == 'event' && get_field('is_eventbrite')) {
				$content = get_event_content_from_eventbrite(get_the_ID());

				$m = array();
				$m['content'] = $content;
				$mod_num = 1;
				$m['buttons'] = array(
					array(
						'button_type' => 'link',
						'link' => array(
							'title' => pll__('Learn More'),
							'url' => $event_data->url,
							'target' => '_blank',
						)
					)
				);
				// echo '<div id="article-content" class="u-rel">';
				include('modules/article/text.php');
				// echo '</div>';
			} else {
				render_flexible_content_modules('modules', 'article'); 
			}

			include('modules/article/share_article.php');
			include('modules/article/related_articles.php');
		?>
	</div>

<?php get_footer();
