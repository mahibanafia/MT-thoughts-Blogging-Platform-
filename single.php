<?php
include("path.php");
include(ROOT_PATH . "/app/controllers/posts.php");
include("server.php");
$post = null;
$comments = [];
if (isset($_GET['id'])) {
    $post = selectOne('posts', ['id' => $_GET['id']]);
    $user = selectOne('users', ['id' => $post['user_id']]);
    $author = $user['username'];
}
userOnly();
$topics = selectAll('topics');
$posts = selectAll('posts', ['published' => 1]);
$user_id = $_SESSION['id'];
$user = selectOne('users', ['id' => $user_id]);
$topLikedPosts = getTopLikedPosts(4);


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment'])) {
    $user_id = $_SESSION['id'];
    $post_id = $_GET['id']; // Assuming the post ID is in the URL

    $commentData = [
        'post_id' => $post_id,
        'user_id' => $user_id,
        'comment' => $_POST['comment']
    ];

    // Insert the comment into the database
    createComment($commentData);
    $_SESSION['message'] = 'Comment added successfully';
    $_SESSION['type'] = 'success';
    // Redirect back to the same page after adding the comment
    header("Location: single.php?id=" . $post_id);
    exit();
}
if ($post) {
    $comments = getCommentsByPostId($post['id']);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/css/font/bootstrap-icons.css">
    <script src="jquery.min.js"></script>


    <!-- Custom Styling -->
    <link rel="stylesheet" href="assets/css/style.css">

    <!--Comment and Like Styling-->
    <link rel="stylesheet" href="assets/css/commentLike.css">

    <title>
        <?php echo $post['title'] ?> | MTthoughts
    </title>

</head>

<body>

    <?php include(ROOT_PATH . "/app/includes/header.php"); ?>
    <?php include(ROOT_PATH . "/app/includes/messages.php"); ?>

    <!--Page Wrapper-->

    <div class="page-wrapper">


        <!--Content--->
        <div class="content clearfix">
            <!--Main Content Wrapper-->
            <div class="main-content-wrapper">
                <div class="main-content single">
                    <h1 class="post-title">
                        <?php echo $post['title'] ?>
                    </h1>
                    <img class="single-image" src="<?php echo BASE_URL . '/assets/images/' . $post['image'] ?>"
                        alt="Post Image">
                    <div class="post-content">
                        <span class="text-muted">
                            <i class="bi bi-person"></i>
                            <?php echo $author ?>
                        </span>
                        &nbsp;
                        <span class="text-muted">
                            <i class="bi bi-calendar"></i>
                            <?php echo date('F j, Y', strtotime($post['created_at'])) ?>
                        </span>
                        
                        <?php echo html_entity_decode($post['body']); ?>
                    </div>
                    <div class="post-separator"></div>
                    <!-- Like Section -->
                    <div class="like-section">
                        <!--Like button-->

                        <i <?php if (userLiked($post['id'], $user_id)): ?> class="bi bi-hand-thumbs-up-fill like-btn"
                            <?php else: ?> class="bi bi-hand-thumbs-up like-btn" <?php endif; ?>
                            data-id="<?php echo $post['id'] ?>"></i>
                        <span class="likes">
                            <?php echo getLikes($post['id']) ?>
                        </span>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <!--Disike button-->
                        <i <?php if (userDisliked($post['id'], $user_id)): ?>
                                class="bi bi-hand-thumbs-down-fill dislike-btn" <?php else: ?>
                                class="bi bi-hand-thumbs-down dislike-btn" <?php endif; ?>
                            data-id="<?php echo $post['id'] ?>"></i>
                        <span class="dislikes">
                            <?php echo getDisikes($post['id']) ?>
                        </span>
                    </div>
                    <!-- Comment Section -->
                    <div class="comment-section">
                        <h2>Comments</h2>
                        <?php foreach ($comments as $comment): ?>
                            <div class="comment">
                                <span class="comment-username">
                                    <?php echo $comment['username'] ?>:
                                </span>
                                <p class="comment-text">
                                    <?php echo $comment['comment'] ?>
                                </p>
                                <?php if ($comment['user_id'] === $user_id): ?>
                                    <a href="delete_comment.php?comment_id=<?php echo $comment['comment_id']; ?>"
                                        class="delete">Delete</a>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                        <div class="comment-form">
                            <h5>Add a Comment</h5>
                            <form action="" method="post">
                                <textarea class="comment-input" name="comment"
                                    placeholder="Write a Comment..."></textarea>
                                <button type="submit" class="btn btn-big">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--//Main Content Wrapper-->
            <!--Sidebar-->
            <div class="sidebar single">
                <div class="section popular">
                    <h3 class="section-title">Popular Posts</h3>
                    <?php foreach ($topLikedPosts as $p): ?>
                        <div class="post clearfix">
                            <img src="<?php echo BASE_URL . '/assets/images/' . $p['image'] ?>" alt="">
                            <a href="single.php?id=<?php echo $p['id'] ?>" class="title">
                                <h6>
                                    <?php echo $p['title'] ?>
                                </h6>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>


                <div class="section topics">
                    <h3 class="section-title">Categories</h3>
                    <ul>
                        <?php foreach ($topics as $topic): ?>
                            <li><a
                                    href="<?php echo BASE_URL . '/index.php?t_id=' . $topic['id'] . '&name=' . $topic['name'] ?>">
                                    <?php echo $topic['name'] ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <!--//Sidebar-->
        </div>
        <!--//Content--->
    </div>
    <!--//Page Wrapper-->



    <?php include(ROOT_PATH . "/app/includes/footer.php"); ?>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="script.js"></script>
    <script>
        var userId = <?php echo json_encode($_SESSION['id']); ?>;
    </script>

</body>

</html>