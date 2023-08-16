<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $password = $_POST["password"];

    // Database connection
    $conn = new mysqli("localhost", "root", "", "projectv1smk8");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query to fetch user details
    $query = "SELECT id, password FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $stmt->bind_result($userId, $hashedPassword);
    $stmt->fetch();
    $stmt->close();

    // Verify password
    if (password_verify($password, $hashedPassword)) {
        $_SESSION["authenticated"] = true;
        $_SESSION["user_id"] = $userId;
        header("Location: ../components/displaymenu.php"); // Redirect to displaymenu after successful login
    } else {
        echo "Invalid id or password.";
    }

    $conn->close();
}
?>
