<?php include 'includes/header.php';?>
<div class="container-fluid">
	<h4 class="text-center">Change Password</h4>
	<hr>
<?php 
if (isset($_POST['submit'])) {
	$np = $_POST['newPassword'];
    $cp = $_POST['confirmPassword'];
    $email = $_SESSION['email'];
    if ($np==$cp) {
        $password = password_hash( $cp, PASSWORD_BCRYPT, array('cost' => 12));
    UpdatePass($email,$password);
	echo '<p class="text-success"> Password Updated</p>'; 
    }else{
        echo '<p class="text-danger">*Both Password Should be Same</p>';
        
    }
}
?>
<form action="" method="POST">
	<label>New Password :</label>
	<input type="password" name="newPassword" class="form-control mb-3 col-md-6">
	<label>Confirm Password :</label>
	<input type="text" name="confirmPassword" class="form-control mb-3 col-md-6">
	<input type="submit" name="submit" class="form-control btn btn-primary col-md-6">
</form>
	
</div>
<?php include 'includes/footer.php';?>