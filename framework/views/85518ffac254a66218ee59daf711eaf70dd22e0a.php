<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Home</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      margin: 0;
      padding-top: 80px;
      background-color: #f0f2f5;
      font-family: Arial, sans-serif;
    }
    .section-title {
      text-align: center;
      margin-top: 40px;
      margin-bottom: 20px;
      font-size: 28px;
      color: #333;
    }
    .card-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
      gap: 20px;
      padding: 20px;
    }
    .card {
      border: 1px solid #ddd;
      border-radius: 12px;
      padding: 16px;
      background-color: #fff;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      text-align: center;
    }
    .card:hover {
      transform: translateY(-5px);
    }
    .card img {
      width: 100%;
      height: 160px;
      object-fit: cover;
      border-radius: 8px;
      margin-bottom: 10px;
    }
    .btn-view {
      margin-top: 10px;
    }
    .placement-details {
      display: none;
      font-size: 14px;
      text-align: left;
      margin-top: 10px;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top shadow">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">IT Courses</a>
    <div class="collapse navbar-collapse">
      <div class="navbar-nav ms-auto">
       <?php if(auth()->guard()->check()): ?>
  <a class="nav-link" href="/user/dashboard">View Courses</a>
<?php else: ?>
  <a class="nav-link" href="javascript:void(0);" onclick="handleViewCoursesClick()">View Courses</a>
<?php endif; ?>

        <!-- <a class="nav-link" href="/user/dashboard">View Courses</a> -->
        <a class="nav-link" href="/login">Login</a>
        <a class="nav-link" href="/register">Register</a>
      </div>
    </div>
  </div>
</nav>

<!-- Courses Section -->
<section>
  <div class="container mt-4">
    <h2 class="text-center mb-4">Available Courses</h2>

    <div class="row">
      <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-4 d-flex align-items-stretch">
          <div class="card mb-4 shadow-sm w-100" style="min-height: 420px;">
            <div class="card-body d-flex flex-column justify-content-between text-center">
              <div>
                <img src="<?php echo e(asset('storage/' . $course->image)); ?>" class="mb-3 img-fluid" style="max-height: 120px; width: auto;" alt="Course Image">
                <h5 class="card-title"><?php echo e($course->name); ?></h5>
                <p class="card-text"><strong>Duration:</strong> <?php echo e($course->duration); ?></p>
                <p class="card-text"><strong>Technologies:</strong> <?php echo e($course->technologies); ?></p>
              </div>
              <a href="<?php echo e(route('login')); ?>" class="btn btn-outline-primary mt-3">Login to Enroll</a>
              
            </div>
          </div>
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <!-- Courses Pagination -->
    <div class="d-flex justify-content-center mt-4">
      <!-- <?php echo e($courses->links('pagination::bootstrap-5')); ?> -->
      <?php echo e($courses->appends(['placements_page' => request('placements_page')])->links('pagination::bootstrap-5')); ?>


    </div>
  </div>
</section>

<!-- Placement Section -->
<section>
  <h2 class="section-title text-center my-4">Placement History</h2>
  <div class="card-grid">
    <?php $__currentLoopData = $placements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $placement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="card">
        <!-- <img src="<?php echo e(asset('storage/photos/' . $placement->photo)); ?>" alt="Profile Photo"> -->
        <img src="<?php echo e(asset('storage/' . $placement->photo)); ?>" alt="Profile Photo">

        <h5><?php echo e($placement->user->first_name ?? 'N/A'); ?> <?php echo e($placement->user->last_name ?? ''); ?></h5>
        <p><strong>Company:</strong> <?php echo e($placement->company); ?></p>
        <p><strong>Course:</strong> <?php echo e($placement->course->name ?? 'N/A'); ?></p>
        <button class="btn btn-sm btn-outline-success btn-view" onclick="toggleDetails(this)">View Details</button>
        <div class="placement-details" style="display: none;">
          <p><strong>Duration:</strong> <?php echo e($placement->course->duration ?? 'N/A'); ?></p>
          <p><strong>Technologies:</strong> <?php echo e($placement->course->technologies ?? 'N/A'); ?></p>
        </div>
      </div>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>

  <!-- Placements Pagination -->
  <div class="d-flex justify-content-center mt-4">
   <!-- <?php echo e($placements->links('pagination::bootstrap-5')); ?> -->

<?php echo e($placements->appends(['courses_page' => request('courses_page')])->links('pagination::bootstrap-5')); ?>


  </div>
</section>

<!-- JS -->
<script>
  function toggleDetails(button) {
    const details = button.nextElementSibling;
    details.style.display = details.style.display === 'none' ? 'block' : 'none';
  }
</script>
<script>
  function handleViewCoursesClick() {
    alert("Please login first to view courses.");
    window.location.href = "/login";
  }
</script>



</body>
</html>
<?php /**PATH C:\Users\vishw\form\resources\views/home.blade.php ENDPATH**/ ?>