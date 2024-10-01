(function ($) {
    "use strict";
    /*=================================
        JS Index Here
    ==================================*/
    /*
    01. On Load Function
    02. Preloader
    03. Mobile Menu Active
    04. Sticky fix
    05. Scroll To Top
    06. Set Background Image Color & Mask
    07. Global Slider
    08. Custom Animaiton For Slider
    09. Ajax Contact Form
    10. Search Box Popup
    11. Popup Sidemenu
    12. Magnific Popup
    13. Dark Mode Toggle
    14. Indicator
    15. AS Tab
    16. Filter
    17. Counter Up
    18. Price Slider
    00. Woocommerce Toggle
    00. Right Click Disable
    */
    /*=================================
        JS Index End
    ==================================*/
    /*

  /*---------- 01. On Load Function ----------*/
    $(window).on("load", function () {
        $(".preloader").fadeOut();
        $(".popup-subscribe").addClass('popup-ani');
    });

    $(window).on('resize', function () {
        $(".slick-slider").slick("refresh");
    });

    /*---------- 02. Preloader ----------*/
    if ($(".preloader").length > 0) {
        $(".preloaderCls").each(function () {
            $(this).on("click", function (e) {
                e.preventDefault();
                $(".preloader").css("display", "none");
            });
        });
    }

    /*---------- 03. Mobile Menu Active ----------*/
    $.fn.thmobilemenu = function (options) {
        var opt = $.extend(
            {
                menuToggleBtn: ".th-menu-toggle",
                bodyToggleClass: "th-body-visible",
                subMenuClass: "th-submenu",
                subMenuParent: "th-item-has-children",
                subMenuParentToggle: "th-active",
                meanExpandClass: "th-mean-expand",
                appendElement: '<span class="th-mean-expand"></span>',
                subMenuToggleClass: "th-open",
                toggleSpeed: 400,
            },
            options
        );

        return this.each(function () {
            var menu = $(this); // Select menu

            // Menu Show & Hide
            function menuToggle() {
                menu.toggleClass(opt.bodyToggleClass);

                // collapse submenu on menu hide or show
                var subMenu = "." + opt.subMenuClass;
                $(subMenu).each(function () {
                    if ($(this).hasClass(opt.subMenuToggleClass)) {
                        $(this).removeClass(opt.subMenuToggleClass);
                        $(this).css("display", "none");
                        $(this).parent().removeClass(opt.subMenuParentToggle);
                    }
                });
            }

            // Class Set Up for every submenu
            menu.find("li").each(function () {
                var submenu = $(this).find("ul");
                submenu.addClass(opt.subMenuClass);
                submenu.css("display", "none");
                submenu.parent().addClass(opt.subMenuParent);
                submenu.prev("a").append(opt.appendElement);
                submenu.next("a").append(opt.appendElement);
            });

            // Toggle Submenu
            function toggleDropDown($element) {
                if ($($element).next("ul").length > 0) {
                    $($element).parent().toggleClass(opt.subMenuParentToggle);
                    $($element).next("ul").slideToggle(opt.toggleSpeed);
                    $($element).next("ul").toggleClass(opt.subMenuToggleClass);
                } else if ($($element).prev("ul").length > 0) {
                    $($element).parent().toggleClass(opt.subMenuParentToggle);
                    $($element).prev("ul").slideToggle(opt.toggleSpeed);
                    $($element).prev("ul").toggleClass(opt.subMenuToggleClass);
                }
            }

            // Submenu toggle Button
            var expandToggler = "." + opt.meanExpandClass;
            $(expandToggler).each(function () {
                $(this).on("click", function (e) {
                    e.preventDefault();
                    toggleDropDown($(this).parent());
                });
            });

            // Menu Show & Hide On Toggle Btn click
            $(opt.menuToggleBtn).each(function () {
                $(this).on("click", function () {
                    menuToggle();
                });
            });

            // Hide Menu On out side click
            menu.on("click", function (e) {
                e.stopPropagation();
                menuToggle();
            });

            // Stop Hide full menu on menu click
            menu.find("div").on("click", function (e) {
                e.stopPropagation();
            });
        });
    };

    $(".th-menu-wrapper").thmobilemenu();

    /*---------- 04. Sticky fix ----------*/
    $(window).scroll(function () {
        var topPos = $(this).scrollTop();
        if (topPos > 500) {
            $('.sticky-wrapper').addClass('sticky');
        } else {
            $('.sticky-wrapper').removeClass('sticky')
        }
    })

    /*---------- Sticky Footer ----------*/
    function checkHeight() {
        if ($('body').height() < $(window).height()) {
          $('.footer-sitcky').addClass('sticky-footer');
        } else {
          $('.footer-sitcky').removeClass('sticky-footer');
        }
    }
    $(window).on('load resize', function () {
        checkHeight();
    });

    /*---------- 05. Scroll To Top ----------*/
    // progressAvtivation
    if ($('.scroll-top').length > 0) {
        
        var scrollTopbtn = document.querySelector('.scroll-top');
        var progressPath = document.querySelector('.scroll-top path');
        var pathLength = progressPath.getTotalLength();
        progressPath.style.transition = progressPath.style.WebkitTransition = 'none';
        progressPath.style.strokeDasharray = pathLength + ' ' + pathLength;
        progressPath.style.strokeDashoffset = pathLength;
        progressPath.getBoundingClientRect();
        progressPath.style.transition = progressPath.style.WebkitTransition = 'stroke-dashoffset 10ms linear';		
        var updateProgress = function () {
            var scroll = $(window).scrollTop();
            var height = $(document).height() - $(window).height();
            var progress = pathLength - (scroll * pathLength / height);
            progressPath.style.strokeDashoffset = progress;
        }
        updateProgress();
        $(window).scroll(updateProgress);	
        var offset = 50;
        var duration = 750;
        jQuery(window).on('scroll', function() {
            if (jQuery(this).scrollTop() > offset) {
                jQuery(scrollTopbtn).addClass('show');
            } else {
                jQuery(scrollTopbtn).removeClass('show');
            }
        });				
        jQuery(scrollTopbtn).on('click', function(event) {
            event.preventDefault();
            jQuery('html, body').animate({scrollTop: 0}, duration);
            return false;
        })
    }

    /*---------- 06. Set Background Image Color & Mask ----------*/
    if ($("[data-bg-src]").length > 0) {
        $("[data-bg-src]").each(function () {
            var src = $(this).attr("data-bg-src");
            $(this).css("background-image", "url(" + src + ")");
            $(this).removeAttr("data-bg-src").addClass("background-image");
        });
    }

    if ($('[data-bg-color]').length > 0) {
        $('[data-bg-color]').each(function () {
          var color = $(this).attr('data-bg-color');
          $(this).css('background-color', color);
          $(this).removeAttr('data-bg-color');
        });
    };

    if ($('[data-theme-color]').length > 0) {
        $('[data-theme-color]').each(function () {
          var $color = $(this).attr('data-theme-color');
          $(this).get(0).style.setProperty('--theme-color', $color);
          $(this).removeAttr('data-theme-color');
        });
    };
      
    if ($('[data-mask-src]').length > 0) {
        $('[data-mask-src]').each(function () {
          var mask = $(this).attr('data-mask-src');
          $(this).css({
            'mask-image': 'url(' + mask + ')',
            '-webkit-mask-image': 'url(' + mask + ')'
          });
          $(this).addClass('bg-mask');
          $(this).removeAttr('data-mask-src');
        });
    };

    // Function For Custom Arrow Btn
    $("[data-slick-next]").each(function () {
        $(this).on("click", function (e) {
            e.preventDefault();
            $($(this).data("slick-next")).slick("slickNext");
        });
    });

    $("[data-slick-prev]").each(function () {
        $(this).on("click", function (e) {
            e.preventDefault();
            $($(this).data("slick-prev")).slick("slickPrev");
        });
    });

    /*----------- 07. Global Slider ----------*/


    /*---------- 10. Search Box Popup & Close Popup ----------*/
    function popupSarchBox($searchBox, $searchOpen, $searchCls, $toggleCls) {
        $($searchOpen).on("click", function (e) {
            e.preventDefault();
            $($searchBox).addClass($toggleCls);
        });
        $($searchBox).on("click", function (e) {
            e.stopPropagation();
            $($searchBox).removeClass($toggleCls);
        });
        $($searchBox)
            .find("form")
            .on("click", function (e) {
                e.stopPropagation();
                $($searchBox).addClass($toggleCls);
            });
        $($searchCls).on("click", function (e) {
            e.preventDefault();
            e.stopPropagation();
            $($searchBox).removeClass($toggleCls);
        });
    }
    popupSarchBox( ".popup-search-box", ".searchBoxToggler", ".searchClose", "show" );

    /*---------- Close Popup ----------*/
    function closePopup($popupBox, $popupClose) {
        $($popupClose).on("click", function (e) {
            $($popupBox).addClass('hide');
        });
    }
    closePopup( ".popup-subscribe-area", ".popupClose");
    
    $("#destroyPopup").on("click", function () {
        $(".popup-subscribe-area").addClass('hide');
        localStorage.setItem("popupDestroyed", "true");
    });
    
    const popupDestroyed = localStorage.getItem("popupDestroyed");
    if (popupDestroyed === "true") {
        $(".popup-subscribe-area").hide();
    }

    /*---------- 11. Popup Sidemenu ----------*/
    function popupSideMenu($sideMenu, $sideMunuOpen, $sideMenuCls, $toggleCls) {
        // Sidebar Popup
        $($sideMunuOpen).on('click', function (e) {
        e.preventDefault();
        $($sideMenu).addClass($toggleCls);
        });
        $($sideMenu).on('click', function (e) {
        e.stopPropagation();
        $($sideMenu).removeClass($toggleCls)
        });
        var sideMenuChild = $sideMenu + ' > div';
        $(sideMenuChild).on('click', function (e) {
        e.stopPropagation();
        $($sideMenu).addClass($toggleCls)
        });
        $($sideMenuCls).on('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
        $($sideMenu).removeClass($toggleCls);
        });
    };
    popupSideMenu('.sidemenu-1', '.sideMenuToggler', '.sideMenuCls', 'show');

    /*---------- For Cart ----------*/
    function popupSideMenu($sideMenu, $sideMunuOpen, $sideMenuCls, $toggleCls) {
        // Sidebar Popup
        $($sideMunuOpen).on('click', function (e) {
        e.preventDefault();
        $($sideMenu).addClass($toggleCls);
        });
        $($sideMenu).on('click', function (e) {
        e.stopPropagation();
        $($sideMenu).removeClass($toggleCls)
        });
        var sideMenuChild = $sideMenu + ' > div';
        $(sideMenuChild).on('click', function (e) {
        e.stopPropagation();
        $($sideMenu).addClass($toggleCls)
        });
        $($sideMenuCls).on('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
        $($sideMenu).removeClass($toggleCls);
        });
    };
    popupSideMenu('.cart-side-menu', '.cartToggler', '.sideMenuCls', 'show');

    /*----------- 12. Magnific Popup ----------*/
    /* magnificPopup img view */
    $(".popup-image").magnificPopup({
        type: "image",
        mainClass: 'mfp-zoom-in', 
        removalDelay: 260,
        gallery: {
            enabled: true,
        },
    });

    /* magnificPopup video view */
    $(".popup-video").magnificPopup({
        type: "iframe",
    });

    /* magnificPopup video view */
    $(".popup-content").magnificPopup({
        type: "inline",
        midClick: true,
    });

    $(".popup-content").on("click", function () {
        $(".slick-slider").slick("refresh");
    });

    /*----------- 13. Dark Mode Toggle ----------*/
    // Function to toggle the theme
    function toggleTheme() {
        $("html").toggleClass("dark-theme").removeClass("light-theme");
        const currentTheme = $("html").hasClass("dark-theme") ? "dark" : "light";
        $("html").attr("data-theme", currentTheme);
        $('.theme-switcher').toggleClass('active');

        // Save the theme preference to localStorage
        localStorage.setItem("themePreference", currentTheme);
    }

    // Check if the theme preference is saved in localStorage and apply it
    const savedTheme = localStorage.getItem("themePreference");
    if (savedTheme) {
        if (savedTheme === "dark") {
            $("html").addClass("dark-theme").attr("data-theme", "dark");
            $('.theme-switcher').addClass('active');
        } else {
            $("html").addClass("light-theme").attr("data-theme", "light");
            $('.theme-switcher').removeClass('active');
        }
    }

    // Attach click event handler to theme toggler
    $(".theme-toggler, .theme-switcher").on("click", function (e) {
        e.preventDefault();
        toggleTheme();
    });

    // Print Html Document
    $('.print_btn').on('click', function (e) {
        window.print();
    });

    /*----------- 14. Indicator ----------*/
    // Indicator

    
    /*---------- 15. AS Tab ----------*/


    /*----------- 16. Filter ----------*/
    $(".filter-active").imagesLoaded(function () {
        var $filter = ".filter-active",
            $filterItem = ".filter-item",
            $filterMenu = ".filter-menu-active";

        if ($($filter).length > 0) {
            var $grid = $($filter).isotope({
                itemSelector: $filterItem,
                filter: "*",
                masonry: {
                    // use outer width of grid-sizer for columnWidth
                    // columnWidth: 1,
                },
            });

            // filter items on button click
            $($filterMenu).on("click", "button", function () {
                var filterValue = $(this).attr("data-filter");
                $grid.isotope({
                    filter: filterValue,
                });
            });

            // Menu Active Class
            $($filterMenu).on("click", "button", function (event) {
                event.preventDefault();
                $(this).addClass("active");
                $(this).siblings(".active").removeClass("active");
            });
        }
    });


    /*----------- 17. Counter Up ----------*/
    $(".counter-number").counterUp({
        delay: 5,
        time: 600,
    });

    /*----------- 18. Price Slider ----------*/
    $(".price_slider").slider({
        range: true,
        min: 10,
        max: 100,
        values: [10, 75],
        slide: function (event, ui) {
          $(".from").text("$" + ui.values[0]);
          $(".to").text("$" + ui.values[1]);
        }
      });
    $(".from").text("$" + $(".price_slider").slider("values", 0));
    $(".to").text("$" + $(".price_slider").slider("values", 1));

    /*----------- 00. Woocommerce Toggle ----------*/
    // Woocommerce Shipping Method
    $(".shipping-calculator-button").on("click", function (e) {
        e.preventDefault();
        $(this).next(".shipping-calculator-form").slideToggle();
    });

    // Woocommerce Payment Toggle
    $('.wc_payment_methods input[type="radio"]:checked')
        .siblings(".payment_box")
        .show();
    $('.wc_payment_methods input[type="radio"]').each(function () {
        $(this).on("change", function () {
            $(".payment_box").slideUp();
            $(this).siblings(".payment_box").slideDown();
        });
    });

    // Woocommerce Rating Toggle
    $(".rating-select .stars a").each(function () {
        $(this).on("click", function (e) {
            e.preventDefault();
            $(this).siblings().removeClass("active");
            $(this).parent().parent().addClass("selected");
            $(this).addClass("active");
        });
    });

    // Quantity Plus Minus ---------------------------
    $(document).on('click', '.quantity-plus, .quantity-minus', function (e) {
        e.preventDefault();
        // Get current quantity values
        var qty = $(this).closest('.quantity, .product-quantity').find('.qty-input');
        var val = parseFloat(qty.val());
        var max = parseFloat(qty.attr('max'));
        var min = parseFloat(qty.attr('min'));
        var step = parseFloat(qty.attr('step'));

        // Change the value if plus or minus
        if ($(this).is('.quantity-plus')) {
            if (max && (max <= val)) {
                qty.val(max);
            } else {
                qty.val(val + step);
            }
        } else {
            if (min && (min >= val)) {
                qty.val(min);
            } else if (val > 0) {
                qty.val(val - step);
            }
        }
        $('.cart_table button[name="update_cart"]').prop('disabled', false);
    });


    //Blog Slider
    $('.th-blog-carousel').slick({
        dots: false,
        infinite: true,
        arrows: true,
        prevArrow: '<button type="button" class="slick-prev slick-arrow" style=""><i class="far fa-arrow-left"></i></button>',
        nextArrow: '<button type="button" class="slick-next slick-arrow" style=""><i class="far fa-arrow-right"></i></button>',
        autoplay: true,
        autoplaySpeed: 3000,
        fade: true,
        speed: 1000,
        slidesToShow: 1,
        slidesToScroll: 1,
        adaptiveHeight: true,
        responsive: [ {
            breakpoint: 992, 
            settings: {
                slidesToShow: 1,
                arrows: false,
                }
            }
        ]
    });

    // Search Masonary //
    $('.search-active').imagesLoaded(function () {
        var $filter = '.search-active',
        $filterItem = '.filter-item';

        if ($($filter).length > 0) {
        var $grid = $($filter).isotope({
            itemSelector: $filterItem,
            filter: '*',
            // masonry: {
            // // use outer width of grid-sizer for columnWidth
            //     columnWidth: 1
            // }
        });
        };
    });
    
    // Product Slider for single product
    $('.product-img-slider').slick({
        dots: true,
        infinite: true,
        arrows: false,
        autoplay: true,
        autoplaySpeed: 6000,
        fade: true,
        speed: 1000,
        slidesToShow: 1,
        slidesToScroll: 1,
    });

    // Related Product Slider 
    $('.related-products-carousel').slick({
        dots: false,
        infinite: true,
        arrows: false,
        autoplay: true,
        autoplaySpeed: 6000,
        fade: false,
        speed: 1000,
        slidesToShow: 4,
        slidesToScroll: 1,
        responsive: [{
                breakpoint: 1500,
                settings: {
                    slidesToShow: 4,
                    arrows: false,
                }
            },
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 3,
                    arrows: false,
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                    arrows: false,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    arrows: false,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                    arrows: false,
                }
            }
        ]
    });
    
    // /*----------- 00. Right Click Disable ----------*/
    //   window.addEventListener('contextmenu', function (e) {
    //     // do something here...
    //     e.preventDefault();
    //   }, false);

    // /*----------- 00. Inspect Element Disable ----------*/
    //   document.onkeydown = function (e) {
    //     if (event.keyCode == 123) {
    //       return false;
    //     }
    //     if (e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
    //       return false;
    //     }
    //     if (e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) {
    //       return false;
    //     }
    //     if (e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
    //       return false;
    //     }
    //     if (e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
    //       return false;
    //     }
    //   }


    
})(jQuery);