$( document ).ready(function(){
	$(".button-collapse").sideNav();
	$(".slide-1").owlCarousel({
		navigation:false,
		items:6,
		itemsDesktop:[1645,5],
		itemsDesktopSmall:[1461,5],
		itemsTabletSmall:[992,4],
		itemsTablet:[1248,3.5],
		itemsMobile:[600,2.5],
		pagination:false,
		afterInit:function () {
			$('.slide-container').show();
        }
	});

    $(".slide-2").owlCarousel({
        navigation:false,
        items:6,
        itemsDesktop:[1645,5],
        itemsDesktopSmall:[1461,5],
        itemsTabletSmall:[992,4],
        itemsTablet:[1248,3.5],
        itemsMobile:[600,2.5],
        pagination:false
    });
    $(".slide-3").owlCarousel({
        navigation:false,
        items:6,
        itemsDesktop:[1645,5],
        itemsDesktopSmall:[1461,5],
        itemsTabletSmall:[992,4],
        itemsTablet:[1248,3.5],
        itemsMobile:[600,2.5],
        pagination:false
    });
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
	$("button[data-role='slide-next-1']").on("click",function(){
        console.log('clicked');
        // var owl=$(this).closest(".slide-container").data('owlCarousel');
		var owl=$(".slide-1").data('owlCarousel');
		owl.next();
	});
    $("button[data-role='slide-next-2']").on("click",function(){
        console.log('clicked');
        // var owl=$(this).closest(".slide-container").data('owlCarousel');
        var owl=$(".slide-2").data('owlCarousel');
        owl.next();
    });
    $("button[data-role='slide-next-3']").on("click",function(){
        console.log('clicked');
        // var owl=$(this).closest(".slide-container").data('owlCarousel');
        var owl=$(".slide-3").data('owlCarousel');
        owl.next();
    });
	$("button[data-role='slide-prev-1']").on("click",function(){
        console.log('clicked');
        // var owl=$(this).closest(".slide-container").data('owlCarousel');
		var owl=$(".slide-1").data('owlCarousel');
		owl.prev();
	});
    $("button[data-role='slide-prev-2']").on("click",function(){
        console.log('clicked');
        // var owl=$(this).closest(".slide-container").data('owlCarousel');
        var owl=$(".slide-2").data('owlCarousel');
        owl.prev();
    });
    $("button[data-role='slide-prev-3']").on("click",function(){
        console.log('clicked');
        // var owl=$(this).closest(".slide-container").data('owlCarousel');
        var owl=$(".slide-3").data('owlCarousel');
        owl.prev();
    });
    $("a[data-role='tab-genre']").one('click',function () {
        var t=$(this);
        $.ajax({
            url:"/api/genres/"+$(this).attr('data-content'),
            dataType:'html',
            cache:true,
            success:function (data) {
                console.log(data);
                $(t.attr('href')).html(data);
            }
        });
    });
	$('.modal').modal();
	$('.tooltipped').tooltip({delay: 50});
	$('.carousel.carousel-slider').carousel({full_width: true,dist:0});
	setInterval(function () {
        $('.carousel.carousel-slider').carousel('next');
    },3500);
	// $(".dropdown-button").dropdown();

});

function indexTabAjax() {

}