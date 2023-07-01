<?php
  session_start();
  if(!isset($_SESSION['user']) && !isset($_SESSION['id_login'])){
    header('location:login.php');
  }
?>

<!DOCTYPE html>
<html lang="en">
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Tekinfo Desktop</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/dashboard.css">
</head>

<body>
<header class=" navbar navbar-dark sticky-top flex-md-nowrap p-0 ">
  <a class="text-bg-dark navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="#">TEKINFO DESK</a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
</header>

<div class="container-fluid">
  <div class="row ">
  <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
  <div class="position-sticky pt-3 sidebar-sticky text-bg-dark">
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link <?php echo (empty($_GET['p']) ? 'active' : ''); ?>" aria-current="page" href="#">
          <span class="align-text-bottom">
            <?php
              echo "Hello, ";
              echo ($_SESSION['user']);
            ?>
          </span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php echo (isset($_GET['p']) && $_GET['p'] === 'home' ? 'active' : ''); ?>" aria-current="page" href="index.php?p=home">
          <span data-feather="home"></span>
          Home
          <span class="align-text-bottom"></span>
        </a>
      </li>
      <?php
        if ($_SESSION['level']=='admin') { //hanya bisa diakses oleh level admin
      ?>
      <li class="nav-item">
        <a class="nav-link <?php echo  (isset($_GET['p']) && $_GET['p'] == 'user' ? 'active' : ''); ?>" href="index.php?p=user">
          <span data-feather="user"></span>
          User
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php echo  (isset($_GET['p']) && $_GET['p'] == 'bidang' ? 'active' : ''); ?>" href="index.php?p=bidang">
          <span data-feather="server"></span>
          Bidang
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php echo  (isset($_GET['p']) && $_GET['p'] == 'prodi' ? 'active' : ''); ?>" href="index.php?p=prodi">
          <span data-feather="slack"></span>
          Prodi
        </a>
      </li>
      <?php
        }
      ?>
      <?php
        if ($_SESSION['level']=='admin'||$_SESSION['level']=='sekretaris') { //hanya bisa diakses oleh level admin & sekretaris
      ?>
      <li class="nav-item">
        <a class="nav-link <?php echo  (isset($_GET['p']) && $_GET['p'] == 'pengurus' ? 'active' : ''); ?>" href="index.php?p=pengurus">
          <span data-feather="users"></span>
          Pengurus
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php echo  (isset($_GET['p']) && $_GET['p'] == 'proker' ? 'active' : ''); ?>" href="index.php?p=proker">
          <span data-feather="clipboard"></span>
          Proker
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php echo  (isset($_GET['p']) && $_GET['p'] == 'surat' ? 'active' : ''); ?>" href="index.php?p=surat">
          <span data-feather="mail"></span>
          Surat
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php echo  (isset($_GET['p']) && $_GET['p'] == 'ormawa' ? 'active' : ''); ?>" href="index.php?p=ormawa">
          <span data-feather="briefcase"></span>
          Ormawa
        </a>
      </li>
      <?php
        }
      ?>
      <?php
        if ($_SESSION['level']=='admin'||$_SESSION['level']=='bendahara') { //hanya bisa diakses oleh level admin & bendahara
      ?>
      <li class="nav-item">
        <a class="nav-link <?php echo  (isset($_GET['p']) && $_GET['p'] == 'kas' ? 'active' : ''); ?>" href="index.php?p=kas">
          <span data-feather="dollar-sign"></span>
          KAS
        </a>
      </li>
      <?php
        }
      ?>
      <?php
        if ($_SESSION['level']=='admin'||$_SESSION['level']=='danus') { //hanya bisa diakses oleh level admin & danus
      ?>
      <li class="nav-item">
        <a class="nav-link <?php echo  (isset($_GET['p']) && $_GET['p'] == 'barang' ? 'active' : ''); ?>" href="index.php?p=barang">
          <span data-feather="package"></span>
          Barang
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php echo  (isset($_GET['p']) && $_GET['p'] == 'it-mart' ? 'active' : ''); ?>" href="index.php?p=it-mart">
          <span data-feather="shopping-cart"></span>
          IT Mart
        </a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link <?php echo (isset($_GET['p']) && $_GET['p'] == 'laporan' ? 'active' : ''); ?>" href="index.php?p=laporan">
          <span data-feather="printer"></span>
          Laporan Transaksi
        </a>
      </li>
      <?php
        }
      ?>
      <li class="nav-item">
        <a class="nav-link px-3 text-bg-dark <?php echo (isset($_GET['p']) && $_GET['p'] == 'logout' ? 'active' : ''); ?>" href="logout.php">
          <span data-feather="log-out"></span>
          Sign Out
        </a>
      </li>
    </ul>
  </div>
</nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      
      </div>

      <?php
          include 'koneksi.php';
          $p=isset($_GET['p']) ?$_GET['p'] : 'home';
          if($p=='home') include'home.php';
          if ($p=='user') include'user.php';
          if ($p=='pengurus') include'pengurus.php';
          if ($p=='pengurus2') include'pengurusOld.php';
          if ($p=='proker') include'proker.php';
          if ($p=='surat') include'surat.php';
          if ($p=='kas') include'kas.php';
          if ($p=='it-mart') include'it-mart.php';
          if ($p=='bidang') include'bidang.php';
          if ($p=='prodi') include'prodi.php';
          if ($p=='barang') include'barang.php';
          if ($p=='laporan') include'laporan.php';
          if ($p=='ormawa') include'ormawa.php';
         
        ?>
    </main>
  </div>
</div>
<script src="js/bootstrap.bundle.min.js"> </script>
<script src="js/feather.min.js"> </script>
<script>
  feather.replace({ 'aria-hidden': 'true' })
</script>
</body>
</html>