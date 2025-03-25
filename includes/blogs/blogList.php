<?php
require_once 'api/apiService.php';

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$itemsPerPage = isset($_GET['items_per_page']) ? (int)$_GET['items_per_page'] : 3;

$apiService = new ApiService();
$blogsResponse = $apiService->getBlogs(1, 10);

$blogs = isset($blogsResponse['data']) ? $blogsResponse['data'] : [];
$totalBlogs = $blogsResponse['total'];
$totalPages = ceil($totalBlogs / $itemsPerPage);
?>

<!-- Display the blogs in HTML -->

<div class="container-xxl pt-5">
    <div class="container">
        <div class="text-center text-md-start pb-5 pb-md-0 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <p class="fs-5 fw-medium text-primary">Our Blogs</p>
            <h1 class="display-5 mb-5">Glean more Knowledge from our Articles</h1>
        </div>

        <!-- Search Bar and Items Per Page Dropdown -->
        <div class="row g-4">
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
            <div class="ms-3">
                <select class="form-select" id="itemsPerPage" onchange="updateItemsPerPage()">
                    <option value="3" <?= $itemsPerPage == 3 ? 'selected' : '' ?>>3 per page</option>
                    <option value="5" <?= $itemsPerPage == 5 ? 'selected' : '' ?>>5 per page</option>
                    <option value="10" <?= $itemsPerPage == 10 ? 'selected' : '' ?>>10 per page</option>
                </select>
            </div>
        </div>

        <!-- Blog List -->
        <div class="row g-4">
            <?php foreach ($blogs as $blog): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <!-- Blog Image -->
                        <img class="card-img-top" src="<?= htmlspecialchars($blog['banner_image']) ?>" 
                            alt="<?= htmlspecialchars($blog['post_title']) ?>" 
                            style="height: 200px; object-fit: cover; border-radius: 10px 10px 0 0;">

                        <!-- Blog Details -->
                        <div class="card-body">
                            <!-- Date and Author -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <small class="text-muted"><?= date("d M Y", strtotime($blog['post_time'])) ?></small>
                                <small class="text-muted"><?= htmlspecialchars($blog['post_writer_first_name']) ?> <?= htmlspecialchars($blog['post_writer_last_name']) ?></small>
                            </div>

                            <!-- Blog Title -->
                            <h5 class="card-title fw-bold"><?= htmlspecialchars($blog['post_title']) ?></h5>

                            <!-- Short Description -->
                            <p class="card-text text-muted"><?= htmlspecialchars(substr($blog['post_body'], 0, 100)) ?>...</p>

                            <!-- Read More Button -->
                            <a href="blog/<?php echo $blog['_id']; ?>" class="btn btn-outline-primary btn-sm">
                            <!-- <a href="route.php?page=blog&id=<?= $blog['_id'] ?>" class="btn btn-outline-primary btn-sm"> -->
                                Read More <i class="fa fa-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Pagination -->
        <ul class="pagination justify-content-center mt-4">
            <li class="page-item <?= $page == 1 ? 'disabled' : '' ?>">
                <a class="page-link" href="?page=<?= $page - 1 ?>&items_per_page=<?= $itemsPerPage ?>">Previous</a>
            </li>
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?= $page == $i ? 'active' : '' ?>">
                    <a class="page-link" href="?page=<?= $i ?>&items_per_page=<?= $itemsPerPage ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>
            <li class="page-item <?= $page == $totalPages ? 'disabled' : '' ?>">
                <a class="page-link" href="?page=<?= $page + 1 ?>&items_per_page=<?= $itemsPerPage ?>">Next</a>
            </li>
        </ul>
    </div>
</div>

<script>
function updateItemsPerPage() {
    const itemsPerPage = document.getElementById('itemsPerPage').value;
    window.location.href = `?page=1&items_per_page=${itemsPerPage}`;
}
</script>