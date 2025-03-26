<?php 
error_reporting(E_ERROR | E_PARSE);

if(!isset($conn))
	require_once('../config.php');

if(isset($_SESSION['user']) && !empty($_SESSION['user'])){
  header("location: index.php");
  exit;
}

if (isset($_POST['username']) && isset($_POST['password'])){
	$username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
	$password = $_POST["password"];

	$_username = LOGIN_USER;
	$_password = LOGIN_PASS;

	if($username === $_username){
		if($password === $_password){
			$_SESSION['user'] = $username;
			header('Location: index.php');
		}
		else
			$error = 'Login incorrect!';
	}
	else
		$error = 'Login incorrect!';
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="robots" content="noindex,nofollow">
	<meta charset="UTF-8">
	<title>Login Page</title>
	<link rel="stylesheet" href="css/login_style.css">
	<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript">
		 $("#login-button").click(function(event){
			event.preventDefault();
			 
			 $('form').fadeOut(500);
			 $('.wrapper').addClass('form-success');
		});
	</script>
</head>
<body>
	<div class="wrapper">
		<div class="container">
			<h1>Login</h1>
			<?php if(isset($error) && $error!=''): ?>
			<div class="alert"><?php echo $error ?></div>
			<?php endif; ?>

			<form class="form" method="post" action="" autocomplete="off">
				<input type="text" placeholder="Username" name="username" />
				<input type="password" placeholder="Password" name="password" />
				<button type="submit" id="login-button" class="hvr-bounce-to-right">Login</button>
			</form>
		</div>
		
		<ul class="bg-bubbles">
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
		</ul>
	</div>
	
</body>
</html>