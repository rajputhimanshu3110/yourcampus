<?php include 'includes/header.php'; 

$email = $_SESSION['email'];
$deltoken = "DELETE FROM passgenerator WHERE email='$email'";
$del = mysqli_query($connection,$query);



?>
    <!-- Begin Page Content -->
    <div class="container-fluid" style="background-image: url('');background-size: fit;">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <hr>
        </div>
        
        <!-- Content Row -->
        <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Semester</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo Sem_Count(); ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Team Members (Total)</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo Team_count(); ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-farm fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Courses
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo course_count(); ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-city fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

           
        </div>

    </div>
    <!-- /.container-fluid -->



<!-- Footer -->
<?php include 'includes/footer.php'; ?>