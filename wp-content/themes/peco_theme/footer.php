<?php

include 'variables.php';

//=============================================================================
//  変数など
//=============================================================================

/**
 * Footer Modules
 *
 * @var $startFooter 出力用ヒアドキュメント
 * @var $endFooter   出力用ヒアドキュメント
 */
$startFooter = <<< EOD
<footer role="contentinfo" class="siteFooter">
EOD
;
$endFooter = <<< EOD
</footer>
EOD
;

/**
 * Footer Modules * 各種モジュール
 *
 * @var $copyrightModule  出力用ヒアドキュメント
 */
$copyrightModule = <<< EOD
<p class="copyright">
<small>&copy; 2014-$dateYear PECO.</small>
</p>
EOD
;

/**
 * JavaScript 読み込み用 HTML タグ
 *
 * @var $siteScripts 出力用ヒアドキュメント
 * @var $topScripts  出力用ヒアドキュメント
 */
//<script src="$themeDir/resource/scripts/all.min.js"></script>
$siteScripts = <<< EOD
<script src="https://code.jquery.com/jquery-1.11.2.js"></script>
<script src="$themeDir/resource/bootstrap/js/bootstrap.js"></script>
EOD
;
$topScripts = <<< EOD
<!--[if lt IE 8]><script src="$themeDir/resource/scripts/ie.min.js"></script><![endif]-->
EOD
;

//=============================================================================
//  出力処理
//=============================================================================

/**
 * Footer Modules 開始
 *
 * @see $startFooter
 */
echo $startFooter."\n";

?>
<div class="container">
<aside class="socialButtons">
<ul>
<li class="facebook"><div class="fb-like" data-href="http://peco-japan.com/" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div></li>
<li class="twitter"><a href="https://twitter.com/share" class="twitter-share-button" data-url="http://peco-japan.com/" data-via="PECO_japan" data-lang="ja">ツイート</a></li>
<li class="google"><div class="g-plusone" data-href="http://peco-japan.com/" data-size="medium"></div></li>
</ul>
</aside>
<?php

/**
 * Copyright 出力
 *
 * @see $copyrightModule
 */
echo $copyrightModule."\n";

echo "</div>";

/**
 * Footer Modules 終了
 *
 * @see $startFooter
 */
echo $endFooter."\n";

/**
 * JavaScript 読み込み開始
 *
 * @see $siteScripts
 * @see $singleScripts
 */
echo $siteScripts."\n";

if (is_home() && !is_smartphone()) {
  echo $topScripts."\n";
}

/**
 * GoogleAnalytics & Social JavaScript & FacebookRetargeting 出力
 *
 * @see $googleAnalytics
 * @see $socialJavaScript
 * @see $facebookRetargeting
 */
//echo $googleAnalytics."\n";
//echo $googleTagManager."\n";
//echo $socialJavaScript."\n";
//echo $facebookRetargeting."\n";

/**
 * 'wp_footer' アクションフックをスタート
 */
wp_footer();

/**
 * Body & HTML タグの終了
 *
 * @see $endBody
 */
echo $endBody."\n";

