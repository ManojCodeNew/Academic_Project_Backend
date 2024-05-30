<?php
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Headers:Content-Type");

$server = "localhost";
$username = "root";
$password = "";
$database = "admin";
$conn=mysqli_connect($server,$username,$password,$database);

if ($_SERVER["REQUEST_METHOD"]=="POST" && $_GET["type"]=="admin_login") {
   header("Content-Type: application/json");
   $admin_data=file_get_contents("php://input");
   $decoded_admin_data=json_decode($admin_data,true);

$admin_email=$decoded_admin_data['admin_email'];
$admin_password=$decoded_admin_data['admin_password'];


   // Error/success Messages
   $Error= array("Error"=>"Sorry account is not found");
   $Success=array("success"=>" Account is found");


$finding_admin = "SELECT id FROM login where email='$admin_email' AND password='$admin_password'";
$response = mysqli_query($conn, $finding_admin);

if (mysqli_num_rows($response)>0) {
   while ($row=mysqli_fetch_assoc($response)) {
      $containter=(Object)$row;

}
echo json_encode($containter);


   }
   else{

      print_r(json_encode($Error));

}






}



