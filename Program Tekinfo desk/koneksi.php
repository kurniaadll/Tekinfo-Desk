
<?php
    $server = "localhost";
    $user = "root";
    $password = "";
    $nama_database = "db_tekinfodesk";

    $db = new mysqli($server, $user, $password);
    $create_db_query = "CREATE DATABASE $nama_database";
    
     $create_db_query = "CREATE DATABASE IF NOT EXISTS $nama_database";
     mysqli_query($db, $create_db_query);
    
    mysqli_select_db($db, $nama_database);
       
       $create_tuser = "CREATE TABLE IF NOT EXISTS user (
            id_pengurus int(11) primary key,
            username varchar(50),
            password varchar(100),
            level enum('admin','sekretaris','bendahara','danus')
        )";
        mysqli_query($db, $create_tuser);

        $create_tpengurus=("CREATE TABLE IF NOT EXISTS pengurus (
                        id_pengurus int(11) primary key,
                        nama_pengurus varchar(50),
                        id_bidang int(11),
                        id_prodi int(11));");
        mysqli_query($db, $create_tpengurus);

        $create_tbidang=("CREATE TABLE IF NOT EXISTS bidang (
                        id_bidang int(11) auto_increment primary key,
                        nama_bidang varchar(50),
                        kabid int(11),
                        keterangan text);");
        mysqli_query($db, $create_tbidang);

        $create_tbarang=("CREATE TABLE IF NOT EXISTS barang(
                        id_barang int(11) auto_increment primary key,
                        nama_barang varchar(30),
                        stock int(11),
                        harga int(11));");
        mysqli_query($db, $create_tbarang);

        $create_tdetail_transaksi=("CREATE TABLE IF NOT EXISTS detail_transaksi (
                        id_detailtransaksi int (11) auto_increment primary key,
                        id_transaksi int (11),
                        id_barang int(11),
                        qty int(11),
                        harga int(11),
                        subtotal int(11));");
        mysqli_query($db, $create_tdetail_transaksi);

        $create_tkas=("CREATE TABLE IF NOT EXISTS kas (
                        id_kas int(11) auto_increment primary key,
                        id_pengurus int(11),
                        tanggal int(11),
                        bulan int(11),
                        status enum('terlambat','tidak terlambat'));");
        mysqli_query($db, $create_tkas);

        $create_tormawa=("CREATE TABLE IF NOT EXISTS ormawa (id_ormawa int(11) auto_increment primary key,
                        nama_ormawa varchar(100),
                        keterangan text);");
        mysqli_query($db, $create_tormawa);

        $create_tprodi=("CREATE TABLE IF NOT EXISTS prodi (
                        id_prodi int(11) auto_increment primary key,
                        nama_prodi varchar(50));");
        mysqli_query($db, $create_tprodi);

        $create_tproker=("CREATE TABLE IF NOT EXISTS proker (
                        id_proker int(11) auto_increment primary key,
                        nama_proker varchar(50),
                        id_bidang int(11),
                        tanggal date,
                        keterangan_proker text);");
        mysqli_query($db, $create_tproker);

        $create_tsurat=("CREATE TABLE IF NOT EXISTS surat (
                        id_surat int(11) auto_increment primary key, 
                        no_surat int(11),
                        kode_surat varchar(20),
                        id_ormawa int(11),
                        bulan varchar(10),
                        tahun int(11),
                        jenis_surat enum('surat masuk','surat keluar'),
                        keterangan_surat text);");
        mysqli_query($db, $create_tsurat);

        $create_ttransaksi=("CREATE TABLE IF NOT EXISTS transaksi (
                        id_transaksi int(11) primary key,
                        kasir int(20),
                        waktu timestamp,
                        tanggal date,
                        total_bayar int(50),
                        uang_yg_dibayar int(11),
                        status_transaksi enum('incomplete','completed'));");
        mysqli_query($db, $create_ttransaksi);
        
        $exists_user = "SELECT * from user";
        $result = mysqli_query($db, $exists_user);
        $rowcount = mysqli_num_rows( $result );
        if($rowcount == 0 ){
            $input_user_admin = ("INSERT INTO user(id_pengurus,username,password,level)
                            VALUES ('1111111111','admin',MD5('admin'),'admin')");
        mysqli_query($db, $input_user_admin);
        }
        
        

        
   
?>
