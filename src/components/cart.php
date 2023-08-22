<?php
session_start();
if (!isset($_SESSION["authenticated"])) {
  // Redirect user to login page if not authenticated
  header("Location: ./seccurity.php");
  exit();
}


$server = "localhost";
$user = "root";
$pass = "";
$database = "projectv1smk8";
 
$conn = mysqli_connect($server, $user, $pass, $database);


if(isset($_POST['update_update_btn'])){
   $update_value = $_POST['update_quantity'];
   $update_id = $_POST['update_quantity_id'];
   $update_quantity_query = mysqli_query($conn, "UPDATE `menu` SET quantity = '$update_value' WHERE id = '$update_id'");
   if($update_quantity_query){
      header('location:cart.php');
   };
};

if(isset($_GET['remove'])){
   $remove_id = $_GET['remove'];
   mysqli_query($conn, "DELETE FROM `menu` WHERE id = '$remove_id'");
   header('location:cart.php');
};

if(isset($_GET['delete_all'])){
   mysqli_query($conn, "DELETE FROM `menu`");
   header('location:cart.php');
}

if(isset($_POST['order_btn'])){
   $nameItem = $_POST['nameitem'];
   $names = $_POST['name'];
   $number = $_POST['number'];
   $method = $_POST['method'];

   $cart_query = mysqli_query($conn, "SELECT * FROM `menu`");
   $price_total = 0;
   if(mysqli_num_rows($cart_query) > 0){
      while($product_item = mysqli_fetch_assoc($cart_query)){
         $product_name[] = $product_item['item_name'] .' ('. $product_item['quantity'] .') ';
         $product_price = number_format($product_item['price'] * $product_item['quantity']);
         $price_total += $product_price;
      };
   };

   $total_product = implode(', ',$product_name);
   $detail_query = mysqli_query($conn, "INSERT INTO `orders`(Item_name, name, no_meja, metode_pembayaran, total_harga) VALUES('$nameItem','$names','$number','$method','$price_total')") or die('query failed');

   if($cart_query && $detail_query){
      echo "
      <div class='order-message-container'>
      <div class='message-container' style='background-color:#482e1d ;'>
         <h3 style='color:white;'>Thanks for the order</h3>
         <div class='order-detail'>
            <span>".$total_product."</span>
            <span class='total'> total : $".$price_total."/-  </span>
         </div>
         <div class='customer-details'>
            <p style='color:white;'> Nama Pemesan : <span style='color:white;'>".$name."</span> </p>
            <p style='color:white;'> No Meja : <span style='color:white;'>".$number."</span> </p>
            <p style='color:white;'> Metode Pembayaran : <span style='color:white;'>".$method."</span> </p>
         </div>
            <a href='./displaymenu.php' class='btn' style='background-color: #ffa500;'>Print</a>
         </div>
         </div>
            <a href='./displaymenu.php' class='btn' style='background-color: #ffa500;'>continue shopping</a>
         </div>
      </div>
      ";
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>shopping cart</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../style/style.css">
   <link rel="stylesheet" href="../style/cart.css">

</head>
<body>
<nav class="navbar">
      <a href="https://www.utter.academy/" target="_blank"><img src="../../public/Utter__1_-removebg-preview 7.png"  alt="backgroundmenu" width="210px" height="210px" style="cursor:pointer;"/></a>
      <div class="navbar2">
        <a href="./profil.php"><i class="bi bi-person-circle" style="color:white; font-size:40px; cursor:pointer; margin-right:-100px;"></i></a>
      </div>
    </nav>

    <div class="container">

<section class="checkout-form">

   <h1 class="heading">complete your order</h1>

   <form action="" method="post" style="width:400px; position:absolute; top:130px; right:850px; display:none; background:#482e1d;" id="form-checkout">

   <div class="display-order" style="background:#c89d80;">
      <?php
         $select_cart = mysqli_query($conn, "SELECT * FROM `menu`");
         $total = 0;
         $grand_total = 0;
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = number_format($fetch_cart['price'] * $fetch_cart['quantity']);
            $grand_total = $total += $total_price;
      ?>
      <span><?= $fetch_cart['item_name']; ?>(<?= $fetch_cart['quantity']; ?>)</span>
      <input type="hidden" name="nameitem" value="<?= $fetch_cart["item_name"]?>">
      <?php
         }
      }else{
         echo "<div class='display-order'><span>your cart is empty!</span></div>";
      }
      ?>
      <span class="grand-total"> Total : Rp<?= $grand_total; ?>/- </span>
   </div>

      <div class="flex">
         <div class="inputBox">
            <span style="color:white;">Nama Pemesan</span>
            <input type="text" placeholder="enter your name" name="name" required style="background:#c89d80; color:white;">
         </div>
         <div class="inputBox">
            <span style="color:white;">No Meja</span>
            <input type="number" placeholder="enter your number" name="number" required style="background:#c89d80; color:white;">
         </div>
         <div class="inputBox">
            <span style="color:white;">Metode Pembayaran</span>
            <select name="method" style="background:#c89d80; color:white;">
               <option value="Debit" selected>Debit</option>
               <option value="Cash">Cash</option>
               <option value="Q'RIS">Q'RIS</option>
            </select>
         </div>
         <!-- <div class="inputBox">
            <span>your email</span>
            <input type="email" placeholder="enter your email" name="email" required>
         </div>
         <div class="inputBox">
            <span>address line 1</span>
            <input type="text" placeholder="e.g. flat no." name="flat" required>
         </div>
         <div class="inputBox">
            <span>address line 2</span>
            <input type="text" placeholder="e.g. street name" name="street" required>
         </div>
         <div class="inputBox">
            <span>city</span>
            <input type="text" placeholder="e.g. mumbai" name="city" required>
         </div>
         <div class="inputBox">
            <span>state</span>
            <input type="text" placeholder="e.g. maharashtra" name="state" required>
         </div>
         <div class="inputBox">
            <span>country</span>
            <input type="text" placeholder="e.g. india" name="country" required>
         </div>
         <div class="inputBox">
            <span>pin code</span>
            <input type="text" placeholder="e.g. 123456" name="pin_code" required>
         </div>
      </div> -->
      <input type="submit" value="order now" name="order_btn" class="btn" style="background-color: var(--orange);">
   </form>

</section>

</div>

<?php ?>

<div class="container">

<section class="shopping-cart" style="margin-top:20px;">

   <!-- <h1 class="heading">shopping cart</h1> -->

   <table style="width:100%;" id="table-order">


      <tbody style="background:#482e1d;">

         <?php 
         
         $select_cart = mysqli_query($conn, "SELECT * FROM `menu`");
         $grand_total = 0;
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
         ?>

         <tr >
            <td><img src="../../public/<?php echo $fetch_cart['image_path']; ?>" height="100" alt="" style="margin-left:20px;"></td>
            <td style="color:white;"><?php echo $fetch_cart['item_name']; ?></td>
            <td style="color:white;">Rp<?php echo number_format($fetch_cart['price']); ?>/-</td>
            <td>
               <form action="" method="post">
                  <input type="hidden" name="update_quantity_id"  value="<?php echo $fetch_cart['id']; ?>" >
                  <input type="number" name="update_quantity" min="1"  value="<?php echo $fetch_cart['quantity']; ?>" >
                  <input type="submit" value="update" name="update_update_btn">
               </form>   
            </td>
            <td style="color:white;">Rp<?php echo $sub_total = number_format($fetch_cart['price'] * $fetch_cart['quantity']); ?>/-</td>
            <td><a href="cart.php?remove=<?php echo $fetch_cart['id']; ?>" onclick="return confirm('remove item from cart?')" class="delete-btn"> <i class="fas fa-trash"></i> Hapus</a></td>
         </tr>
         <?php
           $grand_total += $sub_total;  
            };
         };
         ?>
         <tr class="table-bottom">
            <td><a href="./displaymenu.php" class="option-btn" style="margin-top: 0;">Lanjut Belanja</a></td>
            <td colspan="3">Total</td>
            <td>Rp<?php echo $grand_total; ?>/-</td>
            <td><a href="cart.php?delete_all" onclick="return confirm('are you sure you want to delete all?');" class="delete-btn"> <i class="fas fa-trash"></i> Hapus Semua </a></td>
         </tr>

      </tbody>

   </table>

   <div class="checkout-btn">
      <button class="btn <?= ($grand_total > 1)?'':'disabled';?>" id="btn-checkout" style="width:200px; margin-left:40%; background:#482e1d;">Checkout</button>
   </div>

</section>

</div>
   
<!-- custom js file link  -->
<script>
   const buttonCheckout = document.getElementById('btn-checkout');
    const formCheckout = document.getElementById('form-checkout');
    const tabelOrder = document.getElementById('table-order');

    buttonCheckout.addEventListener('click', () => {
        formCheckout.style.display = 'block';
        tabelOrder.style.width = '400px';
        tabelOrder.style.marginLeft = '450px';
        buttonCheckout.style.marginLeft = '65%';
    });
</script>

</body>
</html>