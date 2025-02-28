<?php
require_once 'api/apiService.php';

$apiService = new ApiService();
$blogsResponse = $apiService->getBlogs(1, 10);

// Ensure 'data' exists before using it
$blogs = isset($blogsResponse['data']) ? $blogsResponse['data'] : [];
?>

<!-- Display the blogs in HTML -->
<div class="container-xxl pt-5">
    <div class="container">
        <div class="text-center text-md-start pb-5 pb-md-0 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <p class="fs-5 fw-medium text-primary">Our Blogs</p>
            <h1 class="display-5 mb-5">We've Written Lots of Awesome Blogs</h1>
        </div>

        <div class="owl-carousel project-carousel wow fadeInUp" data-wow-delay="0.1s">
            <?php foreach ($blogs as $blog): ?>
                <div class="project-item mb-5">
                    <!-- Blog Image -->
                    <div class="position-relative">
                        <img class="img-fluid" src="<?= htmlspecialchars($blog['banner_image']) ?>" 
                            alt="<?= htmlspecialchars($blog['post_title']) ?>" 
                            style="width: 550px; height: 400px; object-fit: cover; border-radius: 10px;">
                        <div class="project-overlay">
                            <a class="btn btn-lg-square btn-light rounded-circle m-1" href="<?= htmlspecialchars($blog['banner_image']) ?>" data-lightbox="project">
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
                        <a class="d-block h5 fw-bold text-dark" href="#"><?= htmlspecialchars($blog['post_title']) ?></a>

                        <!-- Author Info -->
                        <div class="d-flex align-items-center my-3">
                            <img src="<?= htmlspecialchars($blog['post_writer_image']) ?>" alt="Author Image" 
                                class="rounded-circle me-2" style="width: 40px; height: 40px; object-fit: cover;">
                            <p class="text-muted mb-0">By <?= htmlspecialchars($blog['post_writer_first_name']) ?> <?= htmlspecialchars($blog['post_writer_last_name']) ?></p>
                        </div>

                        <!-- Short Description -->
                        <p class="text-muted"><?= htmlspecialchars(substr($blog['post_body'], 0, 120)) ?>...</p>

                        <!-- Date & Time -->
                        <div class="d-flex flex-column">
                            <p class="text-muted mb-2">
                                <i class="fa fa-calendar-alt text-primary me-2"></i> 
                                <?= date("F j, Y", strtotime($blog['post_time'])) ?>
                            </p>
                        </div>

                        <!-- Read More Button -->
                        <a href="route.php?page=blog&id=<?= htmlspecialchars($blog['_id']) ?>" class="btn btn-outline-primary btn-sm">

                        <!-- <a href="route.php?page=blog&id=<?= $blog['_id'] ?>" class="btn btn-outline-primary btn-sm"> -->
                            Read More <i class="fa fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
