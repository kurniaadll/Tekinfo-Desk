<?php
    $SqlPeriode = "";
    $awalTgl = "";
    $akhirTgl = "";
    $tglAwal = "";
    $tglAkhir = "";
    
    if(isset($_POST['btnTampil'])){
        $tglAwal = isset($_POST['txtTglAwal']) ? $_POST['txtTglAwal'] : "01-".date('m-Y');
        $tglAkhir = isset($_POST['txtTglAkhir']) ? $_POST['txtTglAkhir'] : date('d-m-Y');
        $SqlPeriode = " WHERE tanggal BETWEEN '". $tglAwal. "' AND '" .$tglAkhir. "' AND status_transaksi = 'completed'";;
    }
    else{
        $awalTgl = "01-".date('m-Y');
        $akhirTgl = date('d-m-Y');
        $SqlPeriode = " WHERE tanggal BETWEEN '". $awalTgl. "' AND '" .$akhirTgl. "' AND status_transaksi = 'completed'";;
    }
?>

<div class="container">
    <div class="row mb-2">

        <h2>Data Transaksi IT Mart </h2>
        <h6>Periode Tanggal <b><?php echo ($tglAwal); ?></b> s/d <b><?php echo ($tglAkhir); ?></b></h6>


            <div class="col-md-4">
                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" target="_self" class="row g-1">
                <div class="col-5">
                    <input name="txtTglAwal" type="date" class="form-control custom-width" value="<?php echo $awalTgl; ?>">
                </div>
                <div class="col-5">
                    <input name="txtTglAkhir" type="date" class="form-control custom-width" value="<?php echo $akhirTgl; ?>">
                </div>
                <div class="col-2">
                    <input name="btnTampil" class="btn btn-primary" type="submit" value="Tampilkan">
                </div>
                </form>
            </div>

            <div class="row mt-2">
            <div class="col-md-12">
                <form action="proses_laporan.php?aksi=" method="post">
                <table class="table table-bordered">
                <tr class="table-dark">
                    <th>No</th>
                    <th>No Transaksi</th>
                    <th>Kasir</th>
                    <th>Waktu</th>
                    <th>Total Bayar</th>
                    <th>Status</th>
                </tr>
                <?php
                    include 'koneksi.php';

                    $ambil = mysqli_query($db, "SELECT * FROM transaksi INNER JOIN 
                        pengurus ON transaksi.kasir=pengurus.id_pengurus $SqlPeriode ORDER BY waktu DESC");

                    $no = 1;
                    while ($data = mysqli_fetch_array($ambil)) {
                        //hitung jumlah
                ?>
                <tr>
                    <td> <?php echo $no ?> </td>
                        <td> <?php echo $data['id_transaksi'] ?> </td>
                        <td> <?php echo $data['nama_pengurus'] ?> </td>
                        <td> <?php echo $data['waktu'] ?> </td>
                        <td> Rp. <?php echo number_format($data['total_bayar']) ?> </td>
                        <td> <?php echo $data['status_transaksi'] ?> </td>
                    </tr>
                    <?php
                    $no++;
                    }
                ?>
                </table>

                <div class="row">
                <div class="col-2">

                    <a href="cetak.php?awal=<?php echo $tglAwal; ?>&&akhir=<?php echo $tglAkhir; ?>" target="_blank" alt="Edit Data" class="btn btn-dark" > Cetak </a>
                </div>
                </div>
                </form>
            </div>
            </div>

           