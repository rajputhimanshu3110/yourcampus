<?php include 'includes/header.php';

?>
<div class="container-fluid">
	<h4>My Contribution</h4>
	<hr>
	<table class="table table-hover table-responsive-md table-striped table-bordered" width="100%">
	  <thead class="thead-dark">
	    <tr>
	      <th scope="col">#</th>
	      <th scope="col">Subject</th>
	      <th scope="col">Alias</th>
	      <th scope="col">Semester</th>
	      <th scope="col">Course</th>
	      <th scope="col">Data</th>
	      <th scope="col">Youtube Playlist</th>
	      <th scope="col">Action</th>

	    </tr>
	  </thead>
	  <tbody>

<?php
		$user = $_SESSION['id'];
		$query = "SELECT * FROM subject WHERE user='$user' || last_user='$user'";
    $user_sub = mysqli_query($connection,$query);
    $uc = mysqli_num_rows($user_sub);
    $per_page = 8;
    $pages = ceil($uc/$per_page);
	if (isset($_GET['page'])) {
		$page = $_GET['page'];
		
		
	}else{
		$page = 1;
	}
	$start = ($page-1)*$per_page;
	$i=$start+1;
    $query = "SELECT * FROM subject WHERE user='$user' || last_user='$user' ORDER BY id DESC LIMIT $start,$per_page";
    $select_sub = mysqli_query($connection,$query);  
    confirmQuery($select_sub);

    while($row = mysqli_fetch_assoc($select_sub)) {
    $id = $row['id'];
    $subject = $row['subject'];
    $alias = $row['alias'];
    $sem=$row['sem'];
    $course=$row['course'];
    $syllabus=$row['syllabus'];
    $handwritten=$row['handwritten'];
    $previousyear=$row['previousyear'];
    $quantum=$row['quantum'];
    $playlist=$row['playlist'];

    $row = course_viewid($course);


    echo "<tr>";
        
    echo "<td>{$i}</td>";
    echo "<td>{$subject}</td>";
    echo "<td>{$alias}</td>";
	echo "<td>{$sem}</td>";
	echo "<td>{$row['name']}</td>";
	echo "<td><a target='_blank' href='{$syllabus}' class='btn btn-outline-success m-1'>Syllabus</a>
	<a target='_blank' href='{$handwritten}' class='btn btn-outline-success m-1'>Notes</a>
	<a target='_blank' href='{$previousyear}' class='btn btn-outline-success m-1'>Previous Year</a>
	<a target='_blank' href='{$quantum}' class='btn btn-outline-success m-1'>Quantum</a>
	</td>";
	echo '<td><iframe width="160" height="160" src="'.$playlist.'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></td>';

   echo '<td>
   <a class="btn m-1 btn-sm rounded-circle btn-outline-primary" href="editcontent.php?id='.$id.'">
                <i class="fas fa-pen"></i>
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
     <a class="page-link" href="mydata.php?page='.$new.'">Previous</a>
    </li>';
	}
	
	$i=1;
	while ($i<=$pages) {
		
		echo '<li class="page-item"><a class="page-link" href="mydata.php?page='.$i.'">'.$i.'</a></li>';
		$i++;
	}
	if ($page==$pages) {
		echo '<li class="page-item disabled">
     <a class="page-link" href="#" tabindex="-1">Next</a>
    </li>';
	}else{
		
		$new = $page + 1;
		echo '<li class="page-item">
     <a class="page-link" href="mydata.php?page='.$new.'">Next</a>
    </li>';
	}



?>
  </ul>
</nav>
</div>



<?php include 'includes/footer.php';?>