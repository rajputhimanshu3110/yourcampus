<?php include 'db.php';
if (isset($_POST['course'])) {
	$id = $_POST['course'];
	$query = "SELECT name FROM semester WHERE course_id = '$id'";
    $result = mysqli_query($connection, $query);

    while($row=mysqli_fetch_array($result)){
    	$sem_name = $row['name'];
    	echo "<option value='{$sem_name}'>{$sem_name}</option>";
    }
}

?>