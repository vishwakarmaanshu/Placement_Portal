

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
  <h3>Edit YouTube Links for: <span class="text-primary"><?php echo e($course->name); ?></span></h3>

  <form action="<?php echo e(route('admin.courses.updateYoutubeLinks', $course->id)); ?>" method="POST">
    <?php echo csrf_field(); ?>

    <?php $__currentLoopData = $course->youtubeVideos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="mb-3">
        <label>YouTube Link <?php echo e($index + 1); ?></label>
        <input type="url" name="youtube_urls[]" class="form-control" value="<?php echo e($video->youtube_url); ?>" required>
      </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <!-- Add empty fields to allow adding more -->
    <div class="mb-3">
      <label>Add New Link</label>
      <input type="url" name="youtube_urls[]" class="form-control" placeholder="https://youtube.com/...">
    </div>

    <div class="mb-3">
      <label>Add Another</label>
      <input type="url" name="youtube_urls[]" class="form-control" placeholder="https://youtube.com/...">
    </div>

    <div class="d-flex justify-content-end">
      <button type="submit" class="btn btn-success">Update</button>
      <a href="<?php echo e(route('admin.courses.index')); ?>" class="btn btn-secondary ms-2">Cancel</a>
    </div>
  </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\vishw\form\resources\views/admin/courses/edit_youtube.blade.php ENDPATH**/ ?>