<?php

//=============================================================================
//  変数など
//=============================================================================

/**
 * Sidebar Modules
 *
 * @var $startSidebar 出力用ヒアドキュメント
 * @var $endSidebar   出力用ヒアドキュメント
 */
$startSidebar = <<< EOD
<div class="subModule">
EOD
;
$endSidebar = <<< EOD
</div><!-- /.subModule -->
EOD
;

/**
 * Sidebar Modules * 広告
 *
 * @var $adModule Google AdSense
 */
$adModule = <<< EOD
EOD
;

$toClinicRelations = <<< EOD
<div style="margin-top:10px; margin-bottom:10px;">病院関係者の皆様へ</div>
EOD
;

/**
 * Twitter Widget
 *
 * @var string
 */
$twitterWidget = <<< EOD
<aside class="blk-twitter">
<a class="twitter-timeline" href="https://twitter.com/PECO_japan" data-tweet-limit="1" data-chrome="noborders nofooter noscrollbar" data-widget-id="560792943930249216">@PECO_japanさんのツイート</a>
</aside>
EOD
;

/**
 * Sidebar Modules * 各種リスト
 *
 * @var $startTagList       出力用ヒアドキュメント
 * @var $endTagList         出力用ヒアドキュメント
 * @var $startCartegoryList 出力用ヒアドキュメント
 * @var $endCartegoryList   出力用ヒアドキュメント
 * @var $startArchiveList   出力用ヒアドキュメント
 * @var $endArchiveList     出力用ヒアドキュメント
 */
$startTagList = <<< EOD
<nav class="blk-tagList">
<h2 class="title"><span class="icon-pad-org">人気のトピックス</span></h2>
EOD
;
$endTagList = <<< EOD
</nav>
EOD
;
$startCartegoriesList = <<< EOD
<nav class="categoriesList">
<h2>Categories</h2>
<ul>
EOD
;
$endCartegoriesList = <<< EOD
</ul>
</nav>
EOD
;
$startArchiveList = <<< EOD
<nav class="archiveList">
<h2>Archives</h2>
<ul>
EOD
;
$endArchiveList = <<< EOD
</ul>
</nav>
EOD
;

//=============================================================================
//  出力処理
//=============================================================================

/**
 * Sidebar Modules 開始
 *
 * @see $startSidebar
 */
echo $startSidebar."\n";

get_template_part_ex('mod', 'about-clinicmatch');
/*
get_template_part_ex('mod', 'facebook-likebox');
echo $twitterWidget."\n";
*/

/**
 * 広告 出力
 *
 * @see $adModule
 */
// echo $adModule."\n";

echo $toClinicRelations."\n";

/**
 * Widget 1
 */
if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('PECO_Widget_1'));

/**
 * Tag 出力
 *
 * @see $startTagList
 * @see $endTagList
 */
/*
echo $startTagList."\n";
original_tag_list();
echo $endTagList."\n";
*/

/**
 * Widget 2
 */
if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('PECO_Widget_2'));

/**
 * Sidebar Modules 終了
 *
 * @see $endSidebar
 */
echo $endSidebar."\n";

?>
