<?php
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Headers:Content-Type");

$server = "127.0.0.1:3307";
$username = "root";
$password = "";
$database = "user";
$conn = mysqli_connect($server, $username, $password, $database);

$requestType = $_SERVER["REQUEST_METHOD"];
$type = $_GET['type'];

if ($requestType == "POST" && $type == "ordered_products") {
    header("Content-Type: application/json");
    $product_accessed_id = file_get_contents("php://input");
    $orderedData = json_decode($product_accessed_id, true);

    $useraddress=$orderedData['userAddress'];
    $userContactDetails=$orderedData['userContactDetails'];
    $orderedTime=$orderedData['ordered_Time'];
    $orderedDate=$orderedData['ordered_Date'];
    $orderedUserId=$orderedData['userId'];
    $orderedShopId=$orderedData['shopId'];
    $orderedProductName=$orderedData['productName'];
    $orderedProductPrice=$orderedData['productPrice'];
    $orderedProductQty=$orderedData['productQty'];

    $insertSql = "INSERT INTO orderdetails (`useraddress`, `userContactDetails`, `orderedTime`, `orderedDate`,`userid`,`shopid`,`productname`,`productprice`,`productqty`) 
    VALUES ('$useraddress', '$userContactDetails', '$orderedTime', '$orderedDate', '$orderedUserId','$orderedShopId','$orderedProductName','$orderedProductPrice','$orderedProductQty')";
    $connect_query=mysqli_query($conn,$insertSql);
    if ($connect_query) {
        print_r(json_encode(array("msg"=> "ordered product saved successfully")));

    }else{
        print_r(json_encode(array("msg"=> "Error")));

    }
}
?>