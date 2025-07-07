<!DOCTYPE html>
<html>
<head>
    <title>Edit Placement</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 40px;
            display: flex;
            justify-content: center;
        }

        .container {
            background-color: #fff;
            padding: 10px 10px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            max-width: 500px;
            width: 90%;
        }

        h1 {
            text-align: center;
            color: #333;
            /* margin-bottom: 20px; */
            margin-top: 80px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }

        button:hover {
            background-color: #218838;
        }

        .back-link {
            display: block;
            margin-top: 15px;
            text-align: center;
            color: #007bff;
            text-decoration: none;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        .error-list {
            color: red;
            margin-bottom: 20px;
        }

        .error-list ul {
            padding-left: 20px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top shadow">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"><h1 class="h4 mb-0">Free Placement Provider</h1></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
              aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ms-auto">
           <a class="nav-link" href="/">Logout</a>
        </div>
      </div>
    </div>
  </nav>
    <div class="container">
        <h1 style="margin-top: 40px;">Edit Placement</h1>

        <?php if($errors->any()): ?>
            <div class="error-list">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?php echo e(route('placements.update', $placement->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <label>Name:</label>
            <input type="text" name="name" value="<?php echo e($placement->name); ?>">

            <label>Company:</label>
            <input type="text" name="company" value="<?php echo e($placement->company); ?>">

            <label>Course:</label>
            <input type="text" name="course" value="<?php echo e($placement->course); ?>">

            <label>Photo URL:</label>
            <input type="text" name="photo" value="<?php echo e($placement->photo); ?>">

            <button type="submit">Update</button>
        </form>

        <a href="<?php echo e(route('placements.index')); ?>" class="back-link">← Back to List</a>
    </div>
</body>
</html>
<?php /**PATH C:\Users\vishw\form\resources\views/placements/edit.blade.php ENDPATH**/ ?>