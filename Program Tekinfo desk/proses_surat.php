<?php
        include 'koneksi.php';
if($_GET['p']=='create'){
//insert
    if (isset($_POST['submit'])){

        $no_surat = $_POST['no_surat'];
        $kode_surat = $_POST['kode_surat'];
        $id_ormawa = $_POST['ormawa'];
        $bulan = $_POST['bulan'];
        $tahun = $_POST['tahun'];
        $jenis_surat = $_POST['jenis_surat'];
        $keterangan_surat = $_POST['keterangan_surat'];

        $sql=mysqli_query ($db,"INSERT INTO surat(no_surat,kode_surat,id_ormawa,bulan,tahun,jenis_surat,keterangan_surat) 
        VALUES ('$no_surat','$kode_surat','$id_ormawa','$bulan','$tahun','$jenis_surat','$keterangan_surat')");
        if($sql){
            echo "<script> 
            window.location = 'index.php?p=surat&msg=ok';
            </script>";
        }
    }
}

elseif($_GET['p']=='update'){
    //update
            if (isset($_POST['submit'])) {
                        $sql=mysqli_query($db,"UPDATE surat SET
                        no_surat            ='$_POST[no_surat]',
                        kode_surat          ='$_POST[kode_surat]',
                        id_ormawa           ='$_POST[ormawa]',
                        bulan               ='$_POST[bulan]',
                        tahun               ='$_POST[tahun]',
                        jenis_surat         ='$_POST[jenis_surat]',
                        keterangan_surat    ='$_POST[keterangan_surat]'
                        WHERE id_surat='$_POST[id_surat]'");
                        if ($sql) {
                            echo "<script>window.location='index.php?p=surat&msg=ok'</script>"; 
                        }
            }
    }
elseif($_GET['p']=='delete'){
//delete
        $hapus = mysqli_query($db, "DELETE FROM surat WHERE id_surat='$_GET[id_hapus]'");
        if($hapus){
            echo "<script>
            alert('Data Berhasil Dihapus !');
            document.location.href = 'index.php?p=surat';
            </script>";
        }
        else {
            print('Gagal menghapus data');
        }
}
?>
