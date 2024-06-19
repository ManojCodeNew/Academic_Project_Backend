<?php
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Headers:Content-Type");

$type = $_GET['type'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //   Directory where files will be saved 
    $uploadDir = 'uploads/';

    // Checking folder is present or not
    if (!is_dir($uploadDir)) {
        // Creating new folder 
        mkdir($uploadDir, 0777, true);
    }
    if ($type == "shop_image_upload") {
        // Get information about the uploaded file
        $logoFile = $_FILES['logoUrl'];
        $imgFile = $_FILES['ImgUrl'];

        // Get file path
        $logoFilePath = $uploadDir . basename($logoFile['name']);
        $imgFilePath = $uploadDir . basename($imgFile['name']);

        // img store to the specified directory
        if ($logoFile['error'] == UPLOAD_ERR_OK && $imgFile['error'] == UPLOAD_ERR_OK) {
            if (move_uploaded_file($logoFile['tmp_name'], $logoFilePath) && move_uploaded_file($imgFile['tmp_name'], $imgFilePath)) {

                // this url link should applicable on a browser 
                echo json_encode(array("Msg" => "File uploaded success", "shopImgPath" => 'http://' . $_SERVER['HTTP_HOST'] . '/BACKEND/ADMIN/ADMIN_ACTION/' . $imgFilePath, "logoImgPath" => 'http://' . $_SERVER['HTTP_HOST'] . '/BACKEND/ADMIN/ADMIN_ACTION/' . $logoFilePath));
            } else {
                echo json_encode(array("Msg" => "File uploaded unsuccess"));

            }
        } else {
            echo json_encode(array("Msg" => "Error during file uploaded"));

        }
    }
    if ($type == "product_image_upload") {
        // Get information about the uploaded file
        $productFile = $_FILES['product_img_input'];

        // Get file path
        $productFilePath = $uploadDir . basename($productFile['name']);

        // img store to the specified directory
        if ($productFile['error'] == UPLOAD_ERR_OK) {
            if (move_uploaded_file($productFile['tmp_name'], $productFilePath)) {

                // this url link should applicable on a browser 
                echo json_encode(array("Msg" => "Product File uploaded success", "productImgPath" => 'http://' . $_SERVER['HTTP_HOST'] . '/BACKEND/ADMIN/ADMIN_ACTION/' . $productFilePath));
            } else {
                echo json_encode(array("Msg" => "File uploaded unsuccess"));

            }
        } else {
            echo json_encode(array("Msg" => "Error during file uploaded"));

        }
    }
}
?>