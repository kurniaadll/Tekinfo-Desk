<?php
include 'koneksi.php';
if($_GET['aksi']=='create'){
//insert
    if (isset($_POST['input'])){

        $nama_barang = $_POST['nama_barang'];
        $stock = $_POST['stock'];
        $harga = $_POST['harga'];

        $sql=mysqli_query ($db,"INSERT INTO barang(nama_barang,stock,harga) 
        VALUES ('$nama_barang','$stock','$harga')");

        if($sql){
            
             echo "<script> 
             window.location = 'index.php?p=barang&msg=ok';
             </script>";
        } else {
            echo $db->error;
        }
    }
}

elseif($_GET['aksi']=='update'){
//update
include 'koneksi.php';
        if (isset($_POST['submit'])) {
                    $sql=mysqli_query($db,"UPDATE barang SET
                    nama_barang    ='$_POST[nama_barang]',
                    harga    ='$_POST[harga]',
                    stock        ='$_POST[stock]'
                    WHERE id_barang='$_POST[id_barang]'");
                    if ($sql) {
                        echo "<script>window.location='index.php?p=barang&msg=ok'</script>"; 
                    }
        }
}

elseif($_GET['aksi']=='delete'){
//delete
    include 'koneksi.php';
        $hapus = mysqli_query($db, "DELETE FROM barang WHERE id_barang='$_GET[id_hapus]'");
        if($hapus){
            echo "<script>
            alert('Data Berhasil Dihapus !');
            document.location.href = 'index.php?p=barang';
            </script>";
        }
        else {
            print('Gagal menghapus data');
        }
}
?>
