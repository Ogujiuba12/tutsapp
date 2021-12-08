<?php 

/* - - - - - - - - - - - -
-  Admin users functions
- - - - - - - - - - - - -*/
/* * * * * * * * * * * * * * * * * * * * * * *
* - Receives new admin data from form
* - Create new admin user
* - Returns all admin users with their roles 
* * * * * * * * * * * * * * * * * * * * * * */
function createAdmin($request_values){
	global $conn, $errors, $role, $username, $email;
	$username = esc($request_values['username']);
	$email = esc($request_values['email']);
	$password = esc($request_values['password']);
	$passwordConfirmation = esc($request_values['passwordConfirmation']);

	if(isset($request_values['role'])){
		$role = esc($request_values['role']);
	}
	// form validation: ensure that the form is correctly filled
	if (empty($username)) { array_push($errors, "Uhmm...We gonna need the username"); }
	if (empty($email)) { array_push($errors, "Oops.. Email is missing"); }
	if (empty($role)) { array_push($errors, "Role is required for admin users");}
	if (empty($password)) { array_push($errors, "uh-oh you forgot the password"); }
	if ($password != $passwordConfirmation) { array_push($errors, "The two passwords do not match"); }
	// Ensure that no user is registered twice. 
	// the email and usernames should be unique
	$user_check_query = "SELECT * FROM users WHERE username='$username' 
							OR email='$email' LIMIT 1";
	$result = mysqli_query($conn, $user_check_query);
	$user = mysqli_fetch_assoc($result);
	if ($user) { // if user exists
		if ($user['username'] === $username) {
		  array_push($errors, "Username already exists");
		}

		if ($user['email'] === $email) {
		  array_push($errors, "Email already exists");
		}
	}
	// register user if there are no errors in the form
	if (count($errors) == 0) {
		$password = md5($password);//encrypt the password before saving in the database
		$query = "INSERT INTO users (username, email, role, password, created_at, updated_at) 
				  VALUES('$username', '$email', '$role', '$password', now(), now())";
		mysqli_query($conn, $query);

		$_SESSION['message'] = "Admin user created successfully";
		header('location: users.php');
		exit(0);
	}
}
/* * * * * * * * * * * * * * * * * * * * *
* - Takes admin id as parameter
* - Fetches the admin from database
* - sets admin fields on form for editing
* * * * * * * * * * * * * * * * * * * * * */
function editAdmin($admin_id)
{
	global $conn, $username, $role, $isEditingUser, $admin_id, $email;

	$sql = "SELECT * FROM users WHERE id=$admin_id LIMIT 1";
	$result = mysqli_query($conn, $sql);
	$admin = mysqli_fetch_assoc($result);

	// set form values ($username and $email) on the form to be updated
	$username = $admin['username'];
	$email = $admin['email'];
}

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * 
* - Receives admin request from form and updates in database
* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
function updateAdmin($request_values){
	global $conn, $errors, $role, $username, $isEditingUser, $admin_id, $email;
	// get id of the admin to be updated
	$admin_id = $request_values['admin_id'];
	// set edit state to false
	$isEditingUser = false;


	$username = esc($request_values['username']);
	$email = esc($request_values['email']);
	$password = esc($request_values['password']);
	$passwordConfirmation = esc($request_values['passwordConfirmation']);
	if(isset($request_values['role'])){
		$role = $request_values['role'];
	}
	// register user if there are no errors in the form
	if (count($errors) == 0) {
		//encrypt the password (security purposes)
		$password = md5($password);

		$query = "UPDATE users SET username='$username', email='$email', role='$role', password='$password' WHERE id=$admin_id";
		mysqli_query($conn, $query);

		$_SESSION['message'] = "Admin user updated successfully";
		header('location: users.php');
		exit(0);
	}
}
// delete admin user 
function deleteAdmin($admin_id) {
	global $conn;
	$sql = "DELETE FROM users WHERE id=$admin_id";
	if (mysqli_query($conn, $sql)) {
		$_SESSION['message'] = "User successfully deleted";
		header("location: users.php");
		exit(0);
	}
}

// Admin user variables
$admin_id = 0;
$isEditingUser = false;
$username = "";
$role = "";
$email = "";
// general variables
$errors = [];

/* - - - - - - - - - - 
-  Admin users actions
- - - - - - - - - - -*/
// if user clicks the create admin button
if (isset($_POST['create_admin'])) {
	createAdmin($_POST);
}
// if user clicks the Edit admin button
if (isset($_GET['edit-admin'])) {
	$isEditingUser = true;
	$admin_id = $_GET['edit-admin'];
	editAdmin($admin_id);
}
// if user clicks the update admin button
if (isset($_POST['update_admin'])) {
	updateAdmin($_POST);
}
// if user clicks the Delete admin button
if (isset($_GET['delete-admin'])) {
	$admin_id = $_GET['delete-admin'];
	deleteAdmin($admin_id);
}


/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * 
* - Returns all admin users and their corresponding roles
* * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
function getAdminUsers(){
	global $conn, $roles;
	$sql = "SELECT * FROM users WHERE role IS NOT NULL";
	$result = mysqli_query($conn, $sql);
	$users = mysqli_fetch_all($result, MYSQLI_ASSOC);

	return $users;
}
/* * * * * * * * * * * * * * * * * * * * *
* - Escapes form submitted value, hence, preventing SQL injection
* * * * * * * * * * * * * * * * * * * * * */
function esc(String $value){
	// bring the global db connect object into function
	global $conn;
	// remove empty space sorrounding string
	$val = trim($value); 
	$val = mysqli_real_escape_string($conn, $value);
	return $val;
}
// Receives a string like 'Some Sample String'
// and returns 'some-sample-string'
function makeSlug(String $string){
	$string = strtolower($string);
	$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
	return $slug;
}
?>

<?php 

// Admin user variables
// ... varaibles here ...

// Topics variables
$topic_id = 0;
$isEditingTopic = false;
$topic_name = "";

/* - - - - - - - - - - 
-  Admin users actions
- - - - - - - - - - -*/
// ... 

/* - - - - - - - - - - 
-  Topic actions
- - - - - - - - - - -*/
// if user clicks the create topic button
if (isset($_POST['create_topic'])) { createTopic($_POST); }
// if user clicks the Edit topic button
if (isset($_GET['edit-topic'])) {
	$isEditingTopic = true;
	$topic_id = $_GET['edit-topic'];
	editTopic($topic_id);
}
// if user clicks the update topic button
if (isset($_POST['update_topic'])) {
	updateTopic($_POST);
}
// if user clicks the Delete topic button
if (isset($_GET['delete-topic'])) {
	$topic_id = $_GET['delete-topic'];
	deleteTopic($topic_id);
}


/* - - - - - - - - - - - -
-  Admin users functions
- - - - - - - - - - - - -*/
// ...

/* - - - - - - - - - - 
-  Topics functions
- - - - - - - - - - -*/
// get all topics from DB
function getAllTopics() {
	global $conn;
	$sql = "SELECT * FROM topics";
	$result = mysqli_query($conn, $sql);
	$topics = mysqli_fetch_all($result, MYSQLI_ASSOC);
	return $topics;
}
function createTopic($request_values){
	global $conn, $errors, $topic_name;
	$topic_name = esc($request_values['topic_name']);
	$category_id = esc($request_values['category_id']);
	// create slug: if topic is "Life Advice", return "life-advice" as slug
	$topic_slug = makeSlug($topic_name);
	// validate form
	if (empty($topic_name)) { 
		array_push($errors, "Topic name required"); 
	}
	// Ensure that no topic is saved twice. 
	$topic_check_query = "SELECT * FROM topics WHERE slug='$topic_slug' LIMIT 1";
	$result = mysqli_query($conn, $topic_check_query);
	if (mysqli_num_rows($result) > 0) { // if topic exists
		array_push($errors, "Topic already exists");
	}
	// register topic if there are no errors in the form
	if (count($errors) == 0) {
		$query = "INSERT INTO topics (name, slug, category_id) 
				  VALUES('$topic_name', '$topic_slug', '$category_id')";
		mysqli_query($conn, $query);

		$_SESSION['message'] = "Topic created successfully";
		header('location: topics.php');
		exit(0);
	}
}
/* * * * * * * * * * * * * * * * * * * * *
* - Takes topic id as parameter
* - Fetches the topic from database
* - sets topic fields on form for editing
* * * * * * * * * * * * * * * * * * * * * */
function editTopic($topic_id) {
	global $conn, $topic_name, $isEditingTopic, $topic_id;
	$sql = "SELECT * FROM topics WHERE id=$topic_id LIMIT 1";
	$result = mysqli_query($conn, $sql);
	$topic = mysqli_fetch_assoc($result);
	// set form values ($topic_name) on the form to be updated
	$topic_name = $topic['name'];
}
function updateTopic($request_values) {
	global $conn, $errors, $topic_name, $topic_id;
	$topic_name = esc($request_values['topic_name']);
	$topic_id = esc($request_values['topic_id']);
	// create slug: if topic is "Life Advice", return "life-advice" as slug
	$topic_slug = makeSlug($topic_name);
	// validate form
	if (empty($topic_name)) { 
		array_push($errors, "Topic name required"); 
	}
	// register topic if there are no errors in the form
	if (count($errors) == 0) {
		$query = "UPDATE topics SET name='$topic_name', slug='$topic_slug' WHERE id=$topic_id";
		mysqli_query($conn, $query);

		$_SESSION['message'] = "Topic updated successfully";
		header('location: topics.php');
		exit(0);
	}
}
// delete topic 
function deleteTopic($topic_id) {
	global $conn;
	$sql = "DELETE FROM topics WHERE id=$topic_id";
	if (mysqli_query($conn, $sql)) {
		$_SESSION['message'] = "Topic successfully deleted";
		header("location: topics.php");
		exit(0);
	}
}

function user_count(){
	global $conn, $rowcount;
$sql = "SELECT * from users";

if ($result = mysqli_query($conn, $sql)) {

    // Return the number of rows in result set
    $rowcount = mysqli_num_rows( $result );
    
	//return $rowcount;
    // Display result
   // printf("Total rows in this table :  %d\n", $rowcount);
 }
}

function post_count(){
	global $conn, $rowcount;
$sql = "SELECT * from posts";

if ($result = mysqli_query($conn, $sql)) {

    // Return the number of rows in result set
    $rowcount = mysqli_num_rows( $result );
    
	//return $rowcount;
    // Display result
   // printf("Total rows in this table :  %d\n", $rowcount);
 }
}

function comment_count(){
	global $conn, $rowcount;
$sql = "SELECT * from comments";

if ($result = mysqli_query($conn, $sql)) {

    // Return the number of rows in result set
    $rowcount = mysqli_num_rows( $result );
    
	//return $rowcount;
    // Display result
   // printf("Total rows in this table :  %d\n", $rowcount);
 }
}

?>



<?php 
// Admin user variables
// ... varaibles here ...

// categories variables
$category_id = 0;
$isEditingcategory = false;
$category_name = "";

/* - - - - - - - - - - 
-  Admin users actions
- - - - - - - - - - -*/
// ... 

/* - - - - - - - - - - 
-  category actions
- - - - - - - - - - -*/
// if user clicks the create category button
if (isset($_POST['create_category'])) { createcategory($_POST); }
// if user clicks the Edit category button
if (isset($_GET['edit-category'])) {
	$isEditingcategory = true;
	$category_id = $_GET['edit-category'];
	editcategory($category_id);
}
// if user clicks the update category button
if (isset($_POST['update_category'])) {
	updatecategory($_POST);
}
// if user clicks the Delete category button
if (isset($_GET['delete-category'])) {
	$category_id = $_GET['delete-category'];
	deletecategory($category_id);
}


/* - - - - - - - - - - - -
-  Admin users functions
- - - - - - - - - - - - -*/
// ...

/* - - - - - - - - - - 
-  categories functions
- - - - - - - - - - -*/
// get all categories from DB
function getAllcategories() {
	global $conn;
	$sql = "SELECT * FROM categories";
	$result = mysqli_query($conn, $sql);
	$categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
	return $categories;
}
function createcategory($request_values){
	global $conn, $errors, $category_name;
	$category_name = esc($request_values['category_name']);
	// create slug: if category is "Life Advice", return "life-advice" as slug
	$category_slug = makeSlug($category_name);
	// validate form
	if (empty($category_name)) { 
		array_push($errors, "category name required"); 
	}
	// Ensure that no category is saved twice. 
	$category_check_query = "SELECT * FROM categories WHERE slug='$category_slug' LIMIT 1";
	$result = mysqli_query($conn, $category_check_query);
	if (mysqli_num_rows($result) > 0) { // if category exists
		array_push($errors, "category already exists");
	}
	// register category if there are no errors in the form
	if (count($errors) == 0) {
		$query = "INSERT INTO categories (name, slug) 
				  VALUES('$category_name', '$category_slug')";
		mysqli_query($conn, $query);

		$_SESSION['message'] = "category created successfully";
		header('location: categories.php');
		exit(0);
	}
}
/* * * * * * * * * * * * * * * * * * * * *
* - Takes category id as parameter
* - Fetches the category from database
* - sets category fields on form for editing
* * * * * * * * * * * * * * * * * * * * * */
function editcategory($category_id) {
	global $conn, $category_name, $isEditingcategory, $category_id;
	$sql = "SELECT * FROM categories WHERE id=$category_id LIMIT 1";
	$result = mysqli_query($conn, $sql);
	$category = mysqli_fetch_assoc($result);
	// set form values ($category_name) on the form to be updated
	$category_name = $category['name'];
}
function updatecategory($request_values) {
	global $conn, $errors, $category_name, $category_id;
	$category_name = esc($request_values['category_name']);
	$category_id = esc($request_values['category_id']);
	// create slug: if category is "Life Advice", return "life-advice" as slug
	$category_slug = makeSlug($category_name);
	// validate form
	if (empty($category_name)) { 
		array_push($errors, "category name required"); 
	}
	// register category if there are no errors in the form
	if (count($errors) == 0) {
		$query = "UPDATE categories SET name='$category_name', slug='$category_slug' WHERE id=$category_id";
		mysqli_query($conn, $query);

		$_SESSION['message'] = "category updated successfully";
		header('location: categories.php');
		exit(0);
	}
}
// delete category 
function deletecategory($category_id) {
	global $conn;
	$sql = "DELETE FROM categories WHERE id=$category_id";
	if (mysqli_query($conn, $sql)) {
		$_SESSION['message'] = "category successfully deleted";
		header("location: categories.php");
		exit(0);
	}
}


?>

<?php 
// Admin user variables
// ... varaibles here ...

// quizzes variables
$quiz_id = 0;
$isEditingquiz = false;
$quiz_name = "";

/* - - - - - - - - - - 
-  Admin users actions
- - - - - - - - - - -*/
// ... 

/* - - - - - - - - - - 
-  quiz actions
- - - - - - - - - - -*/
// if user clicks the create quiz button
if (isset($_POST['create_quiz'])) { createquiz($_POST); }
// if user clicks the Edit quiz button
if (isset($_GET['edit-quiz'])) {
	$isEditingquiz = true;
	$quiz_id = $_GET['edit-quiz'];
	editquiz($quiz_id);
}
// if user clicks the update quiz button
if (isset($_POST['update_quiz'])) {
	updatequiz($_POST);
}
// if user clicks the Delete quiz button
if (isset($_GET['delete-quiz'])) {
	$quiz_id = $_GET['delete-quiz'];
	deletequiz($quiz_id);
}


/* - - - - - - - - - - - -
-  Admin users functions
- - - - - - - - - - - - -*/
// ...

/* - - - - - - - - - - 
-  quizzes functions
- - - - - - - - - - -*/
// get all quizzes from DB
function getAllquizzes() {
	global $conn;
	$sql = "SELECT * FROM quizzes";
	$result = mysqli_query($conn, $sql);
	$quizzes = mysqli_fetch_all($result, MYSQLI_ASSOC);
	return $quizzes;
}
function createquiz($request_values){
	global $conn, $errors, $quiz_name, $post_id, $interviewer;
	$quiz_name = esc($request_values['quiz_name']);
	$post_id = esc($request_values['post_id']);
	$interviewer = $_SESSION['user']['id'];

	// create slug: if quiz is "Life Advice", return "life-advice" as slug
	$quiz_slug = makeSlug($quiz_name);
	// validate form
	if (empty($quiz_name)) { 
		array_push($errors, "quiz name required"); 
	}
	// Ensure that no quiz is saved twice. 
	$quiz_check_query = "SELECT * FROM quizzes WHERE slug='$quiz_slug' LIMIT 1";
	$result = mysqli_query($conn, $quiz_check_query);
	if (mysqli_num_rows($result) > 0) { // if quiz exists
		array_push($errors, "quiz already exists");
	}
	// register quiz if there are no errors in the form
	if (count($errors) == 0) {
		$query = "INSERT INTO quizzes (name, slug, post_id, interviewer) 
				  VALUES('$quiz_name', '$quiz_slug', $post_id, $interviewer)";
		mysqli_query($conn, $query);

		$_SESSION['message'] = "quiz created successfully";
		header('location: quizzes.php');
		exit(0);
	}
}
/* * * * * * * * * * * * * * * * * * * * *
* - Takes quiz id as parameter
* - Fetches the quiz from database
* - sets quiz fields on form for editing
* * * * * * * * * * * * * * * * * * * * * */
function editquiz($quiz_id) {
	global $conn, $quiz_name, $isEditingquiz, $quiz_id, $quiz_result, $quiz_answer;
	$sql = "SELECT * FROM quizzes WHERE id=$quiz_id LIMIT 1";
	$result = mysqli_query($conn, $sql);
	$quiz = mysqli_fetch_assoc($result);
	// set form values ($quiz_name) on the form to be updated
	$quiz_name = $quiz['name'];
	$quiz_answer =$quiz['answer'];
	$quiz_result = $quiz['result'];
}
function updatequiz($request_values) {
	global $conn, $errors, $quiz_name, $quiz_id, $quiz_result, $quiz_answer;
	$quiz_result = esc($request_values['quiz_result']);
	$quiz_name = esc($request_values['quiz_name']);
	$quiz_id = esc($request_values['quiz_id']);
	$quiz_answer = esc($request_values['quiz_answer']);
	// create slug: if quiz is "Life Advice", return "life-advice" as slug
	$quiz_slug = makeSlug($quiz_name);
	// validate form
	if (empty($quiz_name)) { 
		array_push($errors, "quiz name required"); 
	}
	// register quiz if there are no errors in the form
	if (count($errors) == 0) {
		$query = "UPDATE quizzes SET name='$quiz_name', slug='$quiz_slug', result=$quiz_result, answer= $quiz_answer WHERE id=$quiz_id";
		mysqli_query($conn, $query);

		$_SESSION['message'] = "quiz updated successfully";
		header('location: quizzes.php');
		exit(0);
	}
}
// delete quiz 
function deletequiz($quiz_id) {
	global $conn;
	$sql = "DELETE FROM quizzes WHERE id=$quiz_id";
	if (mysqli_query($conn, $sql)) {
		$_SESSION['message'] = "quiz successfully deleted";
		header("location: quizzes.php");
		exit(0);
	}
}

?>