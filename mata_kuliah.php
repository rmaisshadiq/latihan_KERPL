<?php
require 'koneksi.php';
$aksi = isset($_GET['action']) ? $_GET['action'] : 'read';

switch ($aksi) {
    case 'read':
?>
        <h1>Data Mata Kuliah</h1>
        <a href="index.php?page=matkul&action=create" class="btn btn-primary">Tambah Data</a>
        <hr />
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Kode Matkul</th>
                    <th scope="col">Nama Matkul</th>
                    <th scope="col">SKS</th>
                    <th scope="col">NIP Dosen</th>
                    <th scope="col">Semester</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $queryMK = "SELECT * FROM mata_kuliah mk LEFT JOIN dosen d ON mk.dosen_nip = d.nip;";
                $resMK = mysqli_query($db, $queryMK);
                $no = 1;
                while ($rowMK = mysqli_fetch_array($resMK)) {
                ?>
                    <tr>
                        <th scope="row"><?= $no++ ?></th>
                        <td><?= $rowMK['kode_mk'] ?></td>
                        <td><?= $rowMK['nama_mk'] ?></td>
                        <td><?= $rowMK['sks'] ?></td>
                        <td><?= $rowMK['dosen_nip'] ?></td>
                        <td><?= $rowMK['semester'] ?></td>
                        <td>
                            <a href="index.php?page=matkul&action=update&id=<?= $rowMK['kode_mk'] ?>" class="btn btn-warning">Edit</a>
                            <a href="proses_matkul.php?process=delete&id=<?= $rowMK['kode_mk'] ?>" class="btn btn-danger">Hapus</a>
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
                <h1>Input Data Mata Kuliah</h1>
                <form action="proses_matkul.php?process=save" method="POST">
                    <div class="mb-3">
                        <label for="kode_mk">Kode Mata Kuliah</label>
                        <input type="text" class="form-control" id="kode_mk" name="kode_mk" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama_mk">Nama Mata Kuliah</label>
                        <input type="text" class="form-control" id="nama_mk" name="nama_mk" required>
                    </div>
                    <div class="mb-3">
                        <label for="sks">SKS</label>
                        <input type="number" class="form-control" id="sks" name="sks" required>
                    </div>
                    <div class="mb-3">
                        <label for="nip">Dosen Pengampu</label>
                        <select name="nip" id="nip" class="form-control">
                            <option value="" selected disabled hidden>Pilih disini</option>
                            <?php
                            $sqlNIP = "SELECT * FROM dosen";
                            $queryNIP = mysqli_query($db, $sqlNIP);
                            while ($rowNIP = mysqli_fetch_array($queryNIP)) {
                            ?>
                                <option value="<?= $rowNIP['nip'] ?>"><?= $rowNIP['nama_dosen'] ?></option>
                            <?php }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="kode_mk">Semester</label>
                        <input type="number" class="form-control" id="semester" name="semester" required>
                    </div>
                    <button type="submit" name="submit" value="simpan" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    <?php
        break;
    case 'update':
    ?>
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h1>Update Data Mata Kuliah</h1>
                <?php
                $kode_mk = $_GET['id'];
                $sqlEdit = "SELECT * FROM mata_kuliah mk LEFT JOIN dosen d ON mk.dosen_nip = $kode_mk";
                $queryEdit = mysqli_query($db, $sqlEdit);
                $rowEdit = mysqli_fetch_array($queryEdit);
                ?>
                <form action="proses_matkul.php?process=edit" method="POST">
                    <div class="mb-3">
                        <label for="kode_mk">Kode Mata Kuliah</label>
                        <input type="text" class="form-control bg-body-tertiary" id="kode_mk" name="kode_mk" value="<?= $rowEdit['kode_mk'] ?>" required readonly>
                    </div>
                    <div class="mb-3">
                        <label for="nama_mk">Nama Mata Kuliah</label>
                        <input type="text" class="form-control" id="nama_mk" name="nama_mk" value="<?= $rowEdit['nama_mk'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="sks">SKS</label>
                        <input type="number" class="form-control" id="sks" name="sks" value="<?= $rowEdit['sks'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="nip">Dosen Pengampu</label>
                        <select name="nip" id="nip" class="form-control">
                            <option value="" selected disabled hidden><?= $rowEdit['nama_dosen'] ?></option>
                            <?php
                            $sqlNIP = "SELECT * FROM dosen";
                            $queryNIP = mysqli_query($db, $sqlNIP);
                            while ($rowNIP = mysqli_fetch_array($queryNIP)) {
                            ?>
                                <option value="<?= $rowNIP['nip'] ?>"><?= $rowNIP['nama_dosen'] ?></option>
                            <?php }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="kode_mk">Semester</label>
                        <input type="number" class="form-control" id="semester" name="semester" required>
                    </div>
                    <button type="submit" name="update" value="update" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
<?php } ?>