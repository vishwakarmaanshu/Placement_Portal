<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Enrolled Students</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .container {
      background-color: #fff;
      border-radius: 10px;
      padding: 30px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
      margin-top: 50px;
    }

    h1 {
      color: #343a40;
      font-weight: 600;
    }

    .btn-secondary {
      background-color: #6c757d;
      border: none;
    }

    .btn-secondary:hover {
      background-color: #5a6268;
    }

    table {
      margin-top: 20px;
    }

    table thead th {
      background-color: #343a40 !important;
      color: #ffffff !important;
      font-weight: bold;
    }

    table tbody tr:hover {
      background-color: #f1f1f1;
    }

    .text-center {
      text-align: center;
    }

    .no-data {
      background-color: #ffc107;
      color: #212529;
      font-weight: 500;
    }

    @media (max-width: 768px) {
      .table-responsive {
        overflow-x: auto;
      }
    }

    
  </style>
</head>
<body>
  <div class="container">
    <h1 class="text-center mb-4">Enrolled Students</h1>

    <div class="d-flex justify-content-end">
      <a href="/admin/dashboard" class="btn btn-secondary mb-3">← Back to Dashboard</a>
    </div>

    <div class="table-responsive">
      <table class="table table-bordered table-striped">
  <thead class="table-dark">
    <tr>
      <th>#</th>
      <th>User Name</th>
      <th>Email</th>
      <th>Course Name</th>
      <th>Enrolled At</th>
    </tr>
  </thead>
  <tbody>
    <?php $__empty_1 = true; $__currentLoopData = $enrollments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $enrollment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
      <tr>
        <td><?php echo e($index + 1); ?></td>
        <td><?php echo e($enrollment->user->first_name ?? 'N/A'); ?></td>
        <td><?php echo e($enrollment->user->email ?? 'N/A'); ?></td>
        <td><?php echo e($enrollment->course_name); ?></td>
        <td><?php echo e($enrollment->created_at->format('Y-m-d')); ?></td>
      </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
      <tr>
        <td colspan="5" class="text-center">No enrollments found.</td>
      </tr>
    <?php endif; ?>
  </tbody>
</table>

    </div>
  </div>
</body>
</html>
<?php /**PATH C:\Users\vishw\form\resources\views/enrollments/index.blade.php ENDPATH**/ ?>