<!DOCTYPE html>
<html>
<head>
    <title>Order History</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
    <link rel="stylesheet" href="../style/history.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
</head>
<body>
<nav class="navbar">
      <a href="https://www.utter.academy/" target="_blank"><img src="../../public/Utter__1_-removebg-preview 7.png"  alt="backgroundmenu" width="210px" height="210px" style="cursor:pointer;"/></a>
      <div class="navbar2">
        <a href="./profil.php"><i class="bi bi-person-circle" style="color:white; font-size:40px; cursor:pointer; margin-right:-100px;"></i></a>
      </div>
    </nav>
    <div class="navbar2" style="width:150px; height:83%; background:#F1E4D6; position:absolute; left:0; top:100px; display:flex;  flex-direction:column; align-items:center; justify-content: space-around; position:fixed;">
    <a href="./displaymenu.php"><button type="submit" class="filter-btn2" style="background: #482e1d; padding: 10px; width: 120px; border-radius: 10px; color: #ffff;  margin-top:20px; cursor:pointer;">Home</button></a>
    <a href="./addmenu.php"><button type="submit" class="filter-btn3" style="background: #482e1d; padding: 10px; width: 120px; border-radius: 10px; color: #ffff; margin-top:20px; cursor:pointer;">Tambah Menu</button></a>
    <a href="./datamenu.php"><button type="submit" class="filter-btn3" style="background: #482e1d; padding: 10px; width: 120px; border-radius: 10px; color: #ffff; margin-top:20px; cursor:pointer;">Data Menu</button></a>
</div>
<h1 style="margin-top:150px; margin-left:50px;">Order History</h1>

<?php
session_start();
if (!isset($_SESSION["authenticated"])) {
  // Redirect user to login page if not authenticated
  header("Location: ./seccurity.php");
  exit();
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projectv1smk8";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve order history data
$sql = "SELECT * FROM orders";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<table style="margin-top:80px; margin-left:200px;">';
    echo '<tr><th style="background-color:#482e1d; color:#fff;">Order ID</th><th style="background-color:#482e1d; color:#fff;">Product</th><th style="background-color:#482e1d; color:#fff;">Pemesan</th><th style="background-color:#482e1d; color:#fff;">No Meja</th><th style="background-color:#482e1d; color:#fff;">Metode Pembayaran</th><th style="background-color:#482e1d; color:#fff;">Total Harga</th></tr>';
    
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['item_name'] . '</td>';
        echo '<td>' . $row['name'] . '</td>';
        echo '<td>' . $row['no_meja'] . '</td>';
        echo '<td>' . $row['metode_pembayaran'] . '</td>';
        echo '<td>Rp' . $row['total_harga'] . '</td>';
        echo '</tr>';
    }
    
    echo '</table>';
} else {
    echo 'No order history.';
}

$conn->close();
?>

</body>
</html>
