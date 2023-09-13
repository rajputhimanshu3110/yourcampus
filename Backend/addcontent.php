<?php include 'includes/header.php'; ?>
	<div class="container-fluid">
		<h4 class="text-center">Add Content</h4>
		<hr>
<?php
if (isset($_POST['submit'])) {
	$course = $_POST['course'];
	$sem = $_POST['sem'];
	$sub = $_POST['sub'];
	$alias = $_POST['alias'];
	$syllabus = $_POST['syllabus'];
	$notes = $_POST['notes'];
	$previousyear = $_POST['previousyear'];
	$quantum = $_POST['quantum'];
	$youtube = $_POST['youtube'];
	$user = $_SESSION['id'];
	$date = date('y-m-d');

	$query = "INSERT INTO subject (subject,alias,sem,course,syllabus,handwritten,previousyear,quantum,playlist,user,tm) ";
        $query .= "VALUES('{$sub}','{$alias}','{$sem}','{$course}','{$syllabus}','{$notes}','{$previousyear}','{$quantum}','{$youtube}','{$user}','{$date}')";
        $subject_query = mysqli_query($connection, $query);
    redirect('content.php');
}


?>

	<form action="addcontent.php" method="POST">
	  <div class="form-group col-md-6">
	    <label for="course">Select Course</label>
	    <select class="form-control" id="courseSelect" name="course">
	    	<option selected disabled>Course</option>
<?php 
$res = course_view();
while ($row = mysqli_fetch_array($res)) {
	$id = $row['course_id'];
	$name = $row['name'];

	echo "<option value='{$id}'>{$name}</option>";
}

?>
	    </select>
	  </div>

	  <div class="form-group col-md-6">
	    <label for="course">Select Semester</label>
	    <select class="form-control" id="semSelect" name="sem">
	    	<option selected disabled>Select Semester</option>
	    	
	    </select>
	  </div>

	  <div class="form-group col-md-6">
	    <label for="sub">Subject</label>
	    <input type="text" class="form-control" name="sub" placeholder="Enter Subject" required>
	  </div>
	  <div class="form-group col-md-6">
	    <label for="alias">Short Name</label>
	    <input type="text" class="form-control" name="alias" placeholder="Enter Alias" required>
	  </div>
	  <div class="form-group col-md-6">
	    <label for="name">Drive URL's</label>
		<div class="input-group mb-3">
		  <span class="input-group-text" id="basic-addon3">Syllabus</span>
		  <input type="text" class="form-control" id="basic-url" placeholder="https://drive.google.com/drive/folders/.........." aria-describedby="basic-addon3" name="syllabus">
		</div>
		<div class="input-group mb-3">
		  <span class="input-group-text" id="basic-addon3">Notes</span>
		  <input type="text" class="form-control" id="basic-url" placeholder="https://drive.google.com/drive/folders/.........." aria-describedby="basic-addon3" name="notes">
		</div>
		<div class="input-group mb-3">
		  <span class="input-group-text" id="basic-addon1">Previous Year</span>
		  <input type="text" class="form-control" placeholder="https://drive.google.com/drive/folders/.........." aria-label="Username" aria-describedby="basic-addon1" name="previousyear">
		</div>
		<div class="input-group mb-3">
		  <span class="input-group-text" id="basic-addon3">Quantum</span>
		  <input type="text" placeholder="https://drive.google.com/drive/folders/.........." class="form-control" id="basic-url" aria-describedby="basic-addon3" name="quantum">
		</div>
	  </div>
	  <div class="form-group col-md-6">
	    <label for="alias">Embed URL</label>
	    <div class="input-group mb-3">
		  <span class="input-group-text" id="basic-addon3">Youtube src</span>
		  <input type="text" class="form-control" id="basic-url" placeholder="https://www.youtube.com/embed/bCjkXqQITXw" aria-describedby="basic-addon3" name="youtube">
		</div>
	  </div>
	  
	  <div class="col-md-6">
	  	<button type="submit" name="submit" class="col-md-6 btn btn-primary bn-block">Submit</button>
	  </div>  
	</form>



	</div>


<?php include 'includes/footer.php'; ?>