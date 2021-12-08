<?php

// if user clicks the create post button
if (isset($_POST['create_quiz'])) { createQuiz($_POST); }

function getPost(){
	global $conn;
	// Get single post slug
	$post_slug = $_GET['id'];
	$sql = "SELECT * FROM quizzes WHERE post_id='$post_slug' ";
	$result = mysqli_query($conn, $sql);

	// fetch query results as associative array.
	$post = mysqli_fetch_assoc($result);
	if ($post) {
		// get the topic to which this post belongs
		//$post['topic'] = getPostTopic($post['id']);
	}
	return $post;
}

function createQuiz($request_values)
	{
		global $conn, $answer;
		$answer = esc($request_values['answer']);
		
		if (empty($answer)) { array_push($errors, "Answer is required"); }
		
		// create post if there are no errors in the form
		if (count($errors) == 0) {
			$query = "INSERT INTO quizzes (answer) VALUES('$answer')";
			if(mysqli_query($conn, $query)){ // if post created successfully
				$inserted_post_id = mysqli_insert_id($conn);
				
				$_SESSION['message'] = "Answered submitted successfully";
				header('location: ./single_post.php');
				exit(0);
			}
		}
	}

?>