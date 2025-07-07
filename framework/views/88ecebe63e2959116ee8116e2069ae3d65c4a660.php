<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Panel</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .sidebar {
      height: 100vh;
      background-color: #343a40;
      color: white;
      padding-top: 20px;
      position: fixed;
      width: 200px;
    }
    .sidebar a {
      color: white;
      text-decoration: none;
      display: block;
      padding: 10px 20px;
    }
    .sidebar a:hover {
      background-color: #495057;
    }
    .main-content {
      margin-left: 210px;
      padding: 20px;
    }
  </style>
</head>
<body>

  <!-- Sidebar -->
  <div class="sidebar">
    <h2>Admin Panel</h2>
        <a href="<?php echo e(route('user.dashboard')); ?>">Dashboard</a>
        <a href="<?php echo e(route('admin.users')); ?>">Users</a>
        <a href="<?php echo e(route('admin.courses.index')); ?>">Courses</a>
        <a href="<?php echo e(route('admin.placements.index')); ?>">Placements</a>
        <a href="<?php echo e(route('admin.dashboard')); ?>">Back to Admin Panel</a>
        <a href="/logout">Logout</a>
  </div>

  <!-- Main Content -->
  <div class="main-content">
    <?php echo $__env->yieldContent('content'); ?>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH C:\Users\vishw\form\resources\views/layouts/admin.blade.php ENDPATH**/ ?>