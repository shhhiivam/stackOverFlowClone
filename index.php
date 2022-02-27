<?php
$flag=false;
session_start();
include_once('db.php');
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
if(isset($_POST['loginBtn'])){
	$query="SELECT * FROM `user` WHERE email='".$_POST['email']."' and password='".$_POST['password']."'";
	
	$run=mysqli_query($conn,$query);
	$row = mysqli_fetch_row($run);
	echo $query;
	if (isset($row)) {
		 
		 
		  $_SESSION['email']=$row[2];
		   $_SESSION['id']=$row[0];
		  $_SESSION['name']=$row[1];
		  $_SESSION['phone_name']=$row[3];
		  header('location:home.php');

	}
	else {
  		$flag=true;
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Stack Over Flow</title>
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
	<div class="w3-bar w3-center w3-margin-top">
		<img class="w3-bar-item" src="svg/stackoverflow-color.svg" style="width:8%;margin-left: 30%;" >
		<h1 class="logo w3-bar-item">Stack <b class="w3-text-orange">Over </b>Flow Clone</h1>
		<a href="sign-up.php" class="w3-bar-item w3-right w3-button w3-margin-top w3-margin-right"><i class="fa fa-sign-in "></i> Register <i class="w3-text-orange"><b>Here</b></i></a>
	</div>
	<div class="w3-card-4 w3-third  w3-display-middle" >
			<?php 
			if($flag==true){?>
			<div class="w3-panel w3-pale-red w3-leftbar w3-border-red">
				  <p>Login Failed.. Please Check Email/Password</p>
			</div><?php }?>
		

		<header class="w3-container w3-light-grey">
  			<h3 class="w3-center">Login Here</h3>
		</header>
		<div class="w3-container">
		<form class="w3-form" action="" method="post">
			<p>
			<label>Email</label><input class="w3-input" type="email" name="email"></p>
			<p>
			<label>Password</label><input class="w3-input" type="password" name="password"></p>
			<p>
			<button type="submit" name="loginBtn" value="Login" class="w3-button w3-dark-grey w3-margin-bottom w3-left"> <i class="fa fa-sign-in"></i> Sign In</button>
			<a href="forget-password.php" class="w3-right">Forgot Password</a> </p>
		</form>
		</div>
	</div>
	<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="w3-display-bottommiddle"> 
  		<path fill="#273036" fill-opacity="1" d="M0,192L48,202.7C96,213,192,235,288,224C384,213,480,171,576,181.3C672,192,768,256,864,282.7C960,309,1056,299,1152,282.7C1248,267,1344,245,1392,234.7L1440,224L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
	</svg>
</body>
</html>