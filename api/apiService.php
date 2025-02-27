<?php
require_once 'api/api.php'; 
// //require_once __DIR__ . '/../../../api/api.php';
// $file_path = __DIR__ . '\api.php';

// if (file_exists($file_path)) {
//     require_once $file_path;
// } else {
//     die("Error: File not found at $file_path");
// }

class ApiService
{
    private $apiClient;

    public function __construct()
    {
        $this->apiClient = new ApiClient(
            'https://nea-global-api-latest.onrender.com',

            //'http://127.0.0.1:8000', 
            
            [
                'Content-Type: application/json',
                'Accept: application/json'
            ]
        );
    }

    // Fetch events
    public function getEvents($skip = 0, $limit = 6)
    {
        $response = $this->apiClient->get("/user/web/event?skip={$skip}&limit={$limit}");
        return ($response['statusCode'] === 200) ? $response['body'] : [];
    }

    // Fetch blog posts
    public function getBlogs($page = 1, $itemsPerPage = 10, $search = "")
    {
        $payload = [
            "page" => $page,
            "items_per_page" => $itemsPerPage,
            "search" => $search
        ];
        
        $response = $this->apiClient->post("/blog/", $payload);        
        return ($response['statusCode'] === 200) ? $response['body'] : [];
    }

    // Fetch a single event by ID
    public function getEventById($eventId)
    {
        $response = $this->apiClient->get("/user/web/event/{$eventId}");
        return ($response['statusCode'] === 200) ? $response['body'] : null;
    }

    // Fetch a single blog post by ID
    public function getBlogById($blogId, $page = 1, $itemsPerPage = 10)
    {
        $payload = [
            "page" => $page,
            "items_per_page" => $itemsPerPage,
            "blog_id" => $blogId
        ];

        $response = $this->apiClient->post("/blog/", $payload);

        return ($response['statusCode'] === 200) ? $response['body'] : null;
    }

    // get the recent Blogs
    public function getRecentBlogs() {
        $requestData = [
            'page' => 1,
            'items_per_page' => 3
        ];
        $response = $this->apiClient->post("/blog/", $requestData);

        return ($response['statusCode'] === 200) ? $response['body'] : null;
    }


    // Fetch all active Testimonials 
    public function getActiveTestimonials($skip = 0, $limit = 3): mixed
    {
        $response = $this->apiClient->get("/user/web/testimonials?skip={$skip}&limit={$limit}");
        return ($response['statusCode'] === 200) ? $response['body']: [];
    }

    // Comment post
    public function postComment($blogId, $commentBody): mixed 
    {
        $payload = [
            "commentBody" => $commentBody,
        ];
        $response = $this->apiClient->POST(endpoint: "/blog/blog_comment/{$blogId}", data: $payload);
        return ($response["statusCode"] === 200) ? $response['body'] : null;
    }

    //Admin Login
    public function adminLogin($email, $password): mixed {
        $payload = http_build_query([
            'grant_type' => 'password',
            'username' => $email,
            'password' => $password,
            'scope' => '',
            'client_id' => 'string',
            'client_secret' => 'string',
        ]);
    
        $this->apiClient = new ApiClient(
            'http://127.0.0.1:8000',
            [
                'Accept: application/json',
                'Content-Type: application/x-www-form-urlencoded'
            ]
        );
    
        $response = $this->apiClient->post('/admin/login/', $payload);
    
        return ($response['statusCode'] === 200) ? $response['body'] : null;
    }
    
    
}
