<?php
        include 'koneksi.php';
if($_GET['p']=='create'){
//insert
    if (isset($_POST['submit'])){

        $id_pengurus = $_POST['id_pengurus'];
        $tanggal = $_POST['tanggal'];
        $bulan = $_POST['bulan'];
        $status = $_POST['status'];

        $sql=mysqli_query ($db,"INSERT INTO kas(id_pengurus,tanggal,bulan,status) 
        VALUES ('$id_pengurus','$tanggal','$bulan','$status')");
        if($sql){
            echo "<script> 
            window.location = 'index.php?p=kas&msg=ok';
            </script>";
        }
    }
}

elseif($_GET['p']=='update'){
    //update
            if (isset($_POST['submit'])) {
                        $sql=mysqli_query($db,"UPDATE kas SET
                        tanggal            ='$_POST[tanggal]',
                        bulan          ='$_POST[bulan]',
                        status           ='$_POST[status]'
                        WHERE id_kas='$_POST[id_kas]'");
                        if ($sql) {
                            echo "<script>window.location='index.php?p=kas&msg=ok'</script>"; 
                        }
            }
}
elseif($_GET['p']=='delete'){
//delete
        $hapus = mysqli_query($db, "DELETE FROM kas WHERE id_kas='$_GET[id_hapus]'");
        if($hapus){
            echo "<script>
            alert('Data Berhasil Dihapus !');
            document.location.href = 'index.php?p=kas';
            </script>";
        }
        else {
            print('Gagal menghapus data');
        }
}
?>
