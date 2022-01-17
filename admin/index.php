<?php 
  session_start();
  if (!$_SESSION["id_pengguna"]){
        header('Location:../index.php?halaman=login&pesan=login_dulu');
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Halaman Admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../style/css/style1.css">
    <script src="../bootstrap/js/style1.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <!-- Brand -->
    <?php
        include '../koneksi/koneksi.php';
        $ambil_kategori = mysqli_query ($con,"select * from profil limit 1");
        $row = mysqli_fetch_assoc($ambil_kategori); 
        $nama_web = $row['nama_web'];
        //$copy_right = $row['nama_website'];
    ?>
    <a class="navbar-brand" href="../index.php"><?php echo $nama_web; ?> </a>

    <!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar links -->
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav  ml-auto">
        <li class="text-light">Login Sebagai :  <?php echo $_SESSION["nama_pengguna"]; ?> </li>
        </ul>
    </div>
   
</nav>
<div class="jumbotron text-center">
<?php 
if(isset($_GET['halaman']) && !isset($_GET['kategori'])){
    $halaman = $_GET['halaman'];
   echo "<h1>".ucwords($halaman)."</h1>";
}

if(isset($_GET['halaman']) &&  isset($_GET['kategori'])){

    include '../koneksi/koneksi.php';
    $ambil_kategori = mysqli_query ($con,"select * from kategori where id_kategori='".$_GET['kategori']."' limit 1");
    $row = mysqli_fetch_assoc($ambil_kategori); 
    $kategori = $row['nama_kategori'];
    $halaman = $_GET['halaman'];
   echo "<h1>".ucwords($halaman)." ".ucwords($kategori)."</h1>";
}
?>
</div>
<div class="container">
    <div class="row">
        <div class="col-sm-2">
            <div class="list-group">
                <a href="index.php?halaman=kategori" class="list-group-item list-group-item-action">Artikel</a>
                <a href="logout.php" class="list-group-item list-group-item-action">Logout</a>
            </div>
        </div> 
        <div class="col-sm-10">
        <?php 
            if(isset($_GET['halaman'])){
                $halaman = $_GET['halaman'];
                switch ($halaman) {
                    case 'kategori':
                        include "artikel/kategori.php";
                        break;
                    case 'artikel':
                        include "artikel/index.php";
                        break;
                    default:
                    echo "<center><h3>Maaf. Halaman tidak di temukan !</h3></center>";
                    break;
                }
            }else {
                include "dashboard.php";
            }
        ?>
        </div>
    </div>
    <br>
</div>
<div class="jumbotron text-center" style="margin-bottom:0">
    <p>Copyright 2021</p>
    <!--<p>Copyright <?php echo  $copy_right; ?> 2021</p>-->
</div>
</body>
</html>
