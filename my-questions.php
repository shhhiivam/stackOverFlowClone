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

if(isset($_POST['postBtn'])){
	$sql="INSERT INTO `post_comments`(`post_id`, `user_id`, `comment`) VALUES (".$_GET['post_id'].",".$id.",'".$_POST['comment']."')";
	$run=mysqli_query($conn,$sql);

	if (isset($run)) {
		 
		 header('location:post-preview.php?post_id='.$_GET['post_id']);
		  
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
		<div class="w3-twothird w3-row-container" style="margin-left:16%;margin-top:6%">
				

				<!-- Question Row  -->
				<div class="w3-row-container">
				<!-- Question -->
				<?php 
				if(isset($_SESSION['id'])){
						$sql="SELECT * FROM `post` WHERE `user_id`=".$_SESSION['id'];
						$run=mysqli_query($conn,$sql);
						while($row = mysqli_fetch_row($run))
						{
						
				?>
					<div class="w3-panel w3-border w3-light-grey w3-round-large">
						<h2><?php echo $row[2];?></h2>
						<h5><?php echo $row[3];?></h5>
						<div class="w3-bar">
							<span class="w3-badge w3-dark-grey  w3-bar-item w3-margin-bottom"><i class="fa fa-caret-up"></i> <?php echo $row[4];?></span>
							<span class="w3-bar-item w3-dark-grey  w3-badge w3-margin-left"><i class="fa fa-caret-down"></i> <?php echo $row[5];?></span>
							<a href="edit-post.php?post_id=<?php echo $row[0]; ?>" class="w3-bar-item w3-button w3-grey w3-right w3-margin-top w3-margin-bottom">Edit <i class="fa fa-pencil"></i></a>
						</div>
					</div>
				<?php 
					}
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