<?php 
session_start();
include_once('db.php');
$id=$_GET['post_id'];
$title=$_GET['title'];
$dis=$_GET['dis'];
$_SESSION['flag']='';
if(isset($_GET['post_id'])){
	
	$sql="UPDATE `post` SET `title`='".$title."',`question`='".$dis."' WHERE `post_id`=".$id;
	$run=mysqli_query($conn,$sql);
	if(isset($run)){
		$_SESSION['flag']='success';
		header('location:edit-post.php');

	}
	else{
		$_SESSION['flag']='fail';
	}
}
else{
		$_SESSION['flag']='fail';
	}
?>