<?php // Meeting Rooms booking modal
ob_start();
?>
    <h1><?php pll_e('Book room as a non-member'); ?></h1>
    
    <!-- <iframe src="https://workclockwise.member.site/externalbooker.aspx" scrolling="no" height="530" width="280" frameborder="no"></iframe> -->

    <div class="js-mr-modal-tel">
        <h2><?php pll_e('Book via telephone'); ?></h2>
        <p>T: <a href="#" target="_blank" class="js-mr-modal-tel-text" data-barba-prevent></a></p>
    </div>
    <div class="js-mr-modal-email">
        <h2><?php pll_e('Book via email'); ?></h2>
        <p>E: <a href="#" target="_blank" class="js-mr-modal-email-text" data-barba-prevent></a></p>
    </div>
<?php

$content = ob_get_clean();

echo get_small_modal($content, 'js-mr-modal');
?>