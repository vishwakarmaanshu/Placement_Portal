<!DOCTYPE html>
<html>
<head>
    <title>All Placements</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
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
           <a class="nav-link" href="/">Logout</a>
        </div>
      </div>
    </div>
  </nav>
    <h1 style="margin-top: 60px;">Placement List</h1>

    <?php if(session('success')): ?>
        <p style="color: green;"><?php echo e(session('success')); ?></p>
    <?php endif; ?>

    <?php $__currentLoopData = $placements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $placement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div style="border: 1px solid #ccc; margin: 10px; padding: 10px;">
            <h3><?php echo e($placement->name); ?></h3>
            <p>Company: <?php echo e($placement->company); ?></p>
            <p>Course: <?php echo e($placement->course); ?></p>
            <?php if($placement->photo): ?>
                <img src="<?php echo e(asset('storage/photos/' . $placement->photo)); ?>" alt="Photo" width="100">
            <?php endif; ?>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</body>
</html>
<?php /**PATH C:\Users\vishw\form\resources\views/placements/index.blade.php ENDPATH**/ ?>