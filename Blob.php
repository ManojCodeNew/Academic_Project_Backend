<!DOCTYPE html>
<html>
<head>
    <title>Upload and Display Image</title>
</head>
<body>
    <h2>Upload Image</h2>
    <form action="" method="post" >
        Select image to upload:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload Image" name="submit">
    </form>

   <script>

   </script>
</body>

</html>
<!-- 
<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // $file = $_FILES['fileToUpload']['tmp_name'];
    $image = $_POST['fileToUpload'];
    
// echo ;
print_r($file) ;
}

?> -->