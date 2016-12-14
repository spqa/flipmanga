$(document).ready(function () {
    var lastScrollTop = 0;
    $(window).scroll(function(event){
        var st = $(this).scrollTop();
        if (st > lastScrollTop){
            // console.log('up');
            $(".fixed-action-btn").hide();
        } else {
            $(".fixed-action-btn").show();

        }
        lastScrollTop = st;
    });
    $('.modal').modal();

    $.ajax({
        url:'/update-view/'+$('meta[name="manga-id"]').attr('content'),
        method:'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
});
