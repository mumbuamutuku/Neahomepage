<?php
//require_once 'api/api.php'; 
require_once __DIR__ . '/../api/api.php';

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
            //'https://nea-global-api-latest.onrender.com',

            'http://127.0.0.1:8000', 
            
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
    
    public function workWithus(array $data): mixed {
        //error_log("📡 Sending JSON Payload: " . json_encode($data)); // Debug
    
        $response = $this->apiClient->post('/user/web/workwithus', $data);
        
        error_log("🔍 Raw Response: " . print_r($response, true));
        //error_log('Response' . $response);
        //return ($response['statusCode'] === 200) ? $response['body'] : null;
        // Ensure response is an array
        if (!is_array($response)) {
            error_log("❌ Unexpected Response Format");
            return null;
        }

        // Extract status code correctly
        $statusCode = $response['body']['status_code'] ?? null; 
        error_log("ℹ️ Extracted status_code: " . ($statusCode ?? 'NULL'));    

        // Check if the status code is valid
        if ($statusCode === 200 || $statusCode === 201) {
            return $response; // Return full response
        } else {
            error_log("❌ API Call Failed with status code: " . ($statusCode ?? 'Unknown'));
            return null;
        }
    }

    /**
     * Get all events from the API, with optional filtering and pagination.
     *
     * @param int $page The page number to retrieve.
     * @param int $itemsPerPage The number of items per page.
     * @param string $search Search query to filter events by.
     *
     * @return array The list of events.
     */
    public function getAllEvents($page = 1, $itemsPerPage = 10, $search = "")
    {
        $payload = [
            "page" => $page,
            "items_per_page" => $itemsPerPage,
            "search" => $search
        ];

        // Make the API call to the events endpoint
        $response = $this->apiClient->post("/user/web/events/", $payload);

        // Return the response body if the call was successful
        return ($response['statusCode'] === 200) ? $response['body'] : [];
    }

    
    
}
