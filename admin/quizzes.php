<?php  include('../config.php'); ?>
<?php  include(ROOT_PATH . '/admin/includes/admin_functions.php'); ?>
<?php  include(ROOT_PATH . '/admin/includes/post_functions.php'); ?>
<?php include(ROOT_PATH . '/admin/includes/head_section.php'); ?>
<!-- Get all quizzes from DB -->
<?php $quizzes = getAllquizzes();	?>

<!-- Get all topics from DB -->
<?php $Posts = getAllPosts();	?>

	<title>Admin | Manage Quizzes</title>
</head>
<body>
	<!-- admin navbar -->
	<?php include(ROOT_PATH . '/admin/includes/navbar.php') ?>
	<div class="container content">
		<!-- Left side menu -->
		<?php include(ROOT_PATH . '/admin/includes/menu.php') ?>

		<!-- Middle form - to create and edit -->
		<div class="action">
			<h1 class="page-title">Create/Edit quizzes</h1>
			<form method="post" action="<?php echo BASE_URL . 'admin/quizzes.php'; ?>" >
				<!-- validation errors for the form -->
				<?php include(ROOT_PATH . '/includes/errors.php') ?>
				<!-- if editing quiz, the id is required to identify that quiz -->
				<?php if ($isEditingquiz === true): ?>
					<input type="hidden" name="quiz_id" value="<?php echo $quiz_id; ?>">
					<input type="number" class="form-control" placeholder="Score answer 0-100" name="quiz_result" value="<?php echo $quiz_result; ?>">
					<textarea class="form-control" cols="10" rows="10" name="quiz_answer" ><?php echo $quiz_answer; ?></textarea>
				<?php endif ?>

				<select name="post_id">
					<option value="" selected disabled>Choose Post</option>
					<?php foreach ($Posts as $post): ?>
						<option value="<?php echo $post['id']; ?>">
							<?php echo $post['title']; ?>
						</option>
					<?php endforeach ?>

				<input type="text" name="quiz_name" value="<?php echo $quiz_name; ?>" placeholder="quiz">
				<!-- if editing quiz, display the update button instead of create button -->
				<?php if ($isEditingquiz === true): ?> 
					<button type="submit" class="btn btn-primary" name="update_quiz">UPDATE</button>
				<?php else: ?>
					<button type="submit" class="btn btn-primary" name="create_quiz">Save quiz</button>
				<?php endif ?>
			</form>
		</div>
		<!-- // Middle form - to create and edit -->

		<!-- Display records from DB-->
		<div class="table-div">
			<!-- Display notification message -->
			<?php include(ROOT_PATH . '/includes/messages.php') ?>
			<?php if (empty($quizzes)): ?>
				<h1>No quizzes in the database.</h1>
			<?php else: ?>
				<table class="table">
					<thead>
						<th>N</th>
						<th>quiz Name</th>
						<th colspan="2">Action</th>
					</thead>
					<tbody>
					<?php foreach ($quizzes as $key => $quiz): ?>
						<tr>
							<td><?php echo $key + 1; ?></td>
							<td><?php echo $quiz['name']; ?></td>
							<td>
								<a class="fa fa-pencil btn edit"
									href="quizzes.php?edit-quiz=<?php echo $quiz['id'] ?>">
								</a>
							</td>
							<td>
								<a class="fa fa-trash btn delete"								
									href="quizzes.php?delete-quiz=<?php echo $quiz['id'] ?>">
								</a>
							</td>
						</tr>
					<?php endforeach ?>
					</tbody>
				</table>
			<?php endif ?>
		</div>
		<!-- // Display records from DB -->
	</div>
</body>
</html>