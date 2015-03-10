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
  クチコミ
</div>

<div style="border-bottom: solid 1px gray;">
新着クチコミ
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
get_template_part('tmp','comment');
/**
 * 404 Modules 終了
 *
 * @see $end404Content
 */
echo $endContent."\n";

?>
