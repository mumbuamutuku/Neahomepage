<?php

require_once __DIR__ . '/../api/api.php';

class ApiService
{
    private $apiClient;

    private $baseUrl = "http://127.0.0.1:8000";  //'https://nea-global-api-latest.onrender.com',

    public function __construct()
    {
        $this->apiClient = new ApiClient(
            $this->baseUrl,
            [
                'Content-Type: application/json',
                'Accept: application/json'
            ]
        );
    }

    private function fetchFromApi($endpoint, $payload)
    {
        $response = $this->apiClient->post($endpoint, $payload);
        return ($response['statusCode'] === 200) ? $response['body'] : [];
    }
    private function buildPaginationPayload($page, $itemsPerPage, $search = "", $extraParams = [])
    {
        return array_merge([
            'page' => $page,
            'items_per_page' => $itemsPerPage,
            'search' => $search
        ], $extraParams);
    }

    // ✅ Generic getAll method
    public function getAll($endpoint, $page = 1, $itemsPerPage = 10, $search = "", $extraParams = [])
    {
        $payload = $this->buildPaginationPayload($page, $itemsPerPage, $search, $extraParams);
        return $this->fetchFromApi($endpoint, $payload);
    }

    //fetch all blogs
    public function getBlogs($page = 1, $itemsPerPage = 10, $search = "")
    {
        return $this->getAll("/blog/", $page, $itemsPerPage, $search);
    }
    //Fetch Single Event
    public function getEventById($event_id, $page = 1, $itemsPerPage = 10, $search = "")
    {
        return $this->getAll("/user/web/events/", $page, $itemsPerPage, $search, ["event_id" => $event_id]);
    }

    // Fetch a single blog post by ID
    public function getBlogById($blog_id, $page = 1, $itemsPerPage = 10, $search = "")
    {
        return $this->getAll("/blog/", $page, $itemsPerPage, $search, ["blog_id" => $blog_id]);
    }

    // get the recent Blogs
    public function getRecentBlogs()
    {
        $requestData = [
            'page' => 1,
            'items_per_page' => 3
        ];
        $response = $this->apiClient->post("/blog/", $requestData);

        return ($response['statusCode'] === 200) ? $response['body'] : null;
    }

    //Fetch all testimonials
    public function getAllActiveTestimonials($page = 1, $itemsPerPage = 10, $search = "")
    {
        return $this->getAll("/user/web/active_testimonials/", $page, $itemsPerPage, $search);
    }
    public function getAllActiveTestimonialsById($testimonial_id, $page = 1, $itemsPerPage = 10, $search = "")
    {
        return $this->getAll("/user/web/active_testimonials/", $page, $itemsPerPage, $search, ["testimonial_id" => $testimonial_id]);
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

    //work with us Model
    public function workWithus(array $data): mixed
    {

        $multipartData = [
            'fullname' => $data['fullname'],
            'email' => $data['email'],
            'phone_number' => $data['phone_number'],
            'country' => $data['country'],
            'application_type' => $data['application_type'] ?? '',
            'message' => $data['message']
        ];

        // Handle file uploads
        if (!empty($data['cv'])) {
            $multipartData['cv'] = new CURLFile($data['cv'], mime_content_type($data['cv']), basename($data['cv']));
        }

        if (!empty($data['cover_letter'])) {
            $multipartData['cover_letter'] = new CURLFile($data['cover_letter'], mime_content_type($data['cover_letter']), basename($data['cover_letter']));
        }

        // Send request using Multipart
        $response = $this->apiClient->post('/user/web/work-with-us', $multipartData, true);

        error_log("🔍 Raw Response: " . json_encode($response));

        if (!is_array($response)) {
            error_log("❌ Unexpected Response Format (Expected an array)");
            return null;
        }

        $statusCode = $response['body']['status_code'] ?? null;
        error_log("ℹ️ Extracted status_code: " . ($statusCode ?? 'NULL'));

        if ($statusCode === 200 || $statusCode === 201) {
            return $response;
        } else {
            error_log("❌ API Call Failed with status code: " . ($statusCode ?? 'Unknown'));
            return null;
        }
    }

    //Get all events
    public function getAllEvents($page = 1, $itemsPerPage = 10, $search = "")
    {
        return $this->getAll("/user/web/events/", $page, $itemsPerPage, $search);
    }

    //sign up for newsletter
    public function signUpforNewsletter($email): array
    {
        $payload = ["email" => $email];

        $response = $this->apiClient->post("/user/web/{$email}/news/signUp", $payload);

        if (isset($response['statusCode']) && ($response['statusCode'] === 200 || $response['statusCode'] === 201)) {
            return [
                "status_code" => $response['statusCode'],
                "body" => $response['body'] ?? [],
            ];
        } elseif (isset($response['statusCode']) && $response['statusCode'] === 409) {
            return [
                "status_code" => 409,
                "message" => "Email already registered"
            ];
        }

        return [
            "status_code" => 500,
            "error" => "Unexpected error occurred"
        ];
    }
}
?>