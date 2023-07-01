<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/login.css" rel="stylesheet">
    <title>Sign in</title>
</head>
<body class="text-center">
<main class="form-signin w-100 m-auto" >
    <form action="" method="post">
    <h1 class="h3 mb-3 fw-normal text-white">TEKINFO DESK</h1>

    <div class="form-floating">
      <input type="text" name="username" class="form-control" id="floatingInput" placeholder="Username">
      <label for="floatingInput">Username</label>
    </div>
    <div class="form-floating">
      <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>
    <button class="w-100 btn btn-lg btn-dark" name="submit" type="submit">Log In</button>
    <p class="mt-5 mb-3 text-muted">&copy; <?= date('Y')?></p>
  </form>

  <?php
    include 'koneksi.php';
    if(isset($_POST['submit'])){
      $pass=md5($_POST['password']);
      $login=mysqli_query($db,"SELECT * FROM user where username='$_POST[username]' AND 
                          password='$pass'");
      $hasil_login = mysqli_num_rows($login); 
      $data_login = mysqli_fetch_array($login);
      if($hasil_login >0){
        session_start();
        $_SESSION['user'] = $data_login['username'];
        $_SESSION['id_login'] = $data_login['id'];
        $_SESSION['level'] = $data_login['level'];
        header('location:index.php');
        }
      }
  ?>
</main>

</body>
</html>