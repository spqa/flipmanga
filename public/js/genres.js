/**
 * Created by super on 12/14/2016.
 */
$(document).ready(function () {
    $('.chip').click(function (e) {
        $(this).toggleClass('red white-text active');
    });
    $('#btn-search-genre').click(function (e) {
        var genres=[];
        $('.red.active').each(function () {
            genres.push($(this).attr('data-id'));
        });
        console.log(genres);
        $.ajax({
            url:'/api/genre',
            method:'POST',
            data:{
                data:genres
            }
        });
    });
});

