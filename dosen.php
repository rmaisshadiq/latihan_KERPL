<?php
require 'koneksi.php';
$aksi = isset($_GET['action']) ? $_GET['action'] : 'read';

switch ($aksi) {
    case 'read';
?>
        <h1>Data Dosen</h1>
        <a href="index.php?page=dosen&action=create" class="btn btn-primary">Tambah Data</a>
        <hr />
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">NIP</th>
                    <th scope="col">Nama Dosen</th>
                    <th scope="col">Nama Prodi</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $queryDs = "SELECT d.*, p.nama_prodi FROM dosen d
            LEFT JOIN prodi p ON d.prodi_id = p.id;";
                $resultDs = mysqli_query($db, $queryDs);
                $no = 1;
                while ($rowDs = mysqli_fetch_array($resultDs)) {
                ?>
                    <tr>
                        <th scope="row"><?= $no++ ?></th>
                        <td><?= $rowDs['nip'] ?></td>
                        <td><?= $rowDs['nama_dosen'] ?></td>
                        <td><?= $rowDs['nama_prodi'] ?></td>
                        <td><img src="./image/<?= $rowDs['foto']; ?>" id="display-image" alt=""></td>
                        <td>
                            <a href="index.php?page=dosen&action=update&id=<?= $rowDs['nip'] ?>" class="btn btn-warning">Edit</a>
                            <a href="proses_dosen.php?process=delete&id=<?= $rowDs['nip'] ?>" class="btn btn-danger">Hapus</a>
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
                <h1> Input Data Dosen </h1>
                <form action="proses_dosen.php?process=save" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nip" class="form-label">NIP</label>
                        <input type="text" class="form-control" id="nip" name="nip" required>
                    </div>

                    <div class="mb-3">
                        <label for="nama_dosen" class="form-label">Nama Dosen</label>
                        <input type="text" class="form-control" id="nama_dosen" name="nama_dosen" required>
                    </div>

                    <div class="mb-3">
                        <label for="prodi" class="form-label">Prodi</label>
                        <select name="prodi" id="prodi" class="form-control">
                            <option value="" selected disabled hidden>Pilih Disini</option>
                            <?php
                            $queryProdi = "SELECT * FROM prodi";
                            $resProdi = mysqli_query($db, $queryProdi);
                            while ($rowProdi = mysqli_fetch_array($resProdi)) {
                            ?>
                                <option value="<?= $rowProdi['id'] ?>"><?= $rowProdi['nama_prodi'] ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto Dosen</label>
                        <input type="file" class="form-control" name="foto" id="foto" required />
                    </div>

                    <button type="submit" name="submit" value="simpan" class="btn btn-primary">Submit</button>

                </form>
            </div>
        </div>
    <?php
        break;
    case 'update':
    ?>
<?php } ?>