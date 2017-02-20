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
    $(".dropdown-button").dropdown();
    $('.modal').modal({
        ready: function(modal, trigger) { // Callback for Modal open. Modal and trigger parameters available.
            $('#adult-continue').click(function () {
                setCookie("adult-check",1,15);
            });
            // console.log(modal, trigger);
        }
    });
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