<?php 
    
     // Include  sections
     $sections = [
        'teams/teamsHeader', 'home/teamthree',
     ];

     foreach ($sections as $section) {
        include "includes/$section.php";
    }
?>