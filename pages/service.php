<?php

$sections = [
    'service/serviceHeader', 'home/service',
 ];

 foreach ($sections as $section) {
    include "includes/$section.php";
}
?>