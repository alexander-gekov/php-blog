$(document).ready(function () {

//Slider
    var speed = 500;
    var autoswtich = true;
    var autoswitch_speed = 4000;

    //Add class
    $('.slide').first().addClass('active');

    $('.slide').hide();

    $('.active').show();

    $('#next').on('click', nextSlide);

    $('#prev').on('click', prevSlide);

    if (autoswtich == true) {
        setInterval(nextSlide, autoswitch_speed);
    }

    function nextSlide(){
        $('.active').removeClass('active').addClass('oldActive');
        if($('.oldActive').is(':last-child')){
            $('.slide').first().addClass('active');
        }
        else{
            $('.oldActive').next().addClass('active');
        }
        $('.oldActive').removeClass('oldActive');
        $('.slide').fadeOut(speed);
        $('.active').fadeIn(speed);
    }

    function prevSlide(){
        $('.active').removeClass('active').addClass('oldActive');
        if ($('.oldActive').is(':first-child')) {
            $('.slide').last().addClass('active');
        }
        else {
            $('.oldActive').prev().addClass('active');
        }
        $('.oldActive').removeClass('oldActive');
        $('.slide').fadeOut(speed);
        $('.active').fadeIn(speed);
    }

    $(window).scroll(function() {
        var scroll = $(window).scrollTop();
        $("#js-hero img").css({
            width: (100 + scroll/5) + "%"
        })
    })

    var button = document.getElementById("btnSubmit");

    if (document.getElementById("loginForm")) {
        button.addEventListener("click", validateLoginForm);
    }
    if (document.getElementById("registerForm")) {
        button.addEventListener("click", validateRegisterForm);
    }
    if (document.getElementById("resetForm")) {
        button.addEventListener("click", validateResetForm);
    }

    function validateLoginForm() {
        var username = document.getElementById("loginUsername");
        var password = document.getElementById("loginPassword");

        if (username.value === "" || username === null) {
            alert('Please enter username.');
        }
        if (password.value === "" || password === null) {
            alert('Please enter password.');
        }
    }

    function validateRegisterForm() {
        var username = document.getElementById("registerUsername");
        var password = document.getElementById("registerPassword");
        var confirm_pass = document.getElementById("registerConfirmPassword");

        if (username.value === "" || username === null) {
            alert('Please fill in user name.');
        }
        if (password.value === "" || password === null) {
            alert('Please fill in password.');
        }
        if (password.value.length < 6) {
            alert('Password should be at least 6 characters.')
        }
        if (confirm_pass.value === "" || confirm_pass === null) {
            alert('Please fill in confirm password.');
        }
        if (password.value !== confirm_pass.value) {
            alert('Passwords should match');
        }
    }

    function validateResetForm() {
        var new_pass = document.getElementById("newPass");
        var confirm_new_pass = document.getElementById("confirmNewPass");

        if (new_pass.value.length < 6) {
            alert('Password should be at least 6 characters.')
        }
        if (new_pass.value !== confirm_new_pass.value) {
            alert('Passwords should match');
        }
        if (new_pass.value === "" || confirm_new_pass === null) {
            alert('Please fill in confirm password.');
        }
    }

    CKEDITOR.replace('editor');

    $("#my_posts").click(function(){
        $.get("posts/my_posts",function(data){
            $('#posts_container').html(data);
        })
    })


    $("#all_posts").click(function(){
        $.get("posts/all_posts",function(data){
            $('#posts_container').html(data);
        })
    })


});
