/*----------------------------------------------------------------------------*/
/* --------------------   External Custom Functions   ------------------------*/
/*----------------------------------------------------------------------------*/

/* Detect IE
------------------------------------------------------------------------------*/
function detectIE() {
    var ua = window.navigator.userAgent;

    var msie = ua.indexOf('MSIE ');
    if (msie > 0) {
        // IE 10 or older => return version number
        return parseInt(ua.substring(msie + 5, ua.indexOf('.', msie)), 10);
    }
    var trident = ua.indexOf('Trident/');
    if (trident > 0) {
        // IE 11 => return version number
        var rv = ua.indexOf('rv:');
        return parseInt(ua.substring(rv + 3, ua.indexOf('.', rv)), 10);
    }
    var edge = ua.indexOf('Edge/');
    if (edge > 0) {
        // Edge (IE 12+) => return version number
        return parseInt(ua.substring(edge + 5, ua.indexOf('.', edge)), 10);
    }
    // other browser
    return false;
}

/*Check Safari compatibility
-------------------------------------------------------------------*/
function is_Safari() {
    if ( navigator.userAgent.indexOf('Safari') != -1 && navigator.userAgent.indexOf('Chrome') == -1 ) {
        return true
    } else {
        return false;
    }
}

/*Check FireFox compatibility
-------------------------------------------------------------------*/
function is_Firefox() {
    if ( navigator.userAgent.indexOf('Firefox') > -1) {
        return true
    } else {
        return false;
    }
}


var browser = (function() {
    var ua = function(regexp) {return regexp.test(window.navigator.userAgent)}
    switch (true) {
        case ua(/edg/i): return "edge";
        case ua(/trident/i): return "ie";
        case ua(/firefox|fxios/i): return "firefox";
        case ua(/opr\//i): return "opera";
        case ua(/ucbrowser/i): return "uc";
        case ua(/samsungbrowser/i): return "samsung";
        case ua(/chrome|chromium|crios/i): return "chrome";
        case ua(/safari/i): return "safari";
        // default: return "other";
        default: return false;
    }
})();
// alert(browser);

/*Check IOS compatibility
-------------------------------------------------------------------*/
function is_iOS() {
    return [
        'iPad Simulator',
        'iPhone Simulator',
        'iPod Simulator',
        'iPad',
        'iPhone',
        'iPod'
    ].includes(navigator.platform)
    // iPad on iOS 13 detection
    || (navigator.userAgent.includes("Mac") && "ontouchend" in document)
}


/* Popup Overlay Functions
------------------------------------------------------------------------------*/
function open_page_overlay(thisObj) {

    // Check if arguments is a obj or string to ge the target data attribute value.
    if (typeof thisObj === 'string' || thisObj instanceof String) {
        var data_page_overlay = thisObj;
    } else {
        var data_page_overlay = $(thisObj).attr('data-open-target');
    }
    var page_overlay = '.page-overlay[data-page-overlay="'+ data_page_overlay +'"]';

    $('body').addClass(data_page_overlay);
    $('body').addClass('page-overlay-actived');
    setTimeout(function() {
        $.scrollLock( true );
        //$('html,body').addClass('page-overlay-displayed');
        $(page_overlay).addClass("actived");
        /* Custom Effect 1/2 */
        $('#mainmenu').addClass('invisible');
        $('#mainmenu').removeClass('visible');
        $('.logo').addClass('overlay-active');
        $('#wrapper').css('position','initial');
    }, 10);
    setTimeout(function() {
        $(page_overlay).addClass("displayed");
        $('#header').addClass("page-overlay-active");
    }, 50);
    setTimeout(function() {
        $(page_overlay + " .page-overlay-content").addClass("displayed");
        $('.page-overlay .get-focus-active').focus();
    }, 70);
}
function close_page_overlay() {
    //$('.close_overlay').addClass('active');
    //$( ".open-page-overlay" ).removeClass("active");

    // Just when is one page-overlay displayed
    //var data_page_overlay = $('.page-overlay.displayed').attr('data-page-overlay');

    // To work with multiples page-overlay displayed
    var data_page_overlay = new Array();
    $('.page-overlay.displayed').each( function() {
        data_page_overlay.push( $(this).attr('data-page-overlay'));
    });

    $.scrollLock( false );

    setTimeout(function() {
        $('.page-overlay-content').removeClass("displayed");
    }, 10);
    setTimeout(function() {
        $('.page-overlay').removeClass("displayed");
        $('#header').removeClass("page-overlay-active");
        $(".responsive-menu-btn").removeClass('open');
        /* Custom Effect 2/2*/
        $('#mainmenu').removeClass('invisible');
        $('#mainmenu').addClass('visible');
        $('.logo').removeClass('overlay-active');
        $('#wrapper').css('position','relative');
    }, 100);
    setTimeout(function() {
        $('.page-overlay').removeClass("actived");
        //$('html,body').removeClass('page-overlay-displayed');
    }, 400);
    setTimeout(function() {
        $(data_page_overlay).each( function( index, value) {
            $('body').removeClass(value);
        });
        $('body').removeClass('page-overlay-actived');
    }, 700);
}


/* -----------------------   TMP External Functions   ------------------------*/
/*----------------------------------------------------------------------------*/

/* Sticky Element - Sidebar
------------------------------------------------------------------------------*/
// function sticky_elements_function() {
//     if ($('#sidebar').length > 0) {
//         if ($(".jd_media_query_activation .d-lg-block").css("display") == "block" ){
//             $("#sidebar .contact-section").stick_in_parent({recalc_every: 1});
//         } else {
//             $("#sidebar .contact-section").trigger("sticky_kit:detach");
//         }
//     }
// }


/* Adding last first classes function
------------------------------------------------------------------------------*/
// function last_first_class_function($parent,$element) {
//     $($parent + '>' + $element).removeClass("first last").each(function () {
//         if ($(this).next().length && $(this).offset().top < $(this).next().offset().top) {
//             $(this).addClass("last");
//         }
//         if ($(this).prev().length && $(this).offset().top > $(this).prev().offset().top) {
//             $(this).addClass("first");
//         }
//     });
// }


/* Mobile Functions
------------------------------------------------------------------------------*/
// function mobile_function() {
//     if ($(".jd_media_query_activation .d-md-block").css("display") === "block" ){

//         // /* Responsive Images 1/2
//         // -------------------------------------------------------------------*/
//         // $('[data-mobile-img]').each(function() {
//         //     var mobileImg = $(this).attr('data-mobile-img');
//         //     $(this).attr('src',mobileImg);
//         // });

//         // /* Responsive Background Images 1/2
//         // -------------------------------------------------------------------*/
//         // $('[data-mobile-bg-img]').each(function() {
//         //     var mobileImg = $(this).attr('data-mobile-bg-img');
//         //     $(this).css({'background-image': 'url(' + mobileImg +')'});
//         // });

//     }
//     else{
//         /* Responsive Images 2/2
//         -------------------------------------------------------------------*/
//         // $('[data-desktop-img]').each(function() {
//         //     var desktopImg = $(this).attr('data-desktop-img');
//         //     $(this).attr('src', desktopImg);
//         // });


//         // /* Responsive Background Images 2/2
//         // -------------------------------------------------------------------*/
//         // $('[data-desktop-bg-img]').each(function() {
//         //     var desktopImg = $(this).attr('data-desktop-bg-img');
//         //     $(this).css({'background-image': 'url(' + desktopImg +')'});
//         // });

//     }
// }


/*----------------------------------------------------------------------------*/
/* -----------------  END OF External Custom Functions   ---------------------*/
/*----------------------------------------------------------------------------*/
