<?php
require 'koneksi.php';
$aksi = isset($_GET['action']) ? $_GET['action'] : 'read';

switch ($aksi) {
    case 'read':

?>
        <h1>Data Mahasiswa</h1>
        <a href="index.php?page=mahasiswa&action=create" class="btn btn-primary">Tambah Data</a>
        <hr />
        <table id="tabelMhs" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">NIM</th>
                    <th scope="col">Prodi</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Hobi</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $queryMhs = mysqli_query($db, "SELECT m.*, p.nama_prodi FROM mahasiswa m 
                LEFT JOIN prodi p ON m.prodi_id = p.id;");
                $no = 1;
                while ($rowMhs = mysqli_fetch_array($queryMhs)) {
                ?>
                    <tr>
                        <th scope="row"><?= $no++ ?></th>
                        <td><?= $rowMhs['nama']  ?></td>
                        <td><?= $rowMhs['email'] ?></td>
                        <td><?= $rowMhs['nim'] ?></td>
                        <td><?= $rowMhs['nama_prodi'] ?></td>
                        <td><?= $rowMhs['gender'] == 'L' ? 'Laki-laki' : 'Perempuan' ?></td>
                        <td><?= $rowMhs['hobi'] ?></td>
                        <td><?= $rowMhs['alamat'] ?></td>
                        <td>
                            <a href="index.php?page=mahasiswa&action=update&id=<?= $rowMhs['id']  ?>" class="btn btn-warning">Edit</a>
                            <a href="proses_mahasiswa.php?process=delete&id=<?= $rowMhs['id']  ?>" onclick="return confirm('Apakah Anda yakin menghapus data ini?');" class="btn btn-danger">Hapus</a>
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
                <h1> Input Data Mahasiswa </h1>
                <form action="proses_mahasiswa.php?process=save" method="POST">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="nim" class="form-label">NIM</label>
                        <input type="number" class="form-control" id="nim" name="nim" required>
                    </div>
                    <div class="mb-3">
                        <label for="prodi" class="form-label">Prodi</label>
                        <select name="prodi" id="prodi" class="form-control">
                            <option value="" selected disabled hidden>Pilih Disini</option>
                            <?php
                            $queryProdi = mysqli_query($db, "SELECT * FROM prodi");
                            while ($rowProdi = mysqli_fetch_array($queryProdi)) {
                            ?>
                                <option value="<?= $rowProdi['id'] ?>"><?= $rowProdi['nama_prodi'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="L" name="gender" id="gender">
                            <label class="form-check-label" for="gender">
                                Laki-laki
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="P" name="gender" id="gender">
                            <label class="form-check-label" for="gender">
                                Perempuan
                            </label>
                        </div>
                        <div class="mb-3">
                            <label for="hobi" class="form-label">Hobi</label>
                            <div class="form-check">
                                <input class="form-check-input" name="hobi[]" type="checkbox" value="Mancing" id="hobi">
                                <label class="form-check-label" for="hobi">
                                    Mancing
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" name="hobi[]" type="checkbox" value="Olahraga" id="hobi">
                                <label class="form-check-label" for="hobi">
                                    Olahraga
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" name="hobi[]" type="checkbox" value="Gaming" id="hobi">
                                <label class="form-check-label" for="hobi">
                                    Gaming
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat"></textarea>
                        </div>
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
                <h1>Edit Data Mahasiswa</h1>
                <?php
                $id = $_GET['id'];
                $queryEdit = mysqli_query($db, "SELECT * FROM mahasiswa LEFT JOIN prodi ON mahasiswa.prodi_id = prodi.id WHERE mahasiswa.id = $id");
                $rowEdit = mysqli_fetch_array($queryEdit);
                $hobbies = explode(", ", $rowEdit["hobi"]);
                ?>
                <form action="proses_mahasiswa.php?process=edit" method="POST">
                    <input type="hidden" value="<?= $id ?>" name="id">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= $rowEdit['nama'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= $rowEdit['email'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="nim" class="form-label">NIM</label>
                        <input type="number" class="form-control bg-body-tertiary id=" nim" name="nim" value="<?= $rowEdit['nim'] ?>" required readonly>
                    </div>
                    <div class="mb-3">
                        <label for="prodi" class="form-label">Prodi</label>
                        <select name="prodi" id="prodi" class="form-control">
                            <option value="<?= $rowEdit['prodi_id'] ?>" hidden selected><?= $rowEdit['nama_prodi'] ?></option>
                            <?php
                            $queryProdi = mysqli_query($db, "SELECT * FROM prodi");
                            while ($rowProdi = mysqli_fetch_array($queryProdi)) {
                            ?>
                                <option value="<?= $rowProdi['id'] ?>"><?= $rowProdi['nama_prodi'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="L" name="gender" id="gender" <?= $rowEdit['gender'] == 'L' ? 'checked' : '' ?>>
                            <label class="form-check-label" for="gender">
                                Laki-laki
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="P" name="gender" id="gender" <?= $rowEdit['gender'] == 'P' ? 'checked' : '' ?>>
                            <label class="form-check-label" for="gender">
                                Perempuan
                            </label>
                        </div>
                        <div class="mb-3">
                            <label for="hobi" class="form-label">Hobi</label>
                            <div class="form-check">
                                <input class="form-check-input" name="hobi[]" type="checkbox" value="Mancing" id="hobi" <?= in_array("Mancing", $hobbies) ? 'checked' : '' ?>>
                                <label class="form-check-label" for="hobi">
                                    Mancing
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" name="hobi[]" type="checkbox" value="Olahraga" id="hobi" <?= in_array("Olahraga", $hobbies) ? 'checked' : '' ?>>
                                <label class="form-check-label" for="hobi">
                                    Olahraga
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" name="hobi[]" type="checkbox" value="Gaming" id="hobi" <?= in_array("Gaming", $hobbies) ? 'checked' : '' ?>>
                                <label class="form-check-label" for="hobi">
                                    Gaming
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat"><?= $rowEdit['alamat'] ?></textarea>
                        </div>
                    </div>
                    <button type="submit" name="update" value="update" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
<?php
        break;
}
?>