<?php

include 'variables.php';

//=============================================================================
//  変数など
//=============================================================================

/**
 * 404 Modules
 *
 * @var $start404Content 出力用ヒアドキュメント
 * @var $end404Content   出力用ヒアドキュメント
 */
$startContent = <<< EOD
EOD
;
$content = <<< EOD
<ul class="nav nav-tabs search-tab">
  <li class="active"><a href="#tab1" data-toggle="tab">地図から探す</a></li>
  <li><a href="#tab2" data-toggle="tab">症状から探す</a></li>
  <li><a href="#tab3" data-toggle="tab">診療科目から探す</a></li>
  <li><a href="#tab4" data-toggle="tab">最寄り駅から探す</a></li>
</ul>

<div id="myTabContent" class="tab-content">
  <div class="tab-pane in active" id="tab1">
    <p>地図から探す</p>
  </div>
  <div class="tab-pane" id="tab2">
    <p>症状から探す</p>
  </div>
  <div class="tab-pane" id="tab3">
    <p>診療科目から探す</p>
  </div>
  <div class="tab-pane" id="tab4">
    <p>最寄り駅から探す</p>
  </div>
</div>
EOD
;

$endContent = <<< EOD
EOD
;

//=============================================================================
//  出力処理
//=============================================================================

/**
 * 404 Modules 開始
 *
 * @see $start404Content
 */
echo $startContent."\n";

/**
 * loop-base.php を投稿数に応じてループする
 */
echo $content."\n";
/**
 * 404 Modules 終了
 *
 * @see $end404Content
 */
echo $endContent."\n";

?>
