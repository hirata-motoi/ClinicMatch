<?php

//=============================================================================
//  変数など
//=============================================================================

/**
 * Pickup Modules
 *
 * @var $startPickup 出力用ヒアドキュメント
 * @var $endPickup   出力用ヒアドキュメント
 */
$startPickup = <<< EOD
<div class="blk-pickup">
<div class="blk-pickup_inner">
<section class="blk-pickupList">
<h2 class="assistive">Pickup</h2>
EOD
;
$endPickup = <<< EOD
</section>
</div>
</div>
EOD
;

//=============================================================================
//  出力処理
//=============================================================================

/**
 * Pickup 出力
 *
 * @see $startPickup
 * @see $endPickup
 */
echo $startPickup."\n";

$pickup = get_pickup();
while ($pickup->have_posts()) {
  $pickup->the_post();
  get_template_part('loop','pickup');
}

echo $endPickup."\n";

