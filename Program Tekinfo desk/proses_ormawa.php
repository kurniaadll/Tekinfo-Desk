<?php
    include 'koneksi.php';
    if($_GET['p']=="input_ormawa"){
        if (isset($_POST['submit'])) {
            $nama = $_POST['nama'];
            

            //query
            $sql = mysqli_query($db, "INSERT INTO ormawa (nama_ormawa)
                                    VALUES ('$nama')
                                ");
            if ($sql) {
                echo "
                <script>
                    window.location = 'index.php?p=ormawa&msg=ok';
                </script>";
            } else {
                echo "
                <script>
                    alert('data gagal  disimpan !');
                </script>";
            }
        }
    }

    elseif($_GET['p'] == 'edit_ormawa'){
        include 'koneksi.php';
        if (isset($_POST['submit'])) {

            //query
            $sql = mysqli_query($db, "UPDATE  ormawa  SET
            nama_ormawa = '$_POST[nama]'
            WHERE id_ormawa = '$_POST[id]'");

        if ($sql) {
            echo "
            <script>
                window.location = 'index.php?p=ormawa';
            </script>";
        } else {
            echo "
            <script>
                alert('Data Gagal Diubah!');
            </script>";
            }
        }
    }

    elseif($_GET['p'] == 'hapus_ormawa'){
        $hapus = mysqli_query($db, "DELETE FROM ormawa where id_ormawa = '$_GET[id_hapus]'");

        if($hapus){
            echo "<script>
            alert('Data Berhasil Dihapus !');
            document.location.href = 'index.php?p=ormawa';
            </script>";
        }
    }
?>