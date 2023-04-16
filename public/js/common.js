$( document ).ready(function() {

    // Menu arrow
    $('.nav-page-2').parent().addClass('arrow-down');
    
    // Menu slide
    $(".nav-page-1 > .nav-item > .nav-link").on('click', function() {
        $(this).next().slideToggle();
    });

    // Menu fixed
    let nav = $('.navigation');
    let navHeight = $('.navigation').height();
    let replaceNav = $('.replace-nav');
    replaceNav.css('height', navHeight);
    let pos = nav.offset().top;
    $(window).scroll(function () {
        let fix = ($(this).scrollTop() > pos) ? true : false;
        nav.toggleClass('fixed', fix);
        replaceNav.toggleClass("active", fix);
    });
});
