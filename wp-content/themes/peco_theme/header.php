<?php

include 'variables.php';

//=============================================================================
//  変数など
//=============================================================================

/**
 * metaの出力設定
 *
 * @var $metaTitle    タイトル
 * @var $metaDesc     ディスクリプション
 * @var $OGPTitle     OGP用タイトル
 * @var $OGPDesc      OGP用の説明
 * @var $OGPURL       OGP用のURL
 * @var $theTitle     ページタイトル
 * @var $thePermalink ページURL
 * @var $theExcerpt   ページ抜粋
 * @var $theThumbnail ページサムネイル
 * @var $metaCategory カテゴリータイトル
 * @var $metaTag      タグタイトル
 */
$metaTitle    = $siteTitle;
$metaDesc     = $siteDesc;

$OGPTitle     = $siteTitle;
$OGPDesc      = $siteDesc;
$OGPURL       = $siteURL;
$OGPImage     = $themeDir.'/resource/icon/ogp.png';
$OGPType      = 'website';
// $OGPfbID      = 'XXXXXXXXXXXXX';

$metaCategory = single_cat_title('Category :', false);
$metaTag      = single_cat_title('Tag :', false);
$metaArchive  = get_the_time('Y M');

if (have_posts())
{
  while (have_posts())
  {
    the_post();
    $theTitle     = get_the_title();
    $thePermalink = get_permalink();
    $theExcerpt   = get_the_excerpt();

    if (has_post_thumbnail())
    {
      if (get_featured_image_url('original-thumbnail-OGP')) $name = 'original-thumbnail-OGP';
      else $name = 'thumbnail';

      $theThumbnail = get_featured_image_url($name);
    }
    else if (get_first_image_url())
    {
      $theThumbnail = get_first_image_url();
    }
    else
    {
      $theThumbnail = $OGPImage;
    }
  }
}

if (is_single())
{
  $metaTitle  = $theTitle.' :: '.$siteTitle;
  $metaDesc   = $theExcerpt;
  $OGPTitle   = $theTitle;
  $OGPDesc    = $theExcerpt;
  $OGPURL     = $thePermalink;
  $OGPImage   = $theThumbnail;
  $OGPType    = 'article';
}
else if (is_page())
{
  $metaTitle  = $theTitle.' :: '.$siteTitle;
  $OGPTitle   = $theTitle.' :: '.$siteTitle;
  $OGPURL     = $thePermalink;
  $OGPType    = 'article';
}
else if (is_category())
{
  $metaTitle  = $metaCategory.' :: '.$siteTitle;
  $OGPTitle   = $metaCategory.' :: '.$siteTitle;
  $OGPURL     = $thePermalink;
  $OGPType    = 'article';
}
else if (is_tag())
{
  $metaTitle  = $metaTag.' :: '.$siteTitle;
  $OGPTitle   = $metaTag.' :: '.$siteTitle;
  $OGPURL     = $thePermalink;
  $OGPType    = 'article';
}
else if (is_archive())
{
  $metaTitle  = $metaArchive.' :: '.$siteTitle;
  $OGPTitle   = $metaArchive.' :: '.$siteTitle;
  $OGPURL     = $thePermalink;
  $OGPType    = 'article';
}

if (is_home() || is_page())
{
  $itemType = 'http://schema.org/WebPage';
}
else
{
  $itemType = 'http://schema.org/Blog';
}

/**
 * Head Modules
 *
 * @var $startHead 出力用ヒアドキュメント
 * @var $endHead   出力用ヒアドキュメント
 */
$startHead = <<< EOD
<!DOCTYPE html>
<html lang="ja-JP" itemscope itemtype="$itemType">
<head>
<meta charset="UTF-8">
<title>$metaTitle</title>
<meta name="description" content="$metaDesc">
<meta name="viewport" content="width=device-width">
<meta name="google-site-verification" content="G21L0hQMM-yp7SF1X7jdrij0MDK9qKL92o74bjX7Jw4">
EOD
;
$endHead = <<< EOD
</head>
EOD
;

/**
 * Head Modules * <head>
 *
 * @var $headLinksModule         出力用ヒアドキュメント
 * @var $headOGPModule           出力用ヒアドキュメント
 * @var $headTwitterCardModule   出力用ヒアドキュメント
 * @var $headOthersModule        出力用ヒアドキュメント
 */
$headLinksModule = <<< EOD
<link rel="author" href="$siteURL">
<link rel="icon" href="$themeDir/favicon.ico">
<link rel="apple-touch-icon" href="$themeDir/resource/icon/apple-touch-icon.png">
<link rel="apple-touch-icon-precomposed" href="$themeDir/resource/icon/apple-touch-icon-precomposed.png">
<link rel="alternate" type="application/rss+xml" href="$siteURL/feed/" title="RSS 2.0">
<link rel="alternate" type="application/atom+xml" href="$siteURL/feed/atom/" title="Atom cite contents">
<link rel="stylesheet" media="all" href="$themeDir/resource/css/style.css">
<link rel="stylesheet" media="all" href="$themeDir/resource/bootstrap/css/bootstrap.css">
EOD
;
$headOGPModule = <<< EOD
<!-- Open Graph protocol -->
<meta property="og:title" content="$OGPTitle">
<meta property="og:description" content="$OGPDesc">
<meta property="og:url" content="$OGPURL">
<meta property="og:image" content="$OGPImage">
<meta property="og:type" content="$OGPType">
<meta property="og:site_name" content="$siteTitle">
EOD
;
$headOthersModule = <<< EOD
<!--[if lt IE 9]><script src="$themeDir/resource/scripts/html5shiv.min.js"></script><![endif]-->
EOD
;

/**
 * Header Modules
 *
 * @var $startHeader 出力用ヒアドキュメント
 * @var $endHeader   出力用ヒアドキュメント
 */
$startHeader = <<< EOD
<header id="top" role="banner" class="siteHeader">
<h1><a href="$siteURL" class="siteid">$siteTitle</a></h1>
EOD
;
$endHeader = <<< EOD
</header>
EOD
;

//=============================================================================
//  出力処理
//=============================================================================

/**
 * Head Modules 開始
 *
 * @see $startHead
 */
echo $startHead."\n";

/**
 * <link> タグ関連出力
 *
 * @see $headLinksModule
 */
echo $headLinksModule."\n";

/**
 * OGP & Others 出力
 *
 * @see $headOGPModule
 * @see $headTwitterCardModule
 * @see $headOthersModule
 */
echo $headOGPModule."\n";
echo $headOthersModule."\n";

/**
 * 'wp_head' アクションフックをスタート
 */
wp_head();

/**
 * Head Modules 終了
 *
 * @see $endHead
 */
echo $endHead."\n";

/**
 * Body タグの開始
 *
 * @see $startBody
 */
echo $startBody."\n";

/**
 * Header Modules 出力
 *
 * @see $startHeader
 * @see $endHeader
 */
echo $startHeader."\n";
echo $endHeader."\n";

?>
