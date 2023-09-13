<?php include 'includes/header.php'; 
if (role($_SESSION['email'])!='admin'&& role($_SESSION['email'])!='CreatorLead') {
    redirect("index.php");
}

?>
	<div class="container-fluid">

		<h4 class="text-center">Semesters</h4>
		<hr>
	<table class="table table-hover table-striped table-bordered" width="100%">
	  <thead class="thead-dark">
	    <tr>
	      <th scope="col">#</th>
	      <th scope="col">Semester Name</th>
	      <th scope="col">Course</th>
	      <th scope="col">Action</th>

	    </tr>
	  </thead>
	  <tbody>
	  <?php 
	  $countvill = sem_count();
	  $per_page=5;
	  $pages = ceil($countvill/$per_page);
		if (isset($_GET['page'])) {
			$page = $_GET['page'];
	 	}else{
			$page = 1;
		}
		$start = ($page-1)*$per_page;
		$i=$start+1;
	  	
        $view_sem_query = sem_view();
        while ($row = mysqli_fetch_array($view_sem_query)) {

            $sem_name = $row['name'];
            $cid = $row['course_id'];
            $row = course_viewid($cid);
            echo "<tr>";
        
            echo "<td>{$i}</td>";
            echo "<td>{$sem_name}</td>";
            echo "<td>{$row['name']}</td>";
            echo "<td></td>";
         /* 	echo '<td>
            <a class="btn m-1 btn-sm rounded-circle btn-outline-danger" href="semester.php?delete='.$cid.'">
                <i class="fas fa-trash"></i>
            </a>
                  </td>';*/
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