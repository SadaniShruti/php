<?php
	$con = mysqli_connect("localhost","root","","crud_mgt");
	$id = $_GET['id'];
	$sql = "DELETE FROM `stud` WHERE id='$id'";
	mysqli_query($con,$sql);
	header("location:index.php");
?>