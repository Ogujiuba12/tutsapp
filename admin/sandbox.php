
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