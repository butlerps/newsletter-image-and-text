<?php
/* @var $options array contains all the options the current block we're ediging contains */
/* @var $controls NewsletterControls */
/* @var $fields NewsletterFields */

$splits = array();
for ($i=10; $i<=90; $i+=10) {
    $splits["$i"] = $i . '%';
}
?>

<?php $fields->media('image', 'Choose an Image') ?>
<?php $fields->text('image_caption', 'Image Caption (optional)') ?>
<?php $fields->url('link_url', 'Image Link URL') ?>
<div class="tnp-field-row">
    <div class="tnp-field-col-2">
        <?php $fields->select('image_location', 'Image Location', ['left' => 'Left', 'right' => 'Right']) ?>
    </div>
    <div class="tnp-field-col-2">
        <?php $fields->select('image_width', 'Image Width', $splits) ?>
    </div>

</div>

<?php $fields->wp_editor( 'html', 'Enter Text', [
'text_font_family'  => $composer['text_font_family'],
'text_font_size'    => $composer['text_font_size'],
'text_font_weight'  => $composer['text_font_weight'],
'text_font_color'   => $composer['text_font_color'],
] ) 
?>

<?php $fields->block_commons() ?>
