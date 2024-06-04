<?php
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Headers:Content-Type");

$server = "127.0.0.1:3307";
$username = "root";
$password = "";
$database = "admin";
$conn=mysqli_connect($server,$username,$password,$database);

$sql="SELECT * FROM shopdetails";
$result=mysqli_query($conn,$sql);
if (mysqli_num_rows($result)>0) {
    while ($row=mysqli_fetch_assoc($result)) {
        $All_shop_data[]=(Object)$row;
    }
   echo json_encode($All_shop_data);
}
else{
    echo "Not Found";
}
?>