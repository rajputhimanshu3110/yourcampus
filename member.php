<?php include 'include/header.php'; ?>

<div class="container my-3 mb-5">
	<h4 class="text-center">Team Members</h4>
		<hr>
	<div class="row my-3">
<?php
	$query = "SELECT * FROM team";
    $result = mysqli_query($connection, $query);
    confirmQuery($result);
    while($row = mysqli_fetch_array($result)){
    	$name = $row['name'];
    	$position = $row['position'];
    	$batch = $row['batch'];

   
?>
		<div class="col-lg-4 col-sm-6 my-2">
			<div class="card">
			  <img src="asset/back.png" class="card-img-top" alt="..." height="180px">
			  <div class="card-body text-center">
			    <h5 class="card-title  mb-0"><?php echo $name; ?></h5>
			    <span class="badge rounded-pill bg-success"><?php echo $position; ?></span>
			    <p class="card-text pt-2"><b>Batch:</b> <?php echo $batch; ?></p>
			  </div>
			</div>
		</div>

<?php } ?>
	</div>	
</div>


<?php include 'include/footer.php'; ?>