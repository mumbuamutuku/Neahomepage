<?php 

     $sections = [
        'blogs/singleBlogHeader', 'blogs/singleBlog'
     ];

     foreach ($sections as $section) {
        include "includes/$section.php";
    }
?>