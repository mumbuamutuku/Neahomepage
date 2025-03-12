<?php

$sections = [
    'teams/pioneerPage', 'home/teamthree',
];

foreach ($sections as $section) {
    include "includes/$section.php";
}
?>