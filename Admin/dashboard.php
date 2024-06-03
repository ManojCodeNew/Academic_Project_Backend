<?php
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Headers:Content-Type");

$server = "127.0.0.1:3307";
$username = "root";
$password = "";
$database = "admin";
$conn=mysqli_connect($server,$username,$password,$database);



if ($_SERVER["REQUEST_METHOD"]=='POST') {
    header('Content-Type: application/json');
    $dashboard_sended_data=file_get_contents('php://input');
    $dashboard_data_converted_into_array=json_decode($dashboard_sended_data,true);
    $admin_id=$dashboard_data_converted_into_array["admin_id"];
    
    // Status
    $null_shop_msg=array("msg"=>"Create Shop");
    $Success=array("success"=>" Account is found");


    // Shopdetails fetching
    $admin_shopdetails_data_display_query="SELECT * FROM shopdetails,login where  id='$admin_id' AND sid='$admin_id'";
    $connect_query1_to_db=mysqli_query($conn,$admin_shopdetails_data_display_query);

    // Productdetails fetching
    $admin_productdetails_data_display_query="SELECT * FROM productdetails where pid='$admin_id'";
    $connect_query2_to_db=mysqli_query($conn,$admin_productdetails_data_display_query);

    // Storing shopdetails and productdetails data
    $dashboard_data_container=[];

if (mysqli_num_rows($connect_query1_to_db)>0) {
    $dashboard_data_container['shopdetails']=[];
    while ($rows_of_db_data=mysqli_fetch_assoc($connect_query1_to_db)) {
        $dashboard_data_container['shopdetails'][]=(Object)$rows_of_db_data;
    }
    if (mysqli_num_rows($connect_query2_to_db)>0) {
        $dashboard_data_container['productdetails']=[];
        while ($rows_of_db_data=mysqli_fetch_assoc($connect_query2_to_db)) {
            $dashboard_data_container['productdetails'][]=(Object)$rows_of_db_data;
        }
    }

echo json_encode($dashboard_data_container);
}
else{
    print_r(json_encode($null_shop_msg));
}
}
?>