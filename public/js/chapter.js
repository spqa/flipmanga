$(document).ready(function () {
    // var lastScrollTop = 0;
    // $(window).scroll(function(event){
    //     var st = $(this).scrollTop();
    //     if (st > lastScrollTop){
    //         // console.log('up');
    //         $(".fixed-action-btn").hide();
    //         $('#navbar-wrapper').removeClass('navbar-fixed').fadeOut();
    //
    //     } else {
    //         $(".fixed-action-btn").show();
    //         $('#navbar-wrapper').addClass('navbar-fixed').fadeIn();
    //
    //     }
    //     lastScrollTop = st;
    // });

    var didScroll;
    var lastScrollTop = 0;
    var delta = 5;
    var navbarHeight = $('#navbar-wrapper').outerHeight();

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
                $(".fixed-action-btn").hide();
                $('#navbar-wrapper').removeClass('navbar-fixed');
            }
        } else {
            // Scroll Up

            if(st + $(window).height() < $(document).height()) {
                $(".fixed-action-btn").show();
                $('#navbar-wrapper').addClass('navbar-fixed');
            }
        }

        lastScrollTop = st;
    }

    $('.modal').modal();

    $.ajax({
        url: '/update-view/' + $('meta[name="manga-id"]').attr('content'),
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});
