<?php

include 'variables.php';

$url   = esc_attr( isset( $url )   ? $url   : get_permalink() );
$title = esc_attr( isset( $title ) ? $title : get_the_title() );

?>
<div class="blk-socialButtons">
<ul>
<li class="facebook"><a href="http://www.facebook.com/sharer.php?u=<?php echo $url; ?>" target="_blank">シェアする</a></li>
<li class="twitter"><a href="http://twitter.com/intent/tweet?original_referer=<?php echo $url; ?>&amp;text=<?php echo $title; ?>&amp;url=<?php echo $url; ?>&amp;via=PECO_japan">ツイートする</a></li>
</ul>
<div class="line"><a href="line://msg/text/?<?php echo $title; ?>%0D%0A<?php echo $url; ?>"><img src="<?php echo esc_url( $themeDir ); ?>/resource/imgs/linebutton_36x60.png" width="36" height="60" alt="LINEで送る"></a></div>
<div class="facebook"><div class="fb-like" data-href="https://www.facebook.com/pages/PECO%E3%83%9A%E3%82%B3/399909446834300" data-layout="box_count" data-action="like" data-show-faces="false" data-share="false"></div></div>
<div class="fb-like pc" data-href="https://www.facebook.com/pages/PECO%E3%83%9A%E3%82%B3/399909446834300" data-width="680" data-layout="standard" data-action="like" data-show-faces="true" data-share="false"></div>
<div class="fb-like sp" data-href="https://www.facebook.com/pages/PECO%E3%83%9A%E3%82%B3/399909446834300" data-width="320" data-layout="standard" data-action="like" data-show-faces="true" data-share="false"></div>
</div>
