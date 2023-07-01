<?php
include 'koneksi.php';

function InggrisTgl($tanggal)
{
    $tgl=substr($tanggal,0,2);
    $bln=substr($tanggal,3,2);
    $thn=substr($tanggal,6,4);
    $awal="$thn-$bln-$tgl";
    return $awal;
}

function IndonesiaTgl($tanggal)
{
    $tgl=substr($tanggal,8,2);
    $bln=substr($tanggal,5,2);
    $thn=substr($tanggal,0,4);
    $awal="$thn-$bln-$tgl";
    return $awal;
}

$awal = $_GET['awal'];
$tawal=InggrisTgl($awal);

$akhir = $_GET['akhir'];
$takhir=InggrisTgl($akhir);

    $tglAwal = isset($_GET['awal']) ? $_GET['awal'] : "01-".date('m-Y');
    $tglAkhir = isset($_GET['akhir']) ? $_GET['akhir'] : date('d-m-Y');
    $SqlPeriode = " WHERE tanggal BETWEEN '". $awal. "' AND '" .$akhir. "' AND status_transaksi = 'completed'";
?>

<body onload="print()">
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" name="frmedit">
    <?php if(!empty($tglAwal)){ ?>
        <center><h2>DAFTAR LAPORAN TRANSAKSI PESANAN<h2><hr> <br><h4> PERIODE <b><?php echo IndonesiaTgl($awal); ?> s/d <?php echo IndonesiaTgl($akhir);?></b><br /></h4><center>
    <?php }else { ?>
        <center><h2>DAFTAR LAPORAN TRANSAKSI PESANAN</h2></center><hr>
    <?php } ?>

    <table class="table table-bordered table-dark">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">No Transaksi</th>
            <th scope="col">Kasir</th>
            <th scope="col">Waktu</th>
            <th scope="col">Total Bayar</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include 'koneksi.php';

        $ambil = mysqli_query($db, "SELECT * FROM transaksi INNER JOIN 
            pengurus ON transaksi.kasir=pengurus.id_pengurus $SqlPeriode ORDER BY waktu DESC");

        $no = 1;
        $jumlahbayar = 0;
        while ($data = mysqli_fetch_array($ambil)) {
            $jumlahbayar += $data['total_bayar'];
        ?>
        <tr>
            <td><?php echo $no ?></td>
            <td><?php echo $data['id_transaksi'] ?></td>
            <td><?php echo $data['nama_pengurus'] ?></td>
            <td><?php echo $data['tanggal'] ?></td>
            <td>Rp. <?php echo number_format($data['total_bayar']) ?></td>
        </tr>
        <?php
        $no++;
        }
        ?>
        <tr>
            <th align="center"><strong></strong></th>
            <th><strong></strong></th>
            <th><strong></strong></th>
            <th><strong>Total</strong></th>
            <th align="right"><strong>Rp. <?php echo number_format($jumlahbayar); ?>,-</strong></th>
        </tr>
    </tbody>
</table>

</form>
</body>