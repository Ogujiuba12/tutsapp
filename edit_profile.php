<?php  include('config.php'); ?>
<!-- Source code for handling registration and login -->
<?php  include($_SERVER['DOCUMENT_ROOT'] . '/courses/includes/registration_login.php'); ?>

<?php include('includes/head_section.php'); ?>

<title>TutsApp | Edit Account </title>
</head>
<body>
<div class="container">
	<!-- Navbar -->
		<?php include( $_SERVER['DOCUMENT_ROOT'] . '/courses/includes/navbar.php'); ?>
	<!-- // Navbar -->

	<div style="width: 40%; margin: 20px auto;">
		<form method="post" action="register.php" >
			<h2>Edit user on TutsApp</h2>
			<?php include($_SERVER['DOCUMENT_ROOT'] . '/courses/includes/errors.php') ?>
			<input  type="text" name="username" value="<?php echo $username; ?>"  placeholder="Username">
			<input type="email" name="email" value="<?php echo $email ?>" placeholder="Email">
			
			<button type="submit" class="btn" name="edit_user">Edit Accout</button>
			
		</form>
	</div>
</div>
<!-- // container -->
<!-- Footer -->
	<?php include( ROOT_PATH . '/includes/footer.php'); ?>
<!-- // Footer -->