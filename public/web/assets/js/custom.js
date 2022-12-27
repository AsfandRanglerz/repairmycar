$(window).on("load", function() { $("#eventfeat_preloader").removeClass("active").delay(1800).fadeOut() }), $(".options > div").click(function() { $(".select__input > input").val($(this).attr("value")), $(".select__input > .options > div , .select__input > input").removeClass("active"), $(this).addClass("active"), $(content).removeClass("active"), $(content).css("maxHeight", "0px") });
var content = "";
$(".select__input > input").on("click", function() { $(this).toggleClass("active"), content = $(this).next(), $(content).hasClass("active") ? ($(content).removeClass("active"), $(content).css("maxHeight", "0px")) : ($(content).css("maxHeight", $(content)[0].scrollHeight + "px"), $(content).addClass("active")) }), $(window).scroll(function() { $(window).scrollTop() >= 150 ? $(".navbar").addClass("active") : $(".navbar").removeClass("active") }), $(".top_cat_carousel").owlCarousel({ loop: !0, margin: 10, autoplay: !0, nav: !0, autoplayTimeout: 3e3, autoplayHoverPause: !0, responsive: { 0: { items: 1, stagePadding: 60 }, 500: { items: 2, stagePadding: 40 }, 768: { items: 3, stagePadding: 40 }, 991: { items: 4 }, 1100: { items: 5 } } }), $(".cities_wrapper>.owl-carousel").owlCarousel({ loop: !0, margin: 15, nav: !1, autoplay: !0, autoplayTimeout: 5e3, autoplayHoverPause: !0, responsive: { 0: { items: 2, margin: 15 }, 500: { items: 3, margin: 10 }, 750: { items: 2, margin: 20 }, 800: { items: 3, margin: 20 }, 1000: { items: 3 }, 1100: { items: 4 }, 1300: { items: 5 } } }), $(".featured_carousel").owlCarousel({ margin: 20, nav: !0, autoplay: !0, autoplayTimeout: 3e3, autoplayHoverPause: !0, responsive: { 0: { items: 1 }, 500: { items: 1, stagePadding: 60 }, 768: { items: 2 }, 1000: { items: 3 } } }), $(".services_carousel").owlCarousel({ margin: 15, nav: !0, autoplay: !1, autoplayTimeout: 3e3, autoplayHoverPause: !0, items: 1 }), $(".event_shop_carousel").owlCarousel({ loop: !0, margin: 10, autoplay: !0, nav: !0, autoplayTimeout: 3e3, autoplayHoverPause: !0, responsive: { 0: { items: 1, stagePadding: 60 }, 500: { items: 2, stagePadding: 30 }, 700: { items: 4 }, 1000: { items: 5 } } }), $(".navbar-toggler").click(function() { $(".navbar").toggleClass("active") }), $(".artist__profile").owlCarousel({ margin: 20, nav: !0, autoplay: !0, autoplayTimeout: 3e3, autoplayHoverPause: !0, responsive: { 0: { items: 1 }, 500: { items: 1 }, 768: { items: 1 }, 1000: { items: 1 } } }), $(".artist_carousel").owlCarousel({ margin: 20, nav: !0, autoplay: !0, autoplayTimeout: 3e3, autoplayHoverPause: !0, responsive: { 0: { items: 1 }, 500: { items: 1, stagePadding: 60 }, 768: { items: 2 }, 1000: { items: 3 }, 1200: { items: 4 } } });

// $(function() {
//     $('#datepicker').datepicker({
//         minDate: 0,
//         dateFormat: 'DD, d MM, yy',
//         beforeShowDay: $.datepicker.noWeekends,
//         onSelect: function(dateText) {
//             $('#datepicker2').datepicker("setDate", $(this).datepicker("getDate"));
//         }
//     });
// });

// $(function() {
//     $("#datepicker2").datepicker();
// });

$(".vendor_carousel").owlCarousel({ margin: 10, autoplay: !0, nav: !0, autoplayTimeout: 3e3, autoplayHoverPause: !0, responsive: { 0: { items: 1 }, 500: { items: 1, stagePadding: 10 }, 700: { items: 2 }, 1000: { items: 3 } } });
$('.blog_carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    items:1,
    autoplay:true,
    autoplayTimeout:7000,
    autoplayHoverPause:true,
    responsive:{
        0:{
            nav:false,
        },
        767 :{
            nav:true
        }

    }

})

$('.text_carousel').owlCarousel({
    loop:true,
    margin:20,
    nav:true,
    item:1,
    stagePadding:0,
    autoplay:true,
    autoplayTimeout:4000,
    autoplayHoverPause:true
});

$('.community_carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    stagePadding:5,
    responsive:{
        0:{
            items:1,
            stagePadding:30
        } ,
        600:{
            items:3
        },
        991:{
            items:4
        },
        1200:{
            items:5
        }
    }
})
