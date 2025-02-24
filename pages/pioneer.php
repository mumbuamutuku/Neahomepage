<?php

$sections = [
    'teams/pioneerPage', 'home/team',
];

foreach ($sections as $section) {
    include "includes/$section.php";
}
?>