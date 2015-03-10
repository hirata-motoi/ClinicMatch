<?php
/**
 * subModule 用 Facebook Like Box モジュール
 *
 * @package WordPress
 * @subpackage PECO Original
 * @author PECO <info@peco-japan.com>
 * @version PECO Original Theme 1.0
 * @since PECO Original Theme 1.0
 */

$fbLikeBoxWidth  = isset($width)  && is_numeric($width)  ? (int)$width  : 300;
$fbLikeBoxHeight = isset($height) && is_numeric($height) ? (int)$height : 250;
$fbLikeBoxClass  = isset($class) ? ' ' . $class : '';

?>
<aside class="blk-fbLikeBox<?php echo esc_attr($fbLikeBoxClass); ?>">
<div class="fb-like-box" data-href="https://www.facebook.com/pages/PECO%E3%83%9A%E3%82%B3/399909446834300" data-width="<?php echo esc_attr($fbLikeBoxWidth); ?>" data-height="<?php echo esc_attr($fbLikeBoxHeight); ?>" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="false"></div> 
</aside>
