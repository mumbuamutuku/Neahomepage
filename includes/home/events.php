<?php
require_once 'api/apiService.php'; 

$apiService = new ApiService();
$eventsResponse = $apiService->getAllEvents(1, 6);

$events = isset($eventsResponse['data']) ? $eventsResponse['data'] : [];

?>

<!-- Display the Events in HTML -->
<div class="container-xxl pt-5">
    <div class="container">
        <div class="text-center text-md-start pb-5 pb-md-0 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <p class="fs-5 fw-medium text-primary">Upcoming Events</p>
            <h1 class="display-5 mb-5">Join Our Exciting Events</h1>
        </div>
        <<div class="owl-carousel project-carousel wow fadeInUp" data-wow-delay="0.1s">
            <?php foreach ($events as $event): ?>
                <div class="project-item mb-5">
                    <div class="position-relative">
                        <img class="img-fluid" src="<?= htmlspecialchars($event['image_url']) ?>" alt="<?= htmlspecialchars($event['name']) ?>" 
                        style="width: 550px; height: 400px; object-fit: cover; border-radius: 10px;">
                        <div class="project-overlay">
                            <a class="btn btn-lg-square btn-light rounded-circle m-1" href="<?= htmlspecialchars($event['image_url']) ?>" data-lightbox="project">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a class="btn btn-lg-square btn-light rounded-circle m-1" href="route.php?page=event&id=<?= $event['_id'] ?>"><i class="fa fa-link"></i></a>
                        </div>
                    </div>
                    <div class="p-4">
                        <a class="d-block h5 fw-bold text-primary" href="#"><?= htmlspecialchars($event['name']) ?></a>
                        <p class="text-muted"><?= htmlspecialchars($event['description']) ?></p>
        
                        <div class="d-flex flex-column">
                            <p class="text-muted mb-2">
                                <i class="fa fa-calendar-alt text-primary me-2"></i> 
                                <?= date("F j, Y", strtotime($event['date'])) ?>
                            </p>
                            <p class="text-muted mb-2">
                                <i class="fa fa-clock text-success me-2"></i> 
                                <?= htmlspecialchars($event['time']) ?>
                            </p>
                            <p class="text-muted mb-0">
                                <i class="fa fa-map-marker-alt text-danger me-2"></i> 
                                <?= htmlspecialchars($event['location']) ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
