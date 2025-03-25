<?php 
     $sections = [
        'testimonials/testmonialsHeader', 'home/testimonial',
     ];

     foreach ($sections as $section) {
        include "includes/$section.php";
    }
?>