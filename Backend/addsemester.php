<?php include 'includes/header.php'; ?>
	<div class="container-fluid">
		<h4 class="text-center">Add Semester</h4>
		<hr>
<?php
if (role($_SESSION['email'])!='admin'&& role($_SESSION['email'])!='CreatorLead') {
    redirect("index.php");
}
if (isset($_POST['create'])) {
	$sem_name = $_POST['sem'];
	$course_id = $_POST['course'];
	sem_create($sem_name,$course_id,$_SESSION['email']);
	redirect('semester.php');
}


?>
	
	<form action="addsemester.php" method="POST">
		<div class="mb-3">
		    <label for="exampleInputEmail1" class="form-label">Course</label>
			<select class="form-select form-select-sm form-control"  name="course" required>
			  <option disabled selected>Select Course</option>
<?php 
$result = course_view();

	while ($row=mysqli_fetch_array($result)) {
		echo "<option value='".$row['course_id']."'>".$row['name']."</option>";
	}

?>
			</select>
		  </div>
		  <div class="mb-3">
		    <label  class="form-label">Semester</label>
		    <input type="text" class="form-control" name="sem" required>
		  </div>
		  <button type="submit" name="create" class="btn btn-primary">Submit</button>
			</form>

	
	</div>
<?php include 'includes/footer.php'; ?>