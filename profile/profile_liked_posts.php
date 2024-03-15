<?php
include("../path.php");
include(ROOT_PATH . "/app/controllers/users.php");

userOnly();
$userId = $_SESSION['id'];
$likedPosts = getLikedPostsByUser($userId);
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

    <title>Profile- Liked Posts</title>

</head>

<body>

    <?php include(ROOT_PATH . "/app/includes/header.php"); ?>
    <div class="profile-wrapper">
        <!-- Left Sidebar -->
        <?php include(ROOT_PATH . "/app/includes/profileSidebar.php"); ?>
        <!-- //Left Sidebar -->
        <div class="profile-content">
            <h3 class="page-title">Liked Posts</h3>
            <?php include(ROOT_PATH . "/app/includes/messages.php"); ?>
            <table>
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>Title</th>
                        <th>Author</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($likedPosts as $key => $post): ?>
                        <tr>
                            <td><?php echo $key + 1; ?></td>
                            <td><a href="<?php echo BASE_URL . '/single.php?id=' . $post['post_id']; ?>" class="likedposts"><?php echo $post['title']; ?></a></td>
                            <td><?php echo $post['username']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="../bootstrap/js/bootstrap.min.js"></script>

</body>

</html>
