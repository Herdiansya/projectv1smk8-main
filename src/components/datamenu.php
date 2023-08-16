<?php
require 'config.php';

$record = seterah("SELECT * FROM menu");
?>


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
            border:none;
        }

        .update-btn {
            background-color: #fff;
            color: #000;
        }

        .delete-btn {
            background-color: #fff;
            color: #000;
            margin-right:-40px;
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
    <a href="./addmenu.php"><button type="submit" class="filter-btn3" style="background: #482e1d; padding: 10px; width: 120px; border-radius: 10px; color: #ffff; margin-top:20px; cursor:pointer;">Tambah Menu</button></a>
    <a href="#"><button type="submit" class="filter-btn3" style="background: #482e1d; padding: 10px; width: 120px; border-radius: 10px; color: #ffff; margin-top:20px; cursor:pointer;">History</button></a>
</div>
<h2 style="position:absolute; left:50%; top:25%; font-size:2rem;">Data Menu</h2>
<table>
            <<tr><th>ID</th><th>Image</th><th>Produk</th><th>Harga</th><th>Category</th><th>Action</th></tr>
            <?php $i = 1;?>
            <?php foreach($record as $rcd):?>
            <tr>
                <td><?= $i?></td>
                <td><img src="../../public/<?= $rcd["image_path"]?>" width="80px" class="menu-image"></td>
                <td><?= $rcd["item_name"]?></td>
                <td><?= $rcd["price"]?></td>
                <td><?= $rcd["category"]?></td>
                <td>
                <a href="./updatemenu.php?id=<?= $rcd["id"]?>"><button type="button" class="update-btn"><i class="bi bi-pencil-fill"></i></button></a>
                <a href="../logic/deletemenu.php?id=<?= $rcd["id"]?>"><button type="button" class="delete-btn"><i class="bi bi-trash3-fill"></i></button></a>
                </td>
            </tr>
            <?php $i++;?>
            <?php endforeach;?>
        </table>
</body>
</html>
