<?php


$server = "127.0.0.1:3307";
$username = "root";
$password = "";
$database = "admin";
$conn=mysqli_connect($server,$username,$password,$database);



$shop_delete_query = "DELETE FROM productdetails WHERE pid=49";
$response = mysqli_query($conn, $shop_delete_query);

if ($response) {
    $affected_rows = mysqli_affected_rows($conn);
    if ($affected_rows > 0) {
        echo "Record deleted successfully.";
    } else {
        echo "No records found to delete.";
    }
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}


?>


<!-- Important NOTE:   Sometime you may occur 'Fatal error: Uncaught mysqli_sql_exception: No connection could be made because the target machine actively refused it in C:\Xampp docs\htdocs\Backend\Admin\Admin_action\dbcon.php:8 Stack trace: #0 C:\Xampp docs\htdocs\Backend\Admin\Admin_action\dbcon.php(8): mysqli_connect('localhost', 'root', Object(SensitiveParameterValue), 'admin') #1 {main} thrown in C:\Xampp docs\htdocs\Backend\Admin\Admin_action\dbcon.php on line 8'   this error it tells you changed your mysql port so you can add that port value in front of the ' $server='localhost:[your Port value eg. 3307]  this will solve the error' -->