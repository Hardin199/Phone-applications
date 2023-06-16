<?php
// Assuming you have established a database connection
$servername = "your_servername";
$username = "your_username";
$password = "your_password";
$database = "your_database";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Get the user ID and new information from the form
    $user_id = $_POST['user_id'];
    $new_name = $_POST['new_name'];
    $new_email = $_POST['new_email'];

    // Prepare the update statement
    $stmt = $conn->prepare("UPDATE users SET name=?, email=? WHERE id=?");
    $stmt->bind_param("ssi", $new_name, $new_email, $user_id);

    // Execute the update statement
    if ($stmt->execute()) {
        echo "User information updated successfully.";
    } else {
        echo "Error updating user information: " . $conn->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Update User</title>
</head>

<body>
    <h2>Update User Information</h2>
    <form method="POST" action="">
        <label for="user_id">User ID:</label>
        <input type="text" name="user_id" id="user_id" required><br>

        <label for="new_name">New Name:</label>
        <input type="text" name="new_name" id="new_name" required><br>

        <label for="new_email">New Email:</label>
        <input type="email" name="new_email" id="new_email" required><br>

        <input type="submit" name="submit" value="Update">
    </form>
</body>

</html>