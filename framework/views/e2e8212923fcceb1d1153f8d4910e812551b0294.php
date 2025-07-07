<!DOCTYPE html>
<html>
<head>
    <title>Available Courses</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f2f5;
            padding: 30px;
        }

        .course-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .course-title {
            font-size: 20px;
            color: #007bff;
        }

        .enroll-btn {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 8px 12px;
            margin-top: 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .enroll-btn:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top shadow">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"><h1 class="h4 mb-0">Free Placement Provider</h1></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
              aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ms-auto">
          <a class="nav-link" href="/login">Login</a>
          <a class="nav-link" href="/">Logout</a>
        </div>
      </div>
    </div>
  </nav>
    <h1 style="margin-top: 60px;">All IT Courses</h1>

    <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="course-card">
            <div class="course-title"><?php echo e($course['title']); ?></div>
            <p><strong>Duration:</strong> <?php echo e($course['duration']); ?></p>
            <p><strong>Technologies:</strong> <?php echo e($course['technologies']); ?></p>
            <a href="/register" class="enroll-btn">Enroll</a>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <a href="/" style="margin-top: 20px; display: inline-block;margin-left: 10px">← Back to Home</a>
    
</body>
</html>
<?php /**PATH C:\Users\vishw\form\resources\views/courses/index.blade.php ENDPATH**/ ?>