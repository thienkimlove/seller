$(document).ready(function(){
    menu('.open-top-nav');
    menu('.open-main-nav');
    bannerAdsSide();
    changeContentTab('.tab-pro a','.des-pro .tab-content');
});
$(".parentMenu>a").on('click',function(){
    var parentMenu = $(this).parent();
    parentMenu.find('.submenu').toggle();
});
function bannerAdsSide() {
    var $banner = $('.banner-ads'), $window = $(window);
    var $topDefault = parseFloat( $banner.css('top'), 10 );
    $window.on('scroll', function() {
        var $top = $(this).scrollTop();
        $banner.stop().animate( { top: $top + $topDefault }, 100 , 'easeOutCirc');
    });
}
function changeContentTab(btnClick, tabContent){
    $(btnClick).click(function(){
        var content = $(this).data('content');
        $(this).siblings().removeClass('active');
        $(this).addClass('active');
        $(content).siblings().removeClass('active');
        $(content).addClass('active');
    });
}
function menu(btnClick){
    $(btnClick).off('click');
    var click = 0;
    $(btnClick).click(function(){
        var menu = $(this).data('menu');
        if (click == 0) {
            $(menu).addClass('transX0');
            $(this).css({'background':'url("http://lmhtgosu.besaba.com/dist/images/menu-close.png")'});
            click++;
        } else {
            $(menu).removeClass('transX0');
            $(this).css({'background':'url("http://lmhtgosu.besaba.com/dist/images/menu-open.png")'});
            click--;
        }
    });
}
function notify(res) {
    $('.popup').fadeOut();
    $('#login_error, #register_error , #forgot_error, #general_error, #general_success').hide().text('');
    $("#general_popup").fadeIn();
    if (res.status === false) {
        $("#general_popup #general_success").hide();
        $("#general_popup #general_error").show().html(res.msg);
    } else {
        $("#general_popup #general_error").hide();
        $("#general_popup #general_success").show().html(res.msg);
    }

    $("#general_popup .close-popup").click(function () {
        $("#general_popup").fadeOut();
    });
}
function login() {
    $('.popup').fadeOut();
    $('#login_error, #register_error , #forgot_error, #general_error, #general_success').hide().text('');
    $("#login_popup").fadeIn();
    $("#login_popup .close-popup").click(function () {
        $("#login_popup").fadeOut();
    });
}
function register() {
    $('.popup').fadeOut();
    $('#login_error, #register_error , #forgot_error, #general_error, #general_success').hide().text('');
    $("#register_popup").fadeIn();
    $("#register_popup .close-popup").click(function () {
        $("#register_popup").fadeOut();
    });
}

function forgot() {
    $('.popup').fadeOut();
    $('#login_error, #register_error , #forgot_error, #general_error, #general_success').hide().text('');
    $("#forgot_popup").fadeIn();
    $("#forgot_popup .close-popup").click(function () {
        $("#forgot_popup").fadeOut();
    });
}
