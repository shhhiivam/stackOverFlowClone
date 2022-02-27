<?php
session_start();
include_once('db.php');
$_SESSION['flag']='null';
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

if(isset($_POST['updateBtn'])){
	
	
	$answer=$_POST['answer'];
	$sql="UPDATE `post_comments` SET `comment`='".$answer."',`status`='P' WHERE `comment_id`=".$_GET['answer_id'];
	//echo $sql;
	
	$run=mysqli_query($conn,$sql);
	if(isset($run)){
		$_SESSION['flag']='success';
		

	}
	else{
		$_SESSION['flag']='fail';
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
		<div class="w3-twothird w3-row-container" style="margin-left:16%;margin-top:6%">
					
				<?php 
				if($_SESSION['flag']=="success"){?>
				<div class="w3-panel w3-pale-green w3-leftbar w3-border-green">
				  <p>Your Questin has been updated</p>
				</div><?php }?>
				<?php 
			if($_SESSION['flag']=="fail"){?>
			<div class="w3-panel w3-pale-red w3-leftbar w3-border-red">
				  <p>Login Failed.. Please Check Email/Password</p>
			</div><?php }?>

				<!-- Question Row  -->
				<div class="w3-row-container">
				<!-- Question -->
				<?php 
				if(isset($_SESSION['id'])){
						$sql="SELECT * FROM `post_comments` WHERE `comment_id`=".$_GET['answer_id'];
						$run=mysqli_query($conn,$sql);
						$row = mysqli_fetch_row($run)
						
				?>
					<div class="w3-panel w3-border w3-light-grey w3-round-large">
						<form method="POST" action="">
						
						<label>Answer</label>
						<textarea  name="answer" class="w3-input w3-border w3-border-dark-grey"><?php echo $row[3];?> </textarea> 
						<div class="w3-bar">
							<span class="w3-dark-grey  w3-bar-item w3-margin-bottom"><i class="fa fa-caret-up"></i> <?php echo $row[4];?></span>
							<span class="w3-bar-item w3-dark-grey w3-margin-left"><i class="fa fa-caret-down"></i> <?php echo $row[5];?></span>


							<button type="submit" name="updateBtn" class="w3-bar-item w3-button w3-grey w3-right w3-margin-top w3-margin-bottom w3-text-dark-grey">Update Question <i class="fa fa-pencil"></i></button>

						</div>
					</form>
					</div>
				<?php 
					}
				?>
				<!-- Question -->

				
				

				

				</div>
				<!-- Question Row-->


		</div>
		<!-- Post and comment Section Row -->

	</div>
	<!-- Main Section -->


</body>
</html>