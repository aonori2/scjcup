window.addEventListener('DOMContentLoaded', function(){
    $(".toggle_btn").on('click', function() {
        if(!$('#humberger-nav').hasClass('open')) {
            $('#humberger-nav').addClass('open');
            $('.toggle_btn').addClass('open');
        } else {
            $('#humberger-nav').removeClass('open')
        }
    });

    $('.nav-item').on('click', function() {
        var target = $(this).data('target');

        if(!$("#nav-item-sub-area" + target).hasClass('visible')) {
            $("#nav-item-sub-area" + target).addClass('visible');
            $('#nav-item-sub-area' + target).slideDown();
        } else {
            $("#nav-item-sub-area" + target).removeClass('visible');
            $('#nav-item-sub-area' + target).slideUp();
        }
    })

    $('.nav-sub-item-title').on('click', function() {

        var target = $(this).data('target');

        if(!$("#nav-item-second-area" + target).hasClass('visible')) {
            $("#nav-item-second-area" + target).addClass('visible');
            $('#nav-item-second-area' + target).slideDown();
        } else {
            $("#nav-item-second-area" + target).removeClass('visible');
            $('#nav-item-second-area' + target).slideUp();
        }
    })

    $('.footer-nav-item').on('click', function() {
        var target = $(this).data('target');

        if(!$("#footer-nav-subItem" + target).hasClass('visible')) {
            $("#footer-nav-subItem" + target).addClass('visible');
            $('#footer-nav-subItem' + target).slideDown();
        } else {
            $("#footer-nav-subItem" + target).removeClass('visible');
            $('#footer-nav-subItem' + target).slideUp();
        }
    })

    $('.footer-nav-sub-item-title').on('click', function() {
        var target = $(this).data('target');

        if(!$("#footer-nav-item-second-area" + target).hasClass('visible')) {
            $("#footer-nav-item-second-area" + target).addClass('visible');
            $('#footer-nav-item-second-area' + target).slideDown();
        } else {
            $("#footer-nav-item-second-area" + target).removeClass('visible');
            $('#footer-nav-item-second-area' + target).slideUp();
        }
    })


    $('.schedule-section-button').on('click', function() {
        var openAreaTarget = $(this).data('target');

        if(!$(this).hasClass('open')) {
            $('.group' + openAreaTarget).slideDown();
            $(this).addClass('open');
        } else {
            $('.group' + openAreaTarget).slideUp();
            $(this).removeClass('open');
        }
    })


    // $('.modal_pop').hide();

    $('.show_pop').on('click',function(){
        var modalNo = $(this).data('target');
        $('.popup' + modalNo).fadeIn();
    })

    $('.js-modal-close').on('click',function(){
        var modalNo = $(this).data('target');
        $('.popup' + modalNo).fadeOut();
    })
});
