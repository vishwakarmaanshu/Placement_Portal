

<?php $__env->startSection('content'); ?>
<div class="container">
  <h2>Edit Placement</h2>

  <form action="<?php echo e(route('admin.placements.update', $placement->id)); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>

    <div class="mb-3">
      <label for="company" class="form-label">Company</label>
      <input type="text" class="form-control" id="company" name="company" value="<?php echo e($placement->company); ?>" required>
    </div>

    <div class="mb-3">
      <label for="photo" class="form-label">Photo</label>
      <input type="file" class="form-control" id="photo" name="photo">
      <?php if($placement->photo): ?>
        <img src="<?php echo e(asset('storage/photos/' . $placement->photo)); ?>" width="100" class="mt-2">
      <?php endif; ?>
    </div>

    <div class="mb-3">
      <label for="course_id" class="form-label">Course</label>
      <select class="form-control" id="course_id" name="course_id">
        <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <option value="<?php echo e($course->id); ?>" <?php echo e($placement->course_id == $course->id ? 'selected' : ''); ?>>
            <?php echo e($course->name); ?>

          </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </select>
    </div>

    <button type="submit" class="btn btn-success">Update</button>
  </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\vishw\form\resources\views/admin/placements/edit.blade.php ENDPATH**/ ?>