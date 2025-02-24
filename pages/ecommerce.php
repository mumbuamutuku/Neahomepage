<?php 

     // Include homepage sections
     $sections = [
        'teams/teamsHeader', 'home/team',
     ];

     foreach ($sections as $section) {
        include "includes/$section.php";
    }
?>