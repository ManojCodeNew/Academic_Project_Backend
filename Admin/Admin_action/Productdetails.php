<?php
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Headers:Content-Type");

$server = "127.0.0.1:3307";
$username = "root";
$password = "";
$database = "admin";
$conn=mysqli_connect($server,$username,$password,$database);


$requestMethod=$_SERVER["REQUEST_METHOD"];
$type=$_GET['type'];

if ($requestMethod=="POST" && $type=="add_product") {
    header("Content-Type:application/json");
    $productdetails_data=file_get_contents("php://input");
    $decoded_productdetails_data=json_decode($productdetails_data,true);

    $product_id=$decoded_productdetails_data['product_id'];
    $product_name=$decoded_productdetails_data['product_name'];
    $product_price=$decoded_productdetails_data['product_price'];
    $product_desc=$decoded_productdetails_data['product_desc'];
    $product_img=$decoded_productdetails_data['product_img'];

    $product_insert_query="INSERT INTO productdetails (`pid`,`productname`,`price`,`product_desc`,`product_url`) VALUES ('$product_id','$product_name','$product_price','$product_desc','$product_img')";
    mysqli_query($conn,$product_insert_query);

    $msg=array("status"=>"product added Successfully");
    echo json_encode($msg);

    $display_added_product_query="SELECT * FROM productdetails where pid=$product_id";
    $Query_response=mysqli_query($conn,$display_added_product_query);
    
    
}

?>