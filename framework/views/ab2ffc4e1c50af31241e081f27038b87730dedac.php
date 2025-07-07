<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Placement History</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background-color: #f8f9fa;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .container {
      background-color: #ffffff;
      padding: 30px;
      margin-top: 50px;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }

    h1 {
      color: #343a40;
      font-weight: bold;
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

    thead th {
      background-color: #343a40 !important;
      color: #ffffff !important;
    }

    tbody tr:hover {
      background-color: #f1f1f1;
    }

    .no-data {
      background-color: #ffc107;
      color: #212529;
      font-weight: 500;
    }

    img {
      border-radius: 50%;
      object-fit: cover;
    }

    @media (max-width: 768px) {
      .table-responsive {
        overflow-x: auto;
      }

      table {
        font-size: 14px;
      }
    }
  </style>
</head>
<body>

  <div class="container">
    <h1 class="text-center mb-4">Placement History</h1>

    <div class="d-flex justify-content-end">
      <a href="/admin/dashboard" class="btn btn-secondary mb-3">← Back to Dashboard</a>
    </div>

    <div class="table-responsive">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Company</th>
            <th>Course</th>
            <th>Photo</th>
            <th>Inserted At</th>
          </tr>
        </thead>
        <tbody>
          <?php $__empty_1 = true; $__currentLoopData = $placements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $placement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
              <td><?php echo e($index + 1); ?></td>
              <td><?php echo e($placement->first_name); ?></td>
              <td><?php echo e($placement->company); ?></td>
              <td><?php echo e($placement->course); ?></td>
              <td>
                <img src="<?php echo e(asset('storage/photos/' . $placement->photo)); ?>" width="50" height="50" alt="Profile Photo">
              </td>
              <td><?php echo e($placement->created_at->format('Y-m-d')); ?></td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
              <td colspan="6" class="text-center no-data">No placement records found.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

</body>
</html>
<?php /**PATH C:\Users\vishw\form\resources\views/placements/history.blade.php ENDPATH**/ ?>