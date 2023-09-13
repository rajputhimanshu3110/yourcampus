<?php include 'includes/header.php';
if (role($_SESSION['email'])!='admin'&& role($_SESSION['email'])!='CreatorLead') {
    redirect("index.php");
}
?>
<div class="container-fluid">
	<h4>Delete Review</h4>
	<hr>
	<table class="table table-hover table-responsive-md table-striped table-bordered" width="100%">
	  <thead class="thead-dark">
	    <tr>
	      <th scope="col">#</th>
	      <th scope="col">Subject</th>
	      <th scope="col">Semester</th>
	      <th scope="col">Course</th>
	      <th scope="col">Added By</th>
	      <th scope="col">Delete Request</th>
	      
	      <th scope="col">Action</th>

	    </tr>
	  </thead>
	  <tbody>

<?php
	
		$query = "SELECT * FROM subject WHERE status='review'";
    $sub = mysqli_query($connection,$query);
    $cou = mysqli_num_rows($sub);

    $per_page = 8;
    $pages = ceil($cou/$per_page);
	if (isset($_GET['page'])) {
		$page = $_GET['page'];
		
		
	}else{
		$page = 1;
	}
	$start = ($page-1)*$per_page;
	$i=$start+1;
    $query = "SELECT * FROM subject WHERE status='review' ORDER BY id DESC LIMIT $start,$per_page";
    $select_sub = mysqli_query($connection,$query);  

    while($row = mysqli_fetch_assoc($select_sub)) {
    $id = $row['id'];
    $subject = $row['subject'];
    $del_user = $row['del_user'];
    $sem=$row['sem'];
    $course=$row['course'];
    
		$views = $row['views'];
		$user=$row['user'];    
		$user = user_name($user);

    $playlist=$row['playlist'];
    
    $row = course_viewid($course);



    echo "<tr>";
        
    echo "<td>{$i}</td>";
    echo "<td>{$subject}</td>";
    
	echo "<td>{$sem}</td>";
	echo "<td>{$row['name']}</td>";
	echo "<td>{$del_user}</td>";
	echo "<td>{$user}</td>";

   echo '<td>
   <span class="badge badge-info">'.$views.' Views</span>
    <a class="btn m-1 btn-sm rounded-circle btn-outline-success" href="includes/delcontent.php?publish='.$id.'">
    			<i class="fa fa-bullhorn" aria-hidden="true"></i>
    </a>
    <a class="btn m-1 btn-sm rounded-circle btn-outline-danger" href="includes/delcontent.php?did='.$id.'">
                <i class="fas fa-trash"></i></i>
    </a>';

    echo '</td>';
    echo "</tr>";
    $i=$i+1;
    }
?>
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
     <a class="page-link" href="review.php?page='.$new.'">Previous</a>
    </li>';
	}
	
	$i=1;
	while ($i<=$pages) {
		
		echo '<li class="page-item"><a class="page-link" href="review.php?page='.$i.'">'.$i.'</a></li>';
		$i++;
	}
	if ($page==$pages) {
		echo '<li class="page-item disabled">
     <a class="page-link" href="#" tabindex="-1">Next</a>
    </li>';
	}else{
		
		$new = $page + 1;
		echo '<li class="page-item">
     <a class="page-link" href="review.php?page='.$new.'">Next</a>
    </li>';
	}



?>
  </ul>
</nav>
</div>



<?php include 'includes/footer.php';?>