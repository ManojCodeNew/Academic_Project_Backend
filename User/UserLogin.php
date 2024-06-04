<?php
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Headers:Content-Type");

$server = "localhost:3307";
$username = "root";
$password = "";
$database = "User";
$conn=mysqli_connect($server,$username,$password,$database);

if ($_SERVER["REQUEST_METHOD"]=="POST" && $_GET["type"]=="user_login") 
{
    header("Content-Type: application/json");
    $user_data=file_get_contents("php://input");
    $decoded_user_data=json_decode($user_data,true);

    $user_email=$decoded_user_data['user_email'];
    $user_password=$decoded_user_data['user_password'];

   // Error/success Messages
    $Error= array("Error"=>"Sorry account is not found");
    $Success=array("success"=>" Account is found");

// print_r(json_encode($Success));
    $finding_admin = "SELECT uid FROM login where email='$user_email' AND password='$user_password'";
    $response = mysqli_query($conn, $finding_admin);

    if (mysqli_num_rows($response)>0) 
    {
        while ($row=mysqli_fetch_assoc($response)) 
        {
            $containter=(Object)$row;
        }

        echo json_encode($containter);
    }
    else
    {
        print_r(json_encode($Error));
    }

}



