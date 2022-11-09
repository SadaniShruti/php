<link rel="stylesheet" href="https:cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.1/css/bootstrap.min.css"/>
<?php
	$con=mysqli_connect("localhost","root","","form_mgt");
	if(!$con)
	{
		echo "Error DB!";
	}
	else
	{
		if(isset($_POST['txtnm']))
		{
			$nm=$_POST['txtnm'];
			$cno=$_POST['txtcno'];
			$mail=$_POST['txtmail'];
			$pwd=$_POST['txtpwd'];
			
			$sql="INSERT INTO `form`(`user_name`, `contact_no`, `e_mail`,`password`) VALUES ('$nm','$cno','$mail','$pwd')";
			if(mysqli_query($con,$sql))
			{
				header ("location:loginform.php");
			}
		}
	}
?>
<html>
	<head>
		<script src="https:cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.1/js/bootstrap.bundle.min.js"></script>
		<title>Regestration form</title>
		<body>
		<form action="regform.php" method="POST">
		<div class="container mt-3">
		<input type="text" name="txtnm" class="form-control" placeholder="Enter user name" required></br>
		<input type="text" name="txtcno" class="form-control" placeholder="Enter contact number" required></br>
		<input type="email" name="txtmail" class="form-control" placeholder="Enter e-mail" required></br>
		<input type="pwd" name="txtpwd" class="form-control" placeholder="Enter password"required></br>
		<input type="submit" class="btn btn-primary" value="Regester">
		</form>
	</div>
		
		