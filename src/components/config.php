<?php
$server = "localhost";
$user = "root";
$pass = "";
$database = "projectv1smk8";
 
$conn = mysqli_connect($server, $user, $pass, $database);

function seterah($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
};

function edit($data){
    global $conn;
    $id = $data["id"];
    $nama = htmlspecialchars($data["item_name"]);
    $rating = htmlspecialchars($data["price"]);
    $harga = htmlspecialchars($data["category"]);
    $gambar = $data["gambar"];

    $query = "UPDATE menu SET
               item_name = '$nama',
               price = '$rating',
               category = '$harga',
               image_path = '$gambar'
               WHERE id = $id
               ";

    mysqli_query($conn,$query);

    return mysqli_affected_rows($conn);
};

function destt($destinasi){
    global $conn;
    $id = $data["id"];
    $nama = htmlspecialchars($destinasi["item_name"]);
    $price = htmlspecialchars($destinasi["price"]);
    $category = htmlspecialchars($destinasi["category"]);
    $gambar = htmlspecialchars($destinasi["image"]);
    $product_quantity = 1;

    $query = "INSERT INTO menu
              VALUES 
              ('', '$nama', '$price', '$category', '$gambar', '$product_quantity')";

    mysqli_query($conn,$query);

    return mysqli_affected_rows($conn);
}
?>