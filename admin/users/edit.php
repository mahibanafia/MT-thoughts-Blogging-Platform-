<?php
include("../../path.php");
?>
<?php include(ROOT_PATH . "/app/controllers/users.php"); 
adminOnly();?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../bootstrap/css/font/bootstrap-icons.css">

    <!-- Custom Styling -->
    <link rel="stylesheet" href="../../assets/css/style.css">
    <!-- Admin Styling -->
    <link rel="stylesheet" href="../../assets/css/admin.css">

    <title>Admin Section - Edit User</title>

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
            <div class="button-group">
                <a href="create_users.php" class="btn btn-big">Add User</a>
                <a href="index_users.php" class="btn btn-big">Manage Users</a>
            </div>
            <div class="content">
                <h3 class="page-title">Edit User</h3>
                <?php include(ROOT_PATH . "/app/helpers/formErrors.php"); ?>
                <form action="edit.php" method="post">
                <input type="hidden" name="id" value=<?php echo $id ?>>
                <div>
                        <label>Username</label>
                        <input type="text" name="username" value="<?php echo $username ?>" class="text-input">
                    </div>
                    <div>
                        <label>Email</label>
                        <input type="email" name="email" value="<?php echo $email ?>" class="text-input">
                    </div>
                    <div>
                        <label>Password</label>
                        <input type="password" name="password" value="<?php echo $password ?>" class="text-input">
                    </div>
                    <div>
                        <label>Password Confirmation</label>
                        <input type="password" name="passwordConf" value="<?php echo $passwordConf ?>"
                            class="text-input">
                    </div>
                    <div>
                        <?php if (isset($admin)&& $admin == 1): ?>
                            <label>
                                <input type="checkbox" name="admin" checked>
                                Admin
                            </label>
                        <?php else: ?>
                            <label>
                                <input type="checkbox" name="admin">
                                Admin
                            </label>
                        <?php endif; ?>

                    </div>
                    <div>
                        <button type="submit" name="update-user" class="btn btn-big">Update</button>
                    </div>
                </form>

            </div>

        </div>
        <!--//Admin Content-->
    </div>
    <!--//Admin Page Wrapper-->

    <!--CkEditor-->
    <script src="../../ckeditor5/ckeditor.js"></script>
    <!--//CkEditor-->

    <script>
        ClassicEditor
            .create(document.querySelector('#body'), {
                toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote'],
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }
                    ]
                }
            })
            .catch(error => {
                console.log(error);
            });

    </script>
    <script src="../../bootstrap/js/bootstrap.min.js"></script>

</body>

</html>