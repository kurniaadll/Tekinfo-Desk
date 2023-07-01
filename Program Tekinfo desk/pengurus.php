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
            <h2> Data Pengurus </h2>
            <div class="col-md-4 mb-2">
                <a href="index.php?p=pengurus&page=input" class="btn btn-primary" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .90rem;">Input Data</a>
            </div>

            <form action="proses_pengurus.php?aksi=create" method="post">
            <table class="table table-bordered ">
                <tr class="table-dark">
                    <th>No</th>
                    <th>ID Pengurus</th>
                    <th>Nama Pengurus</th>
                    <th>Bidang</th>
                    <th>Prodi</th>
                    <?php
                        if ($_SESSION['level']=='admin'||'sekretaris'){
                    ?>
                    <th> Aksi </th>
                    <?php
                        }
                    ?>
                </tr>
                <?php
                    include 'koneksi.php';
                    $ambil = mysqli_query($db,"SELECT * FROM pengurus");
                    $no = 1;
                    while($data = mysqli_fetch_array($ambil)){
                        $dbidang = $data['id_bidang'];
                        $nama_bidang = mysqli_query($db,"SELECT nama_bidang FROM bidang WHERE id_bidang = $dbidang");
                        $rowcount = mysqli_num_rows( $nama_bidang );
                        $namabidang = mysqli_fetch_assoc($nama_bidang);
                        if($rowcount > 0){
                            $nmbidang = $namabidang['nama_bidang'];
                        }else{
                            $nmbidang = 0;
                        }

                        $prodi = $data['id_prodi'];
                        $nama_prodi = mysqli_query($db,"SELECT nama_prodi FROM prodi WHERE 
                                         id_prodi = $prodi ");
                        $rowcount = mysqli_num_rows( $nama_prodi );
                        $namaprodi = mysqli_fetch_assoc($nama_prodi);
                        if($rowcount >0){
                            $nmprodi = $namaprodi['nama_prodi'];
                        }else{
                            $nmprodi = 0;
                        }
                ?>
                    <tr>
                        <td> <?php echo $no ?> </td>
                        <td> <?php echo $data['id_pengurus'] ?> </td>
                        <td> <?php echo $data['nama_pengurus'] ?> </td>
                        <td> <?php echo $nmbidang ?> </td>
                        <td> <?php echo $nmprodi ?> </td>
                        <?php
                            if ($_SESSION['level']=='admin'){
                        ?>
                        <td> 
                            <a href="proses_pengurus.php?aksi=delete&id_hapus=<?= $data['id_pengurus']?> " class="btn btn-danger" 
                            onclick="return confirm ('Yakin akan menghapus data ?')"><span data-feather="trash-2" class="align-text-bottom"></span> Hapus</a>
                            <a href="index.php?p=pengurus&page=edit&id_edit=<?=$data['id_pengurus']?>" class="btn btn-warning">Edit</a>
                        </td>
                        <?php
                            }
                        ?>
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
    <h2>Form Input Pengurus</h2>
    <div class="row">
        <div class="col-md-4">
            <form action="proses_pengurus.php?aksi=create" method="post">
                
                <div class="mb-3">
                    <label class="form-label"> ID Pengurus </label>
                    <input type="number"name="id_pengurus" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label"> Nama Pengurus </label>
                    <input type="text"name="nama_pengurus" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label"> Bidang </label>
                    <select name="bidang" class="form-select">
                        <option value="">--Pilih Bidang--</option>
                        <?php
                            $bidang=mysqli_query($db,"SELECT * FROM bidang");
                            while($data_bidang=mysqli_fetch_array($bidang)){
                        ?>
                        <option value="<?= $data_bidang['id_bidang']?>"><?=$data_bidang['nama_bidang']?></option>
                        <?php
                            }
                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label"> Prodi </label>
                    <select name="prodi" class="form-select">
                        <option value="">--Pilih Prodi--</option>
                        <?php
                            $prodi=mysqli_query($db,"SELECT * FROM prodi");
                            while($data_prodi=mysqli_fetch_array($prodi)){
                        ?>
                        <option value="<?= $data_prodi['id_prodi']?>"><?=$data_prodi['nama_prodi']?></option>
                        <?php
                            }
                        ?>
                    </select>
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
            $ambil=mysqli_query($db,"SELECT * FROM pengurus WHERE id_pengurus='$_GET[id_edit]'");
            $data=mysqli_fetch_array($ambil);
            
        ?>
        <h3>Form Edit Pengurus</h3>
        <div class="row">
            <div class="col-lg-6">
            <form action="proses_pengurus.php?aksi=update" method="post">
            <div class="mb-2">
                <label class="form-label">ID Pengurus</label>
                <input type="number" class="form-control" name="id_pengurus" value="<?= $data['id_pengurus'] ?>" readonly>
            </div>
            <div class="mb-2">
                <label class="form-label">Nama</label>
                <input type="text" class="form-control" name="nama_pengurus" value="<?= $data['nama_pengurus'] ?>">
            </div>
            <div class="mb-3">
                <?php 
                $bidang=mysqli_query($db,"SELECT * FROM bidang");
                $i = 0;
                while($data_bidang=mysqli_fetch_array($bidang)){
                    $id_bidang[$i] = $data_bidang['id_bidang'];
                    $nama_bidang[$i] = $data_bidang['nama_bidang'];
                    $kabid[$i] = $data_bidang['kabid'];
                    $i++;
                }
                ?>
                <?php if (!in_array($data['id_pengurus'],$kabid)) { ?>
                    <label class="form-label">Bidang</label>
                    <select name="bidang" class="form-select"?>>
                    <?php if ($data['id_bidang'] == 0) { ?>
                        <option value=""><?=""?></option>
                    <?php } ?>
                        <?php 
                            for($i=0;$i<count($id_bidang);$i++) {
                                $terpilih=($data['id_bidang']==$id_bidang[$i]) ? 'selected' : '';
                            ?>
                            <option value="<?= $id_bidang[$i]?>" <?= $terpilih ?>> <?=$nama_bidang[$i]?></option>
                            <?php
                            }
                            ?>
                    </select>
                    
                <?php } ?>
               
            </div>

            <div class="mb-3">
                <label class="form-label">Prodi</label>
                <select name="prodi" class="form-select">
                <?php if ($data['id_prodi'] == 0) { ?>
                        <option value=""><?=""?></option>
                    <?php } ?>
                <?php
                    $prodi=mysqli_query($db,"SELECT * FROM prodi");
                        while($data_prodi=mysqli_fetch_array($prodi)){
                            $terpilih=($data['id_prodi']==$data_prodi['id_prodi']) ? 'selected' : '';
                        ?>
                        <option value="<?= $data_prodi['id_prodi']?>"<?= $terpilih ?>> <?=$data_prodi['nama_prodi']?></option>
                        <?php
                        }
                        ?>
                </select>
            </div>
           
            <div class="mb-2">
                <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                <input type="Reset" class="btn btn btn-secondary" name="reset" value="Reset">
                
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
