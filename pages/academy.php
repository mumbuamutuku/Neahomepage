<?php 

     // Include homepage sections
     $sections = [
         'academy/banner',
     ];

     foreach ($sections as $section) {
        include "includes/$section.php";
    }
?>