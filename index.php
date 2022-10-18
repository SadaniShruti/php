<?php
	$con=mysqli_connect("localhost","root","","crud_mgt");
	if(isset($_POST['txtnm']))
	{
		$nm=$_POST['txtnm'];
		$cs=$_POST['txtcs'];
		$cno=$_POST['txtcno'];
		$sql="INSERT INTO `stud`(`student_name`, `course`, `contact_no`) VALUES ('$nm','$cs','$cno')";
		mysqli_query($con,$sql);
	}
?>
		
<html>
	<head>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.2/css/bootstrap.min.css"/>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.2/js/bootstrap.bundle.min.js"></script>
	</head>
	<body>
	<div class="container mt-2">
	<form action="index.php" method="POST">
		<input type="text" name="txtnm" class="form-control" placeholder="Enter name" required></br>
		<input type="text" name="txtcs" class="form-control" placeholder="Enter course" required></br>
		<input type="text" name="txtcno" class="form-control" placeholder="Enter contact no." required></br>
		<center><input type="submit" class="btn btn-success" value="submit"></center>
	</form>
	<table class="table table-bordered text-center">
	<tr>
	<th>id
	<th>Student name
	<th>Course
	<th>Contact no.
	<th>Action
	</tr>
<?php
	$sql="SELECT * FROM `stud`";
	$res=mysqli_query($con,$sql);
	$i=1;
	while($row=mysqli_fetch_assoc($res))
	{
?>
	<tr>
	<td><?php echo $i; ?>
	<td><?php echo $row['student_name']?>
	<td><?php echo $row['course']?>
	<td><?php echo $row['contact_no']?>
	<td><a class="btn btn-danger" href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
	<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-bs-nm="<?php echo $row['student_name']; ?>" data-bs-cs="<?php echo $row['course'];?>" data-bs-cno="<?php echo $row['contact_no'];?>" data-bs-id="<?php echo $row['id']; ?>">Update</button>
	<?php
		$i++;
	}
	?>
	</table>
	</div>
	<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="staticBackdropLabel">Update Record</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
			<form action="index.php" method="POST">
				<div class="mb-3">
					<input type="text" name="txtsnm" class="form-control"  placeholder="Enter student name" id="snm">
					<input type="text" name="txtid" class="form-control" id="id" hidden>
				</div>
				<div class="mb-3">
					<input type="text" name="txtcor" class="form-control" placeholder="Enter course" id="cor">
				</div>
				<div class="mb-3">
					<input type="text" name="txtcon" class="form-control" placeholder="Enter contact" id="con">
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary w-100">Update</button>
				</div>
			</form>
				</div>
			</div>      
		</div>	
	</div>
	</body>
</html>
<script>
	const exampleModal = document.getElementById('staticBackdrop')
	exampleModal.addEventListener('show.bs.modal', event => {
    const button = event.relatedTarget
    const nm = button.getAttribute('data-bs-nm')
    const cs = button.getAttribute('data-bs-cs')
	const cno = button.getAttribute('data-bs-cno')
    const id = button.getAttribute('data-bs-id')
    const modalTitle = exampleModal.querySelector('.modal-title')
	modalTitle.textContent = `Update Record ID ${id}`
    document.getElementById('snm').value = nm;
	document.getElementById('cor').value = cs;
	document.getElementById('con').value = cno;
	document.getElementById('id').value = id;
})
</script>
<?php
	if(isset($_POST['txtid']))
	{
		$id = $_POST['txtid'];
		$nm = $_POST['txtsnm'];
		$cs= $_POST['txtcor'];
		$cno = $_POST['txtcon'];
		$sql = "UPDATE `stud` SET `student_name`='$nm',`course`='$cs' ,`contact_no`='$cno' WHERE `id`='$id'";
		mysqli_query($con,$sql);
	}
?>