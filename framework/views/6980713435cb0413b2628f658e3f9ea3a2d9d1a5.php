

<?php $__env->startSection('content'); ?>
<div class="container">
  <div class="d-flex justify-content-between mb-3">
    <h2>All Courses</h2>
    <a href="<?php echo e(route('admin.courses.create')); ?>" class="btn btn-primary">Add New Course</a>
  </div>

  <table class="table table-bordered">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Duration</th>
        <th>Technologies</th>
        <th>Image</th>
        <th>YouTube Videos</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
  <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
      <td><?php echo e($course->id); ?></td>
      <td><?php echo e($course->name); ?></td>
      <td><?php echo e($course->duration); ?></td>
      <td><?php echo e($course->technologies); ?></td>
      <td>
        <?php if($course->image): ?>
          <img src="<?php echo e(asset('storage/' . $course->image)); ?>" width="60">
        <?php endif; ?>
      </td>

      <td>
        <?php if($course->youtubeVideos->isNotEmpty()): ?>
          <?php $__currentLoopData = $course->youtubeVideos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $yt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e($yt->youtube_url); ?>" target="_blank">Video <?php echo e($index + 1); ?></a><?php echo e(!$loop->last ? ', ' : ''); ?>

          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
          <small class="text-muted">No YouTube videos</small>
        <?php endif; ?>
      </td>

      <td>
        <a href="<?php echo e(route('admin.courses.edit', $course->id)); ?>" class="btn btn-sm btn-warning">Edit</a>

        <a href="<?php echo e(route('admin.courses.addYoutubeForm', $course->id)); ?>" class="btn btn-sm btn-secondary">Add YouTube</a>

        <form action="<?php echo e(route('admin.courses.destroy', $course->id)); ?>" method="POST" style="display:inline;">
          <?php echo csrf_field(); ?>
          <?php echo method_field('DELETE'); ?>
          <button type="submit" class="btn btn-sm btn-danger">Delete</button>
        </form>
      </td>
    </tr>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>

  </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\vishw\form\resources\views/admin/courses/index.blade.php ENDPATH**/ ?>