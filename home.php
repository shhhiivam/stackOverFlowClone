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
$flag="false";
if(isset($_POST['postBtn'])){
$query="INSERT INTO `post`( `user_id`, `title`, `question`) VALUES (".$id.",'".$_POST['title']."','".$_POST['question']."')";

	
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

		<!-- Post and Feed Section Row -->
		<div class="w3-twothird w3-row-container" style="margin-left:16%;margin-top:6%">
				<!-- Create Post Section -->
				<div class="w3-panel w3-border w3-light-grey w3-round-large" >
					<form method="POST" action="">
						<input type="text" name="title" class="w3-input w3-margin-top" placeholder="Please Give Title" required>
						<p> 
						 <textarea class="w3-input w3-margin-top" placeholder="Ask Something..." name="question" required >	 
						 </textarea>
						 <label>
							Right Your question here
						</label>
						</p>
						<p><input type="text" name="tags" class="w3-input w3-margin-top" placeholder="use comma for multiple tags" required></p>
						 <p> 
						 <button type="submit" class="w3-button  w3-right w3-dark-grey w3-margin-bottom" name="postBtn">post</button>
						 <label>
							Tags	
						</label>
						 </p>
					</form>
				</div>
				<!-- Create Post Section -->
				<?php 
					if($flag=="success"){?>
						<div class="w3-panel w3-pale-green w3-leftbar w3-border-green">
			  				<p>Question is uploaded</p>
						</div>
				<?php }?>
				<!-- Feed Row  -->
				<div class="w3-row-container">
					<!-- posts -->
					<?php
						$sql="SELECT * FROM `post` ORDER BY post_id DESC LIMIT 10";
						$run=mysqli_query($conn,$sql);
						
						while ($row = mysqli_fetch_row($run)) {
						?>	
						
					<div class="w3-panel w3-border w3-light-grey w3-round-large">
						<h2><?php echo $row[2];?></h2>
						<h5><?php echo $row[3];?></h5>
						<div class="w3-bar">
							<span class="w3-badge w3-dark-grey w3-bar-item w3-margin-bottom"><i class="fa fa-caret-up"></i> <?php echo $row[4];?></span>
							<span class="w3-bar-item w3-dark-grey w3-badge w3-margin-left"><i class="fa fa-caret-down"></i><?php echo $row[4];?> </span>
							<a href="post-preview.php?post_id=<?php echo $row[0]; ?>" class="w3-bar-item w3-button w3-grey w3-right w3-margin-top w3-margin-bottom">View <i class="fa fa-plus"></i></a>
						</div>
					</div>

					<?php
				}
				?>





					<!-- posts -->

				</div>
				<!-- Feed Row-->


		</div>
		<!-- Post and Feed Section Row -->


	</div>
	<!-- Main Section -->


</body>
</html>