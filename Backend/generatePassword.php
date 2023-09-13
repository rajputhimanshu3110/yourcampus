<?php include 'includes/head1.php'; ?>
<body class="bg-gradient-primary">
<?php 
$status = 0;
$msg='';

if (isLoggedIn()) {
    echo '<h1 class"" style="color:white">You are already Logged IN</h1>';
}else{


if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $query = "SELECT * FROM passgenerator WHERE token = '$token'";
    $result = mysqli_query($connection,$query);
    confirmQuery($result);
   
        
    
    $row = mysqli_fetch_assoc($result);

    $email = $row['email'];

    $query1 = "SELECT * FROM users WHERE email = '$email'";
    $result1 = mysqli_query($connection,$query1);
    confirmQuery($result1);

    $row1 = mysqli_fetch_assoc($result1);
    
    $name= $row1['name'];
    }



if(isset($_POST['submit'])){
    $np = $_POST['newPassword'];
    $cp = $_POST['confirmPassword'];
    if ($np==$cp) {
        $password = password_hash( $cp, PASSWORD_BCRYPT, array('cost' => 12));
        if (UpdatePass($email,$password)) {
        deleteToken($token);
        redirect("login.php");
        }  
    }else{
        $msg = "*Both Password Should be Same";
        $status = 0;
    }
}
?>
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Hi, <?php echo $name; ?> </h1>
                                        
                                    </div>
                             <form class="user" action="" method="POST">
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                name="newPassword" aria-describedby="emailHelp"
                                                placeholder="Enter New Password...">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                name="confirmPassword" aria-describedby="emailHelp"
                                                placeholder="Confirm Password">
                                        </div>
                                        <button type="submit" name="submit" class="btn btn-primary btn-user btn-block">
                                            Reset Password
                                        </button>
                                    </form>
                                      <?php
                if ($status==0) {
                    echo "<p class='text-danger pt-2 text-center'>".$msg."</p>";
                } }
                ?>
                     
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>