/**
 * @fileOverview IE用
 */
(function($)
{
  "use strict";

  /**
   * document 実行処理
   */
  $(document).on({
    'ready': function(){
      var $elePickupImage = $('.blk-pickupList_articleImage');
      $elePickupImage.css('background-size', 'cover');
    }
  });

})(jQuery);
