<?php
include("../../path.php");
?>
<?php include(ROOT_PATH . "/app/controllers/posts.php"); 
adminOnly();
?>
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

    <title>Admin Section - Edit Posts</title>

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
                <a href="create_posts.php" class="btn btn-big">Add Post</a>
                <a href="index_posts.php" class="btn btn-big">Manage Posts</a>
            </div>
            <div class="content">
                <h3 class="page-title">Edit Post</h3>
                <?php include(ROOT_PATH . "/app/helpers/formErrors.php"); ?>
                <form action="edit.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $id ?>">
                    <div>
                        <label>Title</label>
                        <input type="text" name="title" value="<?php echo $title ?>" class="text-input">
                    </div>
                    <div>
                        <label>Body</label>
                        <textarea name="body" id="body"><?php echo $body ?></textarea>
                    </div>
                    <div>
                        <label>Image</label>
                        <input type="file" name="image" class="text-input">
                    </div>
                    <div>
                        <label>Category</label>
                        <select name="topic_id" class="text-input">
                            <option value=""></option>
                            <?php foreach ($topics as $key => $topic): ?>
                                <?php if (!empty($topic_id) && $topic_id == $topic['id']): ?>
                                    <option selected value="<?php echo $topic['id'] ?>"><?php echo $topic['name'] ?></option>
                                <?php else: ?>
                                    <option value="<?php echo $topic['id'] ?>"><?php echo $topic['name'] ?></option>
                                <?php endif; ?>

                            <?php endforeach; ?>

                        </select>
                    </div>
                    <div>
                        <?php if (empty($published) && $published ==0): ?>
                            <label>
                                <input type="checkbox" name="published">
                                Publish

                            </label>

                        <?php else: ?>
                            <label>
                                <input type="checkbox" name="published" checked>
                                Publish

                            </label>
                        <?php endif; ?>

                    </div>
                    <div>
                        <button type="submit" name="update-post" class="btn btn-big">Update</button>
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
                toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'imageUpload', 'mediaEmbed'],
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }
                    ]
                },
                // Configuration for image upload
                image: {
                    toolbar: ['imageTextAlternative', '|', 'imageStyle:alignLeft', 'imageStyle:full', 'imageStyle:alignRight'],
                    styles: [
                        'full',
                        'alignLeft',
                        'alignRight'
                    ]
                },
                // Configuration for media (video) embed
                mediaEmbed: {
                    previewsInData: true
                }
            })
            .catch(error => {
                console.log(error);
            });

    </script>

    <script src="../../bootstrap/js/bootstrap.min.js"></script>

</body>

</html>