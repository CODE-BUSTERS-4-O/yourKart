<?php 

require_once '../config.php';

// error_reporting(0);

session_start();

// if (!isset($_SESSION['aid'])) {
// 	header("Location: index.php?log=1");
// }

if(isset($_POST['submit'])){

    $pname = $_POST['pname'];
    $desc = $_POST['description'];
    $stock = $_POST['stock'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $brand = $_POST['brand'];

    $file = $_FILES["file"];
  
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.', $fileName);
    print_r($fileExt);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpeg', 'jpg', 'png', 'pdf');

    if( in_array($fileActualExt, $allowed)) {
        if($fileError===0){
            if($fileSize < 1000000) {
                $fileNameNew = uniqid('', true).".".$fileActualExt;
                $fileDestination = 'images/'.$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);

                $sql =  "INSERT INTO product(pname,stock,price,categoryid,brandid,adminid,description,image) VALUES ( ?, ?, ?,?, ?, ?, ?, ?);";
                $stmt = mysqli_stmt_init($conn);

                if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("location: addbyadmin.php?error=stmtfail1");
                    exit();
                }

                mysqli_stmt_bind_param($stmt, "siississ", $pname, $stock, $price, $category, $brand, $_SESSION['aid'], $desc, $fileNameNew);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
                header("Location: managemyshop.php?error=none");
            }else{
                echo "<script>alert('File Size too big!')</script>";
            }

        }else{
            echo "<script>alert('There was an error uploading your file.')</script>";
        //   echo "There was an error uploading your file." ;
        }
    }else{
        echo "<script>alert('You Can not upload files of this type')</script>";

        // echo " You Can not upload files of thhis type";

    }
}
?>