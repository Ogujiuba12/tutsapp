<?php
// general variables
$errors = [];

function esc(String $value){
	// bring the global db connect object into function
	global $conn;
	// remove empty space sorrounding string
	$val = trim($value); 
	$val = mysqli_real_escape_string($conn, $value);
	return $val;
}

function getComments(){
	global $conn, $user_id;
	// Get single post slug
	$user_id = $_SESSION['user']['id'];
	$sql = "SELECT * FROM comments WHERE user_id='$user_id' ";
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
	$sql = "SELECT DISTINCT doneTitle FROM comments WHERE user_id='$user_id' ";
	$result = mysqli_query($conn, $sql);
	$progress = mysqli_fetch_all($result, MYSQLI_ASSOC);
	return $progress;
}

// if user clicks the create post button
if (isset($_POST['create_comment'])) { createComment($_POST); }

function createComment($request_values)
	{
		global $conn, $comment, $commenter, $post_slug;
		$comment = esc($request_values['comment']);
		$commenter = esc($request_values['commenter']);
		$post_slug = $_GET['post-slug'];
		
		if (empty($comment)) { array_push($errors, "A Comment is required"); }
		
		// create post if there are no errors in the form
		if (count($errors) == 0) {
			$query = "INSERT INTO comments (post_slug, user_id, comment) VALUES('$post_slug', '$commenter', '$comment')";
			if(mysqli_query($conn, $query)){ // if post created successfully
				$inserted_post_id = mysqli_insert_id($conn);
				
				$_SESSION['message'] = "Comment sent!!!";
				header('location: ./single_post.php');
				exit(0);
			}
		}
	}

?>