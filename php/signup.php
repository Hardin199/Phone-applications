<?php 
include "../db_conn.php";

if(isset($_POST['fullname']) && 
   isset($_POST['username']) &&  
   isset($_POST['password']) &&
   isset($_FILES['images']))
{

    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $images = $_FILES['images'];

    $data = "fullname=".$fullname."&username=".$username;

    if (empty($fullname)) {
        $em = "Full name is required";
        header("Location: ../index.php?error=$em&$data");
        exit;
    } else if (empty($username)) {
        $em = "User name is required";
        header("Location: ../index.php?error=$em&$data");
        exit;
    } else if (empty($password)) {
        $em = "Password is required";
        header("Location: ../index.php?error=$em&$data");
        exit;
    } else {
        // hashing the password
        $password = password_hash($password, PASSWORD_DEFAULT);

        if (!empty($images['name'])) {
            $img_name = $images['name'];
            $tmp_name = $images['tmp_name'];
            $error = $images['error'];

            if ($error === 0) {
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_to_lc = strtolower($img_ex);

                $allowed_exs = array('jpg', 'jpeg', 'png');
                if (in_array($img_ex_to_lc, $allowed_exs)) {
                    $images = uniqid($username, true).'.'.$img_ex_to_lc;
                    $img_upload_path = '../upload/'.$images;
                    move_uploaded_file($tmp_name, $img_upload_path);

                    // Insert into Database
                    $sql = "INSERT INTO `mytable`(fullname, username, password, images) 
                            VALUES(?,?,?,?)";
                    $stmt = $connect->prepare($sql);
                    $stmt->execute([$fullname, $username, $password, $images]);

                    header("Location: ../index.php?success=Your account has been created successfully");
                    exit;
                } else {
                    $em = "You can't upload files of this type";
                    header("Location: ../index.php?error=$em&$data");
                    exit;
                }
            } else {
                $em = "Unknown error occurred!";
                header("Location: ../index.php?error=$em&$data");
                exit;
            }
        } else {
            $sql = "INSERT INTO `mytable`(fullname, username, password) 
                    VALUES(?,?,?)";
            $stmt = $connect->prepare($sql);
            $stmt->execute([$fullname, $username, $password]);

            header("Location: ../index.php?success=Your account has been created successfully");
            exit;
        }
    }
} else {
    // header("Location: ../index.php?error=error");
    echo "Error 404";
    // exit;
}