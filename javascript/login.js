$( document ).ready(function() {
	$('#signup_button').click(function(){
		$("#loginForm").hide();
		$("#signupForm").show();
	});

	$('#loginLink').click(function(){
		$("#loginForm").show();
		$("#signupForm").hide();
	});
});
