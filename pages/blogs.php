<?php
   $sections = [
      'blogs/pageHeader',
      'blogs/blogGrid',
   ];

   foreach ($sections as $section) {
      include "includes/$section.php";
}
