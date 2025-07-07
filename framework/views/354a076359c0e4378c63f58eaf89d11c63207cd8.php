<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Panel</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Segoe UI", sans-serif;
    }

    body {
      display: flex;
      min-height: 100vh;
      background: #f4f7fa;
    }

    .sidebar {
      width: 220px;
      background: #1e1e2f;
      color: white;
      flex-shrink: 0;
      padding: 20px;
      position: fixed;
      height: 100%;
    }

    .sidebar h2 {
      font-size: 22px;
      margin-bottom: 30px;
    }

    .sidebar a {
      color: #ddd;
      text-decoration: none;
      display: block;
      margin: 15px 0;
      transition: 0.2s;
    }

    .sidebar a:hover {
      color: #fff;
      background: #2b2b3d;
      padding-left: 10px;
    }

    .main-content {
      margin-left: 220px;
      padding: 20px;
      width: 100%;
    }

    .topbar {
      background: #fff;
      padding: 15px 20px;
      margin-bottom: 20px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .topbar h1 {
      font-size: 20px;
    }

    .cards {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
    }

    .card {
      background: white;
      flex: 1 1 200px;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      transition: transform 0.2s;
    }

    .card:hover {
      transform: scale(1.03);
    }

    .card h3 {
      font-size: 18px;
      margin-bottom: 10px;
      color: #333;
    }

    .card p {
      color: #666;
    }

    @media screen and (max-width: 768px) {
      .sidebar {
        display: none;
      }

      .main-content {
        margin-left: 0;
      }

      .topbar h1 {
        font-size: 16px;
      }

      .cards {
        flex-direction: column;
      }
    }
  </style>
</head>
<body>

  <!-- Sidebar -->
  <div class="sidebar">
    <h2>Admin Panel</h2>
    <a href="<?php echo e(route('user.dashboard')); ?>">Dashboard</a>

    <a href="<?php echo e(route('admin.users')); ?>">Users</a>

    <a href="<?php echo e(route('admin.courses.index')); ?>">Courses</a>
    <a href="<?php echo e(route('admin.placements.index')); ?>">Placements</a>
    <!-- <a href="#">Settings</a> -->
    <a href="/logout">Logout</a>
  </div>

  <!-- Main Content -->
  <div class="main-content">
    <!-- Topbar -->
    <div class="topbar">
      <h1>Welcome, Admin</h1>
      <span>🔔 Notifications</span>
    </div>

    <!-- Cards -->
    <div class="cards">
      <div class="card">
        <h3>Total Students</h3>
        <p>1,024</p>
      </div>
      <div class="card">
        <h3>Courses Available</h3>
        <p>12</p>
      </div>
      <div class="card">
        <h3>Companies Visited</h3>
        <p>30</p>
      </div>
      <div class="card">
        <h3>Active Users</h3>
        <p>789</p>
      </div>
    </div>
  </div>

</body>
</html>
<?php /**PATH C:\Users\vishw\form\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>