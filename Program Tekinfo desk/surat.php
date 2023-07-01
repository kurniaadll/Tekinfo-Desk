<?php include 'koneksi.php'; ?>

<?php $page = isset($_GET['page']) ? $_GET['page'] : 'list';

    switch($page){
        case 'list':
?>

<body>
    <div class="container">
        <div class="row ">
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
            <h2>Data Surat</h2>
            <div class="col-md-4 mb-2">
                <a href="index.php?p=surat&page=input" class="btn btn-primary" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .90rem;">Input Data</a>
            </div>
        </div>
        <table class="table table-bordered  table-hover table-responsive">
            <tr class="table-dark">
                <th>No</th>
                <th>Nomor Surat</th>
                <th>Kode Surat</th>
                <th>Organisasi / UKM</th>
                <th>Bulan</th>
                <th>Tahun</th>
                <th>Jenis</th>
                <th>Keterangan</th>
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
                    $surat = mysqli_query($db,"SELECT * FROM surat");
            ?>
            <?php $i = 1  ?>
            <?php foreach ($surat as $row) : 
                $id_ormawa = $row['id_ormawa'];
                $nama_ormawa = mysqli_query($db,"SELECT nama_ormawa FROM ormawa WHERE 
                                 id_ormawa = $id_ormawa ");
                $rowcount = mysqli_num_rows($nama_ormawa);
                $namaormawa = mysqli_fetch_assoc($nama_ormawa);
                if($rowcount > 0){
                    $nmormawa = $namaormawa['nama_ormawa'];
                }else{
                    $nmormawa = 0;
                }
            ?>
            <tr>
                <td><?= $i; ?></td>
                <td> <?= $row["no_surat"]; ?></td>
                <td> <?= $row["kode_surat"]; ?></td>
                <td> <?= $nmormawa ?></td>
                <td> <?= $row["bulan"]; ?></td>
                <td> <?= $row["tahun"]; ?></td>
                <td> <?= $row["jenis_surat"]; ?></td>
                <td> <?= $row["keterangan_surat"]; ?></td>
                <?php
                    if ($_SESSION['level']=='admin'){
                ?>
                <td>
                    <a href="index.php?p=surat&page=edit&id_edit=<?=$row["id_surat"]; ?>" class="btn btn-warning">Edit</a>
                    <a href="proses_surat.php?p=delete&id_hapus=<?= $row["id_surat"]; ?>"
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
            <h2>Form Input Surat</h2>
            <div class="row">
                <form action="proses_surat.php?p=create" method="post">
                    <div class="mb-3">
                        <label class="form-label">Nomor Surat </label>
                        <input type="number" class="form-control" name="no_surat">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kode Surat </label>
                        <input type="text" class="form-control" name="kode_surat">
                    </div>
                    <div class="mb-3">
                    <label class="form-label"> Organisasi / UKM </label>
                    <select name="ormawa" class="form-select">
                        <option value="">--Pilih Organisasi / UKM--</option>
                        <?php
                            $ormawa=mysqli_query($db,"SELECT * FROM ormawa");
                            while($data_ormawa=mysqli_fetch_array($ormawa)){
                        ?>
                        <option value="<?= $data_ormawa['id_ormawa']?>"><?=$data_ormawa['nama_ormawa']?></option>
                        <?php
                            }
                        ?>
                    </select>
                    </div>
                    <div class="mb-3">
                            <label class="form-label"> Bulan </label>
                            <input type="text" class="form-control" name="bulan">
                    </div>
                    <div class="mb-3">
                            <label class="form-label"> Tahun </label>
                            <input type="number" class="form-control" name="tahun">
                    </div>
                    <div class="mb-3">
                    <label class="form-label"> Jenis Surat </label>
                        <select name="jenis_surat" class="form-select">
                        <option value="">--Pilih Jenis Surat--</option>
                        <option value="surat masuk">Surat Masuk</option>
                        <option value="surat keluar">Surat Keluar</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Keterangan</label>
                        <textarea rows="3" name="keterangan_surat" class="form-control"></textarea>
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

            $edit = mysqli_query($db, "SELECT * FROM surat WHERE id_surat='$_GET[id_edit]'");
            $data = mysqli_fetch_array($edit);

            ?>
            <h2>Form Edit Surat</h2>
            <div class="row">
                <form action="proses_surat.php?p=update" method="post">
                    <div class="mb-3">
                        <input type="number" class="form-control" name="id_surat" value="<?= $data['id_surat'] ?>"hidden>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nomor Surat</label>
                        <input type="number" class="form-control" name="no_surat" value="<?= $data['no_surat'] ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kode Surat</label>
                        <input type="text" class="form-control" name="kode_surat" value="<?= $data['kode_surat'] ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Organisasi / UKM</label>
                        <select name="ormawa" class="form-select">
                        <?php if ($data['id_ormawa'] == 0) { ?>
                        <option value=""><?=""?></option>
                        <?php } ?>
                        <?php
                            $ormawa=mysqli_query($db,"SELECT * FROM ormawa");
                            while($data_ormawa=mysqli_fetch_array($ormawa)){
                                    $terpilih=($data['id_ormawa']==$data_ormawa['id_ormawa']) ? 'selected' : '';
                                ?>
                                <option value="<?= $data_ormawa['id_ormawa']?>"<?= $terpilih ?>> <?=$data_ormawa['nama_ormawa']?></option>
                                <?php
                                }
                                ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Bulan</label>
                        <input type="text" class="form-control" name="bulan" value="<?= $data['bulan'] ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tahun</label>
                        <input type="number" class="form-control" name="tahun" value="<?= $data['tahun'] ?>">
                    </div>
                    <label class="form-label"> Jenis Surat </label>
                        <select name="jenis_surat" class="form-select">
                        <?php
                            $surat=mysqli_query($db,"SELECT * FROM surat");
                            while($data_surat=mysqli_fetch_array($surat)){
                            $terpilih=($data['id_surat']==$data_surat['id_surat']) ? 'selected' : ''; //ternary
                        ?> 
                            <option value="<?= $data_surat['jenis_surat']?>" <?= $terpilih ?>> <?=$data_surat['jenis_surat']?> </option> 
                        <?php
                        }
                        ?>
                        </select>
                    </div>
                    <div class=" mb-3">
                        <label class="form-label">Keterangan</label>
                        <textarea rows="3" name="keterangan_surat" class="form-control"><?= $data['keterangan_surat']; ?></textarea>
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
            }
    ?>
</body>