var peco = peco || {};

(function($)
{
  "use strict";

  /**
   * @class Browser
   */

  function Browser() {
    this.ua = navigator.userAgent.toLowerCase();
  }

  Browser.prototype = {

    isIE6: function() {
      return this.ua.indexOf('msie 6') != -1;
    },

    isIE7: function() {
      return this.ua.indexOf('msie 7') != -1;
    },

    isIE8: function() {
      return this.ua.indexOf('msie 8') != -1;
    },

    isIE9: function() {
      return this.ua.indexOf('msie 9') != -1;
    },

    isiPhone: function() {
      return this.ua.indexOf('iphone') != -1;
    },

    isAndroid: function() {
      return this.ua.indexOf('android') != -1;
    },

    isChrome: function() {
      return this.ua.indexOf('chrome') != -1;
    },

    isFirefox: function() {
      return this.ua.indexOf('firefox') != -1;
    }
  };

  // export
  var browser = new Browser();
  peco.browser = browser;

})(jQuery);