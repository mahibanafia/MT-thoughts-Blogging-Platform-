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

    <title>Profile</title>

</head>

<body>

    <?php include(ROOT_PATH . "/app/includes/header.php"); ?>
    <div class="profile-wrapper">
        <!--Left Sidebar-->
        <?php include(ROOT_PATH . "/app/includes/profileSidebar.php"); ?>
        <!--//Left Sidebar-->
        <div class="profile-content">
        <?php include(ROOT_PATH . "/app/includes/messages.php"); ?>
            <div class="info-wrapper">
                <?php
                $q = mysqli_query($conn, "SELECT * FROM users
                 WHERE username='$_SESSION[username]';");
                ?>
                <?php
                $row = mysqli_fetch_assoc($q);
                echo "<div class='user-img'>
                 <img class='img-circle profile-img' src='../assets/images/profile.png' alt='...'>
                 </div>";
                ?>
                <?php
                echo '<div style="text-align: center;"><h5 style="display: inline;">Hi ' . $_SESSION['username'] . '!</h5></div>';

                ?>
                <?php
                echo "<strong>";
                echo "<table class='table' table-bordered>";

                echo "<tr>";
                echo "<td>";
                echo "<strong>Username: </strong>";
                echo "</td>";

                echo "<td>";
                echo $row['username'];
                echo "</td>";
                echo "</tr>";

                echo "<tr>";
                echo "<td>";
                echo "<strong>Email: </strong>";
                echo "</td>";

                echo "<td>";
                echo $row['email'];
                echo "</td>";
                echo "</tr>";

                echo "</table>";
                echo "</strong>";
                ?>
                <div class="edit-button">
                    <form action="../profile/edit.php" method="post">
                        <button class="btn btn-big">Update Profile</button>
                    </form>
                </div>
            </div>

        </div>

    </div>





    <script src="../bootstrap/js/bootstrap.min.js"></script>

</body>

</html>