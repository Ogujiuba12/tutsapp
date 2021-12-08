<?php  include('config.php'); ?>
<?php  //include('includes/public_functions.php'); ?>
<?php  include('includes/progress_functions.php'); ?>

<?php 
	
		$progress = getProgress();
	
	$progresses = getAllProgress();
?>
<?php include('includes/head_section.php'); ?>


<title> User's Progress | TutsApp</title>
</head>
<body>

	<!-- Navbar -->
		<?php include( ROOT_PATH . '/includes/navbar.php'); ?>
	<!-- // Navbar -->
    <div class="container">
        <div class="row">
            <div class="col-9">
                <div class="header">
                    Enrolled Courses
                </div>
                All courses Completed
                <!-- <p><?php //echo $progress['doneTitle'] ?></p> -->

                <?php if (empty($progresses)): ?>
				<h1>No course taken .</h1>
			<?php else: ?>
                <table class="table">
					<thead>
						<th>N</th>
						<th>Title</th>
					</thead>
					<tbody>
					<?php foreach ($progresses as $key => $progress): ?>
						<tr>
							<td><?php echo $key + 1; ?></td>
							<td><?php echo $progress['doneTitle']; ?></td>
							
                            <!-- <td><?php // echo $progress['created_at']; ?></td> -->
							
							<td>
								<!-- <a class="fa fa-trash btn delete"								
									href="categories.php?delete-category=<?php echo $category['id'] ?>">
								</a> -->
							</td>
						</tr>
					<?php endforeach ?>
					</tbody>
				</table>
                <?php endif ?>
            </div>

        </div>
</div>


<?php include( ROOT_PATH . '/includes/footer.php'); ?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="includes/video.js"></script>

</body>
</html>