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
$start404Content = <<< EOD
<section>
<h1 class="hlv-1">404 :: File not found.</h1>
<div class="articleBody">
EOD
;
$end404Content = <<< EOD
</div>
<p><a href="$siteURL" class="btn">Home</a></p>
</section>
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
echo $start404Content."\n";

/**
 * loop-base.php を投稿数に応じてループする
 */
if(is_search())
{
  echo '<p>お探しのキーワードに合った記事が見つかりません。</p>'."\n";
}
else
{
  echo '<p>お探しのページは一時的にアクセス出来ない状況にあるか、移動もしくは削除された可能性があります。</p>'."\n";
}

/**
 * 404 Modules 終了
 *
 * @see $end404Content
 */
echo $end404Content."\n";

?>
