<?php  include('config.php'); ?>
<?php  include('includes/public_functions.php'); ?>
<?php  include('includes/comments_function.php'); ?>
<?php
// redirect user to login page if they're not logged in
if (empty($_SESSION['user']['id'])) {
    header('location: ../login.php');
}
?>
<?php 
	if (isset($_GET['post-slug'])) {
		$post = getPost($_GET['post-slug']);
	}
	$topics = getAllTopics();
?>
<?php include('includes/head_section.php'); ?>


<title> <?php echo $post['title'] ?> | TutsApp</title>
</head>
<body>

	<!-- Navbar -->
		<?php include( ROOT_PATH . '/includes/navbar.php'); ?>
	<!-- // Navbar -->
	<div class="container">
	<div class="content" >
		<!-- Page wrapper -->
		<div class="post-wrapper">
			<!-- full post div -->
			<div class="full-post-div">
			<?php if ($post['published'] == false): ?>
				<h2 class="post-title">Sorry... This post has not been published</h2>
			<?php else: ?>
				<h2 class="post-title" id="title"><?php echo $post['title']; ?></h2>
				<div class="post-body-div">
					<?php echo html_entity_decode($post['body']); ?>
				</div>
				<div class="post-body-div">
				<video width="200" controls="true" poster="" id="video">
					<source type="video/mp4" src="./static/tutorials/<?php echo $post['tutorial']; ?>" ></source>
				</video>

				<div id="status" class="incomplete">
				<span>Play status: </span>
				<span class="status complete">COMPLETE</span>
				<span class="status incomplete">INCOMPLETE</span>
				<br />
				</div>
				<div>
				<span id="played">0</span> seconds out of 
				<span id="duration"></span> seconds. (only updates when the video pauses)
				</div>
				</div>
			<?php endif ?>

			<a class="btn btn-primary"
				href="quiz.php?id=<?php echo $post['id'] ?>">
				Take Quiz
			</a>
			</div>
			<!-- // full post div -->
			
			<!-- comments section -->
			
					<!-- <div class="my-4">
						<form action="./single_post.php?post-slug=$post['slug']" method="post" class="form">
							<input type="hidden" name="commenter" value="<?php //echo $_SESSION['user']['id'] ?>">
							<textarea name="comment" id="comment" cols="30" rows="10" class="form-control">Write Comment Here!</textarea>
							<div class="flex mt-2"> 
							<button type="submit" class="btn btn-primary" name="create_comment">Comment</button>
							<button name="create_comment" type="reset" class="btn btn-secondary">Reset</button>
							</div>
						</form>
					</div> -->
					<!-- <div class="my-4">
					<div class="flex">
						<div>
						<img class="rounded" src="./static/images/<?php// echo $_SESSION['user']['photo'] ?>" alt="user's photo">
						</div>
						<div>
						<p class=""><?php //echo $_SESSION['user']['username'] ?></p>
						</div>
					</div>
					<div class="mb-4">
						<p>Comments appear here!</p>
					</div>
					</div> -->

			<!--  coming soon ...  -->
		</div>
		<!-- // Page wrapper -->

		<!-- post sidebar -->
		<div class="post-sidebar">
			<div class="card">
				<div class="card-header">
					<h2>Topics</h2>
				</div>
				<div class="card-content">
					<?php foreach ($topics as $topic): ?>
						<a 
							href="<?php echo BASE_URL . 'filtered_posts.php?topic=' . $topic['id'] ?>">
							<?php echo $topic['name']; ?>
						</a> 
					<?php endforeach ?>
					
				</div>
			</div>

			
		</div>
		<!-- // post sidebar -->
	</div>
</div>
<!-- // content -->

<?php include( ROOT_PATH . '/includes/footer.php'); ?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="includes/video.js"></script>

<?php  include('includes/updateCompleted.php'); ?>



