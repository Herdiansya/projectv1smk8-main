

<!DOCTYPE html>
<html>
  <head>
    <title>Login</title>
    <link rel="stylesheet" href="./src/style/index.css" />
  </head>
  <body>
    <div class="square">
      <img src="./public/Utter__1_-removebg-preview 7.png" alt="" width="500px" style="margin-left:55px; margin-top:50px;">
    </div>
  <div class="container" style="box-shadow: 0px 0px 9px 0px rgba(0,0,0,0.57);">
  <h2 style="margin-top: -50px; color: #6A4334; font-style: italic;">Login Admin</h2>
  <p style="margin-top: -80px; color: #6A4334;">Silahkan masuk ke panel admin</p>
    <form action="./src/logic/login.php" method="post" style="margin-left:-250px">
      <div  style="display:flex; flex-direction: column; margin-bottom:100px;">
        <label for="id" style="position:absolute; top:150px; color:#482E1D;">ID Admin:</label>
        <input type="text" id="id" name="id" required style="position:absolute; bottom:190px; background:#482E1D; width:250px; border-radius:10px; padding:5px; color:white;"/>
      </div>
      <div style="display:flex; flex-direction: column;">
        <label for="password" style="position:absolute; top:230px; color:#482E1D;">Password:</label>
        <input type="password" id="password" name="password" required style="position:absolute; bottom:110px; background:#482E1D; width:250px; border-radius:10px; padding:5px; color:white;"/>
      </div>
      <div>
        <button type="submit" class="login-btn">Login</button>
      </div>
      <p style="position:absolute; bottom:20px; left:35px;">Don't have account? <a href="./src/components/signup.php" style="text-decoration:none; color:#482e1d;">Sign Up</a></p>
    </form>
  </div>
  </body>
</html>
