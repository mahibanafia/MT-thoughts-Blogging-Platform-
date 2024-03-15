<?php
include("../path.php"); ?>
<?php include(ROOT_PATH . "/app/controllers/posts.php");
userOnly(); ?>
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

    <title>Profile- Write a Blog</title>

</head>

<body>

    <?php include(ROOT_PATH . "/app/includes/header.php"); ?>
    <div class="profile-wrapper">
        <!--Left Sidebar-->
        <?php include(ROOT_PATH . "/app/includes/profileSidebar.php"); ?>
        <!--//Left Sidebar-->
        <div class="profile-content">
            <div class="content">
                <h3 class="page-title">Write a Blog Post</h3>
                <?php include(ROOT_PATH . "/app/helpers/formErrors.php"); ?>
                <form action="profile_create.php" method="post" enctype="multipart/form-data">
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
                        <?php if (empty($published)): ?>
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
                    <div class="add-btn">
                        <button type="submit" name="add-post" class="btn btn-big">Add</button>
                    </div>
                </form>

            </div>

        </div>

    </div>

    <!--CkEditor-->
    <script src="../ckeditor5/ckeditor.js"></script>
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







    <script src="../bootstrap/js/bootstrap.min.js"></script>

</body>

</html>