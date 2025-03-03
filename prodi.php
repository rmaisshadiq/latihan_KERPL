<?php
require 'koneksi.php';
$aksi = isset($_GET['action']) ? $_GET['action'] : 'read';

switch ($aksi) {
    case 'read':
?>
        <h1>Data Prodi</h1>
        <a href="index.php?page=prodi&action=create" class="btn btn-primary">Tambah Data</a>
        <hr>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Prodi</th>
                    <th scope="col">Jenjang</th>
                    <th scope="col">Keterangan</th>
                    <th scope="col">Aksi</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $queryProdi = mysqli_query($db, 'SELECT * FROM prodi;');
                $no = 1;
                while ($rowProdi = mysqli_fetch_array($queryProdi)) {
                ?>
                    <tr>
                        <th scope="row"><?= $no++ ?></th>
                        <td><?= $rowProdi['nama_prodi'] ?></td>
                        <td><?= $rowProdi['jenjang'] ?></td>
                        <td><?= $rowProdi['keterangan'] ?></td>
                        <td>
                            <a href="index.php?page=prodi&action=update&id=<?= $rowProdi['id'] ?>" class="btn btn-warning">Edit</a>
                            <a href="proses_prodi.php?process=delete&id=<?= $rowProdi['id']  ?>" onclick="return confirm('Apakah Anda yakin menghapus data ini?');" class="btn btn-danger">Hapus</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php
        break;
    case 'create':

    ?>
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h1>Input Data Prodi</h1>
                <form action="proses_prodi.php?process=save" method="POST">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Prodi</label>
                        <input type="text" class="form-control" id="nama_prodi" name="nama_prodi" required>
                    </div>
                    <div class="mb-3">
                        <label for="jenjang" class="form-label">Jenjang</label>
                        <select class="form-control" id="jenjang" name="jenjang">
                            <option value="" selected disabled hidden>Pilih disini</option>
                            <option value="D2">D2</option>
                            <option value="D3">D3</option>
                            <option value="D4">D4</option>
                            <option value="S1">S1</option>
                            <option value="S2">S2</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan" name="keterangan" required>
                    </div>
                    <button type="submit" name="submit" value="simpan" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>

    <?php
        break;
    case 'update':
    ?>
        <h1>Edit Data Prodi</h1>
        <?php
        $id = $_GET['id'];
        $queryEdit = mysqli_query($db, "SELECT * FROM prodi WHERE id = $id");
        $row = mysqli_fetch_array($queryEdit);
        ?>
        <form action="proses_prodi.php?process=edit" method="POST">
            <input type="hidden" value="<?= $id ?>" name="id">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Prodi</label>
                <input type="text" class="form-control" id="nama_prodi" name="nama_prodi" value="<?= $row['nama_prodi'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="jenjang" class="form-label">Jenjang</label>
                <select class="form-control" id="jenjang" name="jenjang">
                    <option value="D2" <?= $row['jenjang'] == 'D2' ? 'selected' : '' ?>>D2</option>
                    <option value="D3" <?= $row['jenjang'] == 'D3' ? 'selected' : '' ?>>D3</option>
                    <option value="D4" <?= $row['jenjang'] == 'D4' ? 'selected' : '' ?>>D4</option>
                    <option value="S1" <?= $row['jenjang'] == 'S1' ? 'selected' : '' ?>>S1</option>
                    <option value="S2" <?= $row['jenjang'] == 'S2' ? 'selected' : '' ?>>S2</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?= $row['keterangan'] ?>" required>
            </div>
            <button type="submit" name="update" value="update" class="btn btn-primary">Submit</button>
        </form>
<?php
        break;
}
?>