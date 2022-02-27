<?php
session_start();
include_once('db.php');
if(isset($_SESSION['id'])){

 		  $email=$_SESSION['email'];
		  $id=$_SESSION['id'];
		  $name=$_SESSION['name'];
		  $phoneNo=$_SESSION['phone_name'];
}
else{
	header('location:index.php?login=false');

}


if(isset($_POST['signout'])){
	session_destroy();
	header('location:index.php');
}

if(isset($_POST['profileBtn'])){
	$query="UPDATE `user` SET `name`='".$_POST['name']."',`email`='".$_POST['email']."',`phone_number`='".$_POST['phoneNumber']."' WHERE `user_id`=".$id;
	
	$run=mysqli_query($conn,$query);

	if (isset($run)) {
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
	<?php include_once('head.php') ?>
</head>
<body>
	<!-- Top Header -->
		<?php include_once('other-page-top-bar.php') ?>
	<!-- Top Header -->


	<!-- Main Section -->
	<div id="main-container">
		<!-- Side Bar Section -->
				<?php include_once('sidebar.php') ?>
		<!-- Side Bar Section -->

		<!-- Post and comment Section Row -->
		<div class="w3-third w3-row-container" style="margin-left:30%;margin-top:10%">
				

				<!-- profile Row  -->
				<div class="w3-row-container">
				<!-- profile -->
				<?php 
				
						$sql="SELECT * FROM `user` WHERE `user_id`=".$id;
						
						$run=mysqli_query($conn,$sql);
						$row = mysqli_fetch_row($run);
						
				?>

					<div class="w3-card-4 ">
						<header class="w3-container w3-light-grey">
  							<h3 class="w3-center">Profile</h3>
						</header>
						<div class="w3-container">
						<img src="images/avtar.png" alt="Avatar" class="w3-center w3-circle w3" style="width:35%;margin-left: 33%;margin-top:2%;">
  
						<form method="POST" action="">
							<p>
								<label>Name</label><input type="text" name="name"  class="w3-input w3-border" value="<?php echo $row[1];?>">
							</p>
							<p>
								<label>Email</label><input type="text" name="email" class="w3-input w3-border"  value="<?php echo $row[2];?>">
							</p>
							<p>
								<label>Mobile</label><input type="text" name="phoneNumber"  class="w3-input w3-border" value="<?php echo $row[3];?>">
							</p>
								
							<p>
								<button type="submit" name="profileBtn" class="w3-right w3-button w3-grey w3-margin-bottom"> Update </button>
							</p>
							
						</form>
						</div>
					</div>

					
				<?php 

					
				?>
				<!-- profile -->

				

			

				</div>
				<!-- profile Row-->


		</div>
		<!-- Post and comment Section Row -->

	</div>
	<!-- Main Section -->


</body>
</html>