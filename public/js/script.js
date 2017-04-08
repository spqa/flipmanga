function getCookie(cname) {
    // console.log('get-cookie-called');
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // $('#search').autocomplete({
    //     data: {
    //         "Apple": null,
    //         "Microsoft": null,
    //         "Google": 'http://placehold.it/250x250',
    //         "Google1": 'http://placehold.it/250x250',
    //         "Google2": 'http://placehold.it/250x250',
    //         "Google3": 'http://placehold.it/250x250',
    //         "Google4": 'http://placehold.it/250x250',
    //     },
    //     limit: 20, // The max amount of results that can be shown at once. Default: Infinity.
    //     onAutocomplete: function(val) {
    //         // Callback function when value is autcompleted.
    //     },
    //     minLength: 1, // The minimum length of the input for the autocomplete to start. Default: 1.
    // });
    $('.button-collapse').sideNav({
            menuWidth: 250, // Default is 300
            edge: 'left', // Choose the horizontal origin
            closeOnClick: true, // Closes side-nav on <a> clicks, useful for Angular/Meteor
            draggable: true // Choose whether you can drag to open on touch screens
        }
    );
    $(".slide-1").owlCarousel({
        navigation: false,
        items: 8,
        itemsDesktopSmall: [1461, 7],
        itemsMobile: [600, 1.5],
        itemsTabletSmall: [992, 4],
        pagination: false,
        scrollPerPage: false,
        afterInit: function () {
            $('.slide-container').show();
        }
    });

    $(".slide-2").owlCarousel({
        navigation: false,
        items: 6,
        itemsDesktop: [1645, 5.5],
        itemsDesktopSmall: [1461, 5],
        itemsTabletSmall: [992, 4],
        itemsTablet: [1248, 3.5],
        itemsMobile: [600, 2.5],
        pagination: false,
        scrollPerPage: false
    });
    $(".slide-3").owlCarousel({
        navigation: false,
        items: 6,
        itemsDesktop: [1645, 5.5],
        itemsDesktopSmall: [1461, 5],
        itemsTabletSmall: [992, 4],
        itemsTablet: [1248, 3.5],
        itemsMobile: [600, 2.5],
        pagination: false,
        scrollPerPage: false
    });
    $("button[data-role='slide-next-1']").on("click", function () {
        console.log('clicked');
        // var owl=$(this).closest(".slide-container").data('owlCarousel');
        var owl = $(".slide-1").data('owlCarousel');
        owl.next();
    });
    $("button[data-role='slide-next-2']").on("click", function () {
        console.log('clicked');
        // var owl=$(this).closest(".slide-container").data('owlCarousel');
        var owl = $(".slide-2").data('owlCarousel');
        owl.next();
    });
    $("button[data-role='slide-next-3']").on("click", function () {
        console.log('clicked');
        // var owl=$(this).closest(".slide-container").data('owlCarousel');
        var owl = $(".slide-3").data('owlCarousel');
        owl.next();
    });
    $("button[data-role='slide-prev-1']").on("click", function () {
        console.log('clicked');
        // var owl=$(this).closest(".slide-container").data('owlCarousel');
        var owl = $(".slide-1").data('owlCarousel');
        owl.prev();
    });
    $("button[data-role='slide-prev-2']").on("click", function () {
        console.log('clicked');
        // var owl=$(this).closest(".slide-container").data('owlCarousel');
        var owl = $(".slide-2").data('owlCarousel');
        owl.prev();
    });
    $("button[data-role='slide-prev-3']").on("click", function () {
        console.log('clicked');
        // var owl=$(this).closest(".slide-container").data('owlCarousel');
        var owl = $(".slide-3").data('owlCarousel');
        owl.prev();
    });
    $("a[data-role='tab-genre']").one('click', function () {
        var t = $(this);
        $.ajax({
            url: "/api/genre/" + t.attr('data-content'),
            dataType: 'json',
            cache: true,
            success: function (data) {
                console.log(data);
                $more=$(t.attr('href')).find('.more-wrapper').first();
                $tab=$(t.attr('href'));
                $tab.empty();
                $.each(data, function (index, value) {
                    $tab.append(Handlebars.templates.mangacard(value));
                });
                $tab.append($more);
            }
        });
    });


    $.ajax({
        url: "/api/manga-in-progress",
        dataType: 'html',
        cache: true,
        success: function (data) {
            if (data != 0) {
                var html = $('.in-progress-section').html();
                $('.in-progress-section').html(html + data).show();

            }
        }
    });
    $(".dropdown-button").dropdown();
    $('.parallax').parallax();
    if (getCookie("adult-check") != 1) {
        $('#adult-modal').modal('open');
    }
    // $('.tooltipped').tooltip({delay: 50});
    $('.carousel.carousel-slider').carousel({full_width: true, dist: 0});
    setInterval(function () {
        $('.carousel.carousel-slider').carousel('next');
    }, 3500);
    // $(".dropdown-button").dropdown();
    $('.btn-logout').click(function (e) {
        e.preventDefault();
        $.ajax({
            url: '/logout',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function () {
                location.reload();
            }
        });
    });

    var didScroll;
    var lastScrollTop = 0;
    var delta = 5;
    var navbarHeight = $('.nav-wrapper').outerHeight();

    $(window).scroll(function (event) {
        didScroll = true;
    });

    setInterval(function () {
        if (didScroll) {
            hasScrolled();
            didScroll = false;
        }
    }, 250);

    function hasScrolled() {
        var st = $(this).scrollTop();

        // Make sure they scroll more than delta
        if (Math.abs(lastScrollTop - st) <= delta)
            return;

        // If they scrolled down and are past the navbar, add class .nav-up.
        // This is necessary so you never see what is "behind" the navbar.
        if (st > lastScrollTop && st > navbarHeight) {
            // Scroll Down
            if (st + $(window).height() < $(document).height()) {
                // $(".fixed-action-btn").hide();
                $('#navbar-master').removeClass('navbar-fixed');
            }
        } else {
            // Scroll Up

            if (st + $(window).height() < $(document).height()) {
                // $(".fixed-action-btn").show();
                $('#navbar-master').addClass('navbar-fixed');
            }
        }

        lastScrollTop = st;
    }

    if (location.pathname == "/" &&
        location.hash.length <= 1 &&
        location.search.length <= 1) {
        getLatestPagination(1);
    }
    function getLatestPagination(page) {
        $.ajax({
            url: '/api/latest-update?page=' + page,
            success: function (data) {
                $('.latest-pagination-wrapper').empty().append(data.links);
                $('.latest-pagination-wrapper a').click(function (e) {
                    e.preventDefault();
                    getLatestMangas($(this).attr('href'));
                });
            }
        });
    }

    function getLatestMangas(url_page) {
        if(!url_page.endsWith('#!'))
        $.ajax({
            url: url_page,
            success: function (data) {
                $('#tab-container1 .manga-wrapper').remove();
                $.each(data.mangas.data, function (index, value) {
                    $('#tab-container1').prepend(Handlebars.templates.mangacard(value));
                });
                $('.latest-pagination-wrapper').empty().append(data.links);
                $('.latest-pagination-wrapper a').click(function (e) {
                    e.preventDefault();
                    getLatestMangas($(this).attr('href'));

                });
            }
        });
    }

    ajaxAutoComplete({inputId: 'search-mobile', ajaxUrl: '/api/search/'});
    ajaxAutoComplete({inputId: 'search-desk', ajaxUrl: '/api/search/'});

    function ajaxAutoComplete(options) {

        var defaults = {
            inputId: null,
            ajaxUrl: false,
            data: {},
            minLength: 2
        };

        options = $.extend(defaults, options);
        var $input = $("#" + options.inputId);


        if (options.ajaxUrl) {

            if ($input.attr('id') == 'search-mobile') {
                var $autocomplete = $('<ul id="ac" class="autocomplete-content dropdown-content"></ul>');
            } else {
                var $autocomplete = $('<ul id="ac" class="autocomplete-content dropdown-content"'
                    + 'style="position:absolute;width: 100%;"></ul>');
            }

            var $inputDiv = $input.closest('.input-field'),
                request,
                runningRequest = false,
                timeout,
                liSelected;

            if ($inputDiv.length) {
                $inputDiv.append($autocomplete); // Set ul in body
            } else {
                $input.after($autocomplete);
            }

            var highlight = function (string, match) {
                var matchStart = string.toLowerCase().indexOf("" + match.toLowerCase() + "");
                if (matchStart===-1){
                    return string;
                }
                var matchEnd = matchStart + match.length - 1,
                    beforeMatch = string.slice(0, matchStart),
                    matchText = string.slice(matchStart, matchEnd + 1),
                    afterMatch = string.slice(matchEnd + 1);
                string = "<span>" + beforeMatch + "<span class='highlight'>" +
                    matchText + "</span>" + afterMatch + "</span>";
                return string;

            };

            $autocomplete.on('click', 'li', function () {
                $input.val($(this).text().trim());
                $autocomplete.empty();
            });

            $input.on('keyup', function (e) {

                if (timeout) { // comment to remove timeout
                    clearTimeout(timeout);
                }

                if (runningRequest) {
                    request.abort();
                }

                if (e.which === 13) { // select element with enter key
                    liSelected[0].click();
                    return;
                }

                // scroll ul with arrow keys
                if (e.which === 40) {   // down arrow
                    if (liSelected) {
                        liSelected.removeClass('selected');
                        next = liSelected.next();
                        if (next.length > 0) {
                            liSelected = next.addClass('selected');
                        } else {
                            liSelected = $autocomplete.find('li').eq(0).addClass('selected');
                        }
                    } else {
                        liSelected = $autocomplete.find('li').eq(0).addClass('selected');
                    }
                    return; // stop new AJAX call
                } else if (e.which === 38) { // up arrow
                    if (liSelected) {
                        liSelected.removeClass('selected');
                        next = liSelected.prev();
                        if (next.length > 0) {
                            liSelected = next.addClass('selected');
                        } else {
                            liSelected = $autocomplete.find('li').last().addClass('selected');
                        }
                    } else {
                        liSelected = $autocomplete.find('li').last().addClass('selected');
                    }
                    return;
                }

                // escape these keys
                if (e.which === 9 ||        // tab
                    e.which === 16 ||       // shift
                    e.which === 17 ||       // ctrl
                    e.which === 18 ||       // alt
                    e.which === 20 ||       // caps lock
                    e.which === 35 ||       // end
                    e.which === 36 ||       // home
                    e.which === 37 ||       // left arrow
                    e.which === 39) {       // right arrow
                    return;
                } else if (e.which === 27) { // Esc. Close ul
                    $autocomplete.empty();
                    return;
                }

                var val = $input.val().toLowerCase();
                $autocomplete.empty();

                if (val.length > options.minLength) {

                    timeout = setTimeout(function () { // comment this line to remove timeout
                        runningRequest = true;

                        request = $.ajax({
                            type: 'GET',
                            url: options.ajaxUrl + val,
                            success: function (data) {
                                if (!$.isEmptyObject(data)) { // (or other) check for empty result
                                    var appendList = '';
                                    $.each(data, function (index, key) {
                                        console.log(key.name);
                                        // if (data.hasOwnProperty(key)) {
                                        var li = '';
                                        // if (!!data[key]) { // if image exists as in official docs
                                        li += '<li><img src="' + key.poster + '" class="right">';
                                        li += '<a href="/truyen/' + key.slug + '">' + highlight(key.name, val) + '</a></li>';
                                        // } else {
                                        //     li += '<li><span>' + highlight(key, val) + '</span></li>';
                                        // }
                                        appendList += li;
                                        // }
                                    });
                                    // for (var key in data) {
                                    //
                                    // }
                                    $autocomplete.append(appendList);
                                } else {
                                    $autocomplete.append($('<li><span>Không tìm thấy </span></li>'));
                                }
                            },
                            complete: function () {
                                runningRequest = false;
                            }
                        });
                    }, 250);        // comment this line to remove timeout
                }
            });

            $(document).click(function () { // close ul if clicked outside
                if (!$(event.target).closest($autocomplete).length) {
                    $autocomplete.empty();
                }
            });
        }
    }

});


