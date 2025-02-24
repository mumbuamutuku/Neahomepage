<?php
require_once 'api/apiService.php';

$apiService = new ApiService();
$blogId = $_GET['id'] ?? null;

// Fetch blog post details
$blogsResponse = $blogId ? $apiService->getBlogById($blogId) : null;

$blog = (!empty($blogsResponse['data']) && is_array($blogsResponse['data'])) ? $blogsResponse['data'][0] : null;

if (!$blog) {
    echo "<p class='text-center text-danger mt-5'>Blog post not found.</p>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['commentBody'])) {
    header("Content-Type: application/json"); 
    $commentBody = trim($_POST['commentBody']);
    
    if (empty($commentBody)) {
        echo json_encode(["success" => false, "message" => "Comment cannot be empty"]);
        exit;
    }

    $response = $apiService->postComment($blogId, $commentBody);  

    echo json_encode(["success" => $response['success'], "message" => $response['message']]);
    exit;
}

?>

<div class="container py-5 px-2 bg-white">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <img class="img-fluid w-100 mb-4 rounded" src="<?= htmlspecialchars($blog['banner_image']) ?>" alt="Blog Image">
            <h2 class="mb-3 font-weight-bold text-warning"><?= htmlspecialchars($blog['post_title']) ?></h2>
            
            <div class="d-flex align-items-center my-3">
                <img src="<?= htmlspecialchars($blog['post_writer_image']) ?>" alt="Author Image" 
                    class="rounded-circle me-2 border" style="width: 50px; height: 50px; object-fit: cover;">
                <p class="text-muted mb-0 me-3">
                    <strong>By</strong> <?= htmlspecialchars($blog['post_writer_first_name']) ?> <?= htmlspecialchars($blog['post_writer_last_name']) ?>
                </p>
                <p class="mb-0 text-muted me-3"><i class="fa fa-calendar-alt"></i> <?= date("d M Y", strtotime($blog['post_time'])) ?></p>
                <p class="mb-0 text-muted me-3"><i class="fa fa-folder"></i> <?= htmlspecialchars($blog['category']) ?></p>
                <p class="mb-0 text-muted"><i class="fa fa-comments"></i> <?= count($blog['comments']) ?> Comments</p>
            </div>

            <p class="mt-4 lh-lg"><?= nl2br(htmlspecialchars($blog['post_body'])) ?></p>
        </div>

        <!-- Comments Section -->
        <div class="col-lg-10 py-5">
            <h3 class="mb-4 font-weight-bold"><?= count($blog['comments']) ?> Comments</h3>
            <div class="border rounded p-3">
                <?php foreach ($blog['comments'] as $comment): ?>
                    <div class="media mb-4 p-3 border-bottom">
                        <div class="media-body">
                            <small class="text-muted"><i><?= date("d M Y \a\\t h:i A", strtotime($comment['comment_time'])) ?></i></small>
                            </h5>
                            <p class="text-muted"><?= htmlspecialchars($comment['comment_body']) ?></p>
                            <button class="btn btn-sm btn-outline-primary">Reply</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Comment Form -->
        <div class="col-lg-8">
            <h3 class="mb-4 font-weight-bold">Leave a comment</h3>
            <form id="commentForm" class="p-4 border rounded shadow-sm">
                <div class="mb-3">
                    <label for="message" class="form-label">Message *</label>
                    <textarea id="message" class="form-control" rows="5"></textarea>
                </div>
                <div class="mb-3 text-end">
                    <input type="submit" value="Leave Comment" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const blogId = "<?= htmlspecialchars($blogId) ?>"; 
</script>

<script src="js/comment.js"></script>
