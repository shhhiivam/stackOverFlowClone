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
	$sql="INSERT INTO `post_comments`(`post_id`, `postie_user_id`, `comment`) VALUES (".$_GET['post_id'].",".$id.",'".$_POST['comment']."')";
	$run=mysqli_query($conn,$sql);

	if (isset($run)) {
		 
		 header('location:post-preview.php?post_id='.$_GET['post_id']);
		  
		 $flag="success";

	}
	else {
  		$flag="true";
	}
}

if(isset($_POST['statusA'])){
 $sql="UPDATE `post_comments` SET `status`='A' WHERE `comment_id`=".$_POST['commentId'];
 //echo $sql;
 $run=mysqli_query($conn,$sql);
}
if(isset($_POST['statusN'])){
$sql="UPDATE `post_comments` SET `status`='N' WHERE `comment_id`=".$_POST['commentId'];
$run=mysqli_query($conn,$sql);
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
				if(isset($_GET['post_id'])){
						$sql="SELECT * FROM `post` WHERE `post_id`=".$_GET['post_id'];
						$run=mysqli_query($conn,$sql);
						$row = mysqli_fetch_row($run);
						
				?>
					<div class="w3-panel w3-border w3-light-grey w3-round-large">
						<h2><?php echo $row[2];?></h2>
						<h5><?php echo $row[3];?></h5>
						<div class="w3-bar">
							<span class="w3-badge w3-dark-grey  w3-bar-item w3-margin-bottom"><i class="fa fa-caret-up"></i> <?php echo $row[4];?></span>
							<span class="w3-bar-item w3-dark-grey  w3-badge w3-margin-left"><i class="fa fa-caret-down"></i> <?php echo $row[5];?></span>
						</div>
					</div>
				<?php 

					}
				?>
				<!-- Question -->

				<!-- Posted Comment -->
					<?php
						$sql="SELECT p.`post_id`,u.`user_id`,uc.`name`,`status`,`comment`,pc.`upvote`,pc.`downvote`,`postie_user_id`,`comment_id` FROM `post` p JOIN `user` u on u.user_id=p.user_id JOIN `post_comments` pc ON pc.post_id=p.post_id join `user` uc on uc.`user_id` = postie_user_id WHERE  p.post_id=".$_GET['post_id']."";
						$run=mysqli_query($conn,$sql);
						//echo $sql;
						while ($row = mysqli_fetch_row($run)) {

							if ($row[3]=='A') {
								
						?>	
					<div class="w3-panel w3-leftbar w3-border-green   w3-light-grey w3-round-large">
						<div class="w3-bar">
							<h2 class="w3-bar-item"><?php echo $row[2];?></h2>
							
								<h2 class="w3-bar-item w3-text-green w3-right">Accepted</h2>
								
						</div>
						<h5><?php echo $row[4];?></h5>
						<div class="w3-bar">

							<span class="w3-badge w3-dark-grey w3-bar-item w3-margin-bottom"><i class="fa fa-caret-up"></i><?php echo $row[5];?></span>
							<span class="w3-bar-item w3-dark-grey  w3-badge w3-margin-left"><i class="fa fa-caret-down"></i><?php echo $row[6];?></span>
						</div>
					</div>
					<?php
							}
							else if($row[3]=='N'){

								?>	
					<div class="w3-panel w3-leftbar w3-border-red   w3-light-grey w3-round-large">
						<div class="w3-bar">
							<h2 class="w3-bar-item"><?php echo $row[2];?></h2>
							
							<h2 class="w3-bar-item w3-text-red w3-right">Not Accepted</h2>		
								
						</div>
						<h5><?php echo $row[4];?></h5>
						<div class="w3-bar">

							<span class="w3-badge w3-dark-grey w3-bar-item w3-margin-bottom"><i class="fa fa-caret-up"></i><?php echo $row[5];?></span>
							<span class="w3-bar-item w3-dark-grey  w3-badge w3-margin-left"><i class="fa fa-caret-down"></i><?php echo $row[6];?></span>
						</div>
					</div>
					<?php
							}
							else{
								?>	
					<div class="w3-panel w3-leftbar w3-border-orange   w3-light-grey w3-round-large">
						<div class="w3-bar">
							<h2 class="w3-bar-item"><?php echo $row[2];?></h2>
							
							<h2 class="w3-bar-item w3-text-orange w3-right">Pending</h2>		
								
						</div>
						<h5><?php echo $row[4];?></h5>
						<div class="w3-bar">
							<span class="w3-badge w3-dark-grey w3-bar-item w3-margin-bottom"><i class="fa fa-caret-up"></i><?php echo $row[5];?></span>
							<span class="w3-bar-item w3-dark-grey  w3-badge w3-margin-left"><i class="fa fa-caret-down"></i><?php echo $row[6];?></span>
							<?php


							if ($id==$row[1]) {
								?>
							<form method="POST" action="">
								<input type="number" name="commentId" value="<?php echo $row[8];?>" class="w3-hide">
								<button name="statusA" class="w3-bar-item w3-button w3-green w3-right w3-margin-top w3-margin-bottom w3-margin-right">Accepted <i class="fa fa-check"></i></button>
								<button name="statusN" class="w3-bar-item w3-button w3-red w3-right w3-margin-top w3-margin-bottom w3-margin-right">Not Accepted <i class="fa fa-close	"></i></button>
							</form>
							<?php
							}
							?>
						</div>
					</div>
					<?php
							
							}
							}
					?>
				<!-- Posted Comment -->
				

				<!-- Create Comment -->
				<div class="w3-panel w3-border w3-light-grey w3-round-large" >
					<form method="POST" action="">
						<input type="text" name="comment"  class="w3-input w3-margin-top w3-border"  placeholder="Enter Title ">
						 
						 <p> 
						 <button type="submit" class="w3-button w3-right w3-dark-grey w3-margin-bottom" name="postBtn">Post Comment</button>
						 </p>
					</form>
				</div>



				<!-- Create Comment -->

				</div>
				<!-- Question Row-->


		</div>
		<!-- Post and comment Section Row -->

	</div>
	<!-- Main Section -->


</body>
</html>