    $(document).ready( function() {

        /*Add IOS compatibility
        -------------------------------------------------------------------*/
        if ( !$('html').hasClass("ie-compatible") && is_iOS() ) {
            $('html').addClass("ios-compatible");
        }

        /*Add Safari compatibility
        -------------------------------------------------------------------*/
        if ( is_Safari() ) {
            $('html').addClass("safari-compatible");
        }

        /*Add Safari compatibility
        -------------------------------------------------------------------*/
        if ( is_Firefox() ) {
            $('html').addClass("firefox-compatible");
        }


        /*Responsive tables
        -------------------------------------------------------------------*/
        if ($(".res-table").length > 0) {
        $('td').each (function() {
            var th = $(this).closest('table').find('th').eq( this.cellIndex );
            var thContent = $(th).html();
            if(thContent) {
                thContent = thContent.replace(/<\/?[^>]+(>|$)/g, "");
                $(this).attr('data-th',thContent);
            }
        });
        }


        /*Popup Overlay
        -------------------------------------------------------------------*/
        /** Open Overlay 1/2 **/
        $("body").on('click', '.open-page-overlay',function(e){
            e.preventDefault();
            open_page_overlay($(this));
            $(this).addClass('open');
        });

        /** Closing Overlay 2/2 **/
        /* When clicking Close Button */
        // $( '.close_overlay' ).on( 'click tap', function ( e ) {
        //     e.preventDefault();
        //     close_page_overlay();
        // });

		/* When Clicking Out */
        var page_overlay_inside_element = $( '.page-overlay .page-overlay-content .page-overlay-content-main' );
        $( '.page-overlay' ).bind("click tap", function ( e ) {
            if ( $( e.target ).closest( page_overlay_inside_element ).length === 0 ) {
                close_page_overlay();
            }
        });

        /* When Pressing ESC */
        $( document ).on( 'keydown', function ( e ) {
            if ( e.keyCode === 27 ) {
                close_page_overlay();
            }
        });


        /*  Responsive Menu Trigger
        -------------------------------------------------------------------*/
        $("body").on('click', '.responsive-menu-btn',function(e){
            e.preventDefault();
            if ($(this).hasClass('open')) {
                close_page_overlay();
                $(this).removeClass('open');
            }else{
                open_page_overlay($(this));
                $(this).addClass('open');
            }
        });


        /* Header Search
        -------------------------------------------------------------------*/
        $(document).on('click', '.search-btn.open-page-overlay', function(){
            var search_input = $('.page-overlay[data-page-overlay="search_overlay"] input[type="search"]');
            $(search_input).trigger('focus');
            setTimeout(function(){
                $(search_input).trigger('focus');
            },700);
            return false;
        })


        /*Responsive Menu Dropdown
        -------------------------------------------------------------------*/
        // Add span elements for parent links
        $('.responsive-menu li.menu-item-has-children').has( "ul" ).prepend('<span></span>');
        $('.responsive-menu li.menu-item-has-children > a').addClass('closed');

        // On click show or hide sub menu
        $('.responsive-menu li.menu-item-has-children span').click(function(e){
            // Define variables
            var current_span = $(this);
            var menus = $('.responsive-menu .sub-menu');
            var this_menu = $(this).parent().children('.sub-menu');
            var links = $('.menu-item-has-children.open');
            var this_link = $(this).next('a');

            // Prevent link default action
            e.preventDefault();

            // Close all open menus excluding this one
            // Change open class to closed
            if($('.item-has-children').hasClass('open')){
                menus.not(this_menu).slideUp();
                $(links).not(this_link).removeClass('open').addClass('closed');
            }

            // Toggle clicked on menu
            this_menu.slideToggle();

            // Change class appropriately
            if(this_link.hasClass('closed')){
                this_link.removeClass('closed');
                this_link.addClass('open');
                current_span.addClass('active');
            } else {
                this_link.removeClass('open');
                this_link.addClass('closed');
                current_span.removeClass('active');
            }
        });


        /* Accordion
        -------------------------------------------------------------------*/
        $('.accordion-box:not(.multi-open) .accordion-databox').each(function(){
            var $accordion = $(this),
                $accordionTrigger = $accordion.find('.accordion-trigger'),
                $accordionDatabox = $accordion.find('.accordion-data');

            $accordionTrigger.on('click',function(e){
                var $this = $(this);
                var $accordionData = $this.next('.accordion-data');
                if( $accordionData.is($accordionDatabox) && $accordionData.is(':visible')){
                    $this.parent().removeClass('open');
                    $accordionData.slideUp(400);
                    e.preventDefault();
                }else{
                    $accordionTrigger.parent().removeClass('open');
                    $this.parent().addClass('open');

                    $accordionDatabox.slideUp(400);
                    $accordionData.slideDown(400,function() {
                        // Animation complete.
                        // Just for mobile to scroll back to the top of the page
                        if ($(".jd_media_query_activation .d-md-block").css("display") !== "block") {
                            $('html,body').animate({
                                scrollTop: $this.offset().top
                            }, 50);
                        }
                    });
                }
            });
        });

        /* Accordion - Multi Open
        -------------------------------------------------------------------*/
        $('.accordion-box.multi-open .accordion-row .accordion-trigger').each(function(){
            var $content = $(this).closest('div').find('.accordion-data');

            $(this).bind('click tap',function (e){
                e.preventDefault();
                if (!$content.is(':animated')){  //rigth way to ask if...
                    if (!$(this).closest('div').hasClass("open")) {
                        $(this).closest('div').addClass('open');
                    } else {
                        $(this).closest('div').removeClass('open');
                    }
                }
                $content.not(':animated').slideToggle(400);
            });
        });

        /* Accordion - First Open option
        -------------------------------------------------------------------*/
        $('.accordion-box.first-open').each(function(){
            $(this).find('.accordion-row').first('accordion-row').addClass('open');
            $(this).find('.accordion-row').first('accordion-row').find('div').show();
        });


        /* Tab Content box
        ---------------------------------------------------------------------*/
        var tabBlockElement = $('.jq-tabs');
        $(tabBlockElement).each(function () {
            var $this = $(this),
                tabTrigger = $this.find(".tabnav li"),
                tabContent = $this.find(".tabcontent");
            var textval = [];
            tabTrigger.each(function () {
                textval.push($(this).text());
            });
            $this.find(tabTrigger).first().addClass("active");
            $this.find(tabContent).first().show();

            $(tabTrigger).on('click', function () {
                if ( !$(this).hasClass( 'active' ) ){
                    $(tabContent).hide().removeClass('visible');
                    var activeTab = $(this).find("a").attr("data-rel");
                    $this.find('[data-rel='+ activeTab +']').fadeIn('normal').addClass('visible');
                }
                $(tabTrigger).removeClass("active");
                $(this).addClass("active");

                return false;
            });

            var responsivetabActive = function () {
                if ($(".jd_media_query_activation .d-lg-block").css("display") !== "block") {
                    if (!$this.find('.tabMobiletrigger').length) {
                        $(tabContent).each(function (index) {
                            $(this).before("<h5 class='tabMobiletrigger'>" + textval[index] + "</h5>");
                            $this.find('.tabMobiletrigger:first').addClass("rotate");
                        });
                        $this.find('.tabMobiletrigger').on('click', function () {
                            var tabAcoordianData = $(this).next('.tabcontent');
                            if ($(tabAcoordianData).is(':visible')) {
                                $(this).removeClass('rotate');
                                $(tabAcoordianData).slideUp('normal');
                                //return false;
                            } else {
                                $this.find('.tabMobiletrigger').removeClass('rotate');
                                $(tabContent).slideUp('normal');
                                $(this).addClass('rotate');
                                // $(tabAcoordianData).not(':animated').slideToggle('normal');
                                $(tabAcoordianData).slideToggle('normal');
                            }
                            return false;
                        });
                    }

                } else {
                    if ($('.tabMobiletrigger').length) {
                        $('.tabMobiletrigger').remove();
                        tabTrigger.removeClass("active");
                        $this.find(tabTrigger).removeClass("active").first().addClass('active');
                        $this.find(tabContent).hide().first().show();
                    }
                }
            };
            $(window).on('resize', function () {
                if (!$this.hasClass('only-tab')) {
                    responsivetabActive();
                }
            }).resize();
        });

        /*  Sticky Header
        -------------------------------------------------------------------*/
        // Set options
        var clone = ( $("#wrapper").hasClass('wrap') ) ? "clone-wrap" : "clone-full";
        var options = {
            offset: 1000, // Custom height to be activated
            offsetSide: 'top',
            classes: {
                clone:   clone,
                stick:   'sticky',
                unstick: 'unstick'
            }
        };

        // Initialise with options
        var banner = new Headhesive('.header', options);


        /* Share buttons window popup
        -------------------------------------------------------------------*/
        $('.social-share-buttons a.popup').click(function(e){
            e.preventDefault();
            var url = $(this).attr('href');
            window.open(url, '_blank', 'width=500, height=500, top=50, left=50');
        });


        /* Banner Slider
        -------------------------------------------------------------------*/
        if($('.banner.slider').length > 0){
            $('.banner.slider').slick({
                autoplay: true,
                autoplaySpeed: 2000,
                speed: 500,
                fade: true,
                arrows: false,
                dots:true,
                pauseOnHover:false,
                slide:"figure"
            });
        }

        if($('.banner.slider-arrows').length > 0){
            $('.banner.slider-arrows').slick({
                autoplay: true,
                autoplaySpeed: 2000,
                speed: 500,
                fade: true,
                arrows: true,
                // Uncomment next section if you want custom elements for the slick arrows
                // nextArrow: '.slick-next.slick-arrow',
                // prevArrow: '.slick-prev.slick-arrow',
                dots:true,
                pauseOnHover:false,
                slide:"figure"
            });
        }


        /* Banner Slider LightBox
        -------------------------------------------------------------------*/
        if($('.popup-gallery').length > 0){
            $('.popup-gallery').slickLightbox({
                        //itemSelector: '.lightbox-link',
                        caption:'caption'
                }).on({
                'show.slickLightbox': function(){
                    open_page_overlay();
                    //console.log('A `show.slickLightbox` event triggered.');
                },
                // 'shown.slickLightbox': function(){ console.log('A `shown.slickLightbox` event triggered.'); },
                'hide.slickLightbox': function(){
                    close_page_overlay();
                    //console.log('A `hide.slickLightbox` event triggered.');
                },
                //'hidden.slickLightbox': function(){ console.log('A `hidden.slickLightbox` event triggered.'); }
            });
        };


        if ($('.highlight-slider').length) {
            $('.highlight-slider').slick({
                arrows: false,
                dots: true,
            });
        }

        if($('.logos-slider').length){
            $('.logos-slider').slick({
                autoplay: false,
                autoplaySpeed: 2000,
                speed: 500,
                arrows: false,
                dots: false,
                pauseOnHover:false,
                slidesToShow: 5,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 2,
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                        }
                    }
                ],
            });
        }
        if($('.logos-slider5').length){
            $('.logos-slider5').slick({
                autoplay: false,
                autoplaySpeed: 2000,
                speed: 500,
                arrows: false,
                dots: false,
                pauseOnHover:false,
                slidesToShow: 4,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 2,
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                        }
                    }
                ]
            });
        }
        if($('.carousel-slider').length){
            $('.carousel-slider').slick({
                autoplay: false,
                autoplaySpeed: 2000,
                speed: 500,
                arrows: true,
                dots: false,
                pauseOnHover:false,
                slidesToShow: 1,
            });
        }


        /* Testing Utils
        -------------------------------------------------------------------*/

        var titles_pool = [
            'Short Title.',
            'Regular size normal title example.',
            'Long size title example that could be used in multiple places.',
            'Super extra long size title example that could be used in some places and should be considered.'
        ];

        $('.random-title').each (function() {
            var randomNumber = Math.floor(Math.random() * (titles_pool.length));
            $(this).text(titles_pool[randomNumber]);
        });

        var paragraphs_pool = [
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'Lorem ipsum dolor consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.',
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.',
            'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur.'
        ];

        $('.random-paragraph').each (function() {
            var randomNumber = Math.floor(Math.random() * (paragraphs_pool.length));
            $(this).text(paragraphs_pool[randomNumber]);
        });

        if ($(".random-blocks").length > 0) {
            var blokcs = $(".block-wrapper");
            for(var i = 0; i < blokcs.length; i++){
                var target = Math.floor(Math.random() * blokcs.length -1) + 1;
                var target2 = Math.floor(Math.random() * blokcs.length -1) +1;
                blokcs.eq(target).before(blokcs.eq(target2));
            }
        }

        // work around for input type date missing placeholder on mobile
        $('input[type="date"]')
            .on('click focus change', function() {
                $(this).addClass('active');
            })
            .on('blur', function() {
                if($(this).val() == '') $(this).removeClass('active');
            });


        /*----------------------------------------------------------------------------*/
        /* --------------------------   TMP Ready Functions   ------------------------*/
        /*----------------------------------------------------------------------------*/

        /*SVG IMG compatibility
        -------------------------------------------------------------------*/
        // if (!Modernizr.svg) {
        //     //For SVG Imgs
        //     $('img[src*="svg"]').attr('src', function() {
        //         return $(this).attr('src').replace('.svg', '.png');
        //     });
        //     //For SVG Inline
        //     $('.svg-fallback').addClass('fall-back-active');
        // }

        /*Remove "Tel" links on Desktop
        -------------------------------------------------------------------*/
        // if (!$('html').hasClass('touch')) {
        //     $('a[href^="tel:"]').each(function() {
        //         $(this).removeAttr("href");
        //     });
        // }

        /*Parallax Effect
        -------------------------------------------------------------------*/
        // if ($('body').hasClass('banner-enabled')) {
        //     $('#header').parally();
        // }

        /*----------------------------------------------------------------------------*/
        /* ----------------------   All Custom Function calls   ----------------------*/
        /*----------------------------------------------------------------------------*/

        /* Mobile Function call
        -------------------------------------------------------------------*/
        //mobile_function();

        /*----------------------------------------------------------------------------*/
        /* ---------------------   TMP Custom Function Calls  ------------------------*/
        /*----------------------------------------------------------------------------*/


        /* Sticky Elements Function call
        -------------------------------------------------------------------*/
        // sticky_elements_function();


        /* last_first_class function call
        -------------------------------------------------------------------*/
        // setTimeout(function() {
        //     //Adding "first" "last" classes to element per line with delay
        //     last_first_class_function('#footer ul','li');
        // }, 100);


    /*--------------------------------------------------------------------------------*/
    });/* ************************ $(document).ready  ******************************* */
    /*--------------------------------------------------------------------------------*/
