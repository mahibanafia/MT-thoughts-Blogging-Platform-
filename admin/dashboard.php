<?php
include("../path.php");
?>
<?php include(ROOT_PATH . "/app/controllers/posts.php"); 
adminOnly();?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../bootstrap/css/font/bootstrap-icons.css">

    <!-- Custom Styling -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- Admin Styling -->
    <link rel="stylesheet" href="../assets/css/admin.css">

    <title>Admin Section - Dashboard</title>

</head>

<body>

    <?php include(ROOT_PATH . "/app/includes/adminHeader.php"); ?>

    <!--Admin Page Wrapper-->

    <div class="admin-wrapper">
        <!--Left Sidebar-->
        <?php include(ROOT_PATH . "/app/includes/adminSidebar.php"); ?>
        <!--//Left Sidebar-->
        <!--Admin Content-->
        <div class="admin-content">
            <div class="content">
                <h3 class="page-title">Dashboard</h3>
                <?php include(ROOT_PATH . "/app/includes/messages.php"); ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="dashboard-box">
                            <h5 class="dash-title">Total Number of Users</h5>
                            <h4 class="dash-count"><?php echo getTotalUsersCount(); ?></h4>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="dashboard-box">
                            <h5 class="dash-title">Total Number of Admin Users</h5>
                            <h4 class="dash-count"><?php echo getTotalAdminUsersCount(); ?><h4>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="dashboard-box">
                            <h5 class="dash-title">Total Number of Posts</h5>
                            <h4 class="dash-count"><?php echo getTotalPostsCount(); ?></h4>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="dashboard-box">
                            <h5 class="dash-title">Total Number of Topics</h5>
                            <h4 class="dash-count"><?php echo getTotalTopicsCount(); ?></h4>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!--//Admin Content-->
    </div>
    <!--//Admin Page Wrapper-->


    <script src="../bootstrap/js/bootstrap.min.js"></script>

</body>

</html>