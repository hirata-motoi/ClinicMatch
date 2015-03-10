<?php

include 'variables.php';

//=============================================================================
//  変数など
//=============================================================================

/**
 * 記事の出力設定
 *
 * @var $theTitle     記事タイトル
 * @var $theTime      投稿日時
 * @var $thePermalink 記事URL
 * @var $theThumbnail サムネイル
 */
$theTitle     = get_the_title();
$theTime      = '<time datetime="'.get_the_time('Y-m-d\TH:i:s+09:00').'" itemprop="datePublished">'.get_the_time('Y年m月d日').'</time>';
$theThumbnail = $themeDir.'/resource/imgs/noimage_square.png';
$thePermalink = get_permalink();

// if has Thumbnail. Must use to exept single pages !!!
if (has_post_thumbnail())
{
  $theThumbnail = get_featured_image_url('medium');
}
elseif (get_first_image_url())
{
  $theThumbnail = get_first_image_url();
}

/**
 * Article Modules * 各種モジュール
 *
 * @var $pickupArticleOderListModule 出力用ヒアドキュメント
 */
$pickupArticleOderListModule = <<< EOD
<article class="blk-pickupList_item" itemprop="blogPost" itemscope="" itemtype="http://schema.org/BlogPosting">
<figure class="blk-pickupList_articleImage" style="background-image:url($theThumbnail)"><img src="$theThumbnail" alt="" itemprop="image" title="" style="visibility:hidden"></figure>
<div class="blk-pickupList_articleBody" itemprop="description">
<h1 itemprop="name"><a href="$thePermalink" itemprop="url">$theTitle</a></h1>
<p class="time">$theTime</p>
</div>
</article>
EOD
;


//=============================================================================
//  出力処理
//=============================================================================

/**
 * Article Modules
 *
 * @see $startArticle
 */
echo $pickupArticleOderListModule."\n";

?>