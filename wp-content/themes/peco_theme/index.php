<?php

//=============================================================================
//  変数など
//=============================================================================

/**
 * Content Modules
 *
 * @var $startContent 出力用ヒアドキュメント
 * @var $endContent   出力用ヒアドキュメント
 */
$startContent = <<< EOD
<div class="siteContents">
EOD
;
$endContent = <<< EOD
</div><!-- /.siteContents -->
EOD
;

/**
 * Main Modules
 *
 * @var $htmlTag      HTMLタグ
 * @var $sectionTitle HTMLタグ
 * @var $tagTitle     タグ・カテゴリー
 * @var $archiveTitle アーカイブのタイトル
 * @var $startMain    出力用ヒアドキュメント
 * @var $endMain      出力用ヒアドキュメント
 */
$htmlTag = 'div';
$sectionTitle = '';
$tagTitle     = single_cat_title('', false);
$archiveTitle = get_the_time('Y M');

if (is_category() || is_tag()){
  $htmlTag = 'section';
  $sectionTitle = '<h1 class="title"><span class="icon-pad-org">「'.$tagTitle.'」の記事一覧</span></h1>';
}
elseif (is_archive()){
  $htmlTag = 'section';
  $sectionTitle = '<h1 class="title"><span class="icon-pad-org">「'.$archiveTitle.'」の記事一覧</span></h1>';
}
elseif (is_home()) {
//  $sectionTitle = '<h2 class="title"><span class="icon-pad-org">注目まとめ</span></h2>';
//  $sectionTitle = '<h2 class="title"><span class="icon-pad-org">検索</span></h2>';
}

$startMain = <<< EOD
<$htmlTag role="main" class="mainModule">
$sectionTitle
EOD
;
$endMain = <<< EOD
</$htmlTag><!-- /.mainModule -->
EOD
;

//=============================================================================
//  出力処理
//=============================================================================

/**
 * ヘッダーテンプレートを読み込む
 */
get_header();

/**
 * ピックアップ
 */
if(is_home() && !is_paged())
{
//  get_template_part('mod','pickup');
//  get_template_part('mod','search');
}

/**
 * Content Modules 開始
 *
 * @see $startContent
 */
echo $startContent."\n";

// ----------------------------------------------------------------------------
/**
 * Main Modules 開始
 *
 * @see $startMain
 */
echo $startMain."\n";

/**
 * 404 のテンプレートを読み込む
 */
if(is_404())
{
  get_template_part('tmp','404');
}

/**
 * Base のテンプレートを読み込む
 * - 分岐対象外のページすべてが対象
 */
else
{
  if (is_home()) {
    get_template_part('mod','search');
    get_template_part('mod','ranking');
    get_template_part('mod', 'review');
    get_template_part('mod', 'notice');
  } else {
    get_template_part('tmp', 'base');
  }
  if(function_exists('wp_pagenavi')) { wp_pagenavi(); }
}

/**
 * Main Modules 終了
 *
 * @see $endMain
 */
echo $endMain."\n";

/**
 * サイドバーテンプレートを読み込む
 */
get_sidebar();

// ----------------------------------------------------------------------------

/**
 * Content Modules 終了
 *
 * @see $endContent
 */
echo $endContent."\n";

/**
 * フッターテンプレートを読み込む
 */
get_footer();
?>
