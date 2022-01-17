<?php
session_start();
    include '../../koneksi/koneksi.php';

    $id_kategori=$_POST["id_kategori"];
    $gambar=$_POST["gambar"];

    $sql="delete from kategori where id_kategori=$id_kategori";
    $hapus_kategori=mysqli_query($con,$sql);

    //Menghapus file gambar

    if ($gambar!='gambar_up.png'){
        unlink("gambar_kategori/".$gambar);
    }

?>