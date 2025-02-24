<?php 

     // Include homepage sections
     $sections = [
        'aboutus/aboutheader', 'home/about',
        'aboutus/what', 'aboutus/brands',
     ];

     foreach ($sections as $section) {
        include "includes/$section.php";
    }
?>