<?php
session_start();
if (!isset($_SESSION["authenticated"])) {
  // Redirect user to login page if not authenticated
  header("Location: ./seccurity.php");
  exit();
}

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Sign Up</title>
    <link rel="stylesheet" href="../style/signup.css" />
  </head>
  <body>
    <div class="square">
      <img src="../../public/Utter__1_-removebg-preview 7.png" alt="" width="500px" style="margin-left: 55px; margin-top: 50px" />
    </div>
    <div class="container">
    <h2 style="margin-top: -130px; color: #6A4334; font-style: italic;">Sign Up Admin</h2>
  <p style="margin-top: -150px; color: #6A4334;">Silahkan daftar ke panel admin</p>
    <form action="../logic/signup.php" method="post">
      <div style="display:flex; flex-direction: column; margin-bottom:100px;">
        <label for="id" style="position:absolute; top:120px; left: 50px; color:#482E1D;">Id:</label>
        <input type="text" id="username" name="id" required style="position:absolute; bottom:330px;  left: 50px; background:#482E1D; width:250px; border-radius:10px; padding:5px; color:white;"/>
      </div>
      <div  style="">
        <label for="name" style="position:absolute; top:190px; left:50px; ">Name:</label>
        <input type="text" id="username" name="name" required style="position:absolute; bottom:260px;  left: 50px; background:#482E1D; width:250px; border-radius:10px; padding:5px; color:white;"/>
      </div>
      <div style="">
        <label for="password" style="position:absolute; top:260px; left:50px; ">Password:</label>
        <input type="password" id="password" name="password" required style="position:absolute; bottom:190px;  left: 50px; background:#482E1D; width:250px; border-radius:10px; padding:5px; color:white;"/>
      </div>
      <div style="">
        <label for="confirm_password" style="position:absolute; top:330px; left:50px; ">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required style="position:absolute; bottom:120px;  left: 50px; background:#482E1D; width:250px; border-radius:10px; padding:5px; color:white;"/>
      </div>
      <div>
      <button type="submit" class="signup-btn">SignUp</button>
      </div>
    </form>
    <p style="position:absolute; bottom:20px; left:60px;">Already have account? <a href="../../index.php" style="text-decoration:none; color:#482e1d;">Login</a></p>
    </div>
  </body>
</html>
