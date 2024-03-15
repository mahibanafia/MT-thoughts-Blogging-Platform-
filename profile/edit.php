<?php
include("../path.php");
include(ROOT_PATH . "/app/database/connect.php");
include(ROOT_PATH . "/app/controllers/users.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../bootstrap/css/font/bootstrap-icons.css">

    <!-- Custom Styling -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- Profile Styling -->
    <link rel="stylesheet" href="../assets/css/profile.css">

    <title>Edit Profile</title>

</head>

<body>

    <?php include(ROOT_PATH . "/app/includes/header.php"); ?>
    <div class="profile-wrapper">
        <!--Left Sidebar-->
        <?php include(ROOT_PATH . "/app/includes/profileSidebar.php"); ?>
        <!--//Left Sidebar-->
        <?php
        $q = mysqli_query($conn, "SELECT * FROM users WHERE username='$_SESSION[username]';");
        $row = mysqli_fetch_assoc($q);
        ?>
        <div class="profile-content">
            <div class="edit-profile">
                
                <form action="edit.php" method="post">
                <h3 class="page-title">Edit Information</h3>
                <?php include(ROOT_PATH . "/app/helpers/formErrors.php"); ?>
                    <div class="form-group">
                        <label for="new-username">New Username
                            <input type="checkbox" name="update-username" id="update-username">
                        </label>
                        <input type="text" name="new-username" value="<?php echo $row['username']; ?>"
                            class="text-input">

                    </div>
                    <div class="form-group">
                        <label for="old-password">Old Password</label>
                        <input type="password" name="old-password" class="text-input">
                    </div>
                    <div class="form-group">
                        <label for="new-password">New Password
                            <input type="checkbox" name="update-password" id="update-password">
                        </label>
                        <input type="password" name="new-password" class="text-input">

                    </div>
                    <div class="edit-button">
                        <button class="btn btn-big update-profile" type="submit" name="update-profile">Update</button>
                    </div>
                </form>
            </div>

        </div>

    </div>





    <script src="../bootstrap/js/bootstrap.min.js"></script>

</body>

</html>