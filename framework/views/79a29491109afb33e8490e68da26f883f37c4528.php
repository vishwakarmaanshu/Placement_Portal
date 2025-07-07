

<?php $__env->startSection('content'); ?>
<div class="container mt-5">
  <h2>Add New Placement</h2>

  <?php if(session('error')): ?>
    <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
  <?php endif; ?>

  <?php if(session('success')): ?>
    <div class="alert alert-success"><?php echo e(session('success')); ?></div>
  <?php endif; ?>

  <form action="<?php echo e(route('admin.placements.store')); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>

    <div class="mb-3">
      <label for="user_identifier" class="form-label">Enter User Name or Email</label>
      <input type="text" name="user_identifier" class="form-control" placeholder="e.g. John or john@example.com" required>
    </div>

    <div class="mb-3">
      <label for="course_id" class="form-label">Select Course</label>
      <select name="course_id" class="form-control" required>
        <option value="">-- Select Course --</option>
        <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value="<?php echo e($course->id); ?>"><?php echo e($course->name); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </select>
    </div>

    <div class="mb-3">
      <label for="company" class="form-label">Company</label>
      <input type="text" name="company" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="photo" class="form-label">Photo (optional)</label>
      <input type="file" name="photo" class="form-control">
    </div>

    <button type="submit" class="btn btn-success">Save Placement</button>
    <a href="<?php echo e(route('admin.placements.index')); ?>" class="btn btn-secondary">Back</a>
  </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\vishw\form\resources\views/admin/placements/create.blade.php ENDPATH**/ ?>