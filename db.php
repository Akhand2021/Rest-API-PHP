<?php
// database configuration
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'restapi_db';

// API key configuration
$allowed_api_key = 'gIJvOJOX6J1HAz6YtKZ3RLr4qb2biCdi';

// connect to the database
$conn = mysqli_connect($host, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// function generate_api_key($length = 32)
// {
//     // Characters that can be used in the API key
//     $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
//     $characters_length = strlen($characters);
//     $api_key = '';

//     // Generate random characters to create the API key
//     for ($i = 0; $i < $length; $i++) {
//         $api_key .= $characters[rand(0, $characters_length - 1)];
//     }

//     return $api_key;
// }

// // Usage example:
// $generated_api_key = generate_api_key();
// echo $generated_api_key;
?>
