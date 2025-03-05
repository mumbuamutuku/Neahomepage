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
    'academy' => 'pages/academy.php',
    'healthcare' => 'pages/healthcare.php',
];

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
    'academy' => 'Academy',
    'healthcare' => 'Healthcare',
];


// Get the route and pagination parameters
$route = isset($_GET['page']) ? $_GET['page'] : 'home'; 
$paginationPage = isset($_GET['p']) ? (int)$_GET['p'] : 1; 

// Set the page title
$title = isset($pageTitles[$route]) ? "Nea Giants - " . $pageTitles[$route] : "Nea Giants";

// Handle the blogs page separately for pagination
if ($route === 'blogs' || $route === 'events') {
    // Pass the pagination page to the blogs template
    define('PAGINATION_PAGE', $paginationPage);
}

// Load the appropriate page
if (array_key_exists($route, $routes)) {
    define('LOADED_FROM_ROUTER', true); // Prevent double loading
    require_once 'includes/header.php';
    require_once 'includes/home/topbar.php';
    require_once $routes[$route];  
    require_once 'includes/pagefooter.php';
    require_once 'includes/footer.php';
} else {
    require_once 'pages/404.php';
}
?>