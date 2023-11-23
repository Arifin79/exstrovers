
<?php
error_reporting(0);
switch ($_GET['action']) {
    default:
?>
        <table class="table table-bordered table-striped">
            <thead>
                <th>No</th>
                <th>Judul</th>
                <th>Tanggal</th>
                <th>Deskripsi</th>
                <th><a href="index.php?page=information&action=add" class="btn btn-sm btn-primary"><i class="bi bi-plus"></i>Add</a></th>
            </thead>
            <tbody>
                <?php
                $nomor = 1;
                $query = mysqli_query($koneksi, "SELECT * FROM admin");
                ?>
                <?php while ($data = mysqli_fetch_assoc($query)) : ?>
                    <tr>
                        <td><?= $nomor; ?></td>
                        <td><?= $data['username']; ?></td>
                        <td><?= $data['nama']; ?></td>
                        <td>
                            <a href="index.php?page=information&action=edit&id=<?= $data['username']; ?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i></a>
                            <a href="index.php?page=information&action=resset&id=<?= $data['username']; ?>" class="btn btn-sm btn-info"><i class="bi bi-arrow-clockwise"></i></a>
                            <a href="index.php?page=information&action=hapus&id=<?= $data['username']; ?>" class="btn btn-sm btn-danger"><i class="bi bi-trash-fill"></i></a>
                        </td>
                    </tr>
                    <?php $nomor++; ?>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php
        break;
    case 'add':
        ?>
        <form class="form-horizontal" role="form" action="information.php" method="POST">
            <div class="form-group">
                <label for="nama_lengkap" class="col-sm-1 control-label">Judul</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="nama" placeholder="Masukkan Nama Anda" name="nama">
                </div>
                </div>
            <div class="form-group">
                <label for="email" class="col-sm-1 control-label">Tanggal</label>
                <div class="col-sm-10">
                <input type="date" class="form-control" id="date" name="date" placeholder="Masukkan Tanggal">
                </div>
            </div>
                <div class="form-group">
                <label for="alamat" class="col-sm-1 control-label">Deskripsi</label>
                <div class="col-sm-10">
                <textarea name="alamat" id="alamat" cols="30" rows="5" placeholder="Masukkan alamat anda" class="form-control"></textarea>
            </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-1 col-sm-10">
                <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
            </div>
        </form>
        <?php
        break;
    case 'save':
        if (isset($_POST['user'])) {
            $user = $_POST['user'];
            $password = md5($_POST['password']);
            $nama = $_POST['nama'];
            $query = mysqli_query($koneksi, "INSERT INTO admin (username, password, nama) VALUES ('" . $user . "', '" . $password . "', '" . $nama . "')");

            if ($query) {
                echo "<script>
                        document.location='index.php?page=admin';
                    </script>";
            } else {
                echo "<script>
                        alert('Gagal');
                        document.location = 'index.php?page=admin&action=add';
                    </script>";
            }
        }
        break;
}
?>