<?php
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Headers:Content-Type");

$server = "localhost";
$username = "root";
$password = "";
$database = "admin";
$conn=mysqli_connect($server,$username,$password,$database);


if ($_SERVER["REQUEST_METHOD"]=="POST" && $_GET["type"]=="admin_signup") {

   // Access data to the front end
   header("Content-Type: application/json");
   $admin_signup_data=file_get_contents("php://input");
   $decoded_admin_signup_data=json_decode($admin_signup_data,true);
   $admin_name=$decoded_admin_signup_data['admin_name'];
   $admin_email=$decoded_admin_signup_data['admin_email'];
   $admin_password=$decoded_admin_signup_data['admin_password'];

// Insert data to the database

$insert_admin_query ="INSERT INTO login (`id`,`name`,`email`,`password`) VALUES ('','$admin_name','$admin_email','$admin_password') ";
$Error= array("Error"=>"Invalid field");
$Success=array("success"=>" Account is found");
mysqli_query($conn, $insert_admin_query);


// Get Admin id to the database
$get_admin_id="SELECT id from login where email='$admin_email' and password='$admin_password'";
$result=mysqli_query($conn,$get_admin_id);

if (mysqli_num_rows($result)>0) {
while ($row=mysqli_fetch_assoc($result)) {
   $admin_id=(object)$row;
}
echo json_encode($admin_id);
}
else{
print_r(json_encode($Error));
}
}
