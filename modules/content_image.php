<?php 
    if ($m['style'] == '4') {
        include('content_image/content-image--style-4.php');
    } 
    else if ($m['style'] == '5') {
        $m['text'] = $m['content'];
        $m['section_heading'] = $m['subheading'];
        include('article/text_image.php');
    } 
    else {
        include('content_image/content-image.php');
    }
?>