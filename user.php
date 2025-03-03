<?php
require 'koneksi.php';
$aksi = isset($_GET['action']) ? $_GET['action'] : 'read';

switch ($aksi) {
    case 'read':
?>
        <h1>Data User</h1>
        <a href="index.php?page=user&action=create" class="btn btn-primary">Tambah Data</a>
        <hr />
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Lengkap</th>
                    <th scope="col">Email</th>
                    <th scope="col">Level</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $queryUser = mysqli_query($db, "SELECT * FROM user");
                $no = 1;
                while ($rowUser = mysqli_fetch_array($queryUser)) {
                ?>
                    <tr>
                        <th scope="row"><?= $no++ ?></th>
                        <td><?= $rowUser['nama_lengkap'] ?></td>
                        <td><?= $rowUser['email'] ?></td>
                        <td><?= $rowUser['level'] ?></td>
                        <td>
                            <a href="index.php?page=user&action=update&id=<?= $rowUser['id'] ?>" class="btn btn-warning">Edit</a>
                            <a href="proses_user.php?process=delete&id=<?= $rowUser['id'] ?>" class="btn btn-danger">Hapus</a>
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
                <h1>Input Data User</h1>
                <form action="proses_user.php?process=save" method="POST">
                    <div class="mb-3">
                        <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>

                    <div class="mb-3">
                        <label for="level" class="form-label">Level</label>
                        <select name="level" id="level" class="form-control">
                            <option value="" selected disabled hidden>Pilih Disini</option>
                            <option value="admin">Admin</option>
                            <option value="staff">Staff</option>
                        </select>
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
                <h1>Edit Data User</h1>
                <?php
                $id = $_GET['id'];
                $queryEdit = mysqli_query($db, "SELECT * FROM user WHERE id = $id");
                $rowEdit = mysqli_fetch_array($queryEdit);
                ?>
                <form action="proses_user.php?process=edit" method="POST">
                    <input type="hidden" value="<?= $id ?>" name="id">
                    <div class="mb-3">
                        <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?= $rowEdit['nama_lengkap'] ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= $rowEdit['email'] ?>"required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>

                    <div class="mb-3">
                        <label for="level" class="form-label">Level</label>
                        <select name="level" id="level" class="form-control">
                            <option value="<?= $rowEdit['level'] ?>" selected hidden><?= ucfirst($rowEdit['level']) ?></option>
                            <option value="admin">Admin</option>
                            <option value="staff">Staff</option>
                        </select>
                    </div>
                    <button type="submit" name="update" value="update" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
<?php 
        break;
} ?>