jQuery(function($){
	$('#fname_check').hide();
	$('#lname_check').hide();
	$('#username_check').hide();
	$('#age_check').hide();
	$('#email_check').hide();
	$('#c_email_check').hide();
	$('#pass_check').hide();
	$('#c_pass_check').hide();
	$('#recap_err').hide();

	var fname_err = false;
	var lname_err = false;
	var username_err = false;
	var age_err = false;
	var email_err = false;
	var c_email_err = false;
	var pass_err = false;
	var c_pass_err = false;

	$('#fname').keyup( function(){
		fname_check();
	});

	function fname_check(){
		var fname = $('#fname').val();
		var alphabet_regex = new RegExp(/^[A-z]+$/);
		if(fname == ''){
			$('#fname_check').html("Please fill the username").css("color", "red").show();
			fname_err = true;
			return false;
		}else{
			$('#fname_check').hide();
		}
		if(! alphabet_regex.test(fname)){
			$('#fname_check').html("First name cannot contain numbers.").css("color", "red").show();
			fname_err = true;
			return false;
		}else{
			$('#fname_check').hide();
		}
		if((fname.length < 5) ){
			$('#fname_check').html("Name must be at least 5 characters").css("color", "red").show();
			fname_err = true;
			return false;
		}else{
			$('#fname_check').hide();
		}
	}

	$('#lname').keyup(function(){
		lname_check();
	});	

	function lname_check(){
		var lname = $('#lname').val();
		var alphabet_regex = new RegExp(/^[A-z]+$/);
		if(lname.length == ''){
			$('#lname_check').html("Last Name cannot be empty ").css("color", "red").show();
			lname_err = true;
			return false;
		}else{
			$('#lname_check').hide();
		}

		if(! alphabet_regex.test(lname)){
			$('#lname_check').html("Last name cannot contain numbers. ").css("color", "red").show();
			lname_err = true;
			return false;
		}else{
			$('#lname_check').hide();
		}

		if(lname.length < 3 ){
			$('#lname_check').html("Last Name must be more than 3 characters").css("color", "red").show();
			lname_err = true;
			return false;
		}else{
			$('#lname_check').hide();
		}
	}


	//username validation
	$('#username').keyup( function(){
		username_check();
	});

	function username_check(){
		var username = $('#username').val(),
		 alphabet_regex = new RegExp(/^[A-z]+$/);
		if(username == ''){
			$('#username_check').html("Please fill the username").css("color", "red").show();
			username_err = true;
			return false;
		}else{
			$('#username_check').hide();
		}
		if(! alphabet_regex.test(username)){
			$('#username_check').html("Username name cannot contain numbers.").css("color", "red").show();
			username_err = true;
			return false;
		}else{
			$('#username_check').hide();
		}
		if((username.length < 5) ){
			$('#username_check').html("Name must be at least 5 characters").css("color", "red").show();
			username_err = true;
			return false;
		}else{
			$('#username_check').hide();
		}
	}

	$('#username').blur(function(){
		username_exists();
	});
	function username_exists(){
		var username = $('#username').val();
		
		jQuery.ajax({  
    			type: 'POST',  
    			url: myAjax.ajax_url,
    			data: {action:'username_validation', username:username },
		
		success: function(response){
			if(response.username_exists == 'username exists'){
				$('#username_check').html('username already exists').css("color", "red").show();
				username_err = true;
				return false;
			}
			else{
				$('#Username_check').hide();
				username_err = false;
				return true;
			//$('#Username_check').show();
		}
		},
		error: function(response){
			console.log('username not exists');
		} 
		});
	}

	//Age validation
	$('#age').keyup(function(){
		age_check();
	});
	function age_check(){
		var age = $('#age').val();
		var ageRegex = new RegExp(/^\d+$/ );
		if(age == ''){
			$('#age_check').html("Age can't be empty. ").css("color","red").show();
			age_err = true;
			return false;
		}else{
			$('#age_check').hide();
		}

		if (isNaN(age)) {
			$('#age_check').html("Age must be number. ").css("color","red").show();
			age_err = true;
			return false;
		}else{
			$('#age_check').hide();
		}

		if((age <= 18 ) || (age >= 60)){
			$('#age_check').html("Age must be in between 18 and 60 ").css("color","red").show();
			age_err = true;
			return false;
		}else{
			$('#age_check').hide();
		}
	}

	//email validation
	$('#email').keyup(function(){
		email_check();
	});
	function email_check(){
		var email = $('#email').val();
		var emailRegex = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i); 
		if(email == ''){
			$('#email_check').html("Please enter your Email").css("color", "red").show();
			email_err = true;
			return false;
		}else{
			$('#email_check').hide();
		}

		if(! emailRegex.test(email)){
			$('#email_check').html("Your email is incorrect").css("color", "red").show();
			email_err = true;
			return false;
		}else{
			$('#email_check').hide();
		}

		
	}
	$('#email').blur(function(){
		email_exists();
	});
	function email_exists(){
		var email = $('#email').val();
		
		jQuery.ajax({  
    			type: 'POST',  
    			url: myAjax.ajax_url,
    			data: {action: 'email_validation', email:email },
		
		success: function(response){
			if(response.email_exists == 'email not exists'){
				$('#email_check').hide();
				email_err = false;
				return true;
			}
			else{
				$('#email_check').html("Email already exists").css("color", "red").show();
				email_err = true;
				return false;
				$('#email_check').hide();
		}
		},
		error: function(response){
			console.log('email not exists');
		} 
		});
	}

	//confirm email validation
	$('#c_email').keyup(function(){
		confirm_email();
	});
	function confirm_email(){
		var email = $('#email').val();
		var confirm_email = $('#c_email').val();

		if(email !== confirm_email){
			$('#c_email_check').html("email not matching").css("color", "red").show();
			c_email_err = true;
			return false;
		}else{
			$('#c_email_check').hide();
		}

		if(confirm_email == ''){
			$('#c_email_check').html("Re-Enter your Email").css("color", "red").show();
			c_email_err = true;
			return false;
		}else{
			$('#c_email_check').hide();
		}
	}

	//password validation
	$('#pass').keyup(function(){
		password_check();
	});
	function password_check(){
		var password = $('#pass').val();
		var passRegex = new RegExp(/^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9]+)$/);
		if(password.length == ''){
			$('#pass_check').html("Please enter the password").css("color", "red").show();
			pass_err = true;
			return false;
		}else{
			$('#pass_check').hide();
		}

		if(! passRegex.test(password)){
			$('#pass_check').html("Password must contain at least one character and one number ").css("color", "red").show();
			pass_err = true;
			return false;
		}else{
			$('#pass_check').hide();
		}

	}

	//confirm password
	$('#c_pass').keyup(function(){
		confirm_password();
	});
	function confirm_password(){
		var password = $('#pass').val();
		var confirm_password = $('#c_pass').val();
		if(confirm_password == ''){
			$('#c_pass_check').html("Re-Enter your Password to confirm").css("color", "red").show();
			c_pass_err = true;
			return false;
		}else{
			$('#c_pass_check').hide();
		}

		if(password !== confirm_password){
			$('#c_pass_check').html("Password not matching").css("color", "red").show();
			c_pass_err = true;
			return false;
		}else{
			$('#c_pass_check').hide();
		}
	}

	$('#pass, #c_pass').bind("cut copy paste", function(e){
		e.preventDefault();
		alert('Please retype  your password');
		/*$('#c_pass_check').show();
		$('#c_pass_check').html("Dont copy and paste.");
		$('#c_pass_check').css("color", "red");
		c_pass_err = true;
		return false;*/
		
	});

	$('#sample_form').submit(function(e){
		e.preventDefault();
		fname_err = false;
		lname_err = false;
		username_err = false;
		age_err = false;
		email_err = false;
		c_email_err = false;
		pass_err = false;
		c_pass_err = false;
		re_cap_err = false;

		 fname_check();
		 lname_check();
		 username_check();
		 username_exists();
		 age_check();
		 email_check();
		 email_exists();
		 confirm_email();
		 password_check();
		 confirm_password();

		 if (grecaptcha.getResponse() == ""){
		 	re_cap_err = true;
		 	$('#recap_err').html('please confirm that you are not a robot').css('color', 'red').show();
		 	return false;
		 } else{
		 	$('#recap_err').hide();
		 }

		 if((fname_err === false) && (pass_err ===false) && (c_pass_err === false) && (lname_err === false) && (age_err === false) && (email_err === false)
		 && (c_email_err === false) && username_err === false && re_cap_err === false){
		 	 var fname = $('#fname').val(),
		 		lname = $('#lname').val(),
		 		username = $('#username').val(),
		 		age = $('#age').val(),
		 		email = $('#email').val(),
		 		password = $('#pass').val();
		 jQuery.ajax({  
    			type: 'POST',  
    			url: myAjax.ajax_url,
    			data: {action: 'form_validation',fname:fname, lname:lname, email:email, age:age, pass:password, username:username}, 
    		success: function(response){
    			// console.log(response.content);
    			jQuery('.message').html(response.content).css("color","red").show();
    			//alert('form submitted successfully');
			},  
    		error: function(MLHttpRequest, textStatus, errorThrown){
    			jQuery('.message').html(errorThrown.content).show();
			}  
		 	});
		 	return true;
		 }else{
		 	return false;
		 }
	});
});