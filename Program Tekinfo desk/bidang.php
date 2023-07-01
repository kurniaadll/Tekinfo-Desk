<body>
<?php
$page=isset($_GET['page']) ? $_GET['page'] : 'list';
switch ($page){
    case 'list' :
?>

<div class="container">
        <div class="row mb-2">
        <?php
            $pesan=isset($_GET['msg']) ? $_GET['msg'] : '';
            if ($pesan =='ok'){
        ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Data berhasil disimpan!</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php
            }
        ?>
        <h2> Data Bidang </h2>
        <div class="col-md-4">
            <a href="index.php?p=bidang&page=input" class="btn btn-primary mb-3" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .90rem;">Input Data</a>
        </div>
            <form action="proses_bidang.php?aksi=create" method="post">
            <table class="table table-bordered">
                <tr class="table-dark">
                    <th>No</th>
                    <th>Nama Bidang</th>
                    <th>Ketua Bidang</th>
                    <th>Keterangan</th>
                    <th> Aksi </th>
                </tr>
                <?php
                    include 'koneksi.php';
                    $ambil = mysqli_query($db,"SELECT * FROM bidang");
                    
                    $no = 1;
                    while($data = mysqli_fetch_array($ambil)){
                        $kabid = $data['kabid'];
                        $nama_kabid = mysqli_query($db,"SELECT nama_pengurus FROM pengurus WHERE 
                                         id_pengurus = $kabid ");
                        $rowcount = mysqli_num_rows($nama_kabid);
                        $namakabid = mysqli_fetch_assoc($nama_kabid);
                        if($rowcount > 0){
                            $nmkabid = $namakabid['nama_pengurus'];
                        }else{
                            $nmkabid = 0;
                        }
                ?>
                    <tr>
                        <td> <?php echo $no ?> </td>
                        <td> <?php echo $data['nama_bidang'] ?> </td>
                        <td> <?php echo $nmkabid ?> </td>
                        <td> <?php echo $data['keterangan'] ?> </td>
                        
                        <td> 
                            <a href="proses_bidang.php?aksi=delete&id_hapus=<?= $data['id_bidang']?> " class="btn btn-danger" 
                            onclick="return confirm ('Yakin akan menghapus data ?')"><span data-feather="trash-2" class="align-text-bottom"></span> Hapus</a>
                            <a href="index.php?p=bidang&page=edit&id_edit=<?=$data['id_bidang']?>" class="btn btn-warning">Edit</a>
                        </td>
                        
                    </tr>
                <?php
                    $no++;
                    }
                ?>
            </table>
        </div>
    </div>
<?php        
        break;
    case 'input' : 
?>

<div class="container">
    <h3>Form Input Bidang</h3>
    <div class="row">
        <div class="col-md-4">
            <form action="proses_bidang.php?aksi=create" method="post">
            
            <input type="hidden"name="id_bidang" class="form-control">

                <div class="mb-3">
                    <label class="form-label"> Nama Bidang </label>
                    <input type="text"name="nama_bidang" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label"> Ketua Bidang </label>
                    <select name="kabid" class="form-select">
                        <option value="">--Pilih Ketua Bidang--</option>
                        <?php
                        $pengurus = mysqli_query($db, "SELECT * FROM pengurus WHERE id_pengurus NOT IN (SELECT kabid FROM bidang)");
                        while($data_pengurus=mysqli_fetch_array($pengurus)){
                        ?>
                        <option value="<?= $data_pengurus['id_pengurus']?>"><?=$data_pengurus['nama_pengurus']?></option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                        <label class="form-label">Keterangan </label>
                        <input type="text" class="form-control" name="keterangan">
                    </div>
                <div class="mb-3">
                    <label class="form-label"></label>
                    <input type="submit"name="input" class="btn btn-primary">
                    <input type="reset"name="reset" class="btn btn-secondary">
                </div>
            </form>
        </div>
    </div>
</div>
<?php
    break;
    case 'edit' : 
    ?>
 <div class="container">
    <?php
        include 'koneksi.php';
        $ambil=mysqli_query($db,"SELECT * FROM bidang WHERE id_bidang='$_GET[id_edit]'");
        $data=mysqli_fetch_array($ambil);
        $id_edit = $_GET['id_edit'];
    ?>
        <h3>Edit Data Bidang</h3>
        <div class="row">
            <div class="col-lg-6">
            <form action="proses_bidang.php?aksi=update" method="post">
                <input type="text" class="form-control" name="id_bidang" value="<?= $data['id_bidang'] ?>" hidden>
            <div class="mb-2">
                <label class="form-label">Nama Bidang</label>
                <input type="text" class="form-control" name="nama_bidang" value="<?= $data['nama_bidang'] ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Ketua Bidang</label>
                <select name="kabid" class="form-select">
                <?php
                $id_edit = $_GET['id_edit']; // Ambil nilai id_edit dari URL atau input pengguna

                $bidang = mysqli_query($db, "SELECT * FROM bidang INNER JOIN pengurus ON bidang.kabid = pengurus.id_pengurus
                                         WHERE bidang.id_bidang =' $id_edit' ");
                 $row = mysqli_fetch_assoc($bidang);
                 $kabid = $row['kabid'];
                 $nama_kabid = $row['nama_pengurus'];

                ?>

                <option value="<?= $kabid?>"><?=$nama_kabid?></option>

                <?php
                    $id_edit = $_GET['id_edit']; // Ambil nilai id_edit dari URL atau input pengguna

                    $pengurus = mysqli_query($db, "SELECT * FROM pengurus WHERE id_pengurus NOT IN (SELECT kabid FROM bidang)");
                    
                    while ($data_pengurus = mysqli_fetch_array($pengurus)) {
                        $terpilih = ($id_edit && $id_edit == $data_pengurus['id_pengurus']) ? 'selected' : '';
                        ?>
                        <option value="<?= $data_pengurus['id_pengurus'] ?>" <?= $terpilih ?>><?= $data_pengurus['nama_pengurus'] ?></option>
                        <?php
                    }
                        
                        ?>
                </select>
            </div>
            <div class=" mb-3">
                    <label class="form-label">Keterangan</label>
                    <textarea rows="3" name="keterangan" class="form-control"><?= $data['keterangan']; ?></textarea>
            </div>
            
            <div class="mb-2">
                <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                <input type="Reset" class="btn btn-secondary" name="reset" value="Reset">
                
            </div>
             </form>
             
        </div>     
       </div>     
    </div>     
    <?php
    break;
}
?>
</body>
