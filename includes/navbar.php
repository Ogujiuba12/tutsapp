<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
  <div class="container-fluid">
    <a class="navbar-brand text-primary" href="<?php echo BASE_URL . 'index.php'; ?>">TutsApp</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav mx-auto mb-2 mb-md-0 ">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?php echo BASE_URL . 'index.php'; ?>">Courses</a>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link" href="./pricing.php">Pricing</a>
        </li> -->
        <li class="nav-item">
          <a class="nav-link" href="<?php echo BASE_URL . 'author/registration.php'; ?>">Teach on TutsApp</a>
        </li>
      </ul>
      <!-- <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-primary" type="submit">Search</button>
      </form> -->
      <div>
          <a href="<?php echo BASE_URL . 'login.php'; ?>" class="btn btn-primary mx-4">Login</a>
          <a href="<?php echo BASE_URL . 'register.php'; ?>" class="btn btn-primary mr-4">Take a Course</a>
        
            <?php if (isset($_SESSION['user']['id'])): ?>
          <a href="<?php echo BASE_URL . 'course_progress.php'; ?>" class="btn btn-outline-secondary mr-4">Progress</a>
          <a href="<?php echo BASE_URL . 'profile.php'; ?>" class="text-white mr-4">Your Profile</a>

          <?php endif ?>
      </div>
    </div>
  </div>
</nav>