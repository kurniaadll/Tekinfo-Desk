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
            <h2>Data Proker</h2>
            <div class="col-md-4 mb-2">
                <a href="index.php?p=proker&page=input" class="btn btn-primary" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .90rem;">Input Data</a>            </div>
            </div>
        <table class="table table-bordered  table-hover table-responsive">
            <tr class="table-dark">
                <th>No</th>
                <th>Nama Proker</th>
                <th>Bidang</th>
                <th>Tanggal</th>
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
                    $proker = mysqli_query($db,"SELECT * FROM proker");
            ?>
            <?php $i = 1  ?>
            <?php foreach ($proker as $row) : 
                $id_bidang = $row['id_bidang'];
                $nama_bidang = mysqli_query($db,"SELECT nama_bidang FROM bidang WHERE 
                                 id_bidang = $id_bidang ");
                $rowcount = mysqli_num_rows($nama_bidang);
                $namabidang = mysqli_fetch_assoc($nama_bidang);
                if($rowcount > 0){
                    $nmbidang = $namabidang['nama_bidang'];
                }else{
                    $nmbidang = 0;
                }
            ?>
            <tr>
                <td><?= $i; ?></td>
                <td> <?= $row["nama_proker"]; ?></td>
                <td> <?= $nmbidang ?></td>
                <td> <?= $row["tanggal"]; ?></td>
                <td> <?= $row["keterangan_proker"]; ?></td>
                <td>
                    <a href="index.php?p=proker&page=edit&id_edit=<?=$row["id_proker"]; ?>" class="btn btn-warning">Edit</a>
                    <a href="proses_proker.php?p=delete&id_hapus=<?= $row["id_proker"]; ?>"
                        onclick="return confirm('Yakin hapus data ?');" class="btn btn-danger"><span data-feather="trash-2" class="align-text-bottom"></span> Hapus</a>
                </td>
            </tr>
            <?php $i++ ?>
            <?php endforeach;  ?>
        </table>
    </div>
    
    <?php
        break;
        case 'input' :
    
    ?>
    <div class="container mt-3 ">
        <div class="col-md-4">
            <h2>Form Input Proker</h2>
            <div class="row">
                <form action="proses_proker.php?p=create" method="post">
                    <div class="mb-3">
                        <label class="form-label">Nama Proker </label>
                        <input type="text" class="form-control" name="nama_proker">
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
                    <label class="form-label"> Tanggal </label>
                    <div class="row g-2">
                    <div class="col-md-3">
                        <select name="tgl" class="form-select">
                            <option value= "" selected>DD</option>
                            <?php
                                for ($i=1; $i <=31 ; $i++) { 
                                 echo "<option value=$i>$i</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="bln" class="form-select">
                            <option value= "" selected>MM</option>
                            <?php
                                   $bulan=[1=>'Jan','Feb','Mar','Apr','Mei','Juni','Juli','Agus','Sept','Okt','Nov','Des'];
                                        foreach ($bulan as $key => $namaBulan) {
                                            echo "<option value=".$key.">$namaBulan</option>";   
                                        }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                            <select name="thn" class="form-select">
                                <option value= "" selected>YY</option>
                                
                                <?php
                                    for ($i=date("Y");$i>=2022;$i--) { 
                                        echo "<option value=$i>$i</option>";
                                    }
                                ?>
                            </select>
                    </div>
                    </div>

                <div class="mb-3">
                        <label class="form-label">Keterangan</label>
                        <textarea rows="3" name="keterangan_proker" class="form-control"></textarea>
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

            $edit = mysqli_query($db, "SELECT * FROM proker WHERE id_proker='$_GET[id_edit]'");
            $data = mysqli_fetch_array($edit);
            $tanggal=explode("-", $data['tanggal']);


            ?>
            <h2>Form Edit Proker</h2>
            <div class="row">
                <form action="proses_proker.php?p=update" method="post">
                <div class="mb-3">
                        <input type="text" class="form-control" name="id_proker" value="<?= $data['id_proker'] ?>"hidden>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Proker</label>
                        <input type="text" class="form-control" name="nama_proker" value="<?= $data['nama_proker'] ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Bidang</label>
                        <select name="bidang" class="form-select">
                        <?php if ($data['id_bidang'] == 0) { ?>
                        <option value=""><?=""?></option>
                        <?php } ?>
                        <?php
                            $bidang=mysqli_query($db,"SELECT * FROM bidang");
                            while($data_bidang=mysqli_fetch_array($bidang)){
                                    $terpilih=($data['id_bidang']==$data_bidang['id_bidang']) ? 'selected' : '';
                                ?>
                                <option value="<?= $data_bidang['id_bidang']?>"<?= $terpilih ?>> <?=$data_bidang['nama_bidang']?></option>
                                <?php
                                }
                                ?>
                        </select>
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Tanggal</label>
                        <div class="row g-2">
                        <div class="col-md-3">
                        <select name="tgl" class="form-select">
                            <option value="<?= $tanggal[2]?>"><?= $tanggal[2]?></option>
                            <?php  
                                $i=1;
                                do {
                                echo "<option value=$i>$i</option>";
                                $i++;
                            }  
                            while($i <=31);
                            ?>
                        </select>
                        </div>
                        <div class="col-md-3">
                        <select name="bln" class="form-select">
                        <option value="<?= $tanggal[1]?>"><?= $tanggal[1]?></option>
                            <?php  
                                $nmBln=[1=>'Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agus','Sep','Okt','Nov','Des'];
                                
                            foreach ($nmBln as $key => $value) {
                                echo "<option value=$key>$value</option>";
                            }
                                
                            ?>
                        </select>
                        </div>
                        <div class="col-md-3">
                        <select name="thn" class="form-select">
                        <option value="<?= $tanggal[0]?>"><?= $tanggal[0]?></option>
                            <?php  
                            for ($i=date("Y"); $i >=2022 ; $i--) { 
                                echo "<option value=$i>$i</option>";
                            }  
                            ?>
                        </select>
                        </div>
                        </div>
                    </div>

                    <div class=" mb-3">
                        <label class="form-label">Keterangan</label>
                        <textarea rows="3" name="keterangan_proker" class="form-control"><?= $data['keterangan_proker']; ?></textarea>
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