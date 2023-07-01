<?php
    include 'koneksi.php';
    if($_GET['p']=="input_user"){
        if (isset($_POST['submit'])) {
            $username = $_POST['username'];
            $password=md5($_POST['password']);
            $confirm_password = md5($_POST['confirm_password']);
            $level = $_POST['level'];
            $id_pengurus = $_POST['id_pengurus'];

            if($password == $confirm_password){ 
                // echo $id_pengurus;
                echo $_POST['id_pengurus'];
                //query
                $sql = mysqli_query($db, "INSERT INTO user (id_pengurus,username,password,level)
                                        VALUES ('$id_pengurus','$username','$password','$level')
                                   ");
                if ($sql) {
                    echo "
                    <script>
                        window.location = 'index.php?p=user&msg=ok';
                    </script>";
                } else {
                    echo "
                    <script>
                        alert('data gagal  disimpan !');
                    </script>";
                }
                
            }
            elseif($password != $confirm_password){
                    echo "
                    <script>
                        alert('Password tidak sama dengan Confirm Password!');
                        document.location.href = 'index.php?p=user&page=input';
                        </script>";
                } 
        }
    }

    elseif($_GET['p'] == 'edit_user'){
        include 'koneksi.php';
        if (isset($_POST['submit'])) {
            $username = $_POST['username'];
            $password=md5($_POST['password']);
            $confirm_password = md5($_POST['confirm_password']);
            $level = $_POST['level'];

            if($password == $confirm_password){
                //query
                $sql = mysqli_query($db, "UPDATE  user  SET
                username = '$username', 
                password = '$password',
                level = '$_POST[level]'
                WHERE id_pengurus = '$_POST[id_pengurus]'");

                if ($sql) {
                    echo "
                    <script>
                        window.location = 'index.php?p=user';
                    </script>";
                } else {
                    echo "
                    <script>
                        alert('Data Gagal Diubah!');
                    </script>";
                    }

            }elseif($password != $confirm_password){
                echo "
                <script>
                    alert('Password tidak sama dengan Confirm Password!');
                    document.location.href = 'index.php?p=user&page=edit&id_edit=$_POST[id_pengurus]';
                </script>";
            }else{
                //query
                $sql = mysqli_query($db, "UPDATE  user  SET
                username = '$username', 
                level = '$_POST[level]'
                WHERE id = '$_POST[id]'");
            }
        }
    }

    elseif($_GET['p'] == 'hapus_user'){
        $hapus = mysqli_query($db, "DELETE FROM user where id_pengurus = '$_GET[id_hapus]'");

        if($hapus){
            echo "<script>
            alert('Data Berhasil Dihapus !');
            document.location.href = 'index.php?p=user';
            </script>";
        }
    }
?>
