<?php
require_once 'api/apiService.php'; 

$apiService = new ApiService();
$events = $apiService->getEvents(0, 6);
?>

<!-- Display the Events in HTML -->
 <!-- Event Start -->
 <body class="events-page">
 <div class="event">
            <div class="container">
                <div class="section-header text-center">
                    <p>Upcoming Events</p>
                    <h2>Be ready for our upcoming charity events</h2>
                </div>
            <div class="row">
                <?php foreach ($events as $event): ?>
                    <div class="col-lg-6">
                        <div class="event-item">
                            <img src="<?= htmlspecialchars($event['image_url']) ?>" alt="<?= htmlspecialchars($event['name']) ?>">
                            <div class="event-content">
                                <div class="event-meta">
                                    <p><i class="fa fa-calendar-alt"></i> <?= htmlspecialchars($event['time']) ?></p>
                                    <p><i class="far fa-clock"></i> <?= date("F j, Y", strtotime($event['date'])) ?></p>
                                    <p><i class="fa fa-map-marker-alt"></i> <?= htmlspecialchars($event['location']) ?></p>
                                </div>
                                <div class="event-text">
                                    <h3><?= htmlspecialchars($event['name']) ?></h3>
                                    <p><?= htmlspecialchars($event['description']) ?></p>
                                    <a class="btn btn-custom" href="">Join Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            </div>

    </div>

