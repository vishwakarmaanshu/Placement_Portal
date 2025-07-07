<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>IT Courses Dashboard</title>
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      margin: 0; padding-top: 70px;
      background-color: #f0f2f5;
      font-family: Arial, sans-serif;
    }
    .navbar {
      position: fixed; top: 0; left: 0; right: 0;
      z-index: 999;
    }
    h2 {
      text-align: center;
      margin-bottom: 30px;
      color: #333;
    }
    .course-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 15px;
    }
    .course-card {
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      padding: 20px;
      text-align: center;
      transition: 0.2s;
    }
    .course-card:hover {
      transform: translateY(-5px);
    }
    .course-card img {
      width: 80px;
      height: 80px;
      object-fit: contain;
      margin-bottom: 15px;
    }
    .course-name {
      font-size: 18px;
      font-weight: bold;
      color: #007bff;
      margin-bottom: 10px;
    }
    iframe {
      width: 100%;
      height: 250px;
      margin-top: 10px;
      display: none;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light shadow">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><strong>Free Placement Provider</strong></a>
    <div class="collapse navbar-collapse">
      <div class="navbar-nav ms-auto">
         <!-- <a class="nav-link" href="/logout">Logout</a> -->
        <a class="nav-link" href="/logout">Logout</a>
      </div>
    </div>
  </div>
</nav>

<h2>Welcome, <?php echo e(auth()->user()->name); ?></h2>

<div class="course-container">
  <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
      $videoLinks = json_decode($course->youtube_link, true) ?? [];
      $firstVideo = $videoLinks[0] ?? '';
      $alreadyEnrolled = \App\Models\CourseEnrollment::where('user_id', auth()->id())
                            ->where('course_id', $course->id)
                            ->exists();
    ?>

    <div class="course-card">
      <img src="<?php echo e(asset('storage/' . $course->image)); ?>" alt="Course Image">
      <div class="course-name"><?php echo e($course->name); ?></div>
      <p><strong>Duration:</strong> <?php echo e($course->duration); ?></p>
      <p><strong>Technology:</strong> <?php echo e($course->technologies); ?></p>

      <?php if($alreadyEnrolled): ?>
        <button class="btn btn-secondary mb-2" disabled>Enrolled</button>
        <button class="btn btn-primary" onclick="toggleVideo('video<?php echo e($index); ?>')">View</button>
      <?php else: ?>
        <button class="btn btn-success enroll-btn"
                data-id="<?php echo e($course->id); ?>"
                data-video="<?php echo e($firstVideo); ?>"
                data-index="<?php echo e($index); ?>">
          Enroll
        </button>
        <button class="btn btn-primary view-btn" style="display: none;" onclick="toggleVideo('video<?php echo e($index); ?>')">View</button>
      <?php endif; ?>

      <div id="video<?php echo e($index); ?>" style="display: none;">
        <?php $__currentLoopData = $videoLinks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <iframe src="<?php echo e($link); ?>" frameborder="0" allowfullscreen></iframe>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    </div>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<!-- Modal -->
<div class="modal fade" id="enrollModal" tabindex="-1" aria-labelledby="enrollModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Enrollment Successful</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body text-center">
        <p class="fs-5">You have successfully enrolled in the course.</p>
        <div id="videoContainer" class="my-3" style="display: none;">
          <iframe id="youtubeVideo" width="100%" height="400" frameborder="0" allowfullscreen></iframe>
        </div>
        <button id="viewVideoBtn" class="btn btn-outline-primary">View Course Video</button>
      </div>
    </div>
  </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
  $(document).ready(function () {
    $('.enroll-btn').click(function () {
      const button = $(this);
      const courseId = button.data('id');
      const videoUrl = button.data('video');
      const index = button.data('index');

      $.ajax({
        url: '<?php echo e(route('enroll')); ?>',
        type: 'POST',
        data: {
          course_id: courseId,
          _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
          button.removeClass('btn-success').addClass('btn-secondary').text('Enrolled').prop('disabled', true);
          button.siblings('.view-btn').show();

          $('#enrollModal').modal('show');
          $('#videoContainer').hide();
          $('#youtubeVideo').attr('src', '');

          $('#viewVideoBtn').off('click').on('click', function () {
            $('#videoContainer').show();
            $('#youtubeVideo').attr('src', videoUrl);
          });
        },
        error: function (xhr) {
          alert('Something went wrong.');
          console.log(xhr.responseText);
        }
      });
    });
  });

  function toggleVideo(id) {
    const videoSection = document.getElementById(id);
    videoSection.style.display = (videoSection.style.display === 'block') ? 'none' : 'block';
  }
</script>

</body>
</html>
<?php /**PATH C:\Users\vishw\form\resources\views/user/dashboard.blade.php ENDPATH**/ ?>