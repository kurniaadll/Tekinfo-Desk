<?php
        include 'koneksi.php';
if($_GET['p']=='create'){
//insert
    if (isset($_POST['submit'])){

        $nama_proker = $_POST['nama_proker'];
        $id_bidang = $_POST['bidang'];
        $tanggal=$_POST['thn'] . '-' . $_POST['bln'] . '-' . $_POST['tgl'];
        $keterangan_proker = $_POST['keterangan_proker'];

        $sql=mysqli_query ($db,"INSERT INTO proker(nama_proker,id_bidang,tanggal,keterangan_proker) 
        VALUES ('$nama_proker','$id_bidang','$tanggal','$keterangan_proker')");
        if($sql){
            echo "<script> 
            window.location = 'index.php?p=proker&msg=ok';
            </script>";
        }
    }
}

elseif($_GET['p']=='update'){
    //update
            if (isset($_POST['submit'])) {
                $tanggal = $_POST['thn']."-".$_POST['bln']."-".$_POST['tgl'];
                $sql=mysqli_query($db,"UPDATE proker SET
                nama_proker         ='$_POST[nama_proker]',
                id_bidang         ='$_POST[bidang]',
                tanggal             ='$tanggal',
                keterangan_proker   ='$_POST[keterangan_proker]'
                WHERE id_proker='$_POST[id_proker]'");
                if ($sql) {
                    echo "<script>window.location='index.php?p=proker&msg=ok'</script>"; 
                }
            }
    }
elseif($_GET['p']=='delete'){
//delete
        $hapus = mysqli_query($db, "DELETE FROM proker WHERE id_proker='$_GET[id_hapus]'");
        if($hapus){
            echo "<script>
            alert('Data Berhasil Dihapus !');
            document.location.href = 'index.php?p=proker';
            </script>";
        }
        else {
            print('Gagal menghapus data');
        }
}
?>
