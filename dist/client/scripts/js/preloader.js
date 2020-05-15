$(window).on("load", function () {

    // Remove preloader (https://ihatetomatoes.net/create-custom-preloading-screen/)
    $('main').removeClass('d-none');
    $('body').addClass('loaded');
});