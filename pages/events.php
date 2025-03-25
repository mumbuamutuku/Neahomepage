<?php 
     $sections = [
        'events/pageHeader', 'events/eventGrid',
     ];

     foreach ($sections as $section) {
        include "includes/$section.php";
    }
?>