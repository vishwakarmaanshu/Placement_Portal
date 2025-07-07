

<?php $__env->startSection('content'); ?>
<style>
  .container {
    max-width: 700px;
    margin-top: 30px;
    background: #fff;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
  }

  h3 {
    margin-bottom: 25px;
    font-weight: 600;
    color: #333;
  }

  label {
    font-weight: 500;
    margin-bottom: 5px;
  }

  .form-control {
    border-radius: 8px;
    box-shadow: none;
    transition: 0.3s ease;
  }

  .form-control:focus {
    box-shadow: 0 0 0 0.15rem rgba(13, 110, 253, 0.25);
    border-color: #86b7fe;
  }

  .btn-success, .btn-secondary {
    border-radius: 8px;
    padding: 8px 20px;
  }

  .btn + .btn {
    margin-left: 10px;
  }
</style>

<div class="container">
  <h3>Add YouTube Videos to: <span class="text-primary"><?php echo e($course->name); ?></span></h3>

<form method="POST" action="<?php echo e(route('admin.courses.storeVideo', $course->id)); ?>" enctype="multipart/form-data">
<?php echo csrf_field(); ?>
  <div class="mb-3">
    <label for="videos">Upload Video(s)</label>
    <input type="file" name="videos[]" id="videos" class="form-control" multiple  required>
    <small class="form-text text-muted">You can upload one or more videos (MP4, WebM, etc.).</small>
  </div>

  <div class="d-flex justify-content-end">
    <button type="submit" class="btn btn-success">Save Videos</button>
     <a href="<?php echo e(route('admin.courses.editVideoForm', $course->id)); ?>" class="btn btn-warning">Edit Videos</a>
    <a href="<?php echo e(route('admin.courses.index')); ?>" class="btn btn-secondary">Cancel</a>
  </div>
</form>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\vishw\form\resources\views/admin/courses/add_video.blade.php ENDPATH**/ ?>