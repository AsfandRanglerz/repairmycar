$(window).on("load", function() { $("#eventfeat_preloader").removeClass("active").delay(1800).fadeOut() }), $(".options > div").click(function() { $(".select__input > input").val($(this).attr("value")), $(".select__input > .options > div , .select__input > input").removeClass("active"), $(this).addClass("active"), $(content).removeClass("active"), $(content).css("maxHeight", "0px") });
var content = "";
$(".select__input > input").on("click", function() { $(this).toggleClass("active"), content = $(this).next(), $(content).hasClass("active") ? ($(content).removeClass("active"), $(content).css("maxHeight", "0px")) : ($(content).css("maxHeight", $(content)[0].scrollHeight + "px"), $(content).addClass("active")) }), $(window).scroll(function() { $(window).scrollTop() >= 150 ? $(".navbar").addClass("active") : $(".navbar").removeClass("active") }), $(".top_cat_carousel").owlCarousel({ loop: !0, margin: 10, autoplay: !0, nav: !0, autoplayTimeout: 3e3, autoplayHoverPause: !0, responsive: { 0: { items: 1, stagePadding: 60 }, 500: { items: 2, stagePadding: 40 }, 768: { items: 3, stagePadding: 40 }, 991: { items: 4 }, 1100: { items: 5 } } }), $(".cities_wrapper>.owl-carousel").owlCarousel({ loop: !0, margin: 15, nav: !1, autoplay: !0, autoplayTimeout: 5e3, autoplayHoverPause: !0, responsive: { 0: { items: 2, margin: 15 }, 500: { items: 3, margin: 10 }, 750: { items: 2, margin: 20 }, 800: { items: 3, margin: 20 }, 1000: { items: 3 }, 1100: { items: 4 }, 1300: { items: 5 } } }), $(".featured_carousel").owlCarousel({ margin: 20, nav: !0, autoplay: !0, autoplayTimeout: 3e3, autoplayHoverPause: !0, responsive: { 0: { items: 1 }, 500: { items: 1, stagePadding: 60 }, 768: { items: 2 }, 1000: { items: 3 } } }), $(".services_carousel").owlCarousel({ margin: 15, nav: !0, autoplay: !1, autoplayTimeout: 3e3, autoplayHoverPause: !0, items: 1 }), $(".event_shop_carousel").owlCarousel({ loop: !0, margin: 10, autoplay: !0, nav: !0, autoplayTimeout: 3e3, autoplayHoverPause: !0, responsive: { 0: { items: 1, stagePadding: 60 }, 500: { items: 2, stagePadding: 30 }, 700: { items: 4 }, 1000: { items: 5 } } }), $(".navbar-toggler").click(function() { $(".navbar").toggleClass("active") }), $(".artist__profile").owlCarousel({ margin: 20, nav: !0, autoplay: !0, autoplayTimeout: 3e3, autoplayHoverPause: !0, responsive: { 0: { items: 1 }, 500: { items: 1 }, 768: { items: 1 }, 1000: { items: 1 } } }), $(".artist_carousel").owlCarousel({ margin: 20, nav: !0, autoplay: !0, autoplayTimeout: 3e3, autoplayHoverPause: !0, responsive: { 0: { items: 1 }, 500: { items: 1, stagePadding: 60 }, 768: { items: 2 }, 1000: { items: 3 }, 1200: { items: 4 } } });

toastr.options = {
    "closeButton": true,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
}

$(function() {
    /*Animate loader off screen*/
    $("#pgLoader").fadeOut("slow");

    $('.landline-number').on('keyup', function() {
        var landLineNumber = $('.landline-number:not(".d-none")').val();
        $('input[name="landline_no"]').val(landLineNumber);
    });

    $('button[type="submit"]:not(#sendMsg)').on('click', function() {
        setTimeout(() => {
            if($('label.is-invalid.error').text()=="" && $(this).text()!='delete') {
                $(this).addClass('text-center');
                $(this).text('').append('Please Wait! Submittion in Process<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
            }
        }, 300);
    });

    setTimeout(() => {
        $('input:file').change(function(){
            for(var i=0; i< this.files.length; i++){
                var file = this.files[i];
                name = file.name.toLowerCase();
                MAX_FILE_SIZE = 10 * 1024 * 1024; // 10MB
                size = file.size;
                type = file.type;
            }
            if(type==="application/pdf") {
                $('input[accept=".pdf,.jpeg,.jpg,.png,.PNG,.heic"] + .uploaded .uploaded-image:last-child img').attr('src', './public/assets/images/pdficon.png');
            }
        });

        $('.uploaded-image img').each(function() {
            var fileExtension = $(this).attr('src').split('.').pop();
            if(fileExtension == 'pdf') {
                $(this).attr('src', './public/assets/images/pdficon.png');
            }
        });
    }, 500);

    if($('div').hasClass('text-danger')) {
        toastr.error("Failed! You've to fill the Required Fields");
    }

    /*chatbox*/
    $(document).on("click", ".inbox_contact", function() {
        setTimeout(() => {
            $(".cahtting_messages").scrollTop($(".cahtting_messages")[0].scrollHeight);
        }, 1000);
    });
    $(document).on("click", "#sendMsg", function() {
        setTimeout(() => {
            $(".cahtting_messages").scrollTop($(".cahtting_messages")[0].scrollHeight);
        }, 100);
    });
    /*chatbox*/

    /*eye icon, toggle password*/
    $(".toggle-password").click(function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        }
        else {
            input.attr("type", "password");
        }
    });
    /*tooltip*/
    $('[data-toggle="tooltip"]').tooltip({
        trigger: 'hover'
    });
    /*tooltip*/
    /*related to workshop tabs*/
    $(document).on('click', '.next-tab-btn', function() {
        $(this).closest('.tab-pane').removeClass('show active').next().addClass('show active');
        $('#myTab>.nav_item_li>.tab_btns').removeClass('active')
    });
    /*related to workshop tabs*/

    $(".get_appointment").hover(function() {
        $(this).children('span').toggleClass('d-block d-none');
    });

    // $('#datepicker').datepicker({
    //     minDate: 0,
    //     dateFormat: 'DD, d MM, yy',
    //     beforeShowDay: $.datepicker.noWeekends,
    //     onSelect: function(dateText) {
    //         $('#datepicker2').datepicker("setDate", $(this).datepicker("getDate"));
    //     }
    // });
});

$(function() {
    /*global Select2*/
    /*single select*/
    // $('select[name="country"]').select2({
    //     placeholder: 'Select Your Country',
    // });
    // $('select[name="city"]').select2({
    //     placeholder: 'Select City (Required)',
    // });
    // $('select[name="company_id"]').select2({
    //     placeholder: 'Select Company (Required)',
    // });
    // $('.company-name-field').select2({
    //     placeholder: 'Select Company (Required)',
    // });
    // $('.model-year-field, select[name="model_year_id"]').select2({
    //     placeholder: 'Select Year (Required)',
    // });
    /*Multiple select*/
    $('.insurance-company-multiple').select2({
        placeholder: 'Select Insurance Company (Optional)',
    });
    $('.offer-garage-services').select2({
        placeholder: 'Select The Services You Offering (Optional)',
    });
    $('.garage-services-offer').select2({
        placeholder: 'Select The Services You Offering (Required)',
    });
    $('.garage-services').select2({
        placeholder: 'Select Services You Looking For (Required)',
    });
    /*global Select2*/

    // $("#datepicker2").datepicker();
});

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
