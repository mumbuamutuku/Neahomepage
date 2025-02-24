<?php 

$sections = [
    'contact/contactForm'
];

foreach ($sections as $section) {
    include "includes/$section.php";
}