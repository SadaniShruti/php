<?php
			$con=mysqli_connect("localhost","root","","img_mgt");
			if(isset($_FILES['FileUpload1']))
			{
				$filename=$_FILES['FileUpload1'];
				if(!file_exists("imeges"))
				{
					mkdir("imeges");
				}
			$target_dir="imeges/";
			$target_file=$target_dir.basename($_FILES["FileUpload1"]["name"]);
			$tmp=explode(".",$_FILES["FileUpload1"]["name"]);
			$newfilename=rand(35000,3500000).".".end($tmp);
			move_uploaded_file($_FILES["FileUpload1"]["tmp_name"],$target_dir.$newfilename);
			$sql="INSERT INTO `img`(`profile_pic`) VALUES ('$newfilename')";
			mysqli_query($con,$sql);
			}
	?>
<html>
	<head>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.1/css/bootstrap.min.css"/>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.1/js/bootstrap.bundle.min.js"></script>
	<title>Img Programme</title>
	<body>
	<form action="img.php"  method="POST" enctype="multipart/form-data">
	<div class="container-fluid mt-3">
	<input type="file" name="FileUpload1" class="form-contol"></br>
	<input type="submit" value="save" "w=100" class="btn btn-success"></br></br>
	</form>	
	</div>
	<table  class="table table-bordered text-center" cellpadding="0" cellspacing="0" width="100%" border="1px solid">
	<tr>
		<th>profile_pic
	</tr>
	<?php
			$con=mysqli_connect("localhost","root","","img_mgt");
			$sql = "SELECT * FROM `img`";
			$res = mysqli_query($con,$sql);
			$i=1;
			while($row=mysqli_fetch_assoc($res))
			{
	?> 
		<tr>
		    <td><img height="100" width="100" src="<?php echo "imeges/".$row['profile_pic'];?>">
		<?php
			}
		?>
		</table>
	</body>
</html>
	

