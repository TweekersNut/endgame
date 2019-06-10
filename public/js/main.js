/* =================================
------------------------------------
	EndGam - Gaming Magazine Template
	Version: 1.0
 ------------------------------------
 ====================================*/


'use strict';


$(window).on('load', function() {
	/*------------------
		Preloder
	--------------------*/
	$(".loader").fadeOut();
	$("#preloder").delay(400).fadeOut("slow");

});

(function($) {
	/*------------------
		Navigation
	--------------------*/
	$('.primary-menu').slicknav({
		appendTo:'.header-warp',
		closedSymbol: '<i class="fa fa-angle-down"></i>',
		openedSymbol: '<i class="fa fa-angle-up"></i>'
	});


	/*------------------
		Background Set
	--------------------*/
	$('.set-bg').each(function() {
		var bg = $(this).data('setbg');
		$(this).css('background-image', 'url(' + bg + ')');
	});



	/*------------------
		Hero Slider
	--------------------*/
	$('.hero-slider').owlCarousel({
		loop: true,
		nav: true,
		dots: true,
		navText: ['', '<img src="img/icons/solid-right-arrow.png">'],
		mouseDrag: false,
		animateOut: 'fadeOut',
		animateIn: 'fadeIn',
		items: 1,
		//autoplay: true,
		autoplayTimeout: 10000,
	});

	var dot = $('.hero-slider .owl-dot');
	dot.each(function() {
		var index = $(this).index() + 1;
		if(index < 10){
			$(this).html('0').append(index + '.');
		}else{
			$(this).html(index + '.');
		}
	});



	/*------------------
		Video Popup
	--------------------*/
	$('.video-popup').magnificPopup({
  		type: 'iframe'
	});

	$('#stickySidebar').stickySidebar({
	    topSpacing: 60,
	    bottomSpacing: 60
	});


})(jQuery);
function addAlert(id, message, type) {
    $('#' + id).append(
            '<div class="alert alert-' + type + ' ">' +
            '<button type="button" class="close" data-dismiss="alert">' +
            '&times;</button>' + message + '</div>');
}

/*------------------
 Ajax Functions
 --------------------*/
//var URL_ROOT = 'https://tweekersnut-tutorial.ml/';
//News Letter Form Handler
$("#newsletter_form").submit(function (e) {
    e.preventDefault();
    var email = $("#newsletter_form input[name='email']").val();
    $.ajax({
        type: "POST",
        url: URL_ROOT + "newsletter/subscribe",
        data: {action: "ajax_subscribeNewsletter", email: email},
        success: function (resp) {
            console.log(resp);
            var data = JSON.parse(resp);
            if (data.status != 0) {
                addAlert("newsletter_form_resp", data.msg, "success");
                $("input[name='email']").val('');
            } else {
                addAlert("newsletter_form_resp", data.msg, "danger");
                $("input[name='email']").val('');
            }
        }
        ,
        error: function (err) {
            console.log(err);
            alert("Critical Error Contact Developer");
        }
        ,
        complete: function () {
            console.log("Task Complete");
        }
    });
});


//Contact Us form handler
$("#contact_form").submit(function (e) {
    e.preventDefault();
    var name = $("input[name='name']").val();
    var email = $("input[name='email']").val();
    var subject = $("input[name='subject']").val();
    var message = $("textarea[name='message']").val();

    $.ajax({
        type: "POST",
        url: URL_ROOT + "contact/submit",
        data: {action: "ajax_submitQuery", name: name, email: email, subject: subject, message: message},
        success: function (resp) {
            console.log(resp);
            var data = JSON.parse(resp);
            if (data.status != 0) {
                addAlert("contact_form_resp", data.msg, "success");
                $("input[name='name']").val('');
                $("input[name='email']").val('');
                $("input[name='subject']").val('');
                $("textarea[name='message']").val('');
            } else {
                (data.msg.forEach(element => {
                    addAlert("contact_form_resp", element, "danger");
                }));
            }
        }
        ,
        error: function (err) {
            alert("Critical Error Contact Developer");
        }
        ,
        complete: function () {
            console.log("Task Complete");
        }
    });
});

$("#login_form").submit(function (e) {
    e.preventDefault();

    var email = $("input[name='email']").val();
    var password = $("input[name='password']").val();

    $.ajax({
        type: "POST",
        url: URL_ROOT + "users/auth",
        data: {action: "ajax_processLogin", email: email, password: password},
        success: function (resp) {
            console.log(resp);
            var data = JSON.parse(resp);
            if (data.status != 0) {
                addAlert("login_form_resp", data.msg, "success");
                $("input[name='email']").val('');
                $("input[name='password']").val('');
                setTimeout(window.location.reload(true), 2000);
            } else {
                (data.msg.forEach(element => {
                    addAlert("login_form_resp", element, "danger");
                }));
            }
        }
        ,
        error: function (err) {
            alert("Critical Error Contact Developer");
        }
        ,
        complete: function () {
            console.log("Task Complete");
        }
    });
});

//forgot Password

$("#forgot_password").submit(function (e) {
    e.preventDefault();

    var email = $("#forgot_password input[name='email']").val();

    $.ajax({
        type: "POST",
        url: URL_ROOT + "users/forgotPassword",
        data: {action: "ajax_processForgotPassword", email: email},
        success: function (resp) {
            console.log(resp);
            var data = JSON.parse(resp);
            if (data.status != 0) {
                addAlert("forgot_password_resp", data.msg, "success");
                $("input[name='email']").val('');
            } else {
                (data.msg.forEach(element => {
                    addAlert("forgot_password_resp", element, "danger");
                }));
            }
        }
        ,
        error: function (err) {
            alert("Critical Error Contact Developer");
        }
        ,
        complete: function () {
            console.log("Task Complete");
        }
    });
});

$("#setup_new_password").submit(function(e){
    e.preventDefault()
    
    var password = $("input[name='password']").val();
    var confirm = $("input[name='confirm_password']").val();
    var key = $("input[name='acc_key']").val();
    
    $.ajax({
        type: "POST",
        url: URL_ROOT + "users/setnewPassword",
        data: {action: "ajax_processSetupNewPassword", password: password, confirm:confirm,key:key},
        success: function (resp) {
            console.log(resp);
            var data = JSON.parse(resp);
            if (data.status != 0) {
                addAlert("setup_new_password_resp", data.msg, "success");
            } else {
                (data.msg.forEach(element => {
                    addAlert("setup_new_password_resp", element, "danger");
                }));
            }
        }
        ,
        error: function (err) {
            alert("Critical Error Contact Developer");
        }
        ,
        complete: function () {
            console.log("Task Complete");
        }
    });
});