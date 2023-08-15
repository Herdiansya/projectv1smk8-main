<!DOCTYPE html>
<html>
  <head>
    <title>Menu</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="../style/displaymenu.css">
  </head>
  <body>
    <nav class="navbar">
      <img src="../../public/Utter__1_-removebg-preview 7.png"  alt="backgroundmenu" width="210px" height="210px"/>
      <div class="navbar2">
        <form action="../logic/searchmenu.php" method="get" id="form-search">
          <input type="text" id="search" name="search" style="background: #482e1d; border-color:white; padding:5px; width:200px; border-radius:20px; color:#fff; cursor:pointer; transition: border 0.3s,background 0.3s;"/>
          <button type="submit" class="search-btn"><i class="bi bi-search"></i></button>
        </form>
        <i class="bi bi-cart-fill" style="color:white; font-size:30px; cursor:pointer;"></i>
        <i class="bi bi-person-circle" style="color:white; font-size:30px; cursor:pointer;"></i>
      </div>
    </nav>
    <h1 style="text-align:center; margin-top:30px;">Daftar Menu</h1>

    <form action="searchmenu.php" method="get" id="form-category">
      <label for="category_filter" id="category-text">Pilih Category:</label>
      <select id="category_filter" name="category_filter">
        <option value="all">All</option>
        <option value="food">Makanan</option>
        <option value="drink">Minuman</option>
      </select>
      <button type="submit" class="filter-btn">Filter</button>
    </form>

    <?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $searchTerm = $_GET["search"];


// Database connection
$conn = new mysqli("localhost", "root", "", "projectv1smk8");

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Search query
$query = "SELECT id, item_name, price, image_path FROM menu WHERE item_name LIKE '%$searchTerm%'";
$result = $conn->query($query);

// Filter by category if selected
$category_filter = isset($_GET["category_filter"]) ? $_GET["category_filter"] : "all";
$filter_query = ($category_filter !== "all") ? " WHERE category = '$category_filter'" : "";

// Retrieve menu items from the database
$query = "SELECT id, item_name, price, image_path FROM menu" . $filter_query;
$result = $conn->query($query);

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    echo "<div class='menu-item'>";
    echo "<img class='menu-image' src='" . $row["image_path"] . "' alt='" . $row["item_name"] . "'>";
    echo "<div class='menu-name'>" . $row["item_name"] . "</div>";
    echo "<div class='menu-price'>Price: $" . $row["price"] . "</div>";
    echo "<button type='submit' class='tambah-btn'>Tambah Ke Keranjang</button>";
    echo "</div>";
  }
} else {
  echo "Tidak ada menu yang tersedia.";
}

$conn->close();
}
?>
  </body>
</html>
