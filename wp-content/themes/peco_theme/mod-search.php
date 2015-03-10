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
<div class="blk-section">
EOD
;
$content = <<< EOD
<div class="blk-sectionHeader">
  くりまち検索
</div>
<div>
<div>あなたに合った病院を探そう！</div>
<div style="text-align: center;">

<div class="box-section box-gray">
エリア
<input type="text">
</div>

<div class="box-section box-gray">
症状
<input type="text">
</div>

<button class="search-submit-button">検 索</button>

</div>
</div>

<div>
EOD
;
$endContent = <<< EOD
</div>
</div>
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
get_template_part('mod', 'searchTab');
/**
 * 404 Modules 終了
 *
 * @see $end404Content
 */
echo $endContent."\n";

?>
