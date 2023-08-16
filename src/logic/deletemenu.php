<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "projectv1smk8");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $itemId = $_GET["id"];

    // Delete menu item from the database
    $deleteSql = "DELETE FROM menu WHERE id = $itemId";
    if ($conn->query($deleteSql) === TRUE) {
        echo "<script>
        alert ('Data Berhasil Dihapus')
        window.location.href = document.referrer;
       </script>";
    } else {
        echo "Error deleting menu item: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>
