<?php 
    $title = "HOME";
    // Check if header has already been included (avoid double inclusion)
    if (!defined('LOADED_FROM_ROUTER')) {
        require_once 'includes/header.php';
        include 'includes/home/topbar.php';
    }

    // Include homepage sections
    $sections = [
        'home/carousel', 'home/features', 'home/about', 
        'home/service', 'home/events', 'home/blogs', 'home/workwithus', 
        'home/team', 'home/testimonial'
    ];

    foreach ($sections as $section) {
        include "includes/$section.php";
    }

    // Check if footer has already been included (avoid double inclusion)
    if (!defined('LOADED_FROM_ROUTER')) {
        include 'includes/pagefooter.php';
        require_once 'includes/footer.php';
    }
?>
