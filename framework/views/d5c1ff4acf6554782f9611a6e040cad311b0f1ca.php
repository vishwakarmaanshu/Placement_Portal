

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
  <h3>Edit Videos for: <span class="text-primary"><?php echo e($course->name); ?></span></h3>

  <form method="POST" action="<?php echo e(route('admin.courses.updateVideos', $course->id)); ?>" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>

    <?php if($course->videos->count()): ?>
      <?php $__currentLoopData = $course->videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="mb-3">
          <video width="100%" height="240" controls style="border-radius: 8px;">
            <source src="<?php echo e(asset('storage/' . $video->video_path)); ?>" type="video/mp4">
            Your browser does not support the video tag.
          </video>
          <br>
          <label>
            <input type="checkbox" name="delete_videos[]" value="<?php echo e($video->id); ?>"> Delete this video
          </label>
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php else: ?>
      <p>No videos found for this course.</p>
    <?php endif; ?>

    <div class="mb-3">
      <label>Upload New Video(s)</label>
      <input type="file" name="new_videos[]" class="form-control" multiple accept="video/*">
    </div>

    <button type="submit" class="btn btn-primary">Update Videos</button>
    <a href="<?php echo e(route('admin.courses.index')); ?>" class="btn btn-secondary">Cancel</a>
  </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\vishw\form\resources\views/admin/courses/edit_videos.blade.php ENDPATH**/ ?>