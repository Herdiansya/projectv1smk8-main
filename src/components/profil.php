<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projectv1smk8";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil data pengguna dari database
$user_id = 1; // Ganti dengan ID pengguna yang sesuai
$query = "SELECT id, name, profile_picture FROM users WHERE id = $user_id";
$result = $conn->query($query);
$user_data = $result->fetch_assoc();

// Proses upload foto
if (isset($_POST['upload'])) {
    $target_dir = "../../public/";
    $target_file = $target_dir . basename($_FILES["foto"]["name"]);
    
    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
        // Update foto pengguna di database
        $update_query = "UPDATE users SET profile_picture = '$target_file' WHERE id = $user_id";
        $conn->query($update_query);
        $user_data['foto'] = $target_file;
    } else {
        echo "Upload gagal.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profil Page</title>
    <link rel="stylesheet" href="../style/profil.css">
</head>
<body>
  <nav class="navbar"><a href="https://www.utter.academy/" target="_blank"><img src="../../public/Utter__1_-removebg-preview 7.png"  alt="backgroundmenu" width="210px" height="210px" style="cursor:pointer;"/></a></nav>
  <div class="navbar2" style="width:150px; height:83%; background:#F1E4D6; position:absolute; left:0; top:100px; display:flex;  flex-direction:column; align-items:center; justify-content: space-around; position:fixed;">
    <a href="./displaymenu.php"><button type="submit" class="filter-btn2" style="background: #482e1d; padding: 10px; width: 120px; border-radius: 10px; color: #ffff;  margin-top:20px;">Home</button></a>
    <a href="./addmenu.php"><button type="submit" class="filter-btn3" style="background: #482e1d; padding: 10px; width: 120px; border-radius: 10px; color: #ffff; margin-top:20px;">Tambah Menu</button></a>
    <a href="#"><button type="submit" class="filter-btn3" style="background: #482e1d; padding: 10px; width: 120px; border-radius: 10px; color: #ffff; margin-top:20px;">Histori</button></a>
    <a href="./datamenu.php"><button type="submit" class="filter-btn3" style="background: #482e1d; padding: 10px; width: 120px; border-radius: 10px; color: #ffff; margin-top:20px;">Data Menu</button></a>
</div>
  <div class="container">
  <h1>Welcome</h1>
  <div class="profilBorder">
    <img src="<?php echo $user_data['profile_picture']; ?>" alt="Foto Profil" width="150px" height="150px" style="object-fit:contain;">
  </div>
  <p>Nama: <?php echo $user_data['name']; ?></p>
  <p>ID: <?php echo $user_data['id']; ?></p>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="file" name="foto">
        <input type="submit" name="upload" value="Upload">
    </form>
  </div>  
</body>
</html>
