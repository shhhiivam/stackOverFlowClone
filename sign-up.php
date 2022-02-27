<?php 

$flag="false";
include_once('db.php');
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}


if(isset($_POST['registerBtn'])){
	$query="INSERT INTO `user`(`name`, `email`, `phone_number`, `password`) VALUES ('".$_POST['name']."','".$_POST['email']."','".$_POST['phoneNumber']."','".$_POST['password']."')";
		//echo $query;
	if (mysqli_query($conn,$query)) {
		  $flag="success";

	}
	else {
  		$flag="true";
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
	</div>
	<div class="w3-card-4 w3-third  signup-form" style="margin-left: 33%;margin-top: 5%;">
		<?php 
		if($flag=="success"){?>
		<div class="w3-panel w3-pale-green w3-leftbar w3-border-green">
			  <p>Please Login <a href="index.php">login</a></p>
		</div><?php }?>

		<?php 
		if($flag=="true"){?>
		<div class="w3-panel w3-pale-red w3-leftbar w3-border-red">
			  <p>Something went wrong. Please try again later</p>
		</div><?php }?>


		<header class="w3-container w3-light-grey">
  			<h3 class="w3-center">Join A Helpful Community</h3>
		</header>
		<div class="w3-container">
			<form class="w3-form" action="" method="POST">
				<p><label>Full Name</label><input class="w3-input" type="text" name="name"></p>
				<p><label>Email</label><input class="w3-input" type="email" name="email"></p>
				<p><label>Mobile #</label><input class="w3-input" type="text" name="phoneNumber"></p>
				<p><label>Password </label><input class="w3-input" type="password" name="password"></p>
				<p><label>Confirm Password </label><input class="w3-input" type="password" name="confirm password"></p>
				<a  href="index.php" class="w3-button w3-dark-grey w3-margin-bottom w3-left"> <i class="fa fa-home"></i> Home</a>
				<button type="submit" name="registerBtn" class="w3-button w3-dark-grey w3-right w3-margin-bottom "> <i class="fa fa-sign-in"></i> Sign In</button>
			</form>
		</div>
	</div>



	<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="w3-display-bottommiddle"> 
  		<path fill="#273036" fill-opacity="1" d="M0,192L48,202.7C96,213,192,235,288,224C384,213,480,171,576,181.3C672,192,768,256,864,282.7C960,309,1056,299,1152,282.7C1248,267,1344,245,1392,234.7L1440,224L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
	</svg>
</body>
</html>