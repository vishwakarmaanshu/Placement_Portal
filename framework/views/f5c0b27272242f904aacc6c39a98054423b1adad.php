

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
  <h2>Add New Course</h2>

  <form action="<?php echo e(route('admin.courses.store')); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>

    <div class="mb-3">
      <label for="name">Course Name</label>
      <input type="text" name="name" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="duration">Duration</label>
      <input type="text" name="duration" class="form-control" required>
    </div>

    <div class="mb-3">
      <label for="technologies">Technologies</label>
      <textarea name="technologies" class="form-control"></textarea>
    </div>

    <div class="mb-3">
      <label for="image">Course Image</label>
      <input type="file" name="image" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Add Course</button>
  </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\vishw\form\resources\views/admin/courses/create.blade.php ENDPATH**/ ?>