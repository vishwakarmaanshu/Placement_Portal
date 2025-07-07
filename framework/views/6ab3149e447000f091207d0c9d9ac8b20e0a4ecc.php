

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
  <h3>Add YouTube Links for: <span class="text-primary"><?php echo e($course->name); ?></span></h3>

  <!-- 🔽 Edit Button -->
  <div class="mb-3 text-end">
    <a href="<?php echo e(route('admin.courses.editYoutubeForm', $course->id)); ?>" class="btn btn-sm btn-dark">
      Edit YouTube Videos
    </a>
  </div>

  <!-- 🔽 Add Form -->
  <form action="<?php echo e(route('admin.courses.storeYoutubeLinks', $course->id)); ?>" method="POST">
    <?php echo csrf_field(); ?>

    <div class="mb-3">
      <label for="youtube_url1">YouTube Link 1</label>
      <input type="url" name="youtube_urls[]" class="form-control" placeholder="https://youtube.com/..." required>
    </div>

    <div class="mb-3">
      <label for="youtube_url2">YouTube Link 2 (optional)</label>
      <input type="url" name="youtube_urls[]" class="form-control" placeholder="https://youtube.com/...">
    </div>

    <div class="mb-3">
      <label for="youtube_url3">YouTube Link 3 (optional)</label>
      <input type="url" name="youtube_urls[]" class="form-control" placeholder="https://youtube.com/...">
    </div>

    <div class="d-flex justify-content-end">
      <button type="submit" class="btn btn-success">Save Links</button>
      <a href="<?php echo e(route('admin.courses.index')); ?>" class="btn btn-secondary ms-2">Cancel</a>
    </div>
  </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\vishw\form\resources\views/admin/courses/add_youtube.blade.php ENDPATH**/ ?>