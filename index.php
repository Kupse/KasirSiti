<!DOCTYPE html>
   <html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <!--=============== REMIXICONS ===============-->
      <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

      <!--=============== CSS ===============-->
      <link rel="stylesheet" href="css/styles.css">

      <title> Login to Kasir Berlian</title>
   </head>
   <?php 
    if(isset($_GET['pesan'])){
    if($_GET['pesan']=="gagal"){
      echo "<script>
            alert('Username dan Password tidak sesuai !');
            </script>";
         }
    }
    ?>
   <body>
      <div class="login">
         <img src="img/seventeen.jpg" alt="login image" class="login__img">

         <form action="proses_login.php" class="login__form" method="post">
            <h1 class="login__title">Login</h1>

            <div class="login__content">
               <div class="login__box">
                  <i class="ri-user-3-line login__icon"></i>

                  <div class="login__box-input">
                     <input type="text" required class="login__input" name="username" autofocus autocomplete="off" placeholder>
                     <label for="login-username" class="login__label">Username</label>
                  </div>
               </div>

               <div class="login__box">
                  <i class="ri-lock-2-line login__icon"></i>

                  <div class="login__box-input">
                     <input type="password" required class="login__input" name="password" placeholder=" ">
                     <label for="login-pass" class="login__label">Password</label>
                  </div>
               </div>
            </div>

            <button type="submit" class="login__button">Login</button>

         </form>
      </div>
      
      <!--=============== MAIN JS ===============-->
      <script src="js/main.js"></script>
   </body>
</html>