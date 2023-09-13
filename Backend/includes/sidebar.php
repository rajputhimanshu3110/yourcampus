<ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion " id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" target="_blank" href="https://vitratech.herokuapp.com">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Vitratech </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Creators
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Team</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Option:</h6>
                    <?php 
                    if (role($_SESSION['email'])=='admin'||  role($_SESSION['email'])=='CreatorLead') {
                        
                    ?>
                        <a class="collapse-item" href="emregis.php">Team Registration</a>
                    <?php } ?>
                        <a class="collapse-item" href="employee.php">Current Team</a>
                        <a class="collapse-item" href="former.php">Former Members</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Courses</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Courses:</h6>
<?php 
if (role($_SESSION['email'])=='admin'||  role($_SESSION['email'])=='CreatorLead') {
    
?>                  

                        <a class="collapse-item" href="courses.php">Add Courses</a>

                        <h6 class="collapse-header">Semester:</h6>
                        <a class="collapse-item" href="addsemester.php">Add Semester</a>
                        <a class="collapse-item" href="semester.php">View Semester</a>
<?php } ?>                        
                        <h6 class="collapse-header">Subject: </h6>
                        <a class="collapse-item" href="addcontent.php">
                        Add Content
                        </a>
                        <a class="collapse-item" href="content.php">
                        View Content
                        </a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Verifier
            </div>

            
<?php 
if (role($_SESSION['email'])=='admin' || role($_SESSION['email'])=='CreatorLead' || role($_SESSION['email'])=='contentVerifier') {
 
?>
            <!-- Nav Item - villages -->
            <li class="nav-item">
                <a class="nav-link" href="review.php">
                    <i class="fas fa-fw fa-check"></i>
                    <span>Review</span></a>
            </li>
<?php }  ?>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->
           

        </ul>