<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Dashboard</title>
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      padding-top: 70px;
      background-color: #f0f2f5;
    }
    .course-img {
      width: 120px;
      height: 100px;
      object-fit: cover;
      border-radius: 8px;
      margin-top: 12px;
      display: block;
      margin-left: auto;
      margin-right: auto;
    }
    .navbar {
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }
    .card {
      border: none;
      border-radius: 16px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.08);
      transition: transform 0.2s ease;
    }
    .card:hover {
      transform: translateY(-5px);
    }
    .card-title {
      font-size: 20px;
      font-weight: bold;
      margin-bottom: 10px;
      color: #212529;
    }
    .card-text {
      font-size: 14px;
      color: #555;
    }
    .btn {
      border-radius: 8px;
    }
    .btn-success, .btn-primary, .btn-outline-primary {
      width: 100%;
      margin-top: 10px;
    }
    iframe {
      width: 100%;
      height: 200px;
      border-radius: 10px;
      margin-top: 10px;
    }
  </style>
</head>
<body>

<?php use Illuminate\Support\Facades\Auth; ?>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">User Dashboard</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <a class="nav-link" href="/">Home</a>
        <a class="nav-link" href="/logout">Logout</a>
      </ul>
    </div>
  </div>
</nav>

<!-- Welcome -->
<div class="container mt-4">
  <h3 class="mb-4"> Welcome, <?php echo e(session('first_name')); ?>





</h3>

  <!-- Courses -->
  <div class="row">
    <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php
        $alreadyEnrolled = \App\Models\CourseEnrollment::where('user_id', auth()->id())
                              ->where('course_id', $course->id)
                              ->exists();
      ?>

      <div class="col-md-4 mb-4">
        <div class="card h-100">
          <img src="<?php echo e(asset('storage/' . $course->image)); ?>" class="course-img" alt="Course Image">
          <div class="card-body text-center d-flex flex-column justify-content-between">
            <div>
              <h5 class="card-title"><?php echo e($course->name); ?></h5>
              <p class="card-text"><strong>Duration:</strong> <?php echo e($course->duration); ?></p>
              <p class="card-text"><strong>Technologies:</strong> <?php echo e($course->technologies); ?></p>
            </div>
            <div>
              <?php if($alreadyEnrolled): ?>
                <button class="btn btn-success" disabled>Enrolled</button>

                <?php if($course->youtubeVideos->count()): ?>
                  <button class="btn btn-outline-primary view-youtube-btn"
                          data-ytvideos='<?php echo json_encode($course->youtubeVideos->pluck("youtube_url"), 15, 512) ?>'>
                    View YouTube Videos
                  </button>
                <?php endif; ?>
              <?php else: ?>
                <button class="btn btn-primary enroll-btn"
                        data-id="<?php echo e($course->id); ?>">
                  Enroll
                </button>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>

  <!-- Pagination -->
  <div class="d-flex justify-content-center mt-4">
    <?php echo e($courses->links('pagination::bootstrap-5')); ?>

  </div>
</div>

<!-- Video Modal -->
<div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Course Videos</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="videoContainer">
        <!-- YouTube videos will load here -->
      </div>
    </div>
  </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
  // Convert YouTube URL to embeddable URL
  function convertToEmbedUrl(url) {
    if (!url) return '';
    if (url.includes("watch?v=")) {
      return "https://www.youtube.com/embed/" + url.split("watch?v=")[1];
    } else if (url.includes("youtu.be/")) {
      return "https://www.youtube.com/embed/" + url.split("youtu.be/")[1];
    }
    return url;
  }

  // Handle View YouTube Button Click
  $(document).on('click', '.view-youtube-btn', function () {
    const ytVideos = $(this).data('ytvideos');
    let html = '';

    if (Array.isArray(ytVideos)) {
      ytVideos.forEach(function (url) {
        const embedUrl = convertToEmbedUrl(url);
        html += `<iframe src="${embedUrl}" frameborder="0" allowfullscreen style="width:100%; height:300px; margin-bottom:15px;"></iframe>`;
      });
    } else {
      html = `<p>No YouTube videos available.</p>`;
    }

    $('#videoContainer').html(html);
    $('#videoModal').modal('show');
  });

  // Clear modal content on close
  $('#videoModal').on('hidden.bs.modal', function () {
    $('#videoContainer').html('');
  });

  // Handle enrollment
  $(document).on('click', '.enroll-btn', function () {
    const courseId = $(this).data('id');

    $.ajax({
      url: '/enroll',
      type: 'POST',
      data: {
        course_id: courseId,
        _token: $('meta[name="csrf-token"]').attr('content')
      },
      success: function () {
        location.reload(); // reload to reflect enrolled status and buttons
      },
      error: function () {
        alert('Enrollment failed!');
      }
    });
  });
</script>

</body>
</html>
<?php /**PATH C:\Users\vishw\form\resources\views/user/courses.blade.php ENDPATH**/ ?>