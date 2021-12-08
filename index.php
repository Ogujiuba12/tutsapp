<!-- The first include should be config.php -->
<?php require_once('config.php') ?>

<?php require_once( $_SERVER['DOCUMENT_ROOT'] . '/courses/includes/registration_login.php') ?>

<!-- config.php should be here as the first include  -->

<?php require_once( $_SERVER['DOCUMENT_ROOT'] . '/courses/includes/public_functions.php') ?>

<!-- Retrieve all posts from database  -->
<?php $posts = getPublishedPosts(); ?>



<?php require_once('includes/head_section.php') ?>

	<title>TutsApp | Home </title>
</head>
<body>
	
		<!-- navbar -->
		<?php include('includes/navbar.php') ?>
		<!-- // navbar -->

		<!-- container - wraps whole page -->
	<div class="container">
		
        <!-- banner -->
        <?php include('includes/banner.php') ?>

		<!-- Page content -->
		<div class="">
			<h2 class="">Recent Courses</h2>
			<hr>
			<!-- more content still to come here ... -->
		</div>
		<!-- // Page content -->
<div class="row">
		<?php foreach ($posts as $post): ?>
			<div class="col-md-3">
			<div class="card" style="width: 16rem;">
				<div class="card-body">
				
		<img src="<?php echo BASE_URL . 'static/images/' . $post['image']; ?>" class="card-img-top" alt="">
		<a href="single_post.php?post-slug=<?php echo $post['slug']; ?>">
			<div class="post_info">
				<h3 class="card-title"><?php echo $post['title'] ?></h3>
				<div class="card-text">
					<span><?php echo date("F j, Y ", strtotime($post["created_at"])); ?></span>
					<br>
					<span class="btn btn-outline-primary">Read more...</span>
				</div>
			</div>
		</a>
	
		
	</div>
			</div>
			</div>
	<?php endforeach ?>
			</div>
		<!-- footer -->
		<footer class="footer mx-auto py-3 bg-light">
        <?php include('includes/footer.php') ?>
		</footer>
		<!-- // footer -->

	</div>
	<!-- // container -->
</body>
</html>