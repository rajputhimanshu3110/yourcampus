<?php include 'includes/header.php';
$user_email= $_SESSION['email'];
/*if (role($user_email)!='admin') {
	redirect('index.php');
}*/
?>
<div class="container-fluid">
	<a class="float-right btn btn-sm btn-outline-success" href="emregis.php"><i class="fas fa-plus"> Add New</i></a>
	<h4>Team Members</h4>
	<hr>
	<table class="table table-hover table-responsive-md table-striped table-bordered" width="100%">
	  <thead class="thead-dark">
	    <tr>
	      <th scope="col">#</th>
	      <th scope="col">Name</th>
	      <th scope="col">Email</th>
	      <th scope="col">Position</th>
	      <th scope="col">Batch</th>
	      <th scope="col">Contibution</th>
	      <th scope="col">Action</th>

	    </tr>
	  </thead>
	  <tbody>
<?php
	
    $per_page = 5;
    $pages = ceil(Team_count()/$per_page);
	if (isset($_GET['page'])) {
		$page = $_GET['page'];
		
		
	}else{
		$page = 1;
	}
	$start = ($page-1)*$per_page;
	$i=$start+1;
    $query = "SELECT * FROM team WHERE member!='former' ORDER BY id DESC LIMIT $start,$per_page";
    $select_team = mysqli_query($connection,$query);  

    while($row = mysqli_fetch_assoc($select_team)) {
    $id = $row['id'];
    $name = $row['name'];
    $email = $row['email'];
    $pos = $row['position'];
    $batch=$row['batch'];

		$query = "SELECT * FROM subject WHERE user='$id' || last_user='$id'";
    $user_sub = mysqli_query($connection,$query);
    $uc = mysqli_num_rows($user_sub);

    echo "<tr>";
        
    echo "<td>{$i}</td>";
    echo "<td>{$name}</td>";
    echo "<td>{$email}</td>";
    echo "<td>{$pos}</td>";
    echo "<td>{$batch}</td>";
    echo "<td>{$uc} Times</td>";
	echo "<td>";
if (role($_SESSION['email'])=='admin'||  role($_SESSION['email'])=='CreatorLead') {
	
   

if (role($email)!='admin') {
	
   
   echo '
   <a class="btn m-1 btn-sm rounded-0 btn-outline-secondary" href="">
                Former</i>
            </a>';
}

}
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
     <a class="page-link" href="employee.php?page='.$new.'">Previous</a>
    </li>';
	}
	
	$i=1;
	while ($i<=$pages) {
		
		echo '<li class="page-item"><a class="page-link" href="employee.php?page='.$i.'">'.$i.'</a></li>';
		$i++;
	}
	if ($page==$pages) {
		echo '<li class="page-item disabled">
     <a class="page-link" href="#" tabindex="-1">Next</a>
    </li>';
	}else{
		
		$new = $page + 1;
		echo '<li class="page-item">
     <a class="page-link" href="employee.php?page='.$new.'">Next</a>
    </li>';
	}



?>
  </ul>
</nav>
</div>



<?php include 'includes/footer.php';?>