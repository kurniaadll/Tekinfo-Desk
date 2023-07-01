<?php include 'koneksi.php'; ?>

<?php $page = isset($_GET['page']) ? $_GET['page'] : 'list';

    switch($page){
        case 'list':
?>

<?php
    $ormawa = mysqli_query($db, "SELECT * FROM ormawa");
?>

<body>
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
            <h2>Data Ormawa / UKM</h2>
            <div class="col-md-4">
                <a href="index.php?p=ormawa&page=input" class="btn btn-primary mb-3" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .90rem;">Input Data</a>
            </div>
        <form action="proses_ormawa.php?aksi=create" method="post">
        <table class="table table-bordered">
            <tr class="table-dark">
                <th>No</th>
                <th>Nama Ormawa</th>
                <th>Aksi</th>
                
            </tr>
            <?php $i = 1  ?>
            <?php foreach ($ormawa as $row) : ?>
            <tr>
                <td><?= $i; ?></td>
                <td> <?= $row["nama_ormawa"]; ?></td>
                <td>
                    <a href="index.php?p=ormawa&page=edit&id_edit=<?=$row["id_ormawa"]; ?>" class="btn btn-warning">Edit</a>
                    <a href="proses_ormawa.php?p=hapus_ormawa&id_hapus=<?= $row["id_ormawa"]; ?>"
                        onclick="return confirm('Yakin hapus data ?');" class="btn btn-danger"><span data-feather="trash-2" class="align-text-bottom"></span> Hapus</a>
                </td>
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
            <h2>Form Input Ormawa</h2>
            <div class="row">
                <form action="proses_ormawa.php?p=input_ormawa" method="post">
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control" name="nama">
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

            $edit = mysqli_query($db, "SELECT * FROM ormawa WHERE id_ormawa='$_GET[id_edit]'");
            $data = mysqli_fetch_array($edit);

            ?>
            <h2>Form Edit Ormawa</h2>
            <div class="row">
                <form action="proses_ormawa.php?p=edit_ormawa" method="post">
                        <input type="text" class="form-control" name="id" value="<?= $data['id_ormawa'] ?>"hidden>
                    <div class="mb-3">
                        <label class="form-label">Nama Ormawa</label>
                        <input type="text" class="form-control" name="nama" value="<?= $data['nama_ormawa'] ?>">
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