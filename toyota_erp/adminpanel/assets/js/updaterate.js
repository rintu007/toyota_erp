/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

;
(function($) {

    $.fn.updaterating = function(callback) {


        callback = callback || function() {
        };

        // each for all item
        this.each(function(i, v) {

            $(v).data('urating', {callback: callback})
                    .bind('init.urating', $.fn.rating.init)
                    .bind('set.urating', $.fn.rating.set)
                    .bind('hover.urating', $.fn.rating.hover)
                    .trigger('init.urating');
        });
    };

    $.extend($.fn.rating, {
        init: function(e) {
            var el = $(this),
                    list = '',
                    isChecked = null,
                    childs = el.children(),
                    i = 0,
                    id = 1,
                    l = childs.length;

            for (; i < l; i++) {
                list = list + '<a id="StaffRating' + parseInt(i + id) + '" class="star" title="' + $(childs[i]).val() + '" />';
                if ($(childs[i]).is(':checked')) {
                    isChecked = $(childs[i]).val();
                }
                ;
            }
            ;

            childs.hide();

            el
                    .append('<div class="updatestars">' + list + '</div>')
                    .trigger('set.urating', isChecked);

            $('a', el).bind('click', $.fn.rating.click);
            el.trigger('hover.urating');
        },
        set: function(e, val) {
            var el = $(this),
                    item = $('a', el),
                    input = undefined;

            if (val) {
                item.removeClass('fullStar');

                input = item.filter(function(i) {
                    if ($(this).attr('title') == val)
                        return $(this);
                    else
                        return false;
                });

                input
                        .addClass('fullStar')
                        .prevAll()
                        .addClass('fullStar');
            }

            return;
        },
        hover: function(e) {
            var el = $(this),
                    stars = $('a', el);

            stars.bind('mouseenter', function(e) {
                // add tmp class when mouse enter
                $(this)
                        .addClass('tmp_fs')
                        .prevAll()
                        .addClass('tmp_fs');

                $(this).nextAll()
                        .addClass('tmp_es');
            });

            stars.bind('mouseleave', function(e) {
                // remove all tmp class when mouse leave
                $(this)
                        .removeClass('tmp_fs')
                        .prevAll()
                        .removeClass('tmp_fs');

                $(this).nextAll()
                        .removeClass('tmp_es');
            });
        },
        click: function(e) {
            e.preventDefault();
            var el = $(e.target),
                    container = el.parent().parent(),
                    inputs = container.children('input'),
                    rate = el.attr('title');

            matchInput = inputs.filter(function(i) {
                if ($(this).val() === rate)
                    return true;
                else
                    return false;
            });

            matchInput.attr('checked', true);

            container
                    .trigger('set.urating', matchInput.val())
                    .data('urating').callback(rate, e);
        }
    });

})(jQuery);