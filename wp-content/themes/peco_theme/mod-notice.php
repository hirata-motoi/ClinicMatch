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
  お知らせ
</div>
<div>
<div>
おしらせを適当に
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
/**
 * 404 Modules 終了
 *
 * @see $end404Content
 */
echo $endContent."\n";

?>
