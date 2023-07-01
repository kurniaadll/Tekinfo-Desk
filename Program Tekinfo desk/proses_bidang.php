<?php
        include 'koneksi.php';
if($_GET['aksi']=='create'){
//insert
    if (isset($_POST['input'])){

        $nama_bidang = $_POST['nama_bidang'];
        $kabid = $_POST['kabid'];
        $keterangan = $_POST['keterangan'];
        $sql=mysqli_query ($db,"INSERT INTO bidang(nama_bidang,kabid,keterangan) 
        VALUES ('$nama_bidang','$kabid','$keterangan')");
        $ambil = $db->query("Select * from bidang where kabid='$_POST[kabid]'");
        $data = $ambil->fetch_array();
        $sql2=mysqli_query ($db,"UPDATE pengurus SET id_bidang = '$data[id_bidang]' 
                            WHERE id_pengurus = '$kabid' ");


        if($sql2){
            
             echo "<script> 
             window.location = 'index.php?p=bidang&msg=ok';
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
                    $sql=mysqli_query($db,"UPDATE bidang SET
                    nama_bidang    ='$_POST[nama_bidang]',
                    kabid        ='$_POST[kabid]',
                    keterangan        ='$_POST[keterangan]'
                    WHERE id_bidang='$_POST[id_bidang]'");
                    if ($sql) {
                        echo "<script>window.location='index.php?p=bidang&msg=ok'</script>"; 
                    }
        }
}

elseif($_GET['aksi']=='delete'){
//delete
    include 'koneksi.php';
        $hapus = mysqli_query($db, "DELETE FROM bidang WHERE id_bidang='$_GET[id_hapus]'");
        if($hapus){
            echo "<script>
            alert('Data Berhasil Dihapus !');
            document.location.href = 'index.php?p=bidang';
            </script>";
        }
        else {
            print('Gagal menghapus data');
        }
}
?>
