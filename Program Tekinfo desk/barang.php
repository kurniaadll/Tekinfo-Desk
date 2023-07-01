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
        <h2> Data Barang </h2>
        <div class="col-md-4">
            <a href="index.php?p=barang&page=input" class="btn btn-primary mb-3" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .90rem;">Tambah Barang</a>
        </div>
            <form action="proses_bidang.php?aksi=create" method="post">
            <table class="table table-bordered">
                <tr class="table-dark">
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Stock</th>
                    <th>Harga</th>
                    <th> Aksi </th>
                </tr>
                <?php
                    include 'koneksi.php';
                    $ambil = mysqli_query($db,"SELECT * FROM barang ORDER BY nama_barang");
                    $no = 1;
                    while($data = mysqli_fetch_array($ambil)){
                ?>
                    <tr>
                        <td> <?php echo $no ?> </td>
                        <td> <?php echo $data['nama_barang'] ?> </td>
                        <td> <?php echo $data['stock'] ?> </td>
                        <td> <?php echo $data['harga'] ?> </td>
                        <td> 
                            <a href="proses_barang.php?aksi=delete&id_hapus=<?= $data['id_barang']?> " class="btn btn-danger" 
                            onclick="return confirm ('Yakin akan menghapus data ?')"><span data-feather="trash-2" class="align-text-bottom"></span> Hapus</a>
                            <a href="index.php?p=barang&page=edit&id_edit=<?=$data['id_barang']?>" class="btn btn-warning">Edit</a>
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
    <h3>Form Input Barang</h3>
    <div class="row">
        <div class="col-md-4">
            <form action="proses_barang.php?aksi=create" method="post">
            
            <input type="hidden"name="id_barang" class="form-control">

                <div class="mb-3">
                    <label class="form-label"> Nama Barang </label>
                    <input type="text"name="nama_barang" class="form-control">
                </div>
                <div class="mb-3">
                        <label class="form-label">Stock</label>
                        <input type="number" class="form-control" name="stock">
                </div>
                <div class="mb-3">
                        <label class="form-label">Harga</label>
                        <input type="number" class="form-control" name="harga">
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
            $ambil=mysqli_query($db,"SELECT * FROM barang WHERE id_barang='$_GET[id_edit]'");
            $data=mysqli_fetch_array($ambil);
        ?>
        <h3>Edit Data Barang</h3>
        <div class="row">
            <div class="col-lg-6">
            <form action="proses_barang.php?aksi=update" method="post">

                <input type="number" class="form-control" name="id_barang" value="<?= $data['id_barang'] ?>" hidden>
            <div class="mb-2">
                <label class="form-label">Nama Barang</label>
                <input type="text" class="form-control" name="nama_barang" value="<?= $data['nama_barang'] ?>">
            </div>
            <div class="mb-2">
                <label class="form-label">Stock</label>
                <input type="text" class="form-control" name="stock" value="<?= $data['stock'] ?>" >
            </div>
            <div class="mb-2">
                <label class="form-label">Harga</label>
                <input type="text" class="form-control" name="harga" value="<?= $data['harga'] ?>" >
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
