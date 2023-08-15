<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item_name = $_POST["item_name"];
    $price = $_POST["price"];
    $category = $_POST["category"];

    // Database connection
    $conn = new mysqli("localhost", "root", "", "projectv1smk8");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Upload image file
    $image_path = "../../public" . $_FILES["image"]["name"];
    move_uploaded_file($_FILES["image"]["tmp_name"], $image_path);

    // Insert new menu item into the database
    $insertQuery = "INSERT INTO menu ( item_name, price, category, image_path) VALUES ( ?, ?, ?, ?)";
    $insertStmt = $conn->prepare($insertQuery);
    $insertStmt->bind_param("sdss", $item_name, $price, $category, $image_path);

    if ($insertStmt->execute()) {
        echo "Menu item added successfully.";
    } else {
        echo "Error adding menu item.";
    }

    $insertStmt->close();
    $conn->close();
}
?>
