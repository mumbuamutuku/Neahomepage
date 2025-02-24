<?php
$routes = [
    'home' => 'index.php',
    'about' => 'pages/about.php',
    'ecommerce' => 'pages/ecommerce.php',
    'blogs' => 'pages/blogs.php',
    'blog' => 'pages/blog.php', 
    'events' => 'pages/events.php',
    'event' => 'pages/event.php',
    'team' => 'pages/team.php',
    'testimonials' => 'pages/testimonials.php',
    'contact' => 'pages/contact.php',
    'pioneers' => 'pages/pioneer.php',
];

$page = isset($_GET['page']) ? $_GET['page'] : 'home';

$pageTitles = [
    'home' => "Home",
    'about' => "About Us",
    'ecommerce' => "E-Commerce",
    'blogs' => "Blogs",
    'blog' => "Blog Post",
    'events' => "Events",
    'team' => "Our Team",
    'testimonials' => "Testimonials",
    'contact' => 'Contact Us',
    'pioneer' => 'Pioneer',
];

$title = isset($pageTitles[$page]) ? "Nea Giants - " . $pageTitles[$page] : "Nea Giants";

if (array_key_exists($page, $routes)) {
    define('LOADED_FROM_ROUTER', true); // Prevent double loading
    require_once 'includes/header.php';
    require_once 'includes/home/topbar.php';
    require_once $routes[$page];  
    require_once 'includes/pagefooter.php';
    require_once 'includes/footer.php';
} else {
    require_once 'pages/404.php';
}
?>
