<?php
 $baseDir = dirname(__DIR__) . '/api/apiService.php';

require_once $baseDir;

$apiService = new ApiService();
$blogsResponse = $apiService->getBlogs(1, 10);

// Ensure 'data' exists before using it
$blogs = isset($blogsResponse['data']) ? $blogsResponse['data'] : [];

?>
<!-- Blog Start -->
<div class="container-fluid blog py-5">
    <div class="container py-5">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 900px;">
            <h4 class="text-primary">Our Blog</h4>
            <h1 class="display-5 mb-4">Join Us For New Blog</h1>
            <p class="mb-0">
                Dolor sit amet consectetur, adipisicing elit. Ipsam, beatae maxime. Vel animi eveniet doloremque reiciendis 
                soluta iste provident non rerum illum perferendis earum est architecto dolores vitae quia vero quod incidunt 
                culpa corporis, porro doloribus. Voluptates nemo doloremque cum.
            </p>
        </div>
        <div class="row g-4 justify-content-center">
            <?php foreach ($blogs as $blog): ?>
                <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="blog-item">
                        <div class="blog-img">
                            <img src="<?= htmlspecialchars($blog['banner_image']) ?>" 
                                 alt="<?= htmlspecialchars($blog['post_title']) ?>" 
                                 class="img-fluid w-100">
                            <div class="blog-info">
                                <span><i class="fa fa-clock"></i> <?= date("F j, Y", strtotime($blog['post_time'])) ?></span>
                                <div class="d-flex">
                                    <span class="me-3"> 
                                        <?= isset($blog['likes']) ? htmlspecialchars($blog['likes']) : 0 ?> 
                                        <i class="fa fa-heart"></i>
                                    </span>
                                    <a href="#" class="text-white">
                                        <?= isset($blog['comments']) ? count($blog['comments']) : 0 ?>
                                        <i class="fa fa-comment"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="blog-content text-dark border p-4">
                            <h5 class="mb-4"><?= htmlspecialchars($blog['post_title']) ?></h5>
                            <p class="mb-4"><?= htmlspecialchars(substr($blog['post_body'], 0, 120)) ?>...</p>
                            <a class="btn btn-light rounded-pill py-2 px-4" href="#">Read More</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!-- Blog End -->
