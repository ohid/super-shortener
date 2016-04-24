$(document).ready(function() {
	$('#url').focus();

	// URL SHORTEN AJAX
	$('.shortbtn').on('click', function(e) {
		e.preventDefault();

		var url = $('#url').val(),
			formData = $('.shorten_form').serialize(),
			route = $('.shorten_form').attr('action'),
			url_status = $('.url_status'),
			url_img = $('.urlScreenshot'),
			time = $('.time'),
			shorted_url_stats = $('.shorted_url_stats'),
			shorten_url_info_wrap = $('.shorten_url_info_wrap'),
			url_go_detail = $('.url_go_detail'),
			main_total_links = $('.total_links'),
			shr_fb = $('.shr_fb'),
			shr_tw = $('.shr_tw'),
			shr_gp = $('.shr_gp'),
			shr_lnk = $('.shr_lnk'),
			shr_pin = $('.shr_pin'),
			qr_div = $('.qrcode');

		function checkUrl(url)
		{
		    //regular expression for URL
		    var pattern = /^(http|https)?:\/\/[a-zA-Z0-9-\.]+\.[a-z]{2,4}/;
		 
		    if(pattern.test(url)){
		        return true;
		    } else {
		        return false;
		    }
		}

		var checkURL = checkUrl(url);

		if(checkURL == true)
		{
			$.ajax({
				url : route,
				type : "POST",
				data : formData,
				dataType : "json",
	    		cache: false,
				beforeSend : function() {
					$('.shorten_url_wrapper').show();
					url_status.slideDown().html('<img src="assets/img/loader.gif" alt="preccessing"/> &nbsp; request processing...');
					shorten_url_info_wrap.slideUp();
					$('#copyButton').removeClass('clicked');
					$('#copyButton').html('click to copy');
				},
				success: function(data) {
					if(data.error == 'error_occured') {
						url_status.html('An error occured, please try again');
					} else {
						$('form')[0].reset();
						url_status.hide();

						shorten_url_info_wrap.slideDown();
						time.html('Just now');
						url_img.html('<a href="/' + data.url.short_url+'" target="_blank"><img src="https://api.thumbnail.ws/api/ab2275bc5735a9c983943cf2847ae4968f7d69a11b18/thumbnail/get?url='+data.url.url+'%2F&width=505" class="url_image img-responsive" alt="screenshot" /></a>');
						$('.shorted_url').attr('value', data.hostUrl + '/' + data.url.short_url );
						$('.shorted_url_stats').attr('href', '/statistics/' + data.url.short_url);

						// social share links
						shr_fb.attr('href', 'https://www.facebook.com/sharer/sharer.php?u=http://url.dev/' + data.url.short_url );
						shr_tw.attr('href', 'https://twitter.com/home?status=http://url.dev/' + data.url.short_url );
						shr_gp.attr('href', 'https://plus.google.com/share?url=http://url.dev/' + data.url.short_url );
						shr_lnk.attr('href', 'https://www.linkedin.com/shareArticle?mini=true&url=http://url.dev/' + data.url.short_url );
						shr_pin.attr('href', 'https://pinterest.com/pin/create%2Fbutton/?url=http://url.dev/' + data.url.short_url );

						$('<tr id="short_url_'+data.url.short_url+'">'
							+'<td style="padding-left:20px;"><a href="'+data.url.url+'" target="_blank">'+data.urlText+'</a></td>'
							+'<td><a href="'+data.url.short_url+'" target="_blank">'+data.url.short_url+'</a></td>'
							+'<td class="mb-hidden">Just now</td>'
							+'<td><a href="/statistics/'+data.url.short_url+'">Stats</a></td>'
							+'<td>0</td>'
							+'<td class="mb-hidden"><button type="button" value="'+data.url.short_url+'" class="remove_link"><i class="fa fa-times" title="remove"></i></button></td>'
							+'</tr>'
						).prependTo('#tbody');

						// Increment total links value on submit
						var total_links = main_total_links.html();
						total_links++;
						main_total_links.html(total_links);

						// Remove the no url row if exists;
					    $('#no_url').remove();

					}
				},
				error: function(data) {
					var errors = (data.responseJSON);
					$.each(errors, function(key, value){
						$('.shorten_url_wrapper').show();
						url_status.slideDown().html(value);
						shorten_url_info_wrap.slideUp();
					});
				}
			})	
		} else {
			$('.shorten_url_wrapper').show();
			url_status.slideDown().html('<span class="text-error">Please provide a valid url</span>');
			shorten_url_info_wrap.slideUp();
		}
	});


	// Remove URL 
	$('.remove_link').on('mousedown', function() {
		var $this = $(this);
		var shortUrl = $(this).val();
		var route = $this.closest('form').attr('action');
		var formData = $this.closest('form').serialize();

		if(shortUrl.length < 0) {
			return false;
		}

		if(confirm('Are you sure you want to delete this url')){
			$.ajax({
				type: 'POST',
				url: route,
				data: formData,
				success: function(data) {
					$this.closest("#short_url_"+shortUrl+"").addClass('urlColor').animate({
						backgroundColor: "#ff4c4c",
						color: "#fff"
					}, 'slow', function() {
						$this.closest("#short_url_"+shortUrl+"").remove();
					});
				}
			})
		}
	});




	// Update password
	$('#update_password').on('click', function(e) {
		e.preventDefault();
		var new_password			= $('#new_password').val();
		var new_password_confirm	= $('#new_password_confirm').val();
		var formPassword = $('.form-password');
		var valid = '';

		if(new_password.length <= 7) {
			$('.form-password .help-block').html('<strong class="text-danger">Your password must be at least 8 letters</strong>');
			valid 	= 'invalid';	
		} else if(new_password_confirm.length <= 7) {
			$('.form-password .help-block').html('<strong class="text-danger">Your password must be at least 8 letters</strong>');
			valid 	= 'invalid';		
		} else if(new_password != new_password_confirm) {
			$('.form-password .help-block').html('<strong class="text-danger">Your password not matched.</strong>');
			valid 	= 'invalid';	
		} else {
			$('.form-password .help-block').html('');
			valid 	= 'valid';	
		}


		if(valid == 'valid') {

			var passwordData = $('#profile_update_password').serialize();

			$.ajax({
				type: 'POST',
				url: 'includes/update_profile.php',
				data: passwordData,
				success: function(data) {
					if(data == 'small_password') {
						$('.form-password .help-block').html('<strong class="text-danger">Your password must be at least 8 letters.</strong>');
					} else if(data == 'pass_not_matched') {
						$('.form-password .help-block').html('<strong class="text-danger">Your password not matched.</strong>');
					} else {
						$('.fp2 .help-block').html('<strong class="text-success">Your password updated.</strong>');
					}
				},
				error: function(data) {
					$('.fp2 .help-block').html('<strong class="text-danger">Something went wrong. Please try again later.</strong>');
				}
			});

		}

	});

	// Update email address
	$('#forgetbtn').on('click', function(e) {
		e.preventDefault();
		var forget_password	= $('#forget_password').val();
		var formEmail = $('.form-email');
		var valid = '';

		if(forget_password.length == 0) {
			$('.form-email .help-block').html('<strong class="text-danger">Please type an email address</strong>');
			valid 	= 'invalid';		
		} else if(!forget_password.match(/^([a-z0-9._-]+@[a-z0-9._-]+\.[a-z]{2,4}$)/i)) {
			$('.form-email .help-block').html('<strong class="text-danger">Please type an valid email address</strong>');
			valid 	= 'invalid';			
		} else {			
			$('.form-email .help-block').html('');
			valid 	= 'valid';
		}

		if(valid == 'valid') {

			var forgetFormData = $('#forgetForm').serialize();
			console.log(forgetFormData);

			$.ajax({
				type: 'POST',
				url: 'includes/update_profile.php',
				data: forgetFormData,
				success: function(data) {
					if(data == 'email_sent') {
						$('form')[0].reset();
						$('.form-email .help-block').html('<strong class="text-success">An email has been sent to your email address. Please check it to reset your password.</strong>');
					} else if(data == 'email_not_exist') {
						$('.form-email .help-block').html('<strong class="text-danger">Sorry, Your email number not exists.</strong>');
					}
				},
				error: function(data) {
					$('.form-email .help-block').html('<strong class="text-danger">Something went wrong. Please try again later.</strong>');
				}
			});

		}

	});

	// Get 'get variables'
	function getQueryVariable(variable)
	{
	       var query = window.location.search.substring(1);
	       var vars = query.split("&");
	       for (var i=0;i<vars.length;i++) {
	               var pair = vars[i].split("=");
	               if(pair[0] == variable){return pair[1];}
	       }
	       return(false);
	}
	// Reset password
	$('#resetbtn').on('click', function(e) {
		e.preventDefault();
		var new_pass	= $('#new_pass').val();
		var conf_pass	= $('#conf_pass').val();
		var formPassword = $('.form-password');
		var valid = '';

		if(new_pass.length <= 7) {
			$('.form-password .help-block').html('<strong class="text-danger">Your password must be at least 8 letters</strong>');
			valid 	= 'invalid';	
		} else if(conf_pass.length <= 7) {
			$('.form-password .help-block').html('<strong class="text-danger">Your password must be at least 8 letters</strong>');
			valid 	= 'invalid';		
		} else if(new_pass != conf_pass) {
			$('.form-password .help-block').html('<strong class="text-danger">Your password not matched.</strong>');
			valid 	= 'invalid';	
		} else {
			$('.form-password .help-block').html('');
			valid 	= 'valid';	
		}


		if(valid == 'valid') {

			var name = getQueryVariable('name');
			var token = getQueryVariable('token');

			var resetFormData = { new_pass : new_pass, conf_pass: conf_pass, name: name, token: token } ;
			console.log(resetFormData);

			$.ajax({
				type: 'POST',
				url: 'includes/update_profile.php',
				data: resetFormData,
				success: function(data) {
					if(data == 'small_password') {
						$('.form-password .help-block').html('<strong class="text-danger">Your password must be at least 8 letters.</strong>');
					} else if(data == 'pass_not_matched') {
						$('.form-password .help-block').html('<strong class="text-danger">Your password not matched.</strong>');
					} else if(data == 'user_not_exist') {
						$('.fp2 .help-block').html('<strong class="text-danger">Sorry, we couldn\'t reset your password. Please try again.</strong>');
					} else {
						$('.fp2 .help-block').html('<strong class="text-success">Your password reseted.</strong>');
					}
				},
				error: function(data) {
					$('.fp2 .help-block').html('<strong class="text-danger">Something went wrong. Please try again later.</strong>');
				}
			});

		}

	});

});



