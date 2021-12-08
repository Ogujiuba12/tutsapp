<?php  include('../config.php'); ?>
<?php  include(ROOT_PATH . '/admin/includes/admin_functions.php'); ?>
<?php 
	// Get all admin users from DB
	$admins = getAdminUsers();
	$roles = ['Admin', 'Author', 'student'];				
?>
<?php include(ROOT_PATH . '/author/includes/head_section.php'); ?>
	<title>TutsApp Create Account </title>
</head>
<body>
	<!-- admin navbar -->
	<?php include(ROOT_PATH . '/includes/navbar.php') ?>
	<div class="container content">
		
		<!-- Middle form - to create and edit  -->
		<div class="action">
			<h1 class="page-title">Create Instructor User</h1>

			<form method="post" action="<?php echo BASE_URL . 'author/registration.php'; ?>" >

				<!-- validation errors for the form -->
				<?php include(ROOT_PATH . '/includes/errors.php') ?>

				<!-- if editing user, the id is required to identify that user -->
				<?php if ($isEditingUser === true): ?>
					<input type="hidden" name="admin_id" value="<?php echo $admin_id; ?>">
				<?php endif ?>

				<input type="text" name="username" value="<?php echo $username; ?>" placeholder="Username">
				<input type="email" name="email" value="<?php echo $email ?>" placeholder="Email">
				<input type="password" name="password" placeholder="Password">
				<input type="password" name="passwordConfirmation" placeholder="Password confirmation">
				<input type="hidden" name="role" value="author" />

				<!-- if editing user, display the update button instead of create button -->
				<?php if ($isEditingUser === true): ?> 
					<button type="submit" class="btn btn-primary" name="update_admin">UPDATE</button>
				<?php else: ?>
					<button type="submit" class="btn btn-primary" name="create_admin">Save User</button>
				<?php endif ?>
			</form>
		</div>
		<!-- // Middle form - to create and edit -->

	
		
	</div>
</body>
</html>