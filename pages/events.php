<?php 

     // Include homepage sections
     $sections = [
        'events/pageHeader', 'events/eventGrid',
     ];

     foreach ($sections as $section) {
        include "includes/$section.php";
    }
?>