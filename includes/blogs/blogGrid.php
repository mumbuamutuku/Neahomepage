<?php
require_once 'api/apiService.php';

$apiService = new ApiService();
$currentPage = isset($_GET['p']) ? (int)$_GET['p'] : 1;
$searchQuery = isset($_GET['search']) ? trim($_GET['search']) : '';
$itemsPerPage = isset($_GET['size']) ? (int)$_GET['size'] : 6; 

$blogsResponse = $apiService->getBlogs($currentPage, $itemsPerPage, $searchQuery);

//$blogsResponse = $apiService->getBlogs($currentPage, 1, $searchQuery);

//$blogsResponse = $apiService->getBlogs(1, 10);

// Ensure 'data' exists before using it
$blogs = isset($blogsResponse['data']) ? $blogsResponse['data'] : [];
$total = $blogsResponse['total'];
$size = $blogsResponse['size'];
$page = $blogsResponse['page'];

//Category
$categoryResponse = $apiService->getBlogs(1, 100);
$category = isset($categoryResponse['data']) ? $categoryResponse['data'] : [];

//Recentblogs
$recentBlogsResponse = $apiService->getRecentBlogs();
$recentBlogs = isset($recentBlogsResponse['data']) ? $recentBlogsResponse['data'] : [];
?>
<!-- Blog Start -->
 <div class="container-fluid py-6 px-5" style="background-color: #f8f9fa;"> 

        <div class="row g-5">
            <!-- Blog list Start --> 
            <div class="col-lg-8">
            <div class="mb-3 d-flex justify-content-between align-items-center">
                <h2 class="mb-0">Blogs</h2>
                <form method="GET" class="d-flex">
                    <input type="hidden" name="page" value="blogs">
                    <input type="hidden" name="p" value="<?= $currentPage ?>">
                    <input type="hidden" name="search" value="<?= htmlspecialchars($searchQuery) ?>">
                    
                    <label for="size" class="me-2">Show:</label>
                    <select name="size" id="size" class="form-select" onchange="this.form.submit()">
                        <option value="5" <?= ($itemsPerPage == 5) ? 'selected' : '' ?>>5</option>
                        <option value="1" <?= ($itemsPerPage == 1) ? 'selected' : '' ?>>1</option>
                        <option value="10" <?= ($itemsPerPage == 10) ? 'selected' : '' ?>>10</option>
                        <option value="15" <?= ($itemsPerPage == 15) ? 'selected' : '' ?>>15</option>
                        <option value="20" <?= ($itemsPerPage == 20) ? 'selected' : '' ?>>20</option>
                    </select>
                </form>
            </div>
                <div class="row g-5">
                    <?php foreach ($blogs as $blog): ?>
                    <div class="col-xl-6 col-lg-12 col-md-6">
                        <div class="blog-item">
                            <div class="position-relative overflow-hidden">
                            <img class="img-fluid" src="<?= htmlspecialchars($blog['banner_image']) ?>" 
                                alt="<?= htmlspecialchars($blog['post_title']) ?>" 
                                style="width: 550px; height: 400px; object-fit: cover; border-radius: 10px;" >

                                
                            </div>
                            
                            <div class="bg-secondary d-flex">
                                <div class="flex-shrink-0 d-flex flex-column justify-content-center text-center bg-primary text-white px-4">
                                <?php 
                                $date = new DateTime($blog['post_time']);
                                ?>    
                                <span><?= $date->format('d') ?></span>
                        <h5 class="text-uppercase m-0"><?= $date->format('M') ?></h5>
                        <span><?= $date->format('Y') ?></span>
                                </div>
                                <div class="d-flex flex-column justify-content-center py-3 px-4">
                                    <div class="d-flex mb-2 text-white">
                                        <small class="text-uppercase me-3"><i class="bi bi-person me-2"></i> <?= htmlspecialchars($blog['post_writer_first_name']) ?> <?= htmlspecialchars($blog['post_writer_last_name']) ?></small>
                                        <small class="text-uppercase me-3"><i class="bi bi-bookmarks me-2"></i><?= htmlspecialchars($blog['category']) ?></small>
                                    </div>
                                    <a class="h4" href="route.php?page=blog&id=<?= htmlspecialchars($blog['_id']) ?>" ><?= htmlspecialchars($blog['post_title']) ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                   <?php endforeach; ?>
                    <div class="col-12">
                    <nav aria-label="Page navigation">
                        <ul class="pagination pagination-lg m-0">
                            <!-- Previous Page Button -->
                            <li class="page-item <?= ($currentPage <= 1) ? 'disabled' : '' ?>">
                            <!-- <a class="page-link rounded-0" href="?page=blogs&p=<?= $currentPage - 1 ?>&search=<?= urlencode($searchQuery) ?>" aria-label="Previous"> -->
                            <a class="page-link rounded-0" href="?page=blogs&p=<?= $currentPage - 1 ?>&size=<?= $itemsPerPage ?>&search=<?= urlencode($searchQuery) ?>" aria-label="Previous">
                                <span aria-hidden="true"><i class="bi bi-arrow-left"></i></span>
                            </a>
                            </li>

                            <!-- Page Numbers -->
                            <?php
                            //$totalPages = ceil($total / $size);
                            $totalPages = ceil($total / $itemsPerPage);
                            for ($i = 1; $i <= $totalPages; $i++): ?>
                            <li class="page-item <?= ($i == $currentPage) ? 'active' : '' ?>">
                                <!-- <a class="page-link" href="?page=blogs&p=<?= $i ?>&search=<?= urlencode($searchQuery) ?>"><?= $i ?></a> -->
                                <a class="page-link" href="?page=blogs&p=<?= $i ?>&size=<?= $itemsPerPage ?>&search=<?= urlencode($searchQuery) ?>"><?= $i ?></a>
                            </li>
                            <?php endfor; ?>

                            <!-- Next Page Button -->
                            <li class="page-item <?= ($currentPage >= $totalPages) ? 'disabled' : '' ?>">
                            <!-- <a class="page-link rounded-0" href="?page=blogs&p=<?= $currentPage + 1 ?>&search=<?= urlencode($searchQuery) ?>" aria-label="Next"> -->
                            <a class="page-link rounded-0" href="?page=blogs&p=<?= $currentPage + 1 ?>&size=<?= $itemsPerPage ?>&search=<?= urlencode($searchQuery) ?>" aria-label="Next">
                                <span aria-hidden="true"><i class="bi bi-arrow-right"></i></span>
                            </a>
                            </li>
                        </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Blog list End -->

            <!-- Sidebar Start -->
            <div class="col-lg-4">
                <!-- Search Form Start -->
                <div class="mb-5">
                    <form method="GET" action="">
                        <div class="input-group">
                            <input type="text" class="form-control p-3" name="search" value="<?= htmlspecialchars($searchQuery) ?>" placeholder="Keyword">
                            <input type="hidden" name="page" value="blogs"> <!-- Ensure it stays on the blogs page -->
                            <button class="btn btn-primary px-4" type="submit"><i class="bi bi-search"></i></button>
                        </div>
                    </form>
                </div>
                <!-- Search Form End -->

                <!-- Category Start -->
                <div class="mb-5">
                    <h2 class="mb-4">Categories</h2>
                    <div class="d-flex flex-column justify-content-start bg-light p-4">
                        <?php foreach ($category as $cat): ?>
                        <a class="h5 mb-3" href="#">
                            <i class="bi bi-arrow-right text-primary me-2"></i>
                            <?= htmlspecialchars($cat['category']) ?></a>
                            <?php endforeach; ?>
                        </div>
                </div>
                <!-- Category End -->

                <!-- Recent Post Start -->
                <div class="mb-5">
                    <h2 class="mb-4">Recent Post</h2>
                    <?php foreach ($recentBlogs as $blog): ?>
                    <div class="d-flex mb-3 bg-light p-3">
                        <img class="img-fluid" src="<?= htmlspecialchars($blog['banner_image']) ?>" style="width: 100px; height: 100px; object-fit: cover;" alt="Blog Image">
                        <a href="route.php?page=blog&id=<?= htmlspecialchars($blog['_id']) ?>" class="h5 d-flex align-items-center px-3 mb-0"><?= htmlspecialchars($blog['post_title']) ?>
                        </a>
                    </div>
                    <?php endforeach; ?>
                </div>
                <!-- Recent Post End -->
            </div>
            <!-- Sidebar End -->
        </div>
    </div>
    <!-- Blog End -->