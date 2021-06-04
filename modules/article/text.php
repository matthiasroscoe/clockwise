<?php 
    $text_classes = 'article-text__text c-wysiwyg';
    if ($m['text_size']) {
        $text_classes .= ' article-text__text--large';
    }
?>

<section class="article-text module module--article module-<?php echo $mod_num; ?>">
    <div class="container-lg">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xxl-6">
                <?php if ($m['section_heading']) : ?>
                    <h2><?php echo $m['section_heading']; ?></h2>
                <?php endif; ?>

                <?php if ($m['content']) : ?>
                    <div class="<?php echo $text_classes; ?>">
                        <?php echo $m['content']; ?>
                    </div>
                <?php endif; ?>

                <?php if ($m['buttons']) : ?>
                    <div class="article-text__buttons">
                        <?php 
                            foreach($m['buttons'] as $btn) {
                                if (isset($btn['button_type'])) {
                                    $btn_data = $btn;
                                } else {
                                    $btn_data = array(
                                        'button_type' => 'link',
                                        'link' => $btn['link'],
                                    );
                                }
                                echo get_button(null, null, null, $btn_data); 
                            }
                        ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>