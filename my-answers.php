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
						$sql="SELECT * FROM `post_comments` JOIN user on user_id=postie_user_id WHERE postie_user_id=".$_SESSION['id'];
						//echo $sql;
						$run=mysqli_query($conn,$sql);
						while($row = mysqli_fetch_row($run))
						{
						
					
				?>
					<div class="w3-panel w3-border w3-light-grey w3-round-large">
						<h2><?php echo $row[8];?></h2>
						<h5><?php echo $row[3];?></h5>
						<div class="w3-bar">
							<span class="w3-button w3-dark-grey  w3-bar-item w3-margin-bottom"><i class="	fa fa-thumbs-o-up"></i> <?php echo $row[4];?></span>
							<span class="w3-bar-item w3-button w3-dark-grey w3-margin-left"><i class="fa fa-thumbs-o-down 	"></i> <?php echo $row[5];?></span>
							<a href="delete-answer.php?answer_id=<?php echo $row[0]?>" class="w3-bar-item w3-button w3-grey w3-right w3-margin-top w3-margin-bottom ">Delete Answer <i class="fa fa-eye"></i></a>

							<a href="edit-answer.php?answer_id=<?php echo $row[0]?>" class="w3-bar-item w3-button w3-grey w3-right w3-margin-top w3-margin-bottom w3-margin-right w3-text-dark-grey">Edit <i class="fa fa-pencil"></i></a>
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