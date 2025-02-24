<?php
require_once 'api/apiService.php';

$apiService = new ApiService();
$blogs = $apiService->getBlogs(1, 100, "string", null);
?>

<!-- Display the blogs in HTML -->
<div class="container-xxl pt-5">
    <div class="container">
        <div class="text-center text-md-start pb-5 pb-md-0 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <p class="fs-5 fw-medium text-primary">Our Blogs</p>
            <h1 class="display-5 mb-5">Glean more Knowlegde from our Articles</h1>
        </div>

        <div class="owl-carousel project-carousel wow fadeInUp" data-wow-delay="0.1s">
            <?php foreach ($blogs as $blog): ?>
                <div class="project-item mb-5">
                    <!-- Blog Image -->
                    <div class="position-relative">
                        <img class="img-fluid" src="<?= htmlspecialchars($blog['PicPath']) ?>" 
                            alt="<?= htmlspecialchars($blog['PostTitle']) ?>" 
                            style="width: 550px; height: 400px; object-fit: cover; border-radius: 10px;">
                        <div class="project-overlay">
                            <a class="btn btn-lg-square btn-light rounded-circle m-1" href="<?= htmlspecialchars($blog['PicPath']) ?>" data-lightbox="project">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a class="btn btn-lg-square btn-light rounded-circle m-1" href="#"><i class="fa fa-link"></i></a>
                        </div>
                    </div>

                    <!-- Blog Details -->
                    <div class="p-4">
                        <!-- Category -->
                        <span class="badge bg-primary mb-2"><?= htmlspecialchars($blog['category']) ?></span>

                        <!-- Blog Title -->
                        <a class="d-block h5 fw-bold text-dark" href="#"><?= htmlspecialchars($blog['PostTitle']) ?></a>

                        <!-- Author Info -->
                        <div class="d-flex align-items-center my-3">
                            <img src="<?= htmlspecialchars($blog['postWriterImage']) ?>" alt="Author Image" 
                                class="rounded-circle me-2" style="width: 40px; height: 40px; object-fit: cover;">
                            <p class="text-muted mb-0">By <?= htmlspecialchars($blog['postWriterFirstName']) ?> <?= htmlspecialchars($blog['postWriterLastName']) ?></p>
                        </div>

                        <!-- Short Description -->
                        <p class="text-muted"><?= htmlspecialchars(substr($blog['PostBody'], 0, 120)) ?>...</p>

                        <!-- Date & Time -->
                        <div class="d-flex flex-column">
                            <p class="text-muted mb-2">
                                <i class="fa fa-calendar-alt text-primary me-2"></i> 
                                <?= date("F j, Y", strtotime($blog['PostTime'])) ?>
                            </p>
                        </div>

                        <!-- Read More Button -->
                        <a href="route.php?page=blog&id=<?= $blog['_id'] ?>" class="btn btn-outline-primary btn-sm">
                            Read More <i class="fa fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

