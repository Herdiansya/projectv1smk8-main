<!DOCTYPE html>
<html>
  <head>
    <title>Add Menu Item</title>
    <link rel="stylesheet" href="../style/addmenu.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
  </head>
  <body>
  <nav class="navbar">
      <a href="https://www.utter.academy/" target="_blank"><img src="../../public/Utter__1_-removebg-preview 7.png"  alt="backgroundmenu" width="210px" height="210px" style="cursor:pointer;"/></a>
      <div class="navbar2">
        <a href="./profil.php"><i class="bi bi-person-circle" style="color:white; font-size:40px; cursor:pointer; margin-right:-100px;"></i></a>
      </div>
    </nav>
    <h2 style="position:absolute; top:130px; left:600px;">Tambah Menu</h2>
    <div class="navbar2" style="width:150px; height:83%; background:#F1E4D6; position:absolute; left:0; top:100px; display:flex;  flex-direction:column; align-items:center; justify-content: space-around; position:fixed;">
    <a href="./displaymenu.php"><button type="submit" class="filter-btn2" style="background: #482e1d; padding: 10px; width: 120px; border-radius: 10px; color: #ffff;  margin-top:20px;">Home</button></a>
    <a href="#"><button type="submit" class="filter-btn3" style="background: #482e1d; padding: 10px; width: 120px; border-radius: 10px; color: #ffff; margin-top:20px;">Histori</button></a>
    <a href="#"><button type="submit" class="filter-btn3" style="background: #482e1d; padding: 10px; width: 120px; border-radius: 10px; color: #ffff; margin-top:20px;">Data Menu</button></a>
</div>
    <div class="container">
      <form action="../logic/addmenu.php" method="post" enctype="multipart/form-data">
        <div>
          <label for="item_name" style="margin-right:50px;">Item Name:</label>
          <input type="text" id="item_name" name="item_name" required  style="background:#482E1D; color:#fff; padding:10px; border-radius:51px; width:300px;" />
        </div>
        <div>
          <label for="price" style="margin-right:100px;">Price:</label>
          <input type="number" step="0.01" id="price" name="price" required style="background:#482E1D; color:#fff; padding:10px; border-radius:51px; width:300px;"/>
        </div>
        <div>
          <label for="category" style="margin-right:370px;">Category:</label>
          <div class="radiocontainer" style="position:absolute; left:300px; bottom:170px;">
            <input type="radio" id="food" name="category" value="food" required />
            <label for="food">Food</label>
            <input type="radio" id="drink" name="category" value="drink" required />
            <label for="drink">Drink</label>
          </div>
        </div>
        <div>
          <label for="image" style="margin-right:70px;">Image:</label>
          <input type="file" id="image" name="image" accept="image/*" required />
        </div>
        <div>
          <button type="submit" style="padding:10px; background: #482E1D; color:#fff; border-radius:10px; ">Add Item</button>
        </div>
      </form>
    </div>

  </body>
</html>
