<?php 

     // Include homepage sections
     $sections = [
        'events/pageHeader', 'home/events',
     ];

     foreach ($sections as $section) {
        include "includes/$section.php";
    }
?>