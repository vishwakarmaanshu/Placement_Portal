

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
  <h2 class="mb-4">Placement Records</h2>

  <input type="text" id="searchInput" class="form-control mb-3" placeholder="Search by name or company" onkeyup="filterTable()">

  <div class="mb-3">
    <a href="<?php echo e(route('admin.placements.create')); ?>" class="btn btn-primary">Insert New Placement</a>
  </div>

  <table class="table table-bordered" id="placementTable">
    <thead class="table-dark">
      <tr>
        <th>Photo</th>
        <th>Name</th>
        <th>Email</th>
        <th>Contact</th>
        <th>Course</th>
        <th>Company</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php $__currentLoopData = $placements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $placement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <tr>
        <td>
          <?php if($placement->photo): ?>
            <img src="<?php echo e(asset('storage/' . $placement->photo)); ?>" width="50" height="50" class="rounded-circle">
          <?php else: ?>
            N/A
          <?php endif; ?>
        </td>
        <td><?php echo e($placement->user->first_name ?? 'N/A'); ?></td>
        <td><?php echo e($placement->user->email ?? 'N/A'); ?></td>
        <td><?php echo e($placement->user->contact_no ?? 'N/A'); ?></td>
        <td><?php echo e($placement->course->name ?? 'N/A'); ?></td>
        <td><?php echo e($placement->company); ?></td>
        <td>
          <a href="<?php echo e(route('admin.placements.edit', $placement->id)); ?>" class="btn btn-sm btn-warning">Edit</a>
          
          <form action="<?php echo e(route('admin.placements.destroy', $placement->id)); ?>" method="POST" style="display:inline;">
            <?php echo csrf_field(); ?>
            <?php echo method_field('DELETE'); ?>
            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this record?')">Delete</button>
          </form>
        </td>
      </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
  </table>
</div>

<script>
  function filterTable() {
    let input = document.getElementById("searchInput").value.toLowerCase();
    let rows = document.querySelectorAll("#placementTable tbody tr");

    rows.forEach(row => {
      let name = row.children[1].textContent.toLowerCase();
      let company = row.children[5].textContent.toLowerCase();
      row.style.display = (name.includes(input) || company.includes(input)) ? "" : "none";
    });
  }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\vishw\form\resources\views/admin/placements/index.blade.php ENDPATH**/ ?>