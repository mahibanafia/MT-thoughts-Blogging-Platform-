<?php
include("path.php");
include(ROOT_PATH . "/app/database/db.php");
$user_id = $_SESSION['id'];
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['comment_id'])) {
    $comment_id = $_GET['comment_id'];
    
    $comment = getCommentById($comment_id);
    
    if ($comment && $comment['user_id'] === $user_id) {
        
        deleteComment($comment_id);

        $_SESSION['message'] = 'Comment deleted successfully';
        $_SESSION['type'] = 'success';
        
        
        header("Location: single.php?id=" . $comment['post_id']);
        exit();
    } else {
       
        $_SESSION['message'] = 'You do not have permission to delete this comment';
        $_SESSION['type'] = 'error';
        

        header("Location: single.php?id=" . $comment['post_id']);
        exit();
    }
}
?>
