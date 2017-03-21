/**
 * Created by super on 12/14/2016.
 */
$(document).ready(function () {
    var source="<a href='/truyen/{{slug}}' title='{{name}}'>"
    +"<div class='col s6 m3 l2'>"
        +"<div class='card'>"
        +"<div class='card-image'>"
        +"<img class='img-suggestion' alt='Read latest {{name}} manga online for free' title='Read latest {{name}} manga online for free' src='{{poster}}'>"
        +"<span class='card-title center no-padding'>{{name}}</span>"
    +"</div>"
    +"</div>"
    +"</div>"
    +"</a>";
    var template = Handlebars.compile(source);
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
            dataType:'json',
            data:{
                data:genres
            },
            success:function (data) {
                $('.genre-results').empty();
                $.each(data.data,function (index,value) {
                    $('.genre-results').append(template(value));
                })
            }
        });
    });
});

