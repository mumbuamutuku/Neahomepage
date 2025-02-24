<?php 

     // Include homepage sections
     $sections = [
        'blogs/pageHeader', 'home/blogs'
     ];

     foreach ($sections as $section) {
        include "includes/$section.php";
    }
?>