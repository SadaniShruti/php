<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.1/css/bootstrap.min.css"/>
<?php
	session_start();
	if(!$_SESSION['form'])
	{
		header("location:loginform.php");
	}
	$con = mysqli_connect("localhost","root","","form_mgt");
	if(!$con)
	{
		echo "Error DB!";
	}
	else
	{
		$oldmail = $_SESSION['form'];
		$sql = "SELECT * from `form` where e_mail='$oldmail'";
		$res = mysqli_query($con,$sql);
	}
?>
<div class="container-fluid mt-2 text-center">
	<?php
			$count  = mysqli_affected_rows($con);
			if($count == 1)
			{
				$row = mysqli_fetch_assoc($res);
			}
		?>
	<form action="homepage.php" method="POST" enctype="multipart/form-data">
		<?php
			if($row['profile_pic']!="")
			{
		?>
		<img class="img-circle" src="<?php echo "images/".$row['profile_pic']; ?>" alt="No Image" height="100" width="100" name="usrimg" id="usrimg"></br>
		<?php
			}
			if($row['profile_pic']=="")
			{
		?>
				<img class="img-circle" src="https://cdn.icon-icons.com/icons2/1378/PNG/512/avatardefault_92824.png" alt="No Image" height="100" width="100" name="usrimg" id="usrimg"></br>
				<input type="file" class="form-control" id="fileupload" name="fileupload" accept=".JPEG,.JPG,.PNG"></br>
		<?php
			}
		?>
		<input type="text" value="<?php echo $row['user_name']; ?>" name="txtnm" class="form-control" required></br>
		<input type="email" value="<?php echo $row['e_mail']; ?>" name="txtmail" class="form-control" disabled></br>
		<input type="text" value="<?php echo $row['contact_no']; ?>" name="txtcno" class="form-control" required></br>
		<input type="password" value="<?php echo $row['password']; ?>" name="txtpwd" class="form-control" required></br>
		<input type="submit" value="Save Changes" class="btn btn-primary w-100"></br></br>
		<a href="logout.php" class="btn btn-danger w-100">Log Out</a>
	</form>
</div>
<?php
	if(isset($_POST['txtnm']))
	{
		$nm = $_POST['txtnm'];
		$cno = $_POST['txtcno'];
		$pwd = $_POST['txtpwd'];
		$target_dir = "images/";
		$temp = explode(".", $_FILES["fileupload"]["name"]);
		$newfilename = round(microtime(true)) . '.' . end($temp);
		echo $newfilename;
		if(move_uploaded_file($_FILES["fileupload"]["tmp_name"], $target_dir.$newfilename))
		{
			$sql = "UPDATE `form` set user_name='$nm',contact_no='$cno', password='$pwd', profile_pic='$newfilename' where e_mail='$oldmail'";
		}
		else
		{
			$sql = "UPDATE `form` set user_name='$nm',contact_no='$cno', password='$pwd' where e_mail='$oldmail'";
		}
		if(mysqli_query($con,$sql))
		{
			header("location:homepage.php");
		}
	}
?>
<script>
	fileupload.onchange = evt => {
  const [file] = fileupload.files
  if (file) {
    usrimg.src = URL.createObjectURL(file)
  }
}
</script>
