<?php
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Headers:Content-Type");

$server = "localhost:3307";
$username = "root";
$password = "";
$database = "User";
$conn=mysqli_connect($server,$username,$password,$database);

if ($_SERVER["REQUEST_METHOD"]=="POST" && $_GET["type"]=="user_signup") {

      // Access data to the front end
      header("Content-Type: application/json");
      $user_signup_data=file_get_contents("php://input");
      $decoded_user_signup_data=json_decode($user_signup_data,true);
      $user_name=$decoded_user_signup_data['user_name'];
      $user_email=$decoded_user_signup_data['user_email'];
      $user_password=$decoded_user_signup_data['user_password'];

      // Status message
      $Error= array("Error"=>"Invalid field");
      $Success=array("success"=>" Account is found");

      // Insert data to the database
      $insert_user_query ="INSERT INTO login (`uid`,`name`,`email`,`password`) VALUES ('','$user_name','$user_email','$user_password') ";
      mysqli_query($conn, $insert_user_query);

      // Get Admin id to the database
      $get_user_id="SELECT uid from login where email='$user_email' and password='$user_password'";
      $result=mysqli_query($conn,$get_user_id);
      if (mysqli_num_rows($result)>0) 
      {
            while ($row=mysqli_fetch_assoc($result)) 
            {
            $user_id=(object)$row;
            }
            echo json_encode($user_id);
      }
      else
      {
            print_r(json_encode($Error));
      }
}
?>