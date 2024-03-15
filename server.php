<?php
$conn = mysqli_connect('localhost','root','','blog');

//LIKE AND COMMENT 
if (isset($_POST['action'])) {
    $post_id = $_POST['post_id'];
    $action = $_POST['action'];
    $user_id = $_POST['user_id'];

    switch ($action) {
        case 'like':
            $sql = "INSERT INTO rating_info (post_id,user_id,rating_action)
            VALUES ('$post_id','$user_id','$action')
            ON DUPLICATE KEY UPDATE rating_action='like'";
            break;
        case 'dislike':
            $sql = "INSERT INTO rating_info (post_id,user_id,rating_action)
                VALUES ('$post_id','$user_id','$action')
                ON DUPLICATE KEY UPDATE rating_action='dislike'";
            break;
        case 'unlike':
            $sql = "DELETE FROM rating_info WHERE user_id=$user_id AND post_id=$post_id";
            break;
        case 'undislike':
            $sql = "DELETE FROM rating_info WHERE user_id=$user_id AND post_id=$post_id";
            break;
        default:
            break;

    }
    mysqli_query($conn,$sql);
    //return number of likes
    echo getRating($post_id);
    exit();
}


function getRating($id)
{
    global $conn;
    $rating = array();

    $likes_query = "SELECT COUNT(*) FROM rating_info WHERE post_id = $id AND rating_action='like'";
    $dislikes_query = "SELECT COUNT(*) FROM rating_info WHERE post_id = $id AND rating_action='dislike'";

    $likes_rs=mysqli_query($conn,$likes_query);
    $dislikes_rs=mysqli_query($conn,$dislikes_query);

    $likes=mysqli_fetch_array($likes_rs);
    $dislikes=mysqli_fetch_array($dislikes_rs);

    $rating = [
        'likes' => $likes[0],
        'dislikes' => $dislikes[0]
    ];
    return json_encode($rating);
}
//total no. of likes for a post
function getLikes($id){
    global $conn;
    $sql = "SELECT COUNT(*) FROM rating_info
     WHERE post_id =$id AND rating_action='like'";
    $rs = mysqli_query($conn,$sql);
    $result = mysqli_fetch_array($rs);
    return $result[0];
}
//total no of dislikes for a post
function getDisikes($id){
    global $conn;
    $sql = "SELECT COUNT(*) FROM rating_info
     WHERE post_id =$id AND rating_action='dislike'";
    $rs = mysqli_query($conn,$sql);
    $result = mysqli_fetch_array($rs);
    return $result[0];
}
//checking if user liked or not
function userLiked($post_id,$user_id){
    global $conn;
    $sql = "SELECT * FROM rating_info WHERE user_id=$user_id 
    AND post_id=$post_id AND rating_action='like'";
    $result =mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)>0){
        return true;
    }
    else{
        false;
    }
}

function userDisliked($post_id,$user_id){
    global $conn;
    $sql = "SELECT * FROM rating_info WHERE user_id=$user_id 
    AND post_id=$post_id AND rating_action='dislike'";
    $result =mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)>0){
        return true;
    }
    else{
        false;
    }
}

?>