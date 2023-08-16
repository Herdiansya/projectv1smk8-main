<?php
session_start();
if (!isset($_SESSION["authenticated"])) {
  // Redirect user to login page if not authenticated
  header("Location: ./seccurity.php");
  exit();
}

$conn = mysqli_connect("localhost", "root", "", "projectv1smk8");

if(isset($_POST['add'])){

  $product_name = $_POST['menu'];
  $product_price = $_POST['harga'];
  $product_category = $_POST['category'];
  $product_image = $_POST['image'];
  $product_quantity = 1;

  $select_cart = mysqli_query($conn, "SELECT * FROM `menu` WHERE item_name = '$product_name'");

  if(mysqli_num_rows($select_cart) > 0){
     $message[] = 'product already added to cart';
  }else{
     $insert_product = mysqli_query($conn, "INSERT INTO `menu`(item_name, price, category, image_path, quantity) VALUES('$product_name', '$product_price', '$product_category', '$product_image', '$product_quantity')");
     $message[] = 'product added to cart succesfully';
  }

}

?>
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
        <a href="./cart.php"><i class="bi bi-cart-fill" style="color:white; font-size:30px; cursor:pointer;"></i></a>
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
      <button type="submit" class="filter-btn" style="cursor:pointer;">Filter</button>
    </form>
    <div class="navbar3" style="width:500px; height:100px; background:#b28a6f; position:absolute; right:0; top:90px; display:flex;  align-items:center; justify-content: space-around; position:fixed;">
      <a href="./history.php"><button type="submit" class="filter-btn2" style="background: #482e1d; padding: 10px; width: 120px; border-radius: 10px; color: #ffff;  margin-top:20px; cursor:pointer;">Histori</button></a>
      <a href="./addmenu.php"><button type="submit" class="filter-btn3" style="background: #301607; padding: 10px; width: 120px; border-radius: 10px; color: #ffff; margin-top:20px; cursor:pointer;">Tambah Menu</button></a>
      <a href="./datamenu.php"><button type="submit" class="filter-btn3" style="background: #482e1d; padding: 10px; width: 120px; border-radius: 10px; color: #ffff; margin-top:20px; cursor:pointer;">Data Menu</button></a>
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
$query = "SELECT id, item_name, price, category, image_path, quantity FROM menu" . $filter_query;
$result = $conn->query($query);
$bgcolor = "#fff";
$color = "#000";
if ($result->num_rows > 0) {
  while ($row = mysqli_fetch_array($result)) {?>
    <div class='menu-item'>
  <form method="post" action="displaymenu.php?id=<?= $row['id']?>" >
    <img class='menu-image' src="../../public/<?= $row['image_path'] ?>" alt=<?= $row["item_name"]?>>
    <h5 class="menu-name"><?= $row['item_name']?></h5>
    <h5>Price:Rp <?= $row['price']?></h5>
    <input type="hidden" name="menu" value="<?= $row['item_name']?>">
    <input type="hidden" name="harga" value="<?= $row['price']?>">
    <input type="hidden" name="category" value="<?= $row['category']?>">
    <input type="hidden" name="image" value="<?= $row['image_path']?>">
    <input type="hidden" name="quantity" value="<?= $row['quantity']?>">
    <button type='submit' class='tambah-btn'  name="add" style="cursor:pointer">Tambah Ke Keranjang</button>
  </form>
</div>
    <?php
  }
} else {
  echo "Tidak ada menu yang tersedia.";
}

$conn->close();
?>
  </body>
</html>
