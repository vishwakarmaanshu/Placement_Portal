

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
  <h2>Edit Course</h2>

  <form action="<?php echo e(route('admin.courses.update', $course->id)); ?>" method="POST" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>

    <div class="mb-3">
      <label for="name" class="form-label">Course Name</label>
      <input type="text" name="name" class="form-control" value="<?php echo e($course->name); ?>" required>
    </div>

    <div class="mb-3">
      <label for="duration" class="form-label">Duration</label>
      <input type="text" name="duration" class="form-control" value="<?php echo e($course->duration); ?>" required>
    </div>

    <div class="mb-3">
      <label for="technologies" class="form-label">Technologies / Frameworks</label>
      <textarea name="technologies" class="form-control" rows="3"><?php echo e($course->technologies); ?></textarea>
    </div>

    <div class="mb-3">
      <label for="image" class="form-label">Course Image (optional)</label>
      <input type="file" name="image" class="form-control">
      <?php if($course->image): ?>
        <img src="<?php echo e(asset('storage/' . $course->image)); ?>" alt="Course Image" style="max-width: 100px; margin-top: 10px;">
      <?php endif; ?>
    </div>

    <div class="mb-3">
  <label class="form-label">YouTube Links</label>
  <?php
    $links = $course->youtube_link ?? []; // already an array if casted
  ?>

  <?php for($i = 0; $i < 3; $i++): ?>
    <input type="url" name="youtube_links[]" class="form-control mb-2"
           value="<?php echo e($links[$i] ?? ''); ?>" placeholder="https://youtu.be/...">
  <?php endfor; ?>
</div>


    <button type="submit" class="btn btn-success">Update Course</button>
  </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\vishw\form\resources\views/admin/courses/edit.blade.php ENDPATH**/ ?>