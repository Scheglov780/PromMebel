var searchTimerId;

function isNumberKey(evt) {
    let charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    } else {
        return true;
    }
}

function callScheduler() {
    try {
        $.ajax({
            type: 'GET',
            cache: false,
            url: '/scheduler',
            xhrFields: {
                withCredentials: true
            },
            timeout: 60000,
            success: function (data, textStatus, request) {
                console.log('Scheduled events: processed');
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log('Scheduled events: error');
            }
        });
    } catch (e) {
        console.log('Scheduled events: error');
    }
}

/**
 * @description Инициализирует слайдер Slick см. {@link https://kenwheeler.github.io/slick/}
 * @param {Object|String} sliderSelector - селектор или элемент слайдера
 * @param {Object|String} sliderPreviewSelector  - селектор или элемент навигатора слайдера
 * @param {boolean} multiRow - использовать ли навигацию в многострочном режиме
 */
function productSliderInit(sliderSelector, sliderPreviewSelector, multiRow) {
    $(sliderSelector).on('init', function (event, slick) {
        if (typeof multiRow == 'undefined' || multiRow == false) {
            setTimeout(function () {
                $(sliderPreviewSelector)
                    .on('init', function (event, slick) {
                    })
                    .slick({
                        infinite: true,
                        slidesToShow: 5,
                        slidesToScroll: 1,
                        swipeToSlide: true,
                        lazyLoad: 'ondemand',
                        asNavFor: sliderSelector,
                        arrows: false,
                        focusOnSelect: true,
                        centerMode: true,
                        autoplay: false,
                        fade: false
                    });
            }, 0, sliderSelector, sliderPreviewSelector);
        } else if (multiRow == true) {
            setTimeout(function () {
                $(sliderPreviewSelector)
                    .on('init', function (event, slick) {
                        $(sliderPreviewSelector + ' .product-sub-img')
                            .css({margin: '10px'});
                        $(sliderPreviewSelector + ' .slick-track')
                            .css({display: 'contents'});
                    })
                    .slick({
                        infinite: false,
                        slidesToShow: 5,
                        slidesToScroll: 1,
                        swipeToSlide: false,
                        lazyLoad: 'ondemand',
                        asNavFor: sliderSelector,
                        arrows: false,
                        focusOnSelect: true,
                        autoplay: false,
                        autoplaySpeed: 2000,
                        fade: false
                    });
            }, 0, sliderSelector, sliderPreviewSelector);
            /* Просто, но не красиво...
            $(sliderPreviewSelector+' > div')
                .css({margin: '2vh',float: 'left'})
                .click(function() {
                $(sliderSelector).slick('slickGoTo',$(this).index());
            }) */
        }
    }).on('afterChange', function (e, o) {
        //on change slide = do action
        $('iframe').each(function () {
            $(this)[0].contentWindow.postMessage('{"event":"command","func":"' + 'pauseVideo' + '","args":""}', '*');
        });
    }).slick(
        {
            infinite: false,
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            lazyLoad: 'ondemand',
            fade: false,
            useTransform: true,
            cssEase: 'ease',
            asNavFor: sliderPreviewSelector
        }
    );
}

function windowResized() {
    let popupHeight = $(window).height() - ($('.header-top').outerHeight()
        + $('.popup-cart .header').outerHeight()
        + $('.popup-cart .footer').outerHeight()) + 'px';
    $('.popup-cart .popup-body').css({maxHeight: popupHeight});
    $('.popup-favorite .popup-body').css({maxHeight: popupHeight});
    $('.popup-comparison .popup-body').css({maxHeight: popupHeight});

    if ($(window).width() <= '657') {
        $('.footer_sl_tooggle').parent().addClass('mobilesw');
        $('.footer_sl').slideUp();
    } else {
        $('.footer_sl_tooggle').parent().removeClass('mobilesw');
        $('.footer_sl_tooggle').removeClass('footer_sl_tooggle_mobilesw');
        $('.footer_sl').slideDown();
    }
}

$(window).on('load resize', function (e) {
    windowResized();
});
$('.footer_sl_tooggle').on('click', function () {
    if ($(window).width() <= '657') {
        $(this).siblings().slideToggle();
        $(this).toggleClass('footer_sl_tooggle_mobilesw');
    }
});
jQuery(document).ready(function ($) {
    'use strict';
    $('#recommend-slider').on('init', function (event, slick) {
        //init code goes here
    }).slick({
        dots: false,
        speed: 500,
        arrows: true,
        autoplay: true,
        vertical: true,
        slidesToShow: 2,
        slidesToScroll: 2,
        verticalSwiping: true,
        appendArrows: $('.recommend-side .sub-cont-header'),
        prevArrow: '<div class="rec-arrow-cont prev"><svg width="24" height="20" viewBox="0 0 24 20" xmlns="http://www.w3.org/2000/svg">\n' +
            '<path d="M23.6164 9.06595L14.9491 0.383864C14.7017 0.136033 14.372 0 14.0204 0C13.6684 0 13.3388 0.136229 13.0914 0.383864L12.3045 1.17231C12.0573 1.41975 11.9211 1.75025 11.9211 2.10265C11.9211 2.45485 12.0573 2.7965 12.3045 3.04394L17.3608 8.11997H1.29657C0.572288 8.11997 0 8.68795 0 9.41365V10.5283C0 11.254 0.572288 11.8793 1.29657 11.8793H17.4182L12.3047 16.9836C12.0575 17.2315 11.9213 17.553 11.9213 17.9054C11.9213 18.2574 12.0575 18.5836 12.3047 18.8312L13.0916 19.6171C13.339 19.8649 13.6686 20 14.0206 20C14.3722 20 14.7019 19.8632 14.9493 19.6154L23.6166 10.9335C23.8646 10.6849 24.001 10.353 24 10.0002C24.0008 9.64624 23.8646 9.31417 23.6164 9.06595Z" fill="white"/>\n' +
            '</svg>\n</div>',
        nextArrow: '<div class="rec-arrow-cont next"><svg width="24" height="20" viewBox="0 0 24 20" xmlns="http://www.w3.org/2000/svg">\n' +
            '<path d="M23.6164 9.06595L14.9491 0.383864C14.7017 0.136033 14.372 0 14.0204 0C13.6684 0 13.3388 0.136229 13.0914 0.383864L12.3045 1.17231C12.0573 1.41975 11.9211 1.75025 11.9211 2.10265C11.9211 2.45485 12.0573 2.7965 12.3045 3.04394L17.3608 8.11997H1.29657C0.572288 8.11997 0 8.68795 0 9.41365V10.5283C0 11.254 0.572288 11.8793 1.29657 11.8793H17.4182L12.3047 16.9836C12.0575 17.2315 11.9213 17.553 11.9213 17.9054C11.9213 18.2574 12.0575 18.5836 12.3047 18.8312L13.0916 19.6171C13.339 19.8649 13.6686 20 14.0206 20C14.3722 20 14.7019 19.8632 14.9493 19.6154L23.6166 10.9335C23.8646 10.6849 24.001 10.353 24 10.0002C24.0008 9.64624 23.8646 9.31417 23.6164 9.06595Z" fill="white"/>\n' +
            '</svg>\n</div>',
        autoplaySpeed: 5000,
        responsive: [
            {
                breakpoint: 1366,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    vertical: false,
                    verticalSwiping: false,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    vertical: true,
                    verticalSwiping: true,
                }
            },
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });
    $('#slider')
        .on('init', function (event, slick) {
            //init code goes here
        })
        .slick({
            dots: true,
            speed: 500,
            fade: true,
            arrows: false,
            autoplay: true,
            autoplaySpeed: 5000
        });
    $('#slider').on('beforeChange', function (event, slick, direction) {
        $('.rec-c').toggleClass('active');
    });

    $('.popup-search .popup-search-close').on('click', function (event) {
        $('.popup-search').hide();
    });

    $('body').on('click', '.clpop', function (e) {
        let destroy = $(e.currentTarget).hasClass('clpop-destroy');
        let poup = $(this).closest('.poup.open');//.attr('id')
        closePopup($(poup).attr('id'), destroy);
    });

    $('body').on('click', '.request-message-form .formclose', function (e) {
        //let destroy = $(e.currentTarget).hasClass('clpop-destroy');
        $(this).parents('.request-message-form').remove();
    });

    $(document).on('keydown', '.poup.open', function (e) {
        let key = e.which;
        if (key == 27) {
            e.preventDefault();
            let poup = e.currentTarget;//.attr('id')
            closePopup($(poup).attr('id'));
        }
    });
    $('.mobile-filter-toggle').on('click', function () {
        $(this).toggleClass('active-filter-toggle');
        $('.filter-block').slideToggle('fast');
    });

    $('body').on('input', 'input.product-count', function (e) {
        let inp = $(e.currentTarget);
        changeSum(inp);
    });
    $('body').on('click', 'input.product-count', function (e) {
        e.preventDefault();
    });
    $('body').on('keypress', 'input.product-count', function (e) {
        return isNumberKey(e);
    });

    $('.comparisonblock .star').on('click', function (e) {
        e.preventDefault();
        if (!$(this).hasClass('icon-empty')) {
            let data = [];
            let id = parseInt($(this).data('product-id'));
            data.push({
                id: id
            });
            $('.comparisonblock .star[data-product-id=' + id + ']').addClass('icon-empty');
            $('.comparisonblock .star[data-product-id=' + id + ']').attr('title', 'Товар уже в избранном');
            addToFavorite(data);
        }
        return false;
    });
    $('.comparisonblock .comparisonbutton').on('click', function (e) {
        e.preventDefault();
        if (!$(this).hasClass('icon-empty')) {
            let data = [];
            let id = parseInt($(this).data('product-id'));
            data.push({
                id: id
            });
            $('.comparisonblock .comparisonbutton[data-product-id=' + id + ']').addClass('icon-empty');
            $('.comparisonblock .comparisonbutton[data-product-id=' + id + ']').attr('title', 'Товар уже в сравнении');
            addToComparison(data);
        }
        return false;
    });

    $('body').on('click', '.plus', function (e) {
        e.preventDefault();
        //let inp = $(this).siblings('.count').find('input');
        let inp = $(e.currentTarget).siblings('.count').find('input');
        let count = parseInt(inp.val());
        inp.val(count + 1);
        if ($(this).hasClass('is_cart')) {
            inp.trigger('input');
        } else {
            /* Добавлено для перерасчёта суммы в сериях */
            if (inp.hasClass('product-count')) {
                inp.trigger('input');
            }
        }
    });
    $('body').on('click', '.minus', function (e) {
        e.preventDefault();
        //let inp = $(this).siblings('.count').find('input');
        let inp = $(e.currentTarget).siblings('.count').find('input');
        let count = parseInt(inp.val());
        let min = inp.hasClass('can-zero') ? 0 : 1;
        if (count > min) {
            inp.val(count - 1);
        }
        if ($(this).hasClass('is_cart')) {
            inp.trigger('input');
        } else {
            /* Добавлено для перерасчёта суммы в сериях */
            if (inp.hasClass('product-count')) {
                inp.trigger('input');
            }
        }
    });
    $('.city-menu').on('click', function () {
        $('.cities-mobile-cont').slideToggle(300);
    });
    $('.mobile-menu .parent-item > a').on('click', function (e) {
        if (e.target.tagName == 'IMG') {
            e.preventDefault();
            let ul = $(this).siblings('ul');
            if (ul.hasClass('open')) {
                ul.slideUp();
                ul.removeClass('open');
            } else {
                ul.slideDown();
                ul.addClass('open');
            }
        }
    });
    $('.btn-menu').on('click', function () {
        openMobileMenu();
    });
    $('.catalog-menu').on('click', function () {
        openMobileMenu();
    });
    $('body').find('.favorite-ajax, .favorite-content').on('click', '.delete-from-favorite', function (e) {
        e.preventDefault();
        $('.comparisonblock .star[data-product-id=' + $(this).data('product-id') + ']').removeClass('icon-empty');
        $('.comparisonblock .star[data-product-id=' + $(this).data('product-id') + ']').attr('title', 'Добавить в избранное');
        deleteFromFavorite($(this).data('product-id'));
    });
    $('body').find('.popup-favorite, .favorite-content, .favorite-entity').on('click', '.clear-favorite', function (e) {
        e.preventDefault();
        $('.comparisonblock .star').removeClass('icon-empty');
        $('.comparisonblock .star').attr('title', 'Добавить в избранное');
        deleteFromFavorite(0);
    });
    $('body').find('.comparison-ajax, .comparison-content, .comparison-entity').on('click', '.delete-from-comparison', function (e) {
        e.preventDefault();
        $('.comparisonblock .comparisonbutton[data-product-id=' + $(this).data('product-id') + ']').removeClass('icon-empty');
        $('.comparisonblock .comparisonbutton[data-product-id=' + $(this).data('product-id') + ']').attr('title', 'Добавить в сравнение');
        deleteFromComparison($(this).data('product-id'));
    });
    $('body').find('.popup-comparison, .comparison-content, .comparison-entity').on('click', '.clear-comparison', function (e) {
        e.preventDefault();
        $('.comparisonblock .comparisonbutton').removeClass('icon-empty');
        $('.comparisonblock .comparisonbutton').attr('title', 'Добавить в сравнение');
        deleteFromComparison(0);
    });
    $('.calculated-data-products').on('click', '.delete-from-cart', function () {
        deleteFromCart($(this).data('product-id'));
    });
    $('.popup-cart').on('click', '.clear-cart', function () {
        deleteFromCart(0);
    });
    $(document).on('click', '.in-cart-btn, .to-cart-from-favorite, .to-cart-from-comparison', function (e) {
        e.preventDefault();
        var data = [];
        var id = parseInt($(this).data('product-id'));
        var count = parseInt($(this).parents('.calculated-data-product').find('input').val());
        data.push({
            id: id,
            count: count
        });
        addToCart(data);
    });
    /*	$('.one-click-buy').on('click', function(e){		showPopup('', 'popup-oneclick');	}); */
    $('.series-add-to-cart-btn').on('click', function (e) { //was #series-add-to-cart-btn
        e.preventDefault();
        var data = [];
        var inpTable = $(e.currentTarget).closest('table.series');
        var inp = inpTable.find('input.product-count');
        $.each(inp, function (i, input) {
            var id = parseInt($(input).data('product-id'));
            var count = parseInt($(input).val());
            data.push({
                id: id,
                count: count
            });
        });
        addToCart(data);
    });
    $('.background').on('click', function () {
        closeMobileMenu();
    });
    $('.category-select').on('select', function () {
        console.log($(this).val());
    });
    $('.category-select').on('change', function () {
        var arrayOfStrings = $(this).val().split('+');
        if (arrayOfStrings[0] == 'slug') {
            window.location.href = '/category/' + arrayOfStrings[1];
        }
        if (arrayOfStrings[0] == 'dslug') {
            window.location.href = arrayOfStrings[1];
        }
        if (arrayOfStrings[0] == 'anchor') {
            window.scrollTo(0, $('a[name="catanch+' + arrayOfStrings[1] + '"]').offset().top);
        }
    });
    $('select').on('change', function () {
        $(this).css({'color': '#313132'});
    });
    $('.serch-icon').on('click', function () {
        let text = $('#search').val();
        search(text);
    });
    $('#search').on('keyup', function (e) {
        let text = $(this).val();
        search(text, 1000);
    });

    $('#callback-button').on('click', function () {
        $.ajax({
            url: '/message',
            data: {
                name: $('#callback-name').val(),
                phone: $('#callback-phone').val(),
            },
            type: 'POST',
            dataType: 'json',
            success: function (json) {
                $('#callback-name + .help-b').text('');
                $('#callback-phone + .help-b').text('');
                if (json.result) {
                    showPopup(json.message, 'popup-favorite');
                    setTimeout(closePopup, 5000, 'popup-favorite');
                    $('#callback-name').val('');
                    $('#callback-phone').val('');
                } else {
                    if (json.errors.name !== undefined) {
                        $('#callback-name + .help-b').text(json.errors.name);
                    }
                    if (json.errors.phone !== undefined) {
                        $('#callback-phone + .help-b').text(json.errors.phone);
                    }
                }
            }
        });
    });
    $('.cart-link').on('click', function (e) {
        var url = new URL($(this).attr('href'), window.location);
        var items = $('.form-group.cart-field input[type="text"]');
        $.each(items, function (i, el) {
            url.searchParams.set('fields[' + $(el).attr('id') + ']', $(el).val());
        });
        var itemsChecks = $('.check-cont input:checked');
        $.each(itemsChecks, function (i, el) {
            url.searchParams.set('checks[' + $(el).attr('id') + ']', 1);
        });
        $(this).attr('href', url.href);

    });

    $('.filter-input').on('change', function (e) {
        e.preventDefault();
        var val = $(this).val();
        var param = $(this).data('param');
        var url = new URL(window.location);  // == window.location.href
        url.searchParams.set(param, val);

        history.pushState(null, null, url);

        $('#products-cont').load(url + ' #products-cont', function (data) {
            $('#products-cont').html(data);
        });
    });
    $('.related-href').on('click', function (e) {
        $('.related-cont').show();
        $('.constructor-cont').hide();
        $(this).addClass('ractive');
        $(this).siblings().removeClass('ractive');
    });
    $('.constructor-href').on('click', function (e) {
        $('.related-cont').hide();
        $(this).siblings().removeClass('ractive');
        $('.constructor-cont').show();
        $(this).addClass('ractive');
    });
    callScheduler();
});

function numberFormat(val) {
    if ($.isNumeric(val)) {
        return val.toLocaleString('ru-RU').replace(',', '.');
    }
    return val.toLocaleString('ru-RU');
}

function showPopup(text = '', popupId = 'popup-cart', append = false) {
    if (append) {
        let existingPopup = $('#' + popupId);
        if (existingPopup.length === 0) {
            let newPopup = '<div class=\"poup" id="' + popupId + '">' +
                '<div class="poup-body">' +
                '<span class="popupclose">' +
                '<a class="clpop clpop-destroy" href="#">&times;</a>' +
                '</span>' +
                '<div class="poup-body-text"></div>' +
                '<div class="poup-body-footer"><a class="popuplink clpop">Продолжить покупки</a></div>' +
                '</div>' +
                '</div>';
            $('body').prepend(newPopup);
        }
    }
    if (text != '') {
        if (append) {
            $('#' + popupId + ' .poup-body .poup-body-text').append(text);
        } else {
            $('#' + popupId + ' .poup-body .poup-body-text').html(text);
        }
    }
    setTimeout(function () {
        $('#' + popupId).addClass('open');
        $('#' + popupId).focusin();
    }, 500);

}

function closePopup(popupId = 'popup-cart', destroy = false) {
    $('#' + popupId).removeClass('open');
    if (destroy) {
        $('#' + popupId).remove();
    }
}
function priceFormat(price) {
    return '<span>' + numberFormat(price) + '</span><span>&nbsp;&#8381;</span>'
}
function changeSum(inp, froceRecalculateCart = false) {
    // Находим именно нужную нам для расчетов табличку и далее работаем только с ней
    let productBlock = inp.closest('.calculated-data-product');
    if (typeof productBlock !== 'undefined') {
        let itemCount = parseInt(inp.val());
        let itemPrice = parseInt(inp.data('product-price'));
      productBlock.find('.price').html(priceFormat(itemCount * itemPrice));
    }
    let productsBlock = inp.closest('.calculated-data-products');
    if (typeof productsBlock !== 'undefined') {
        let itemsPrice = 0;
        productsBlock.find('.calculated-data-product input.product-count')
            .each(function (index, value) {
                let itemCount = parseInt($(value).val());
                let itemPrice = parseInt($(value).data('product-price'));
                itemsPrice = itemsPrice + itemCount * itemPrice;
            });
        productsBlock.find('.calculated-data-products-total').html(priceFormat(itemsPrice));
    }
    if (((typeof productsBlock !== 'undefined')
    && (productsBlock.hasClass('cart-ajax') || productsBlock.hasClass('table-cart')))
    || froceRecalculateCart) {
        if ($(inp).parents('.cart-skip-summ-calculations').length == 0) {
            let count = parseInt(inp.val());
            let pId = inp.data('product-id');
            $.ajax({
                url: '/front/product/change-cart',
                data: {id: pId, count: count},
                dataType: 'html',
                type: 'POST',
                success: function (data, textStatus, request) {
                    let cartRows = productsBlock.find('#cart-id-' + pId);
                    if (cartRows.length <= 0) {
                        cartRows = productsBlock.find('#cart-popup-id-' + pId);
                    }
                    productsBlock.find('.product-count[data-product-id="' + pId + '"]').val(count);
                    if (cartRows.length > 0) {
                        let price = parseInt(inp.data('product-price'));
                        if (price != 0) {
                            cartRows.find('.sum-price').html(priceFormat(count * price));
                        }
                        let sum = 0;
                        let mass_sum = 0;
                        let value_summ = 0;
                        let total_count = 0;
                        productsBlock.find('input.product-count')
                            .each(function (index, value) {
                                if ($(value).parents('.cart-skip-summ-calculations').length == 0) {
                                    let itemCount = parseInt($(value).val());
                                    let itemPrice = parseInt($(value).data('product-price'));
                                    total_count = total_count + itemCount;
                                    sum += itemCount * itemPrice;
                                    if ($(value).hasClass('main')) {
                                        let mass = $(value).data('product-mass');
                                        let va = $(value).data('product-value');
                                        mass_sum += itemCount * mass;
                                        value_summ += itemCount * va;
                                    }
                                }
                            });
                        productsBlock.find('.total-sum-price').html(priceFormat(sum));
                        productsBlock.find('.sum-mass').text(numberFormat(mass_sum));
                        productsBlock.find('.sum-value').text(numberFormat(value_summ));
                        wrapCartText(total_count, data.messageText);
                    }
                }
            });
        }
    }
}

function search(text, timeOut = 0) {

    clearTimeout(searchTimerId);
    searchTimerId = setTimeout(function () {
        let searchResultsBlock = $('.search-cont .popup-search .popup-body');
        let searchResultsDialog = $('.search-cont .popup-search');
        let searchResultsHeader = $('.search-cont .popup-search .popup-search-header');
        let searchResultsCount = 0;
        searchResultsBlock.hide(0);
        searchResultsHeader.text('Выполняется поиск...');
        $.ajax({
            url: '/front/product/search',
            data: {text},
            dataType: 'html',
            type: 'POST',
            success: function (html) {
                searchResultsBlock.html(html);
                searchResultsCount = $('.search-cont .popup-search .popup-body a').length;
                let contenWrapperTop = $('.content-wrapper').top;
                let maxHeight = $('.content-wrapper').height();
                let maxWindowHeight = $(window.top).height();
                if (maxWindowHeight < maxHeight) {
                    maxHeight = maxWindowHeight;
                }
                maxHeight = Math.round(maxHeight * 0.9);
                searchResultsBlock.css({'max-height': maxHeight});
                $(searchResultsBlock).show(0);
                if (searchResultsCount) {
                    searchResultsHeader.text('Результатов поиска: ' + searchResultsCount);
                    $(searchResultsDialog).slideDown(400, function () {
                        /* searchResultsBlock.focus();
                         if (!searchResultsBlock.is(':focus')) { // Checking if the target was focused
                             searchResultsBlock.attr('tabindex', '-1'); // Adding tabindex for elements not focusable
                             searchResultsBlock.focus(); // Set focus again
                         } */

                    });
                } else {
                    searchResultsBlock.hide(0);
                    searchResultsHeader.text('Ничего не найдено');
                }
            }
        });
    }, timeOut);
}

function closeMobileMenu() {
    $('.mobile-menu').removeClass('open');
    $('.background').removeClass('open');
}


function addToFavorite(data) {
    $.ajax({
        url: '/front/product/add-to-favorite',
        data: {data},
        dataType: 'JSON',
        type: 'POST',
        success: function (xhr) {
            wrapFavoriteText(xhr.favoriteCount, xhr.messageText);
            wrapFavorite(xhr.html);
            showPopup(xhr.popup, 'popup-favorite');
            setTimeout(closePopup, 3000, 'popup-favorite');
        }
    });
}

function addToComparison(data) {
    $.ajax({
        url: '/front/product/add-to-comparison',
        data: {data},
        dataType: 'JSON',
        type: 'POST',
        success: function (xhr) {
            wrapComparisonText(xhr.comparisonCount, xhr.messageText);
            wrapComparison(xhr.html);
            showPopup(xhr.popup, 'popup-comparison');
            setTimeout(closePopup, 3000, 'popup-comparison');
        }
    });
}


function addToCart(data) {
    $.ajax({
        url: '/front/product/add-to-cart',
        data: {data},
        dataType: 'JSON',
        type: 'POST',
        success: function (xhr) {
            wrapCartText(xhr.cartCount, xhr.messageText);
            wrapCart(xhr.html);
            showPopup(xhr.popup, 'popup-cart');
            setTimeout(closePopup, 5000, 'popup-cart');
        }
    });

//    let cartCount = $('#mobile-cart-count').text();
}

function deleteFromCart(id, count = 0) {
    $.ajax({
        url: '/front/product/delete-from-cart',
        data: {id, count},
        dataType: 'JSON',
        type: 'POST',
        success: function (xhr) {
            if (id == '0') {
                $('body').find('.cart-removable').remove();
            }
            $('body').find('#cart-popup-id-' + id).remove();
            $('body').find('#cart-id-' + id).remove();
            wrapCartText(xhr.count, xhr.messageText);
            $('.total-sum-price').html(xhr.sum);
            $('.value.sum-mass').text(xhr.sum_mass);
            $('.value.sum-value').text(xhr.sum_value);
        }
    });
}

function deleteFromFavorite(id) {
    $.ajax({
        url: '/front/product/delete-from-favorite',
        data: {id},
        dataType: 'JSON',
        type: 'POST',
        success: function (xhr) {
            if (id == '0') {
                $('.favorite-removable').remove();
            } else {
                $('#favorite-id-' + id).remove();
                $('#favorite-popup-id-' + id).remove();
            }
            /*            $('body').find('.favorite-id-' + id).each(function(){
                            $(this).remove();
                        }); */
            wrapFavoriteText(xhr.count, xhr.messageText);
            /* $('.total-sum-price').text(xhr.sum);
            $('.value.sum-mass').text(xhr.sum_mass);
            $('.value.sum-value').text(xhr.sum_value); */
        }
    });
}

function deleteFromComparison(id) {
    $.ajax({
        url: '/front/product/delete-from-comparison',
        data: {id},
        dataType: 'JSON',
        type: 'POST',
        success: function (xhr) {
            if (id == '0') {
                $('body').find('.comparison-removable').remove();
            }
            $('body').find('#comparison-popup-id-' + id).remove();
            $('body').find('#comparison-id-' + id).remove();
            $('body').find('#comparison-cell-' + id).remove();
            wrapComparisonText(xhr.count, xhr.messageText);
            /* $('.total-sum-price').text(xhr.sum);
            $('.value.sum-mass').text(xhr.sum_mass);
            $('.value.sum-value').text(xhr.sum_value); */
        }
    });
}

function wrapCart(html) {
    $('.cart-ajax').html(html);
}

function wrapFavorite(html) {
    $('.favorite-ajax').html(html);
}

function wrapComparison(html) {
    $('.comparison-ajax').html(html);
}

function wrapCartText(cartCount, messageText) {
    if (cartCount > 0) {
        $('#mobile-cart-count').text(cartCount);
        $('#mobile-cart-count').show();
        $('.cart-icon').removeClass('header-icon-empty');
    } else {
        $('#mobile-cart-count').hide();
        $('.cart-icon').addClass('header-icon-empty');
        $('.cart-empty-title').html('<div class="title">Ваша корзина пуста!</div>');
        $('.cart-content').html('<div class="title">Ваша корзина пуста!</div><div class="content cart-categories"></div>');
        $('.content.cart-categories').load('/catalog');
    }
    $('#cart-text').text(messageText);
}

function wrapFavoriteText(favoriteCount, messageText) {
    if (favoriteCount > 0) {
        $('#mobile-favorite-count').text(favoriteCount);
        $('#mobile-favorite-count').show();
        $('.favorite-icon').removeClass('header-icon-empty');
    } else {
        $('#mobile-favorite-count').hide();
        $('.favorite-icon').addClass('header-icon-empty');
        $('.favorite-empty-title').html('<div class="title">Список избранных товаров пуст!</div>');
        $('.favorite-content.favorite-empty-title').html('<div class="title">Список избранных товаров пуст!</div><div class="content favorite-categories"></div>');
        $('.content.favorite-categories').load('/catalog');
    }
    $('#favorite-text').text(messageText);
}

function wrapComparisonText(comparisonCount, messageText) {
    if (comparisonCount > 0) {
        $('#mobile-comparison-count').text(comparisonCount);
        $('#mobile-comparison-count').show();
        $('.comparison-icon').removeClass('header-icon-empty');
    } else {
        $('#mobile-comparison-count').hide();
        $('.comparison-icon').addClass('header-icon-empty');
        $('.popup-comparison .comparison-empty-title').html('<div class="title">Список сравнения пуст!</div>');
        $('.table-comparison.comparison-empty-title').html('<div class="title">Список сравнения пуст!</div><div class="content comparison-categories"></div>');
        $('.content.comparison-categories').load('/catalog');
    }
    $('#comparison-text').text(messageText);
}

function openMobileMenu() {
    $('.mobile-menu').addClass('open');
    $('.background').addClass('open');
}

