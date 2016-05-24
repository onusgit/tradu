/* 
 * jQuery Character count plugin
 * Provides a character counter for any text input or textarea
 * 
 */
(function ($) {

        $.fn.srcount = function (options) {
                var sr = $.extend({
                        infodiv: '#infodiv',
                        maxCount: 140,
                }, options);

                var s = $(this);

                if (!s.length) {
                        return false;
                }

                var count;
                var infodiv = $(options.infodiv); /* Placed the charcter remain count into this area */
                var limit = options.maxCount;


                var i = 0;
                if (i == 0) {
                        var text = $(s).val();
                        count = text.length;
                        $(infodiv).html((limit - count));
                        i++;
                }


                s.on('keypress keyup focusin blur cut paste', function () {
                        var text = $(s).val();
                        count = text.length;

                        if (count > limit) {
                                $(s).val(text.substr(0, limit));
                                return false;
                        } else {
                                $(infodiv).html((limit - count));
                                return true;
                        }
                })
        }
}(jQuery));