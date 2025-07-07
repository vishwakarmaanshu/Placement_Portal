

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>All Users - Admin Panel</title>
 

<?php $__env->startSection('content'); ?>
<style>
  .users-container {
    padding: 20px;
    background: #f8f9fa;
  }

  .users-table {
    width: 100%;
    border-collapse: collapse;
    background: #fff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 0 10px rgba(0,0,0,0.05);
  }

  .users-table thead {
    background-color: #007bff;
    color: white;
  }

  .users-table th, .users-table td {
    padding: 12px 15px;
    text-align: left;
  }

  .users-table tbody tr:nth-child(even) {
    background-color: #f2f2f2;
  }

  .search-bar {
    margin-bottom: 20px;
    padding: 10px;
    width: 100%;
    max-width: 400px;
    border-radius: 5px;
    border: 1px solid #ccc;
  }

  @media screen and (max-width: 768px) {
    .users-table thead {
      display: none;
    }

    .users-table tr {
      display: block;
      margin-bottom: 15px;
      background: #fff;
      border: 1px solid #ccc;
      border-radius: 8px;
      overflow: hidden;
    }

    .users-table td {
      display: block;
      text-align: right;
      padding-left: 50%;
      position: relative;
      padding: 12px;
    }

    .users-table td::before {
      content: attr(data-label);
      position: absolute;
      left: 15px;
      width: 45%;
      text-align: left;
      font-weight: bold;
    }
  }
</style>

<div class="users-container">
  <h2 style="margin-bottom: 20px;">All Registered Users</h2>

  <input type="text" id="searchInput" class="search-bar" onkeyup="searchUsers()" placeholder="Search by name or email...">

  <div class="table-responsive">
    <table class="users-table" id="usersTable">
      <thead>
        <tr>
          <th>ID</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Email</th>
          <th>Contact</th>
          <!-- <th>Course Name</th> -->
        </tr>
      </thead>
      <tbody>
        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
          <td data-label="ID"><?php echo e($user->id); ?></td>
          <td data-label="First Name"><?php echo e($user->first_name); ?></td>
          <td data-label="Last Name"><?php echo e($user->last_name); ?></td>
          <td data-label="Email"><?php echo e($user->email); ?></td>
          <td data-label="Contact"><?php echo e($user->contact_no); ?></td>
          <!-- <td data-label="Course"><?php echo e($user->course_name); ?></td> -->
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </tbody>
    </table>
  </div>
</div>

<script>
  function searchUsers() {
    const input = document.getElementById("searchInput").value.toLowerCase();
    const table = document.getElementById("usersTable");
    const rows = table.getElementsByTagName("tr");

    for (let i = 1; i < rows.length; i++) {
      const firstName = rows[i].getElementsByTagName("td")[1]?.textContent.toLowerCase() || "";
      const lastName = rows[i].getElementsByTagName("td")[2]?.textContent.toLowerCase() || "";
      const email = rows[i].getElementsByTagName("td")[3]?.textContent.toLowerCase() || "";

      if (firstName.includes(input) || lastName.includes(input) || email.includes(input)) {
        rows[i].style.display = "";
      } else {
        rows[i].style.display = "none";
      }
    }
  }
</script>
<?php $__env->stopSection(); ?>

</body>
</html>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\vishw\form\resources\views/admin/users.blade.php ENDPATH**/ ?>