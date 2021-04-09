<?php
/*
 * Name: Image and Text
 * Section: content
 * Description: Image & Text
 *
 */

/* @var $options array */
/* @var $wpdb wpdb */

$default_options = array(
	'image_location' => 'right',
	'image_width' => 40,
    'image' => '',
    'image_caption' => '',
    'link_url' => '',
    'html'=>'<p style="text-align: left; margin: 0"></p>',
    'font_family'=>'',
    'font_size'=>'',
    'font_weight'=>'',
    'font_color'=>'',    
    'block_padding_left' => 0,
    'block_padding_right' => 0,
    'block_padding_top' => 0,
    'block_padding_bottom' => 0,
    'block_background' => ''
);

$options = array_merge($default_options, $options);
$tableWidth = 600;
$imageWidthPc = $options['image_width'];
$imageWidthPx = $tableWidth * ($imageWidthPc/100);
$textWidthPx = $tableWidth - $imageWidthPx;
$imageLocation = $options['image_location'];
$imageCaption = ($options['image_caption']) ? '<span style="text-align: center; display: block; font-size:12px;">' . $options['image_caption'] . '</span>' : '';

$image = '';
if (!empty($options['image']['id'])) {
	$image_original = wp_get_attachment_image_src($options['image']['id'],'large');
	$image_ratio =  $image_original[1]/$image_original[2];
	$size = [$imageWidthPx, round($imageWidthPx / $image_ratio) ,false];
    $image = tnp_resize($options['image']['id'], $size);
    if (!$image) {
        echo 'The selected media file cannot be processed';
        return;
    }
}
$image->link = $options['link_url'];

$image_class_name = 'columnImage';

if ($imageLocation == 'right'){
	$col1WidthPx 	= $textWidthPx;
	$col1Style 		= 'text';
	$col1Class 		= 'text-left';
	$col1Content 	= $options['html'];
	$col2WidthPx 	= $imageWidthPx;
	$col2Style 		= 'image';
	$col2Class		= 'image-right';
	$col2Content = TNP_Composer::image( $image, [ 'class' => $image_class_name ] );
	$col2Content .= $imageCaption;
}else{
	$col1WidthPx = $imageWidthPx;
	$col1Style 		= 'image';
	$col1Class 		= 'image-left';	
	$col1Content = TNP_Composer::image( $image, [ 'class' => $image_class_name ] );
	$col1Content .= $imageCaption;
	$col2WidthPx = $textWidthPx;
	$col2Style 		= 'text';
	$col2Class		= 'text-right';		
	$col2Content = $options['html'];
}


$text_font_family = empty( $options['font_family'] ) ? $global_text_font_family : $options['font_family'];
$text_font_size   = empty( $options['font_size'] ) ? $global_text_font_size : $options['font_size'];
$text_font_color  = empty( $options['font_color'] ) ? $global_text_font_color : $options['font_color'];
$text_font_weight = empty( $options['font_weight'] ) ? $global_text_font_weight : $options['font_weight'];

?>
<style>
    .text {
        font-family: <?php echo $text_font_family ?>;
        font-size: <?php echo $text_font_size ?>px;
        font-weight: <?php echo $text_font_weight ?>;
        color: <?php echo $text_font_color ?>;
        line-height: 1.5;
        padding: 0 15px 0 15px;
    }
    .image {
    	padding: 0 15px 0 15px;
    }
    
</style>


<table border="0" cellpadding="0" cellspacing="0" width="600" id="templateColumns">
    <tr>
        <td align="center" valign="top" width="<?php echo $col1WidthPx; ?>" class="templateColumnContainer">
            <table border="0" cellpadding="10" cellspacing="0" width="100%">
                <tr>
                    <td valign="top" inline-class="<?php echo $col1Style; ?>" class="<?php echo $col1Class; ?>">
                        <?php echo $col1Content; ?>
                    </td>
                </tr>
            </table>
        </td>
        <td align="center" valign="top" width="<?php echo $col2WidthPx; ?>" class="templateColumnContainer">
            <table border="0" cellpadding="10" cellspacing="0" width="100%">
                <tr>
                    <td valign="top" inline-class="<?php echo $col2Style; ?>" class="<?php echo $col2Class; ?>">
                        <?php echo $col2Content; ?>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
