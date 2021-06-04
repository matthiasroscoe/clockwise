<?php 
    if ($m['large_text']) {
        $m['text_size'] = 'large';
        $m['content'] = $m['large_text'];
        include('article/text.php');
    }

    if ($m['paragraphs']) {
        $m['text_size'] = false;
        $m['content'] = $m['paragraphs'];

        $m['buttons'] = array($m['button']);
        include('article/text.php');
    }
?>