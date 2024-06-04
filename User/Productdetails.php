<?php
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Headers:Content-Type");

$server = "127.0.0.1:3307";
$username = "root";
$password = "";
$database = "admin";
$conn=mysqli_connect($server,$username,$password,$database);

$requestType=$_SERVER["REQUEST_METHOD"];
$type=$_GET['type'];

if ($requestType=="POST" && $type=="products") {
    header("Content-Type: application/json");
    $product_accessed_id=file_get_contents("php://input");
    $decoded_product_id=json_decode($product_accessed_id,true);
    $id=$decoded_product_id['Id'];
    echo json_encode($id);
}
?>