<?php

    include 'koneksi.php';
        
    function getTransactionId() {
        include 'koneksi.php';
         
        $today = date('ymd');
        $sql = "SELECT * from transaksi";

        if ($result = mysqli_query($db, $sql)) {
            
            // Return the number of rows in result set
            $rowcount = mysqli_num_rows( $result );
        }
        $newNumber = ($rowcount) + 1;

        // Format nomor dengan tiga digit menggunakan str_pad
        $paddedNumber = str_pad($newNumber, 3, '0', STR_PAD_LEFT);
        
        // Gabungkan semua komponen untuk membuat nomor transaksi
        $transactionNumber = $today . $paddedNumber;
        
        return $transactionNumber;
        }

if ($_GET['aksi']=='new_transaksi') {

    $id_transaksi = getTransactionId();
    $tanggal = date("Y-m-d");
    $kasir = $_POST['kasir'];
        $sql_kasir = mysqli_query ($db,"SELECT id_pengurus from user WHERE username='$kasir'");
        $data_kasir = mysqli_fetch_array($sql_kasir);

        // konversi id kasir ke integer
        $id_kasir = intval($data_kasir['id_pengurus']);
        header("location: index.php?p=it-mart&page=detail_trans&id_transaksi=" . $id_transaksi);

        
     $sql = "INSERT INTO transaksi (id_transaksi,kasir,tanggal) VALUES ('$id_transaksi','$id_kasir','$tanggal')";
    if (mysqli_query($db, $sql)) {
        header("location: index.php?p=it-mart&page=detail_trans&id_transaksi=" . $id_transaksi);
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($db);
    } 
}

elseif($_GET['aksi']=='tambah_barang'){
    //insert
        if (isset($_POST['add_barang'])){
    
            $id_transaksi = $_POST['id_transaksi'];
            $id_barang = $_POST['id_barang'];
            $qty = $_POST['qty'];

            $sql_harga = mysqli_query ($db,"SELECT harga FROM barang WHERE id_barang='$id_barang'") ;
            $row = mysqli_fetch_assoc($sql_harga);
            $harga = $row['harga'];

            $subtotal = $harga*$qty; 

            $hitung1 = mysqli_query ($db,"SELECT * FROM barang WHERE id_barang='$id_barang'") ;
            $hitung2 = mysqli_fetch_array($hitung1);
            $stocksekarang = $hitung2['stock'];//stock barang saat ini

            if($stocksekarang>=$qty){ //stock cukup
                $selisih = $stocksekarang-$qty;


                $sql=mysqli_query ($db,"INSERT INTO detail_transaksi(id_transaksi,id_barang,qty,harga,subtotal) 
                VALUES ('$id_transaksi','$id_barang','$qty','$harga','$subtotal')");

                $get_total = mysqli_query($db, "SELECT SUM(subtotal) AS total_subtotal
                FROM detail_transaksi WHERE id_transaksi = ' $id_transaksi'");
                $row = mysqli_fetch_assoc($get_total);
                $total = $row['total_subtotal'];

                $insert_total=mysqli_query ($db,"UPDATE transaksi SET total_bayar = '$total' WHERE id_transaksi = ' $id_transaksi' ");

                $update = mysqli_query ($db,"UPDATE barang SET stock = '$selisih' 
                                        WHERE id_barang ='$id_barang'"); 
                
                if($sql&&$update){        
                    header("location: index.php?p=it-mart&page=detail_trans&id_transaksi=" . $id_transaksi);
                } else {
                    echo "  $id_transaksi Error: " . $sql . "<br>" . mysqli_error($db);
                } 
            }else{
                echo "<script>
                alert('Stock barang tidak cukup');
                </script>";
                header("location: index.php?p=it-mart&page=detail_trans&id_transaksi=" . $id_transaksi);
            }
        }
}

elseif($_GET['aksi']=='delete_barang'){
    //delete
        include 'koneksi.php';
            $id_transaksi = $_GET['id_transaksi'];

            $cekdata = mysqli_query($db, "SELECT * FROM detail_transaksi WHERE id_detailtransaksi='$_GET[id_hapus]'");
            while($data=mysqli_fetch_array($cekdata)){
                //kembalikan stock
                $qty = $data['qty'];
                $id_barang = $data['id_barang'];

                //stock saat ini
                $caristock = mysqli_query($db, "SELECT * FROM barang WHERE id_barang = '$id_barang'");
                $caristock2 = mysqli_fetch_array($caristock);
                $stocksekarang = $caristock2['stock'];

                $new_stock = $stocksekarang + $qty;

                

                $update = mysqli_query ($db,"UPDATE barang SET stock = '$new_stock' 
                                        WHERE id_barang ='$id_barang'"); 
                //hapus detail transaksi
                $hapus = mysqli_query($db, "DELETE FROM detail_transaksi WHERE id_detailtransaksi='$_GET[id_hapus]'");
                
                //edit total
                $get_total = mysqli_query($db, "SELECT SUM(subtotal) AS total_subtotal
                FROM detail_transaksi WHERE id_transaksi = '$id_transaksi'");
                $row = mysqli_fetch_assoc($get_total);
                $total = $row['total_subtotal'];

                $update_total=mysqli_query ($db,"UPDATE transaksi SET total_bayar = '$total' WHERE id_transaksi = ' $id_transaksi' ");

            }
            
            if($update && $hapus && $update_total){
                echo "<script>
                alert('Data Berhasil Dihapus !');
                </script>";        
                header("location: index.php?p=it-mart&page=detail_trans&id_transaksi=" . $id_transaksi);
            }
            else {
                print('Gagal menghapus data');
            }
}

elseif($_GET['aksi']=='pembayaran'){
    include 'koneksi.php';
    if (isset($_POST['bayar'])){
    
        $id_transaksi = $_POST['id_transaksi'];
            
        $get_total = mysqli_query($db, "SELECT SUM(subtotal) AS total_subtotal
                                FROM detail_transaksi WHERE id_transaksi = '$id_transaksi'");
            $row = mysqli_fetch_assoc($get_total);
            $total = $row['total_subtotal'];
            
        if($get_total){ 
            //$sql=mysqli_query ($db,"INSERT INTO transaksi(total_bayar) 
            $sql=mysqli_query ($db,"INSERT INTO transaksi(total_bayar) 
                VALUES ('$total') WHERE id_transaksi = ' $id_transaksi' ");
                /* $update = mysqli_query ($db,"UPDATE barang SET stock = '$selisih' 
                                            WHERE id_barang ='$id_barang'"); */
            
                if($get_total){        
                        header("location: index.php?p=it-mart&page=list" );
                } else {
                        echo "  $id_transaksi Error: " . $sql . "<br>" . mysqli_error($db);
                } 
        }else{
            echo "<script>
            alert('Pembayaran Gagal');
            </script>";
            header("location: index.php?p=it-mart&page=detail_trans&id_transaksi=" . $id_transaksi);
        }
    }     
}
elseif($_GET['aksi']=='uang_dibayar'){
    include 'koneksi.php';
    if (isset($_POST['input'])){
    
        $id_transaksi = $_POST['id_transaksi'];
        $uang_bayar = $_POST['bayar'];
        $status_transaksi = "completed";

        $sql = mysqli_query($db, "UPDATE transaksi SET uang_yg_dibayar = '$uang_bayar', status_transaksi = '$status_transaksi' WHERE id_transaksi = '$id_transaksi'");

                  
            if($sql){ 
                header("location: index.php?p=it-mart&page=detail_trans&id_transaksi=" . $id_transaksi);
            }else{
                echo "<script>
                alert('Pembayaran Gagal');
                </script>";
                header("location: index.php?p=it-mart&page=detail_trans&id_transaksi=" . $id_transaksi);
            }
    }
}
elseif($_GET['aksi']=='edit_barang'){
    include 'koneksi.php';
    if (isset($_POST['input'])){
    
        $id_transaksi = $_GET['id_transaksi'];
        $id_detailtransaksi = $_GET['id_edit'];
        $uang_bayar = $_POST['bayar'];

        $sql = mysqli_query($db, "UPDATE transaksi SET uang_yg_dibayar = '$uang_bayar' WHERE id_transaksi = '$id_transaksi'");

                  
            if($sql){ 
                header("location: index.php?p=it-mart&page=detail_trans&id_transaksi=" . $id_transaksi);
            }else{
                echo "<script>
                alert('Pembayaran Gagal');
                </script>";
                header("location: index.php?p=it-mart&page=detail_trans&id_transaksi=" . $id_transaksi);
            }
    }
}
?>