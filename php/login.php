<?php 
session_start();

if (isset($_POST['username']) && isset($_POST['password'])) {

    include "../db_conn.php";

    $username = $_POST['username'];
    $password = $_POST['password'];

    $data = "username=".$username;

    if (empty($username)) {
        $em = "User name is required";
        header("Location: ../login.php?error=$em&$data");
        exit;
    } else if (empty($password)) {
        $em = "Password is required";
        header("Location: ../login.php?error=$em&$data");
        exit;
    } else {

        $sql = "SELECT * FROM login WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$username]);

        if ($stmt->rowCount() === 0) {
            // Insert new user into the database
            $insertSql = "INSERT INTO login (username, password) VALUES (?, ?)";
            $stmt = $conn->prepare($insertSql);
            $stmt->execute([$username, $password]);

            // Redirect to success page or perform any other actions
            header("Location: ../success.php");
            exit;
        } else {
            // User already exists, handle the error
            $em = "User already exists";
            header("Location: ../login.php?error=$em&$data");
            exit;
        }
    }
}
?>