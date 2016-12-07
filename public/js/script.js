$( document ).ready(function(){
	$(".button-collapse").sideNav();
	$(".slide-container").owlCarousel({
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
	$("button[data-role='slide-next']").on("click",function(){
        console.log('clicked');
        // var owl=$(this).closest(".slide-container").data('owlCarousel');
		var owl=$(".slide-container").data('owlCarousel');
		owl.next();
	});
	$("button[data-role='slide-prev']").on("click",function(){
        console.log('clicked');
        // var owl=$(this).closest(".slide-container").data('owlCarousel');
		var owl=$(".slide-container").data('owlCarousel');
		owl.prev();
	});
	$('.modal').modal();
	$('.tooltipped').tooltip({delay: 50});
	$('.carousel.carousel-slider').carousel({full_width: true,dist:0});
	// $(".dropdown-button").dropdown();
});