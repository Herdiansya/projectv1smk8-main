<!DOCTYPE html>
<html>
  <head>
    <title>Menu</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="../style/displaymenu.css">
  </head>
  <body>
    <nav class="navbar">
      <a href="https://www.utter.academy/" target="_blank"><img src="../../public/Utter__1_-removebg-preview 7.png"  alt="backgroundmenu" width="210px" height="210px" style="cursor:pointer;"/></a>
      <div class="navbar2">
        <form action="../logic/searchmenu.php" method="get" id="form-search">
          <input type="text" id="search" name="search" style="background: #482e1d; border-color:white; padding:5px; width:200px; border-radius:20px; color:#fff; cursor:pointer; transition: border 0.3s,background 0.3s;"/>
          <button type="submit" class="search-btn"><i class="bi bi-search"></i></button>
        </form>
        <div id="cardNumber" style="position:absolute; color:#fff; left:68rem; background:green; padding:3px; border-radius:5px;">0</div>
        <i class="bi bi-cart-fill" style="color:white; font-size:30px; cursor:pointer;"></i>
        <a href="./profil.php"><i class="bi bi-person-circle" style="color:white; font-size:30px; cursor:pointer;"></i></a>
      </div>
    </nav>
    <h1 style="text-align:center; margin-top:30px;">Daftar Menu</h1>

    <form action="displaymenu.php" method="get" id="form-category">
      <label for="category_filter" id="category-text">Pilih Category:</label>
      <select id="category_filter" name="category_filter">
        <option value="all">All</option>
        <option value="food">Makanan</option>
        <option value="drink">Minuman</option>
      </select>
      <button type="submit" class="filter-btn">Filter</button>
    </form>
    <div class="navbar3" style="width:500px; height:100px; background:#b28a6f; position:absolute; right:0; top:90px; display:flex;  align-items:center; justify-content: space-around; position:fixed;">
    <a href=""><button type="submit" class="filter-btn2" style="background: #482e1d; padding: 10px; width: 120px; border-radius: 10px; color: #ffff;  margin-top:20px;">Histori</button></a>
    <a href="./addmenu.php"><button type="submit" class="filter-btn3" style="background: #301607; padding: 10px; width: 120px; border-radius: 10px; color: #ffff; margin-top:20px;">Tambah Menu</button></a>
    <a href=""><button type="submit" class="filter-btn3" style="background: #482e1d; padding: 10px; width: 120px; border-radius: 10px; color: #ffff; margin-top:20px;">Data Menu</button></a>
    </div>
    <?php
// Database connection
$conn = new mysqli("localhost", "root", "", "projectv1smk8");

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Filter by category if selected
$category_filter = isset($_GET["category_filter"]) ? $_GET["category_filter"] : "all";
$filter_query = ($category_filter !== "all") ? " WHERE category = '$category_filter'" : "";

// Retrieve menu items from the database
$query = "SELECT id, item_name, price, image_path FROM menu" . $filter_query;
$result = $conn->query($query);
$bgcolor = "#fff";
$color = "#000";
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    echo "<div class='menu-item'>";
    echo "<img class='menu-image' src='" . $row["image_path"] . "' alt='" . $row["item_name"] . "'>";
    echo "<div class='menu-name'>" . $row["item_name"] . "</div>";
    echo "<div class='menu-price'>Price: $" . $row["price"] . "</div>";
    echo "<button type='submit' class='tambah-btn' onclick='incrementCardNumber()'>Tambah Ke Keranjang</button>";
    echo "</div>";
  }
} else {
  echo "Tidak ada menu yang tersedia.";
}

$conn->close();
?>

<script>
    let currentCardNumber = 0;

    function incrementCardNumber() {

        currentCardNumber++;
        document.getElementById("cardNumber").textContent = currentCardNumber.toString().padStart(1, '0');
    }
</script>
  </body>
</html>
