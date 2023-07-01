<?php include 'koneksi.php'; ?>

<?php $page = isset($_GET['page']) ? $_GET['page'] : 'list';

    switch($page){
        case 'list':
?>

<body>
    <div class="container">
        <div class="row">
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
            <h2>Data KAS</h2>
            <div class="col-md-4 mb-2">
                <a href="index.php?p=kas&page=input" class="btn btn-primary" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .90rem;">Input Data</a>
            </div>
            <?php
        $kondisi = isset($_POST['bulan']) ? "WHERE bulan = $_POST[bulan]" : '';
        ?>
        <form action="" method="post">
        <select name="bulan" id="" onchange="this.form.submit();">
            <option value="">--Pilih Bulan--</option>
            <option value="1" <?php if(isset($_POST['bulan']) && $_POST['bulan'] == '1') echo 'selected'; ?>>Januari</option>
            <option value="2" <?php if(isset($_POST['bulan']) && $_POST['bulan'] == '2') echo 'selected'; ?>>Februari</option>
            <option value="3" <?php if(isset($_POST['bulan']) && $_POST['bulan'] == '3') echo 'selected'; ?>>Maret</option>
            <option value="4" <?php if(isset($_POST['bulan']) && $_POST['bulan'] == '4') echo 'selected'; ?>>April</option>
            <option value="5" <?php if(isset($_POST['bulan']) && $_POST['bulan'] == '5') echo 'selected'; ?>>Mei</option>
            <option value="6" <?php if(isset($_POST['bulan']) && $_POST['bulan'] == '6') echo 'selected'; ?>>Juni</option>
            <option value="7" <?php if(isset($_POST['bulan']) && $_POST['bulan'] == '7') echo 'selected'; ?>>Juli</option>
            <option value="8" <?php if(isset($_POST['bulan']) && $_POST['bulan'] == '8') echo 'selected'; ?>>Agustus</option>
            <option value="9" <?php if(isset($_POST['bulan']) && $_POST['bulan'] == '9') echo 'selected'; ?>>September</option>
            <option value="10" <?php if(isset($_POST['bulan']) && $_POST['bulan'] == '10') echo 'selected'; ?>>Oktober</option>
            <option value="11" <?php if(isset($_POST['bulan']) && $_POST['bulan'] == '11') echo 'selected'; ?>>November</option>
            <option value="12" <?php if(isset($_POST['bulan']) && $_POST['bulan'] == '12') echo 'selected'; ?>>Desember</option>
        </select>

        </form>
        </div>
        <table class="table table-bordered table-hover table-responsive" style="margin-top:10px";>
            <tr class="table-dark">
                <th>No</th>
                <th>Pengurus</th>
                <th>Tanggal</th>
                <th>Bulan</th>
                <th>Status</th>
                <?php
                    if ($_SESSION['level']=='admin'){
                ?>
                <th>Aksi</th>
                <?php
                    }
                ?>
            </tr>
            <?php
                    include 'koneksi.php';
                    $kas = mysqli_query($db,"SELECT * FROM kas INNER JOIN 
                    pengurus ON kas.id_pengurus=pengurus.id_pengurus
                    $kondisi");
            ?>
            <?php $i = 1  ?>
            <?php foreach ($kas as $row) : ?>
            <tr>
                <td><?= $i; ?></td>
                <td> <?= $row["nama_pengurus"]; ?></td>
                <td> <?= $row["tanggal"]; ?></td>
                <td> <?= $row["bulan"]; ?></td>
                <td> <?= $row["status"]; ?></td>
                <?php
                    if ($_SESSION['level']=='admin'){
                ?>
                <td>
                    <a href="index.php?p=kas&page=edit&id_edit=<?=$row["id_kas"]; ?>" class="btn btn-warning">Edit</a>
                    <a href="proses_kas.php?p=delete&id_hapus=<?= $row["id_kas"]; ?>"
                        onclick="return confirm('Yakin hapus data ?');" class="btn btn-danger"><span data-feather="trash-2" class="align-text-bottom"></span> Hapus</a>
                </td>
                <?php
                    }
                ?>
            </tr>
            <?php $i++  ?>
            <?php endforeach;  ?>
        </table>
    </div>
    
    <?php
        break;
        case 'input' :
    
    ?>
    <div class="container mt-3 ">
        <div class="col-md-4">
            <h2>Form Input Kas</h2>
            <div class="row">
                <form action="proses_kas.php?p=create" method="post">
                <div class="mb-3">
                    <label class="form-label"> Nama Pengurus </label>
                    <select name="id_pengurus" class="form-select">
                        <option value="">--Pilih Nama Pengurus--</option>
                        <?php
                            $pengurus=mysqli_query($db,"SELECT * FROM pengurus");
                            while($data_pengurus=mysqli_fetch_array($pengurus)){
                        ?>
                        <option value="<?= $data_pengurus['id_pengurus']?>"><?=$data_pengurus['nama_pengurus']?></option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
                    <div class="mb-3">
                        <label class="form-label">Tanggal</label>
                        <input type="number" class="form-control" name="tanggal">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Bulan</label>
                        <input type="number" class="form-control" name="bulan">
                    </div>
                    
                    <div class="mb-3">
                    <label class="form-label"> Status </label>

                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" value="terlambat">
                        <label class="form-check-label"> Terlambat </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" value="tidak terlambat">
                        <label class="form-check-label"> Tidak Terlambat </label>
                    </div>
                </div>
                
                    <div class="mb-3">
                        <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                        <input type="reset" class="btn btn-secondary" name="reset" value="Reset">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php
        break;
        case 'edit':
    ?>
    <div class="container mt-3 ">
        <div class="col-md-4">
            <?php
            include 'koneksi.php';

            $edit = mysqli_query($db, "SELECT * FROM kas 
                    INNER JOIN pengurus on kas.id_pengurus=pengurus.id_pengurus
                    WHERE id_kas='$_GET[id_edit]'");
            $data = mysqli_fetch_array($edit);

            ?>
            <h2>Form Edit Kas</h2>
            <div class="row">
                <form action="proses_kas.php?p=update" method="post">
                    <input type="text" class="form-control" name="id_kas" value="<?= $data['id_kas'] ?>"hidden>

                    <div class="mb-3">
                        <label class="form-label">Nama Pengurus</label>
                            <input type="text" class="form-control" name="nama_pengurus" value="<?= $data['nama_pengurus'] ?>"readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tanggal</label>
                        <input type="number" class="form-control" name="tanggal" value="<?= $data['tanggal'] ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Bulan</label>
                        <input type="text" class="form-control" name="bulan" value="<?= $data['bulan'] ?>">
                    </div>

                    <div class="mb-3">
                    <label class="form-label">Status</label>
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" value="terlambat" <?php if ($data['status']=='terlambat') echo 'checked'?>>
                            <label class="form-check-label">Terlambat</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" value="tidak terlambat" <?= ($data['status']=='tidak terlambat') ? 'checked' : ''?>>
                        <label class="form-check-label">Tidak Terlambat</label>
                        </div>
                    </div>

                    <!-- <div class="mb-3">
                    <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                        //<?php
                            //$kas=mysqli_query($db,"SELECT * FROM kas");
                            //while($data_kas=mysqli_fetch_array($kas)){
                            //$terpilih=($data['id_kas']==$data_kas['id_kas']) ? 'selected' : ''; //ternary
                            //}
                        //?> 
                        <option value="terlambat"<?= $terpilih ?>>Terlambat</option>
                        <option value="tidak terlambat"<?= $terpilih ?>>Tidak Terlambat</option>
                       
                        </select>
                    </div> -->

                    <div class="mb-3">
                        <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                        <input type="reset" class="btn btn-secondary" name="reset" value="Reset">
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
