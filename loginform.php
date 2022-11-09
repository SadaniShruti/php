<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.1/css/bootstrap.min.css"/>
<?php
	$con=mysqli_connect("localhost","root","","form_mgt");
	if(!$con)
	{
		echo "Error DB!";
	}
	else
	{
		if(isset($_POST['txtmail']))
		{
			$mail=$_POST['txtmail'];
			$pwd=$_POST['txtpwd'];
			$sql="SELECT * from `form` where e_mail='$mail' and password='$pwd'";
			$res = mysqli_query($con,$sql);
			$count=mysqli_affected_rows($con);
			if($count == 1)
			{
				session_start();
				$_SESSION['form'] = $mail;
				header("location:homepage.php");
			}
			else
			{
				echo ("Invalid Username or Password!");
			}
		}
	}
?>
	<form action="loginform.php" method="POST">
		<div class="container mt-3">
		<input type="text" name="txtmail" class="form-control" placeholder="Enter mail address" required></br>
		<input type="text" name="txtpwd" class="form-control" placeholder="Enter Password" required></br>
		<input type="submit" class="btn btn-success" value="Login">
	</form>
</div>
		