<?php  include('config.php'); ?>
<?php // include($_SERVER['DOCUMENT_ROOT'] . '/courses/admin/includes/admin_functions.php'); ?>
<?php  include($_SERVER['DOCUMENT_ROOT'] . '/courses/admin/includes/quiz_functions.php'); ?>

<!-- Get all quizzes from DB -->
<?php 
if (isset($_GET['id'])) {
		$quiz = getPost($_GET['id']);
	}
?>

<?php include('includes/head_section.php'); ?>

    <title>TutsApp Quiz</title>
</head>
<body>
    <!-- Navbar -->
		<?php include( ROOT_PATH . '/includes/navbar.php'); ?>
	<!-- // Navbar -->
    <div class="container">
        <div class="row">
            <div class="col-9"> 
                <h2>Take a Quick Quiz</h2>
                <div class="card pb-4">
                    <div class="card-body">
    <form action="<?php echo BASE_URL . 'quiz.php'; ?>" method="post" a>
        <label for="question">Question:</label>
        <p><?php echo (isset($quiz['question'])) ? $quiz['question'] : "No question yet oh" ?></p>
        <label for="answer">Answer:</label>
        <textarea type="text" name="answer" class="form-control" cols="10" rows="15"></textarea>
        <div class="my-4">
        <button type="submit" class="btn btn-primary" name="create_answer">Submit</button>
        <button type="reset" class="btn btn-secondary">Reset</button>
        </div>
    </form>

    </div>
                </div>
    </div>
    </div>
    </div>
    
    <footer>
        <?php include_once('./includes/footer.php') ?>
    </footer>
</body>
</html>