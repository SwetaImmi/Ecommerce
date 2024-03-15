<!DOCTYPE html>
<!-- Created By CodingLab - www.codinglabweb.com -->
<html lang="en" dir="ltr">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
	<link rel="stylesheet" type="text/css" href="assets1/css/style.css">
</head>

<body>
	<div class="container">
		<div class="wrapper">
			<div class="title"><span>Sign Up Form</span></div>
			<form action="signin/post" method="post" enctype="multipart/form-data">
				@csrf
				<!-- alert -->
				<div class="alert print-error-msg " style="display:none " role="alert">
					<span style="color: red;">
						<strong>Error!</strong> Please Fill the valid information...
					</span>
				</div>
				<!-- alert -->
				<div class="row">
					<i class="fas fa-user"></i>
					<input type="text" name="name" id="name" placeholder="Name" autocomplete="off">
				
				</div>
				<span>
						@error('name')
						<span class="text-danger">{{$message}}</span>
						@enderror
					</span>
				<div class="row">
					<i class="fas fa-envelope"></i>
					<!-- <i class="fa-solid fa-envelope"></i> -->
					<input type="text" name="email" id="email" placeholder="Email or Phone" autocomplete="OFF">

				</div>
				<span>
					@error('email')
					<span class="text-danger">{{$message}}</span>
					@enderror
				</span>
				<div class="row">
					<i class="fas fa-lock"></i>
					<input type="text" id="password" name="password" placeholder="Password">

				</div>
				<span>
					@error('password')
					<span class="text-danger">{{$message}}</span>
					@enderror
				</span>
				<div class="row">
					<i class="fas fa-lock"></i>
					<input type="text" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password">

				</div>
				<span>
					@error('confirmPassword')
					<span class="text-danger">{{$message}}</span>
					@enderror
				</span>
				<!-- <div class="pass"><a href="#">Forgot password?</a></div> -->
				<div class="row button">
					<input type="submit" value="Login" id="submit" onClick="validate()">
				</div>
				<div class="signup-link">Member Now? <a href="login">Already Signup </a></div>
			</form>
		</div>
	</div>
	<span id="error"></span>

</body>
<!-- <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>

<script>
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	// function validate() {
	// 	var email = $("#email").val();
	// 	alert();

	// 	var regex = new RegExp('^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})|(^[0-9]{10})+$');

	// 	if (email) {
	// 		alert(email);
	// 		if (!regex.test(email)) {
	// 			$("#error").text("Please enter valid email address or phone number.")
	// 		} else {
	// 			$("#error").text('')
	// 		}
	// 	} else {
	// 		$("#error").text('This field is required.')
	// 	}



	// }


	$('#submit').click('submit', function(e) {
		e.preventDefault();

		var name = $("#name").val();
		var email = $('#email').val();
		var password = $('#password').val();
		var confirmPassword = $('#confirmPassword').val();
		// alert(password);
		// alert(confirmPassword, name, );
		$.ajax({
			type: "POST",
			url: 'signUp_create',
			data: {
				name: name,
				email: email,
				password: password,
				confirmPassword: confirmPassword,

			},

			success: function(data) {
				if ($.isEmptyObject(data.error)) {
					alert(data.success);
					location.reload();
				} else {
					printErrorMsg(data.error);
				}
			},



		});
	});

	function printErrorMsg(msg) {
		$(".print-error-msg").find("input").html('');
		$(".print-error-msg").css('display', 'block');
		$.each(msg, function(key, value) {
			$('print-error-msg').find("input").append('<span>' + value + '</span');
			// $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
			// $(".print-error-msg").find("email").append('<li>'+value.name+'</li>');
		});
	}
</script> -->

</html>