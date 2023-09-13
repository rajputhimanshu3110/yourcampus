<?php  
include 'db.php';
$aadhar = $_POST['aadhar'];
$type = $_POST['type'];

$query = "SELECT * FROM farmers WHERE aadhar = $aadhar";
	$result = mysqli_query($connection,$query);
	while($row = mysqli_fetch_array($result)){
		if ($type=='back') {
			$photo = $row['aadharback'];
		}else{
			$photo = $row['aadharfront'];
		}
		
	}
	echo '<img src="data:image/jpeg;base64,'.base64_encode($photo).'" style="max-width: 200px;" class="rounded">';

	


//echo '<img src="data:image/jpeg;base64,'.base64_encode($photo).'" style="max-width: 150px;" class="rounded-circle">';



?>