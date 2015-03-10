<?php

//=============================================================================
//  変数など
//=============================================================================

/**
 * metaの出力設定
 *
 * @var $siteTitle    サイトタイトル
 * @var $siteDesc     サイトの説明
 * @var $siteURL      サイトのURL
 */
$siteTitle = get_bloginfo('name');
$siteDesc  = get_bloginfo('description');
$siteURL   = get_bloginfo('url');

/**
 * ディレクトリのパス
 *
 * @var $themeDir    テンプレート
 */
$themeDir = get_stylesheet_directory_uri();

/**
 * Common * Date
 *
 * @var $dateYear     4桁の年
 */
$dateYear = date('Y');

/**
 * Body & HTML タグ
 *
 * @var $startBody 出力用ヒアドキュメント
 * @var $endBody   出力用ヒアドキュメント
 */
$startBody = <<< EOD
<body>
EOD
;
$endBody = <<< EOD
</body>
</html>
EOD
;

/**
 * Google Analytics
 *
 * @var $googleAnalytics 出力用ヒアドキュメント
 */
$googleAnalytics = <<< EOD
<!-- Google Analytics -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-58181614-1', 'auto');
  ga('send', 'pageview');
</script>
EOD
;

/**
 * Google タグマネージャの埋め込みスクリプト
 *
 * @var string
 */
$googleTagManager = <<< EOD
<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-TVX3P3"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-TVX3P3');</script>
<!-- End Google Tag Manager -->
EOD
;

/**
 * Social JavaScript
 *
 * @var $socialJavaScript 出力用ヒアドキュメント
 */
$socialJavaScript = <<< EOD
<!-- Facebook JavaScript SDK -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id; js.async = true;
  js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<!-- Twitter Javascript -->
<script type="text/javascript" charset="utf-8">
  window.twttr = (function (d,s,id) {
    var t, js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return; js=d.createElement(s); js.id=id; js.async=true;
    js.src="https://platform.twitter.com/widgets.js"; fjs.parentNode.insertBefore(js, fjs);
    return window.twttr || (t = { _e: [], ready: function(f){ t._e.push(f) } });
  }(document, "script", "twitter-wjs"));
</script>
<!-- Pocket Javascript -->
<script>!function(d,i){if(!d.getElementById(i)){var j=d.createElement("script");j.id=i;j.src="https://widgets.getpocket.com/v1/j/btn.js?v=1";var w=d.getElementById(i);d.body.appendChild(j);}}(document,"pocket-btn-js");</script>
<!-- Hatena Javascript -->
<script src="http://b.st-hatena.com/js/bookmark_button.js" charset="utf-8" async="async"></script>
<!-- Google +1 Javascript -->
<script src="https://apis.google.com/js/platform.js" async defer>
  {lang: 'ja'}
</script>
EOD
;

/**
 * Facebook Retargeting
 *
 * @var $facebookRetargeting 出力用ヒアドキュメント
 */
$facebookRetargeting = <<< EOD
<!-- Facebook Retargeting -->
<script>(function() {
  var _fbq = window._fbq || (window._fbq = []);
  if (!_fbq.loaded) {
    var fbds = document.createElement('script');
    fbds.async = true;
    fbds.src = '//connect.facebook.net/en_US/fbds.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(fbds, s);
    _fbq.loaded = true;
  }
  _fbq.push(['addPixelId', '857136387661132']);
})();
window._fbq = window._fbq || [];
window._fbq.push(['track', 'PixelInitialized', {}]);
</script>
<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?id=857136387661132&amp;ev=PixelInitialized" /></noscript>
EOD
;

