<?php include 'includes/header.php'; ?>
	<div class="container-fluid">
		<h4 class="text-center">Villages</h4>
		<hr>
<?php
if (role($_SESSION['email'])!='admin'&& role($_SESSION['email'])!='CreatorLead') {
    redirect("index.php");
}
if (isset($_POST['create'])) {
	$village_name = $_POST['village'];
	course_create($village_name,$_SESSION['email']);
	redirect('courses.php');
}
if (isset($_POST['update'])) {
	$village_name = $_POST['village'];
	$vid = $_GET['edit'];
	course_update($village_name,$vid,$_SESSION['email']);
	redirect('courses.php');
}

if (isset($_GET['edit'])) {
	$vid = $_GET['edit'];
	$query = "SELECT * FROM courses WHERE course_id= '$vid'";
    $edit_query = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($edit_query);

    $village = $row['name'];
?>
	<form action="courses.php?edit=<?php echo $vid; ?>" method="POST">
		<div class="row mb-3">
			<div class="col-sm-8">
				<input type="text" name="village" class="form-control mb-3" value='<?php echo $village; ?>'>
			</div>
			<div class="col-sm-3">
				<button type="submit" name='update' class="btn btn-info">Update</button>
			</div>
		</div>
	</form>

<?php


}else{


?>
	
	<form action="courses.php" method="POST">
		<div class="row mb-3">
			<div class="col-sm-8">
				<input type="text" name="village" class="form-control mb-3">
			</div>
			<div class="col-sm-3">
				<button type="submit" name='create' class="btn btn-warning">Create</button>
			</div>
		</div>
	</form>
<?php } ?>
	<table class="table table-hover table-striped table-bordered" width="100%">
	  <thead class="thead-dark">
	    <tr>
	      <th scope="col">#</th>
	      <th scope="col">Course Name</th>
	      <th scope="col">Semester</th>
	      <th scope="col">Action</th>

	    </tr>
	  </thead>
	  <tbody>
	  <?php 
	  $countvill = mysqli_num_rows(course_view());
	  $per_page=5;
	  $pages = ceil($countvill/$per_page);
		if (isset($_GET['page'])) {
			$page = $_GET['page'];
	 	}else{
			$page = 1;
		}
		$start = ($page-1)*$per_page;
		$i=$start+1;
	  	$query = "SELECT * FROM courses ORDER BY course_id DESC LIMIT $start,$per_page";
        $view_course_query = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_array($view_course_query)) {

            $course_name = $row['name'];
            $vid = $row['course_id'];
            echo "<tr>";
        
            echo "<td>{$i}</td>";
            echo "<td>{$course_name}</td>";
            echo "<td>".semester_count($vid)."</td>";
           echo '<td>
            <a class="btn m-1 btn-sm rounded-circle btn-outline-primary" href="courses.php?edit='.$vid.'">
                <i class="fas fa-pen"></i>
            </a>
                  </td>';
            echo "</tr>";
        $i=$i+1;
        } ?>
	    
	  </tbody>
	</table>
<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
<?php
	if ($page==1) {
		echo '<li class="page-item disabled">
     <a class="page-link" href="#" tabindex="-1">Previous</a>
    </li>';
	}else{
		$new = $page-1;
		echo '<li class="page-item">
     <a class="page-link" href="courses.php?page='.$new.'">Previous</a>
    </li>';
	}
	
	$i=1;
	while ($i<=$pages) {
		
		echo '<li class="page-item"><a class="page-link" href="courses.php?page='.$i.'">'.$i.'</a></li>';
		$i++;
	}
	if ($page==$pages) {
		echo '<li class="page-item disabled">
     <a class="page-link" href="#" tabindex="-1">Next</a>
    </li>';
	}else{
		
		$new = $page + 1;
		echo '<li class="page-item">
     <a class="page-link" href="courses.php?page='.$new.'">Next</a>
    </li>';
	}



?>
  </ul>
</nav>
	</div>
<?php include 'includes/footer.php'; ?>