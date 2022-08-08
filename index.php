<?php
	session_start();
?>
<!DOCTYPE html>
<head>
	<title>Login</title>
	<script src = "js/jquery-3.5.1.min.js"></script>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="fontawesome-free-5.15.1-web/css/all.css">
	<link rel = "stylesheet" type = "text/css" href = "css/bootstrap.css" />
</head>
<body>
<div class="container">
	<div class="wave">
		<img src="wave1.png">
	</div>
	<div class="img">
		<img src="desk.svg" style="width: 470px;">
	</div>
	<div class="form-wrap">
	<form action="login.php" method="post">
		<img class="psu" src="logo.png">
		<h2>welcome</h2>
		<?php if (isset($_SESSION['status']) && $_SESSION['status'] != '') { ?>
			<p class="error"><?php echo $_SESSION['status']; ?></p>
		<?php unset($_SESSION['status']); } ?>
		<div class="register">
			<i class="fa fa-user icon"></i>
			<input type="text" name="username" placeholder="Username">
			<i class="fa fa-lock icon"></i>
			<input id="password" type="password" name="password"  placeholder="Password">
			<i class="fa fa-eye" id="eye"></i>
			<input type="submit" name="submit" value="LogIn">
		</div>
	</form>
	</div>
</div>
<nav class="topbar">
	<div class="header">
		<h4>PSU<span class="topText">ACC</span></h4>
	</div>
</nav>
<script type = "text/javascript">
	$(document).ready(function(){
		const password = $('#password');
		$('#eye').click(function(){
			$(this).toggleClass('fa-eye-slash');
			if(password.prop('type') == 'password'){
				password.attr('type' , 'text');
			}
			else{
				password.attr('type' , 'password');
			}
		})
	});
</script>
</body>
</html>