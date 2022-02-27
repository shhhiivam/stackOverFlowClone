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

if(isset($_GET['answer_id'])){
	$sql="DELETE FROM `post_comments` WHERE `comment_id`=".$_GET['answer_id'];
	$run=mysqli_query($conn,$sql);
	if(isset($run)){
		$_SESSION['flag']='success';
		header('location:my-answers.php');
		

	}
	else{	
		$_SESSION['flag']='fail';
	}
}



?>