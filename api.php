<?php

include "db.php";


// set headers to allow cross-origin requests
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


// function to validate the API key
function validate_api_key($api_key)
{
    global $allowed_api_key;
    return $api_key === $allowed_api_key;
}

$getHeaders = apache_request_headers();
$api_key = isset($getHeaders['API_KEY']) ? $getHeaders['API_KEY'] : '' ;
// Check if the API key is provided in the request headers
if (!validate_api_key($api_key)) {
    json_response(array("message" => "Invalid API key."), 401);
    exit;
}


// function to sanitize input data
function sanitize($data)
{
    return htmlspecialchars(strip_tags(trim($data)));
}

// function to generate a JSON response
function json_response($data, $status = 200)
{
    http_response_code($status);
    echo json_encode($data);
}

// handling GET request to fetch data
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $query = "SELECT * FROM users";
    $result = mysqli_query($conn, $query);
    $users = array();

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $users[] = $row;
        }
    }

    json_response($users);
}

// handling POST request to insert data
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // retrieve data from the request body
    $name = sanitize($_POST["name"]);
    $email = sanitize($_POST["email"]);
    if(!$name || !$email){
        die("Please enter all inputs");
    }
    $password = password_hash(sanitize($_POST["password"]), PASSWORD_DEFAULT);

    // insert data into the database
    $query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        json_response(array("message" => "Data inserted successfully."), 201);
    } else {
        json_response(array("message" => "Error inserting data."), 500);
    }
}

// close the database connection
mysqli_close($conn);
?>
