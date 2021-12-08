<!-- The first include should be config.php -->
<?php require_once('config.php') ?>

<?php require_once( $_SERVER['DOCUMENT_ROOT'] . '/courses/includes/registration_login.php') ?>

<?php include('includes/head_section.php'); ?>
    <title>User's Profile</title>
</head>
<body>
<?php include(ROOT_PATH . '/includes/navbar.php') ?>
    <div class="container">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-9">
                <div class="card">
                    <div class="card-header">
                        <h1><?php echo $_SESSION['user']['username'] ?> Profile</h1>
                    </div>
                        <div class="card-body">
                            <p>Username: <?php echo $_SESSION['user']['username'] ?></p>
                            <p>Email: <?php echo $_SESSION['user']['email'] ?></p>
                            <p>Created On: <?php echo $_SESSION['user']['created_at'] ?></p>
                            <a href="./edit_profile.php" class="btn btn-primary">Edit Profile</a>
                        </div>
                    
                </div>
            </div>
        </div>
    </div>
</body>
</html>