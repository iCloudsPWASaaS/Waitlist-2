$(function () {
    "use strict";

    function handlelogobg() {
        $('.theme-color .theme-item .theme-link').on("click", function () {
            var logobgskin = $(this).attr("data-logobg");
            $('.topbar .top-navbar .navbar-header').attr("data-logobg", logobgskin);
        });
    };
    handlelogobg();

    //****************************
    /* Top navbar Theme Change function Start */
    //****************************
    function handlenavbarbg() {
        if ($('#main-wrapper').attr('data-navbarbg') == 'skin6') {
            // do this
            $(".topbar .navbar").addClass('navbar-light');
            $(".topbar .navbar").removeClass('navbar-dark');
        } else {
            // do that

        }
        $('.theme-color .theme-item .theme-link').on("click", function () {
            var navbarbgskin = $(this).attr("data-navbarbg");
            $('#main-wrapper').attr("data-navbarbg", navbarbgskin);
            $('.topbar .navbar-collapse').attr("data-navbarbg", navbarbgskin);
            if ($('#main-wrapper').attr('data-navbarbg') == 'skin6') {
                // do this
                $(".topbar .navbar").addClass('navbar-light');
                $(".topbar .navbar").removeClass('navbar-dark');
            } else {
                // do that
                $(".topbar .navbar").removeClass('navbar-light');
                $(".topbar .navbar").addClass('navbar-dark');
            }
        });

    };
    handlenavbarbg();

    //****************************
    /* Manage sidebar bg color */
    //****************************
    function handlesidebarbg() {
        $('.theme-color .theme-item .theme-link').on("click", function () {
            var sidebarbgskin = $(this).attr("data-sidebarbg");
            $('.left-sidebar').attr("data-sidebarbg", sidebarbgskin);
            $('.scroll-sidebar').attr("data-sidebarbg", sidebarbgskin);
        });
    };
    handlesidebarbg();

    //****************************
    /* sidebar position */
    //****************************
    function handlesidebarposition() {
        $('#sidebar-position').on("change",function () {
            if ($(this).is(":checked")) {
                $('#main-wrapper').attr("data-sidebar-position", 'fixed');
                $('.topbar .top-navbar .navbar-header').attr("data-navheader", 'fixed');
            } else {
                $('#main-wrapper').attr("data-sidebar-position", 'absolute');
                $('.topbar .top-navbar .navbar-header').attr("data-navheader", 'relative');
            }
        });
    };
    handlesidebarposition();

    //****************************
    /* Header position */
    //****************************
    function handleheaderposition() {
        $('#header-position').on("change",function () {
            if ($(this).is(":checked")) {
                $('#main-wrapper').attr("data-header-position", 'fixed');
            } else {
                $('#main-wrapper').attr("data-header-position", 'relative');
            }
        });
    };
    handleheaderposition();

    //****************************
    /* sidebar position */
    //****************************
    function handleboxedlayout() {
        $('#boxed-layout').on("change",function () {
            if ($(this).is(":checked")) {
                $('#main-wrapper').attr("data-boxed-layout", 'boxed');
            } else {
                $('#main-wrapper').attr("data-boxed-layout", 'full');
            }
        });

    };
    handleboxedlayout();

    //****************************
    /* Header position */
    //****************************
    function handlethemeview() {
        $('#theme-view').on("change",function () {
            if ($(this).is(":checked")) {
                $('body').attr("data-theme", 'dark');
            } else {
                $('body').attr("data-theme", 'light');
            }
        });
    };
    handlethemeview();

    var setsidebartype = function () {
        var width = (window.innerWidth > 0) ? window.innerWidth : this.screen.width;
        if (width < 1170) {
            $("#main-wrapper").attr("data-sidebartype", "mini-sidebar");
            $("#main-wrapper").addClass("mini-sidebar");
        } else {
            $("#main-wrapper").attr("data-sidebartype", "full");
            $("#main-wrapper").removeClass("mini-sidebar");
        }
    };
    $(window).ready(setsidebartype);
    $(window).on("resize", setsidebartype);
});