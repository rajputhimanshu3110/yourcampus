<?php
include 'db.php';
include '../functions.php';
if (role($email)!='admin') {
	redirect('../employee.php')
}
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$query = "DELETE FROM team WHERE id = '$id' ";
    $delete_query = mysqli_query($connection,$query);
    confirmQuery($delete_query);
}
redirect('../employee.php');


?>