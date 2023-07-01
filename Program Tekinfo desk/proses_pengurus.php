<?php
        include 'koneksi.php';
if($_GET['aksi']=='create'){
//insert
    if (isset($_POST['input'])){

        $id_pengurus = $_POST['id_pengurus'];
        $nama_pengurus = $_POST['nama_pengurus'];
        $bidang = $_POST['bidang'];
        $prodi = $_POST['prodi'];

        $sql=mysqli_query ($db,"INSERT INTO pengurus(id_pengurus,nama_pengurus,id_bidang,id_prodi) 
        VALUES ('$id_pengurus','$nama_pengurus','$bidang','$prodi')");
        if($sql){
            echo "<script> 
            window.location = 'index.php?p=pengurus&msg=ok';
            </script>";
        }
    }
}

elseif($_GET['aksi']=='update'){
//update
include 'koneksi.php';
        if (isset($_POST['submit'])) {
            if(isset($_POST['bidang'])){
                    $sql=mysqli_query($db,"UPDATE pengurus SET
                    nama_pengurus    ='$_POST[nama_pengurus]',
                    id_bidang        ='$_POST[bidang]',
                    id_prodi       ='$_POST[prodi]'
                    WHERE id_pengurus='$_POST[id_pengurus]'");
            } else {
                    $sql=mysqli_query($db,"UPDATE pengurus SET
                    nama_pengurus    ='$_POST[nama_pengurus]',
                    id_prodi       ='$_POST[prodi]'
                    WHERE id_pengurus='$_POST[id_pengurus]'");
            }
                    if ($sql) {
                        echo "<script>window.location='index.php?p=pengurus&msg=ok'</script>"; 
                    }
                    else {
                        echo $db->error;
                    }
        }
}

elseif($_GET['aksi']=='delete'){
//delete
    include 'koneksi.php';
        $sql = mysqli_query($db, "SELECT count(id_bidang) FROM bidang where kabid=$_GET[id_hapus]");
        $bid = $sql->fetch_row();
        if($bid[0]=='0'){

            $hapus = mysqli_query($db, "DELETE FROM pengurus WHERE id_pengurus='$_GET[id_hapus]'");
            if($hapus){
                echo "<script>
                alert('Data Berhasil Dihapus !');
                document.location.href = 'index.php?p=pengurus';
                </script>"; 
            }
            else {
                print('Gagal menghapus data');
            }
        } else {
            echo "<script>
            alert('Tidak bisa menghapus data pengurus yang menjadi Kabid!');
                document.location.href = 'index.php?p=pengurus';
                </script>";
        }

}
?>
