
<?php
    require_once 'api/apiService.php'; 

    $apiService = new ApiService();     
    $testimonials = $apiService->getActiveTestimonials(0, 6);
?>
    <!-- Testimonial Start -->
    <div class="container-xxl pt-5">
        <div class="container">
            <div class="text-center text-md-start pb-5 pb-md-0 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <p class="fs-5 fw-medium text-primary">Testimonial</p>
                <h1 class="display-5 mb-5">What Clients Say About Our Services!</h1>
            </div>
           
            <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
            <?php foreach ($testimonials as $testimonial): ?>
                <div class="testimonial-item rounded p-4 p-lg-5 mb-5">
                    <img class="mb-4" src="<?= htmlspecialchars($testimonial['client_pic']) ?>" alt="<?= htmlspecialchars($testimonial['client_name']) ?>" >
                    <p class="mb-4"><?= htmlspecialchars($testimonial['content']) ?></p>
                    <h5>"<?= htmlspecialchars($testimonial['client_name']) ?>"</h5>
                    <span class="text-primary"> "<?= htmlspecialchars($testimonial['position']) ?>" <span> - </span>"<?= htmlspecialchars($testimonial['company']) ?>"</span>
                </div>
                <?php endforeach; ?>
            </div>
           
        </div>
    </div>
    <!-- Testimonial End -->