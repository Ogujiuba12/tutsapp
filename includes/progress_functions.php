<?php


function getProgress(){
	global $conn, $user_id;
	// Get single post slug
	$user_id = $_SESSION['user']['id'];
	$sql = "SELECT * FROM viewers WHERE user_id='$user_id' ";
	$result = mysqli_query($conn, $sql);

	// fetch query results as associative array.
	$post = mysqli_fetch_assoc($result);
	if ($post) {
		// get the topic to which this post belongs
		//$post['topic'] = getPostTopic($post['id']);
	}
	return $post;
}

function getAllProgress() {
	global $conn, $user_id;
    $user_id = $_SESSION['user']['id'];
	$sql = "SELECT DISTINCT doneTitle FROM viewers WHERE user_id='$user_id' ";
	$result = mysqli_query($conn, $sql);
	$progress = mysqli_fetch_all($result, MYSQLI_ASSOC);
	return $progress;
}

?>