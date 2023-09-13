<?php include 'includes/header.php'; 
if (isset($_GET['id'])) {
	$id = $_GET['id'];
}else{
	redirect('content.php');
}
$query = "SELECT * FROM subject WHERE id = '$id'";
    $select_sub = mysqli_query($connection,$query);  

    $row = mysqli_fetch_assoc($select_sub);
    
    $subject = $row['subject'];
    $alias = $row['alias'];
    $sem=$row['sem'];
    $course=$row['course'];
    $syllabus=$row['syllabus'];
    $handwritten=$row['handwritten'];
    $previousyear=$row['previousyear'];
    $quantum=$row['quantum'];
    $playlist=$row['playlist'];



?>
	<div class="container-fluid">
		<h4 class="text-center">Edit Content - <?php echo $subject; ?></h4>
		<hr>
<?php
if (isset($_POST['submit'])) {
	$alias = $_POST['alias'];
	$syllabus = $_POST['syllabus'];
	$notes = $_POST['notes'];
	$previousyear = $_POST['previousyear'];
	$quantum = $_POST['quantum'];
	$youtube = $_POST['youtube'];
	$user = $_SESSION['id'];

	$query = "UPDATE subject SET alias = '$alias', last_user = '$user', syllabus = '$syllabus', handwritten = '$notes', previousyear = '$previousyear', quantum = '$quantum', playlist = '$youtube' WHERE id = $id";
    $subject_query = mysqli_query($connection, $query);
    redirect('content.php');
}


?>

	<form action="editcontent.php?id=<?php echo $id; ?>" method="POST">
	  
	  <div class="form-group col-md-6">
	    <label for="alias">Short Name</label>
	    <input type="text" class="form-control" name="alias" placeholder="Enter Alias" required value="<?php echo $alias; ?>">
	  </div>
	  <div class="form-group col-md-6">
	    <label for="name">Drive URL's</label>
		<div class="input-group mb-3">
		  <span class="input-group-text" id="basic-addon3">Syllabus</span>
		  <input type="text" class="form-control" id="basic-url" placeholder="https://drive.google.com/drive/folders/.........." aria-describedby="basic-addon3" name="syllabus" value="<?php echo $syllabus; ?>">
		</div>
		<div class="input-group mb-3">
		  <span class="input-group-text" id="basic-addon3">Notes</span>
		  <input type="text" class="form-control" id="basic-url" placeholder="https://drive.google.com/drive/folders/.........." aria-describedby="basic-addon3" name="notes" value="<?php echo $handwritten; ?>">
		</div>
		<div class="input-group mb-3">
		  <span class="input-group-text" id="basic-addon1">Previous Year</span>
		  <input type="text" class="form-control" placeholder="https://drive.google.com/drive/folders/.........." aria-label="Username" aria-describedby="basic-addon1" name="previousyear" value="<?php echo $previousyear; ?>">
		</div>
		<div class="input-group mb-3">
		  <span class="input-group-text" id="basic-addon3">Quantum</span>
		  <input type="text" placeholder="https://drive.google.com/drive/folders/.........." class="form-control" id="basic-url" aria-describedby="basic-addon3" name="quantum" value="<?php echo $quantum; ?>">
		</div>
	  </div>
	  <div class="form-group col-md-6">
	    <label for="alias">Embed URL</label>
	    <div class="input-group mb-3">
		  <span class="input-group-text" id="basic-addon3">Youtube src</span>
		  <input type="text" class="form-control" id="basic-url" placeholder="https://www.youtube.com/embed/bCjkXqQITXw" aria-describedby="basic-addon3" name="youtube" value="<?php echo $playlist; ?>">
		</div>
	  </div>
	  
	  <div class="col-md-6">
	  	<button type="submit" name="submit" class="col-md-6 btn btn-primary bn-block">Submit</button>
	  </div>  
	</form>



	</div>


<?php include 'includes/footer.php'; ?>