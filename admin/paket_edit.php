<?php
$title = 'paket';
require'functions.php';

$jenis = ['kiloan','selimut','bedcover','kaos','lain'];

$id_paket = $_GET['id'];
$queryedit = "SELECT * FROM paket WHERE id_paket = '$id_paket'";
$edit = ambilsatubaris($conn,$queryedit);


$query = 'SELECT * FROM outlet';
$data = ambildata($conn,$query);

if(isset($_POST['btn-simpan'])){
    $nama   = $_POST['nama_paket'];
    $jenis_paket = $_POST['jenis_paket'];
    $harga   = $_POST['harga'];
    $outlet_id   = $_POST['outlet_id'];

    $query = "UPDATE paket SET nama_paket='$nama',jenis_paket='$jenis_paket',harga='$harga',outlet_id='$outlet_id' WHERE id_paket = '$id_paket'";
    
    $execute = bisa($conn,$query);
    if($execute == 1){
        $success = 'true';
        $title = 'Berhasil';
        $message = 'Berhasil Ubah Data';
        $type = 'success';
        header('location: paket.php?crud='.$success.'&msg='.$message.'&type='.$type.'&title='.$title);
    }else{
        echo "Gagal Tambah Data";
    }
}


require'layout_header.php';
?> 
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="white-box">
                <form method="post" action="">
                <div class="form-group">
                    <label>Nama Paket</label>
                    <input autocomplete="off" type="text" name="nama_paket" class="form-control" value="<?= $edit['nama_paket'] ?>">
                </div>
                <div class="form-group">
                    <label>Jenis Paket</label>
                    <select name="jenis_paket" class="form-control">
                        <?php foreach ($jenis as $key): ?>
                            <?php if ($key == $edit['jenis_paket']): ?>
                            <option value="<?= $key ?>" selected><?= $key ?></option>    
                            <?php endif ?>
                            <option value="<?= $key ?>"><?= $key ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Harga</label>
                    <input autocomplete="off" type="text" name="harga" class="form-control" value="<?= $edit['harga'] ?>">
                </div>
                <div class="form-group">
                    <label>Pilih Outlet</label>
                    <select name="outlet_id" class="form-control">
                        <?php foreach ($data as $outlet): ?>
                            <?php if ($data['id_outlet'] == $edit['outlet_id']): ?>
                            <option value="<?= $outlet['id_outlet'] ?>" selected><?= $outlet['nama_outlet']; ?></option>
                            <?php endif ?>
                            
                            <option value="<?= $outlet['id_outlet'] ?>"><?= $outlet['nama_outlet']; ?></option>
                        <?php endforeach ?>
                    </select>
                </div>

                <div class="text-right">
                    <a href="javascript:void(0)" onclick="window.history.back();" class="btn btn-primary"><i class="fa fa-arrow-left fa-fw"></i> Kembali</a>
                    <button type="reset" class="btn btn-danger"><i class="fa fa-refresh fa-fw"></i> Reset</button>
                    <button type="submit" name="btn-simpan" class="btn btn-success"><i class="fa fa-save fa-fw"></i> Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
require'layout_footer.php';
?> 