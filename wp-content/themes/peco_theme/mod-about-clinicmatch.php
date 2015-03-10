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

<button type="button" class="about-clinicmatch btn btn-success">くりまちとは</button>
