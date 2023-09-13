<?php include 'includes/header.php';

if (role($_SESSION['email'])!='admin' && role($_SESSION['email'])!='CreatorLead') {
	redirect('index.php');
}
?>

<div class="container-fluid">
	<h4 class="text-center">Add Member</h4>
	<hr>
	<form action="includes/mail.php" method="POST">
	  <div class="form-group col-md-6">
	    <label for="usermail">Email address</label>
	    <input type="email" class="form-control" name="usermail" placeholder="Enter email" required>
	  </div>
	  <div class="form-group col-md-6">
	    <label for="cmail">College Email address</label>
	    <input type="email" class="form-control" name="cmail" placeholder="Enter email" required>
	  </div>
	  <div class="form-group col-md-6">
	    <label for="name">Name</label>
	    <input type="text" class="form-control" name="name" placeholder="Name" required>
	  </div>
	  <div class="form-group col-md-6">
	    <label for="name">Position</label>
	    <input type="text" class="form-control" name="pos" placeholder="Position" required>
	  </div>
	  <div class="form-group col-md-6">
	    <label for="name">Batch</label>
	    <input type="text" class="form-control" name="batch" placeholder="Batch" required>
	  </div>
	  <div class="form-group col-md-6">
	    <label for="name">User Role</label>
	    <select  class="form-control" name="role" required>
<?php
	if (role($_SESSION['email'])!='CreatorLead') {
	echo "<option value='admin'>Admin</option>
	    	<option value='CreatorLead'>Creator Lead</option>
	    	<option value='contentCreator'>Content Creator</option>
	    	<option value='contentVerifier'>Content Verifier</option>";
}else{
	echo "<option value='contentCreator'>Content Creator</option>
	    	<option value='contentVerifier'>Content Verifier</option>";
}
?>
	    	
	    </select>
	  </div>
	  <div class="col-md-6">
	  	<button type="submit" id="empregis-btn" name="submit" class="col-md-6 btn btn-primary">Submit</button>
	  </div>  
	</form>
	
</div>
<?php include 'includes/footer.php';?>