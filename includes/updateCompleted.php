<?php
// register topic if there are no errors in the form
        $user_id = $_SESSION['user']['id'];
        
        if(isset($_POST['title'])){
            $title = $_POST['title'];
            $query = "INSERT INTO viewers (doneTitle, completedCourse, user_id, created_at)
                    VALUES ('$title', TRUE, '$user_id', now())";
			
			if(mysqli_query($conn, $query)){ 
				if (isset($completed)) {
                    $sql = "UPDATE viewers SET updated_at=now() WHERE doneTitle=$title";
                    mysqli_query($conn, $sql);
                }
            }
            exit;
        }
		
    
    
        ?>
