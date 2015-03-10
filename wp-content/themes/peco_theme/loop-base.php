<?php

include 'variables.php';

//=============================================================================
//  変数など
//=============================================================================

/**
 * Article Modules
 *
 * @var $startArticle  出力用ヒアドキュメント
 * @var $endArticle    出力用ヒアドキュメント
 * @var $htmlTag       htmlタグ
 * @var $cssClass      CSSクラス
 * @var $itemTypeScope microdata
 */
$htmlTag       = 'article';
$cssClass      = '';
$itemTypeScope = ' itemprop="blogPost" itemscope itemtype="http://schema.org/BlogPosting"';

// ページでは <section>
if (is_page())
{
  $htmlTag = 'section';
  $itemTypeScope = ' itemscope itemtype="http://schema.org/Article"';
}
// 個別ページ以外のリストでは <article>
else if (!is_single())
{
  $cssClass      = ' class="blk-orderList"';
}

$startArticle = <<< EOD
<$htmlTag$cssClass$itemTypeScope>
EOD
;
$endArticle = <<< EOD
</$htmlTag>
EOD
;

/**
 * 記事の出力設定
 *
 * @var $theTitle     記事タイトル
 * @var $theTime      投稿日時
 * @var $theCategory  カテゴリー
 * @var $theTag       タグ
 * @var $thePermalink 記事URL
 * @var $theContent   コンテンツ
 * @var $theExcerpt   抜粋文
 * @var $theThumbnail サムネイル
 * @var $itemType     microdata
 */
$theTitle     = '<h1 itemprop="name"><a href="'.get_permalink().'" itemprop="url">'.get_the_title().'</a></h1>';
$theTime      = '<time datetime="'.get_the_time('Y-m-d\TH:i:s+09:00').'" itemprop="datePublished">'.get_the_time('Y年m月d日').'</time>';
$theCategory  = get_the_category_list(', ');
$theTag       = get_the_tag_list('', ', ');
$theExcerpt   = get_the_excerpt();
$theContent   = get_the_content();
$theThumbnail = $themeDir.'/resource/imgs/noimage_square.png';

/**
 * キュレーター名
 *
 * @var string 指定されていない場合は空文字
 */
$theAuthor = get_post_meta( get_the_ID(), 'test_field', true );
if ( 0 < strlen( $theAuthor ) ) {
	$theAuthor = '<li class="author">診療日: ' . esc_html( $theAuthor ) . '</li>';
}

ob_start();
//get_template_part( 'mod', 'socialbuttons' );
$articleSocialModule = ob_get_contents();
ob_end_clean();

// microdata
if (is_single() || is_page())
{
  $itemType = 'articleBody';
}
else
{
  $itemType = 'description';
}

// HTML
if (is_single()) {
  if ($theExcerpt) $theExcerpt = '<p class="blk-articleExcerpt">'.$theExcerpt.'</p>';
  if ($theCategory) $theCategory = '<li class="categories"><span>Categories</span>'.$theCategory.'</li>';
  if ($theTag) $theTag = '<li class="tags" itemprop="keywords"><span>Tags</span>'.$theTag.'</li>';
}

// if has Thumbnail. Must use to exept single pages !!!
if (has_post_thumbnail())
{
  $theThumbnail = get_featured_image_url('thumbnail');
}
elseif (get_first_image_url())
{
  $theThumbnail = get_first_image_url();
}

/**
 * Article Modules * 各種モジュール
 *
 * @var $articleContenteModule 出力用ヒアドキュメント
 * @var $pageContenteModule    出力用ヒアドキュメント
 * @var $articleOderListModule 出力用ヒアドキュメント
 * @var $articleSocialModule   出力用ヒアドキュメント
 * @var $readMoreModule        出力用ヒアドキュメント
 * @var $startRelatedPosts     出力用ヒアドキュメント
 * @var $endRelatedPosts       出力用ヒアドキュメント
 */
$articleContenteModule = <<< EOD
$theTitle
$theExcerpt
<footer class="blk-articleFooter">
<ul>
<li class="time"><span>Posted on</span>{$theTime}</li>
{$theCategory}
{$theTag}
{$theAuthor}
</ul>
</footer>
{$articleSocialModule}
<div class="blk-articleBody" itemprop="{$itemType}">
{$theContent}
</div>
EOD
;
$pageContenteModule = <<< EOD
$theTitle
<div class="blk-pageBody" itemprop="$itemType">
$theContent
</div>
EOD
;
$articleOderListModule = <<< EOD
<figure class="blk-orderList_articleImage"><img src="$theThumbnail" alt="" itemprop="image" title=""></figure>
<div class="blk-orderList_articleBody" itemprop="$itemType">
$theTitle
<p class="excerpt">$theExcerpt</p>
<p class="time">$theTime</p>
</div>
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
echo $startArticle."\n";

// ----------------------------------------------------------------------------

/**
 * Content 出力
 *
 * @see $articleOderListModule
 * @see $readMoreModule
 */
if(is_single())
{
  echo $articleContenteModule."\n";
}
else if(is_page())
{
  echo $pageContenteModule."\n";
}
else
{
  echo $articleOderListModule."\n";
}

if ( comments_open() || get_comments_number() ) {
  comments_template();
}
// ----------------------------------------------------------------------------

/**
 * Article Modules 終了
 *
 * @see $startArticle
 */
echo $endArticle."\n";

?>
<div id="pageTopOrHome" class="pageTopOrHome pageTop">
<a href="#top" class="pageTop">ページトップへ</a>
<a href="/" class="home">ホームへ</a>
</div>

<?php if ( is_single() ) : ?>
<aside>
<?php echo $articleSocialModule; ?>
</aside>
<!--<section class="blk-relatedposts">
<h2 class="title"><span class="icon-pad-org">この記事を読んでいる人におすすめの記事</span></h2>
<?php /**wp_related_posts();*/ ?>
</section>
-->
<?php endif; ?>
