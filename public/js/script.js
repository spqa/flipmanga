function getCookie(cname) {
    // console.log('get-cookie-called');
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i <ca.length; i++) {
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
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

$(document).ready(function () {
    $(".button-collapse").sideNav();
    $(".slide-1").owlCarousel({
        navigation: false,
        items: 6,
        itemsDesktop: [1645, 5.5],
        itemsDesktopSmall: [1461, 5],
        itemsTabletSmall: [992, 4],
        itemsTablet: [1248, 3.5],
        itemsMobile: [600, 2.5],
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
            url: "/api/genres/" + $(this).attr('data-content'),
            dataType: 'html',
            cache: true,
            success: function (data) {
                console.log(data);
                $(t.attr('href')).html(data);
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
    $('.modal').modal({
        ready: function(modal, trigger) { // Callback for Modal open. Modal and trigger parameters available.
            $('#adult-continue').click(function () {
                setCookie("adult-check",1,15);
            });
            // console.log(modal, trigger);
        }
    });
    if(getCookie("adult-check")!=1){
        $('#adult-modal').modal('open');
    }
    // $('.tooltipped').tooltip({delay: 50});
    $('.carousel.carousel-slider').carousel({full_width: true, dist: 0});
    setInterval(function () {
        $('.carousel.carousel-slider').carousel('next');
    }, 3500);
    // $(".dropdown-button").dropdown();
    $('.btn-logout').click(function () {
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
    $('.btn-favorite').click(function () {
        $.ajax({
            url:'/api/favorite/'+$(this).attr('data-id'),
            success:function (data) {
                console.log(data);
                if(data==1){
                    $('button[data-id]').html('<i class="material-icons red-text text-accent-4 left">favorite</i>Added to Favorites');
                    Materialize.toast('Added to Favorites', 4000);
                }
                if(data==0){
                    $('button[data-id]').html('<i class="material-icons  red-text text-accent-4 left">favorite_border</i>Add to Favorite');
                    Materialize.toast('Removed from Favorites', 4000);
                }
            },
            statusCode:{
                401:function () {
                        Materialize.toast('Error! You need to login to use this function', 4000);
                }
            }
        });
    });
});


