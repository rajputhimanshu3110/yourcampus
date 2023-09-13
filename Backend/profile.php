<?php include 'includes/header.php';?>
<div class="container-fluid">
	<h4 class="text-center">Profile</h4>
	<hr>
	<div class="text-center mb-3">
		<img src="img/logo.png" class="rounded-circle" width="20%" style="max-height:200px">
	</div>
	<div class="row">
		<div class="col-md-6">
			<label>Name :</label>
			<input type="text" name="" class="form-control mb-3 rounded-0" value="<?php echo $_SESSION['name']; ?>" disabled>
		</div>
		<div class="col-md-6">
			<label>Email :</label>
			<input type="text" name="" class="form-control mb-3 rounded-0" value="<?php echo $_SESSION['email']; ?>" disabled>
		</div>
		<div class="col-md-6">
			<label>Role :</label>
			<input type="text" name="" class="form-control mb-3 rounded-0" value="<?php echo $_SESSION['role']; ?>" disabled>
		</div>
	</div>
	
	
	
	
	
</div>
<?php include 'includes/footer.php';?>