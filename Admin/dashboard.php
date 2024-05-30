<?php
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Headers:Content-Type");

$server = "localhost";
$username = "root";
$password = "";
$database = "admin";
$conn=mysqli_connect($server,$username,$password,$database);



if ($_SERVER["REQUEST_METHOD"]=='POST') {
    header('Content-Type: application/json');
    $dashboard_sended_data=file_get_contents('php://input');
    $dashboard_data_converted_into_array=json_decode($dashboard_sended_data,true);
    $admin_id=$dashboard_data_converted_into_array["admin_id"];
    
    $admin_data_display_query="SELECT * FROM shopdetails,login where  id='$admin_id' AND sid='$admin_id'";
    $connect_query_to_db=mysqli_query($conn,$admin_data_display_query);
    $null_shop_msg=array("msg"=>"Create Shop");
    $Success=array("success"=>" Account is found");

if (mysqli_num_rows($connect_query_to_db)>0) {
    while ($rows_of_db_data=mysqli_fetch_assoc($connect_query_to_db)) {
        $db_data_container=(Object)$rows_of_db_data;
    }
    echo json_encode($db_data_container);
}else{
 
    print_r(json_encode($null_shop_msg));
}
}
?>