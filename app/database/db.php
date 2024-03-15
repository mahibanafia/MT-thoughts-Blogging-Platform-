<?php

session_start();
require('connect.php');


function executeQuery($sql, $data)
{
	global $conn;
	$stmt = $conn->prepare($sql);
	$values = array_values($data);
	$types = str_repeat('s', count($values));
	$stmt->bind_param($types, ...$values);
	$stmt->execute();
	return $stmt;
}

function selectAll($table, $conditions = [])
{
	global $conn;
	$sql = "SELECT * FROM $table";
	if (empty($conditions)) {
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		$records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
		return $records;
	} else {
        $sql .= " WHERE ";
        $i = 0;
        foreach ($conditions as $key => $value) {
            if ($i > 0) {
                $sql .= " AND ";
            }
            $sql .= "$key=?";
            $i++;
        }
		    
		$stmt = executeQuery($sql, $conditions);
		$records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
		return $records;

    }

}

function selectOne($table, $conditions)
{
	global $conn;
	$sql = "SELECT * FROM $table";
	$i = 0;
	foreach ($conditions as $key => $value) {
		if ($i === 0) {
			$sql = $sql . " WHERE $key=?";
		} else {
			$sql = $sql . "AND $key=?";
		}
		$i++;

	}
	$sql = $sql . " LIMIT 1";
	$stmt = executeQuery($sql, $conditions);
	$records = $stmt->get_result()->fetch_assoc();
	return $records;


}

function create($table, $data)
{
	global $conn;
	$keys = implode(',', array_keys($data));
	$placeholders = rtrim(str_repeat('?,', count($data)), ',');
	$sql = "INSERT INTO $table ($keys) VALUES ($placeholders)";
	$stmt = executeQuery($sql, $data);
	$id = $stmt->insert_id;
	return $id;
}


function update($table,$id,$data)
{
	global $conn;
	$sql = "UPDATE $table SET";

	$i=0;
	foreach($data as $key => $value) {
		if($i === 0){
			$sql = $sql . " $key=?";
		}
		else{
			$sql = $sql . ", $key=?";
		}
		$i++;

	}
	$sql = $sql . " WHERE id=?";
	$data[$id] = $id;
	$stmt = executeQuery($sql, $data);
	$id = $stmt->insert_id;
	return $stmt->affected_rows;

}
function deleteT($table,$id)
{
	global $conn;
	$sql = "DELETE FROM $table WHERE id=?";

	$stmt = executeQuery($sql, ['id' => $id ]);
	return $stmt->affected_rows;

}

function getPublishedPosts(){
	global $conn;
	$sql ="SELECT p.*, u.username
	 FROM posts AS p 
	 JOIN users AS u 
	 ON p.user_id=u.id 
	 WHERE published=?";
	$stmt = executeQuery($sql, ['published' => 1]);
	$records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
	return $records;

}
function searchPosts($term){
	global $conn;
	$sql ="SELECT p.*, u.username, t.name as topic_name
	FROM posts AS p
	JOIN users AS u ON p.user_id = u.id
	JOIN topics AS t ON p.topic_id = t.id
	WHERE p.published = ?
	AND (p.title LIKE CONCAT('%', ?, '%')
	OR p.body LIKE CONCAT('%', ?, '%')
	OR u.username LIKE ?
	OR t.name LIKE CONCAT('%', ?, '%'))";
	$stmt = executeQuery($sql, ['published' => 1,'title' => $term,'body'=>$term, 'username' => $term, 'topic_name'=>$term ]);
	$records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
	return $records;

}

function getPostsByTopic($topic_id){
	global $conn;
	$sql ="SELECT p.*, u.username
	 FROM posts AS p 
	 JOIN users AS u 
	 ON p.user_id=u.id
	 WHERE published=? AND topic_id=?";
	$stmt = executeQuery($sql, ['published' => 1, 'topic_id' =>$topic_id]);
	$records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
	return $records;

}
function getPostsByUserId($userId) {
    global $conn;

    $sql = "SELECT * FROM posts WHERE user_id = ?"; 
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    $posts = array();
    while ($row = $result->fetch_assoc()) {
        $posts[] = $row;
    }

    return $posts;
}

//Comments

function createComment($data) {
    return create('comments', $data);
}

function getCommentsByPostId($postId) {
    global $conn;

    $sql = "SELECT c.comment_id, c.comment, c.user_id, u.username
            FROM comments c
            JOIN users u ON c.user_id = u.id
            WHERE c.post_id = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $postId);
    $stmt->execute();
    $result = $stmt->get_result();

    $comments = array();
    while ($row = $result->fetch_assoc()) {
        $comments[] = $row;
    }

    return $comments;
}

function getCommentById($comment_id) {
    global $conn;
    $sql = "SELECT * FROM comments WHERE comment_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $comment_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

// Delete a comment by its ID
function deleteComment($comment_id) {
    global $conn;
    $sql = "DELETE FROM comments WHERE comment_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $comment_id);
    $stmt->execute();
}

//Trending Posts 
function getTopLikedPosts($limit) {
    global $conn;

    $sql = "SELECT p.*, u.username, r.like_count
	FROM posts p
	JOIN users u ON p.user_id = u.id
	LEFT JOIN (
		SELECT post_id, COUNT(*) AS like_count
		FROM rating_info
		WHERE rating_action = 'like'
		GROUP BY post_id
	) r ON p.id = r.post_id
	WHERE p.published = 1
	ORDER BY r.like_count DESC, p.created_at DESC
	LIMIT ?;
	";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $limit);
    $stmt->execute();
    $result = $stmt->get_result();

    $topLikedPosts = array();
    while ($row = $result->fetch_assoc()) {
        $topLikedPosts[] = $row;
    }

    return $topLikedPosts;
}

//Recent Posts 
function getRecentPosts($limit = 4) {
    global $conn;

    $sql = "SELECT p.*, u.username
            FROM posts p
            JOIN users u ON p.user_id = u.id
            WHERE p.published = 1
            ORDER BY p.created_at DESC
            LIMIT ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $limit);
    $stmt->execute();
    $result = $stmt->get_result();

    $recentPosts = array();
    while ($row = $result->fetch_assoc()) {
        $recentPosts[] = $row;
    }

    return $recentPosts;
}


//Profile Liked Posts

//liked posts by user ID
function getLikedPostsByUser($user_id) {
    global $conn;

    $sql = "SELECT p.id AS post_id, p.title, u.username
            FROM rating_info r
            JOIN posts p ON r.post_id = p.id
            JOIN users u ON p.user_id = u.id
            WHERE r.user_id = ? AND r.rating_action = 'like'";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $likedPosts = array();
    while ($row = $result->fetch_assoc()) {
        $likedPosts[] = $row;
    }

    return $likedPosts;
}

//dashboard page 

function getTotalUsersCount() {
    global $conn;

    $sql = "SELECT COUNT(*) as count FROM users";
    $result = $conn->query($sql);
    $count = $result->fetch_assoc()['count'];
    return $count;
}

function getTotalAdminUsersCount() {
    global $conn;

    $sql = "SELECT COUNT(*) as count FROM users WHERE admin = 1";
    $result = $conn->query($sql);
    $count = $result->fetch_assoc()['count'];
    return $count;
}

function getTotalPostsCount() {
    global $conn;

    $sql = "SELECT COUNT(*) as count FROM posts WHERE published = 1 ";
    $result = $conn->query($sql);
    $count = $result->fetch_assoc()['count'];
    return $count;
}

function getTotalTopicsCount() {
    global $conn;

    $sql = "SELECT COUNT(*) as count FROM topics";
    $result = $conn->query($sql);
    $count = $result->fetch_assoc()['count'];
    return $count;
}








