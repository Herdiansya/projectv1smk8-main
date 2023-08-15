<!DOCTYPE html>
<html>
<head>
    <title>Data Menu</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../style/datamenu.css">
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap");
        body {
            font-family: "Montserrat", sans-serif;
            overflow: hidden;
        }

        table {
            border-collapse: collapse;
            width: 80%;
            margin: auto;
            margin-top: 200px;
            margin-left: 200px;
            box-shadow: 0px 0px 9px 0px rgba(0, 0, 0, 0.57);
            background:#fff;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #482E1D;
            border-radius:10px;
            color:#fff;
            text-align:center;
        }

        .btn-container {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }

        .update-btn, .delete-btn {
            padding: 5px 10px;
            cursor: pointer;
            font-size:30px;
        }

        .update-btn {
            background-color: #fff;
            color: #000;
        }

        .delete-btn {
            background-color: #fff;
            color: #000;
        }
        .menu-image{
            position: relative;
            left:170px;
        }
    </style>
</head>
<body>
<nav class="navbar">
      <a href="https://www.utter.academy/" target="_blank"><img src="../../public/Utter__1_-removebg-preview 7.png"  alt="backgroundmenu" width="210px" height="210px" style="cursor:pointer;"/></a>
      <div class="navbar2">
        <a href="./profil.php"><i class="bi bi-person-circle" style="color:white; font-size:40px; cursor:pointer; margin-right:-100px;"></i></a>
      </div>
    </nav>
    <div class="navbar2" style="width:130px; height:83%; background:#F1E4D6; position:absolute; left:0; top:100px; display:flex;  flex-direction:column; align-items:center; justify-content: space-around; position:fixed;">
    <a href="./displaymenu.php"><button type="submit" class="filter-btn2" style="background: #482e1d; padding: 10px; width: 120px; border-radius: 10px; color: #ffff;  margin-top:20px; cursor:pointer;">Home</button></a>
    <a href="./addmenu"><button type="submit" class="filter-btn3" style="background: #482e1d; padding: 10px; width: 120px; border-radius: 10px; color: #ffff; margin-top:20px; cursor:pointer;">Tambah Menu</button></a>
    <a href="#"><button type="submit" class="filter-btn3" style="background: #482e1d; padding: 10px; width: 120px; border-radius: 10px; color: #ffff; margin-top:20px; cursor:pointer;">History</button></a>
</div>
<h2 style="position:absolute; left:50%; top:25%; font-size:2rem;">Data Menu</h2>

<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "projectv1smk8");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch menu items from the database
$sql = "SELECT id, item_name, price, category, image_path FROM menu";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>ID</th><th>Image</th><th>Produk</th><th>Harga</th><th>Category</th><th>Action</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td><img class='menu-image' src='" . $row["image_path"] . "' alt='" . $row["item_name"] . "' width='80px'></td>";
        echo "<td>" . $row["item_name"] . "</td>";
        echo "<td>Rp" . $row["price"] . "</td>";
        echo "<td>" . $row["category"] . "</td>";
        echo '<td class="btn-container">';
        echo '<a class="update-btn" href="update_menu.php?id=' . $row["id"] . '"><i class="bi bi-pencil-fill"></i></a>';
        echo '<a class="delete-btn" href="delete_menu.php?id=' . $row["id"] . '"><i class="bi bi-trash3-fill"></i></a>';
        echo '</td>';
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No menu items found.";
}

$conn->close();
?>

</body>
</html>
