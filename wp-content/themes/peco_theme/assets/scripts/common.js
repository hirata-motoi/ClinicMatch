/**
 * @fileOverview 共通
 */
(function($)
{
  'use strict';

  var FPS = 30
    , PAGE_TOP_OR_HOME_SHOW_POSY = 200
    , interval = 1000 / FPS
    , isAnimated = false
    , $pageTopOrHome = null
    , $window = $(window)
    , scrollTop = $window.scrollTop()
    ;

  $window.on({
      scroll: togglePageTopOrHome
    , touchend: function() {
        setTimeout(updatePageTopOrHome, 1);
      }
    , touchstart: function(e)
      {
        scrollTop = $window.scrollTop();
      }
  });

  /**
   * document 実行処理
   */

  $(document).on({
    'ready': function(){
      init();
    }
  });

  /**
   * 初期読み込み時の実行処理まとめ
   */
  function init()
  {
    var $eleScroll = $('a[href^=#]');

    $eleScroll.smoothScroll({
        play: -40
      , duration: 500
      , easing: 'easeOutQuad'
      , withHash: false
    });

    var $eleClickableBlock = $('.blk-orderList,.related_post li,.blk-pickupList_item');
    $eleClickableBlock.css({ cursor: 'pointer' });
    $eleClickableBlock.on({
      click: function() {
        var newUrl = $(this).find('a').eq(0).attr('href');
        window.location = newUrl;
      }
    });

    $pageTopOrHome = $('#pageTopOrHome');
    togglePageTopOrHome();
  }

  /**
   * ページトップ or ホームへ戻るボタンを表示・非表示します。
   *
   * スクロールした際の位置で表示・非表示を切り替えます。
   */
  function togglePageTopOrHome()
  {
    $pageTopOrHome.toggleClass('show', PAGE_TOP_OR_HOME_SHOW_POSY < $window.scrollTop());
  }

  /** ページトップ or ホームへ戻るボタンの内容を更新します。 */
  function updatePageTopOrHome()
  {
    var diffY = scrollTop - $window.scrollTop(); 
    if (diffY) {
      0 < diffY
        ? $pageTopOrHome.removeClass('pageTop').addClass('home')
        : $pageTopOrHome.removeClass('home').addClass('pageTop')
      ;
    }
  }

  /**
   * Easing: easeOutQuad
   */
  $.extend( jQuery.easing,{
    easeOutQuad: function (x, t, b, c, d) {
      return -c *(t/=d)*(t-2) + b;
    }
  });

})(jQuery);
