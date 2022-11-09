<?php
	session_start();
	$_SESSION['form'] = '';
	header("location:loginform.php");
?>