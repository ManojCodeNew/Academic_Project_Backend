<?php
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Headers:Content-Type");

// include('C:\Xampp docs\htdocs\Backend\dbcon.php');
$server = "localhost";
$username = "root";
$password = "";
$database = "admin";
$conn=mysqli_connect($server,$username,$password,$database);


// if ($_SERVER["REQUEST_METHOD"]=="POST" ) {
    header("Content-Type: application/json");
    $shopdetails_data=file_get_contents("php://input");
    $decoded_shopdetails_data=json_decode($shopdetails_data,true);

    $shop_id=$decoded_shopdetails_data['shop_id'];
    $shop_name=$decoded_shopdetails_data['shop_name'];
    $shop_owner_name=$decoded_shopdetails_data['shop_owner_name'];
    $shop_category=$decoded_shopdetails_data['shop_category'];
    $shop_location=$decoded_shopdetails_data['shop_location'];
    $shop_timings=$decoded_shopdetails_data['shop_timings'];
    $shop_imgUrl=$decoded_shopdetails_data['shop_imgUrl'];
    $shop_logoUrl=$decoded_shopdetails_data['shop_logoUrl'];
    $shop_contact_details=$decoded_shopdetails_data['shop_contact_details'];
    $shop_email=$decoded_shopdetails_data['shop_email'];

$Success=array("success"=>[$shop_id,$shop_name,$shop_owner_name,$shop_category,$shop_location,$shop_timings,$shop_imgUrl,$shop_logoUrl,$shop_contact_details,$shop_email]);
$Error= array("Error"=>"Invalid field");

$insert_query="INSERT INTO shopdetails (`sid`,`shopname`,`ownername`,`Location`,`Timing`,`ShopImgurl`,`logoUrl`,`contactDetails`,`email`,`Shop_category`) VALUES ('$shop_id','$shop_name','$shop_owner_name','$shop_location','$shop_timings','$shop_imgUrl','$shop_logoUrl','$shop_contact_details','$shop_email','$shop_category')";

$response=mysqli_query($conn,$insert_query);
if ($response) {
    print_r(json_encode($Success));

}
else {
    print_r(json_encode($Error));
    
}
// }
?>