
<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="ie6 ielt8"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="ie7 ielt8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="ie8"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html lang="en"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<title>Paper Stack</title>
<link rel="stylesheet" type="text/css" href="assets/frontend/css/\login.css" />
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<style>
    body {
    background: url('https://png.pngtree.com/thumb_back/fw800/background/20230523/pngtree-large-black-cubes-moving-on-the-black-background-image_2606196.jpg') no-repeat center center fixed;
    background-size: cover;
  }
</style>
</head>
<body>
 <?PHP
  /*
    <div class="container" style="margin-top: 200px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
      <section id="content">
        <form method="post" action="index.php?controller=account&action=loginPost">
          <h1>MyComputer Login</h1>
          <div>
            <input type="text" placeholder="Username" required="" name="email" id="username" />
          </div>
          <div>
            <input type="password" placeholder="Password" required="" name="password" id="password" />
          </div>
          <div>
            <input type="submit" value="Log in" />
            <a href="#" class="link-button">Lost your password?</a>
            <a href="index.php?controller=account&action=register" class="link-button">Register</a>
          </div>
        </form><!-- form -->
        <div class="button">
          <a href="#">Download source file</a>
        </div><!-- button -->
      </section><!-- content -->
    </div><!-- container -->
    */
 ?>
 <h1 class="w3ls">Hoang Shop </h1>
<div class="content-w3ls" style="
    font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;">
  <div class="content-agile1">
    <h2 class="agileits1">Welcome</h2>
    
  </div>
  <div class="content-agile2">
    <form form method="post" action="index.php?controller=account&action=loginPost">
      <div class="form-control w3layouts">  
        <input class="form_login_email" type="text" placeholder="Username" required="" name="email" id="username" />
       <!--  <input type="text" id="email" name="email" placeholder="mail@example.com" title="Please enter a valid email" required=""> -->
      </div>
      <div class="form-control agileinfo">  
        <input class="form_login_email" type="password" placeholder="Password" required="" name="password" id="password" />
       <!--  <input type="password" class="lock" name="password" placeholder="Mật khẩu" id="password2"required=""> -->
      </div>
        <input type="submit" value="Log in" class="register"/>       
     <!--  <input type="submit" class="register" value="Login"> -->
    </form>
    <div class="register-to_login">
      <p>Bạn chưa có tài khoản</p>
      <a href="http://localhost/MyComputer/index.php?controller=account&action=register">Register</a>
    </div>
   
  </div>
  <div class="clear"></div>
</div>
</body>
</html>
