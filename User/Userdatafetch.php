<?php
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Headers:Content-Type");

$server = "127.0.0.1:3307";
$username = "root";
$password = "";
$database = "user";
$conn = mysqli_connect($server, $username, $password, $database);

$requestType = $_SERVER["REQUEST_METHOD"];
// $type = $_GET['type'];

if ($requestType == "POST") {
    header("Content-Type: application/json");
    $user = file_get_contents("php://input");
    $decoded_user_id = json_decode($user, true);
    $user_id = $decoded_user_id['user_id'];
    $sql = "SELECT * FROM login where uid=$user_id";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $user_data[] = (Object) $row;
        }
        echo json_encode($user_data);
    } else {
        echo "Not Found";
    }
}
