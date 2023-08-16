<?php
session_start();
if (!isset($_SESSION["authenticated"])) {
  // Redirect user to login page if not authenticated
  header("Location: ./seccurity.php");
  exit();
}

  require 'config.php';

    $id = $_GET["id"];

    $edt = seterah("SELECT * FROM menu WHERE id = $id")[0];

if(isset($_POST["edit"])){

    if(edit($_POST) > 0){
        echo "<script>
        alert ('Data Berhasil Diedit');
        window.location.href = document.referrer;
       </script>";
 }else{
     echo "<script>
        alert ('Data Gagal  Diedit')
        window.location.href = document.referrer;
       </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
    <link rel="stylesheet" href="../style/updatemenu.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bruno+Ace+SC&display=swap" rel="stylesheet">
  </head>
  <body>
  <nav class="navbar">
      <a href="https://www.utter.academy/" target="_blank"><img src="../../public/Utter__1_-removebg-preview 7.png"  alt="backgroundmenu" width="200px" height="200px" style="cursor:pointer; margin-top:-50px"/></a>
      <div class="navbar2" style="margin-top:-50px;"> 
        <a href="./profil.php"><i class="bi bi-person-circle" style="color:white; font-size:40px; cursor:pointer; margin-right:-100px; "></i></a>
      </div>
    </nav>
    <div class="navbar2" style="width:130px; height:83%; background:#F1E4D6; position:absolute; left:0; top:100px; display:flex;  flex-direction:column; align-items:center; justify-content: space-around; position:fixed;">
    <a href="./displaymenu.php"><button type="submit" class="filter-btn2" style="background: #482e1d; padding: 10px; width: 120px; border-radius: 10px; color: #ffff;  margin-top:20px; cursor:pointer;">Home</button></a>
    <a href="./addmenu.php"><button type="submit" class="filter-btn3" style="background: #482e1d; padding: 10px; width: 120px; border-radius: 10px; color: #ffff; margin-top:20px; cursor:pointer;">Tambah Menu</button></a>
    <a href="./datamenu.php"><button type="submit" class="filter-btn3" style="background: #482e1d; padding: 10px; width: 120px; border-radius: 10px; color: #ffff; margin-top:20px; cursor:pointer;">Data Menu</button></a>
    <a href=""><button type="submit" class="filter-btn3" style="background: #482e1d; padding: 10px; width: 120px; border-radius: 10px; color: #ffff; margin-top:20px; cursor:pointer;">History</button></a>
</div>
<div class="container">

    <form action="" method="POST" class="update-form">
        <input type="hidden" name="id" value="<?= $edt["id"]?>">
        <div class="input-group" style="position:absolute; top:50px;">
            <input type="text" placeholder="Nama Tempat" name="item_name" required value="<?= $edt["item_name"];?>" style="width:300px;">
        </div>
        <div class="input-group" style="position:absolute; top:150px;">
            <input type="text" placeholder="Harga" name="price"  required value="<?= $edt["price"];?>" style="width:300px;">
        </div>
        <div class="input-group" style="position:absolute; top:250px;">
            <input type="text" placeholder="Rating" name="category"  required value="<?= $edt["category"];?>" style="width:300px;">
        </div>
        <div class="input-group" style="position:absolute; top:300px;">
        <input type="file" placeholder="file" name="gambar" required value="<?= $edt["image_path"];?>" style="width:300px;">
        </div>
        <div class="input-group">
            <button name="edit" class="btn">Edit</button>
        </div>
    </form>
<!-- </div> -->
</div>
    <!-- <script src="https://unpkg.com/simplebar@latest/dist/simplebar.min.js"></script> -->
    <script src="../script/script-admin.js"></script>
  </body>
</html>