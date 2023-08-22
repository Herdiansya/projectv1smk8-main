<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirm_password"];

    // Check if password and confirm password match
    if ($password !== $confirmPassword) {
        echo "Password and confirm password do not match.";
        exit();
    }

    // Hash the password securely
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Database connection
    $conn = new mysqli("localhost", "root", "", "projectv1smk8");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the username already exists
    $checkQuery = "SELECT id FROM users WHERE name = ?";
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bind_param("s", $name);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows > 0) {
        echo "Username already exists.";
    } else {
        // Insert new user into the database
        $insertQuery = "INSERT INTO users (id, name, password) VALUES (?, ?, ?)";
        $insertStmt = $conn->prepare($insertQuery);
        $insertStmt->bind_param("sss", $id, $name, $hashedPassword);

        if ($insertStmt->execute()) {
            echo " <div class='container' style='display:flex; flex-direction:column; align-items:center; justify-content:space-around; background-color:#482E1D; color:white; padding:10px; width:750px; border-radius:10px; margin:15% auto;'>
            <h2>Login Berhasil</h2>
            <a href='../../index.php'><button type='submit' class='filter-btn3' style='background: #feecbc; padding: 10px; width: 120px; border-radius: 10px; color: #000; cursor:pointer;'>Login</button></a>
        </div>";
        } else {
            echo "Registration failed.";
        }
    }

    $checkStmt->close();
    $insertStmt->close();
    $conn->close();
}
?>
