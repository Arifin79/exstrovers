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
                <th><a href="index.php?page=information&action=add" class="btn btn-sm btn-primary"><i class="fa-solid fa-plus"></i> Add</a></th>
            </thead>
            <tbody>
                <?php
                $nomor = 1;
                $query = mysqli_query($conn, "SELECT * FROM information");
                ?>
                <?php while ($data = mysqli_fetch_assoc($query)) : ?>
                    <tr>
                        <td><?= $nomor; ?></td>
                        <td><?= $data['judul']; ?></td>
                        <td><?= $data['tanggal']; ?></td>
                        <td><?= $data['deskripsi']; ?></td>
                        <td>
                            <a href="index.php?page=information&action=edit&id=<?= $data['judul']; ?>" class="btn btn-sm btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="index.php?page=information&action=reset&id=<?= $data['judul']; ?>" class="btn btn-sm btn-info"><i class="fa-solid fa-arrow-rotate-right"></i></a>
                            <a href="index.php?page=information&action=hapus&id=<?= $data['judul']; ?>" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></a>
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
        <form class="form-horizontal" role="form" action="index.php?page=information&action=save" method="POST">
            <div class="form-group">
                <label for="judul" class="col-sm-1 control-label">Judul</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="judul" placeholder="Masukkan Nama Anda" name="judul">
                </div>
                </div>
            <div class="form-group">
                <label for="date" class="col-sm-1 control-label">Tanggal</label>
                <div class="col-sm-10">
                <input type="date" class="form-control" id="date" name="date" placeholder="Masukkan Tanggal">
                </div>
            </div>
                <div class="form-group">
                <label for="deskripsi" class="col-sm-1 control-label">Deskripsi</label>
                <div class="col-sm-10">
                <textarea name="deskripsi" id="deskripsi" cols="30" rows="5" placeholder="Masukkan alamat anda" class="form-control"></textarea>
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
        if (isset($_POST['judul'])) {
            $user = $_POST['judul'];
            $judul = $_POST['judul'];
            $tanggal = $_POST['tanggal'];
            $deskripsi = $_POST['deskripsi'];
            $query = mysqli_query($conn, "INSERT INTO information (judul, tanggal, deskripsi) VALUES ('" . $user . "','" . $tanggal . "', '" . $deskripsi . "')");

            if ($query) {
                echo "<script>
                        document.location='index.php?page=information';
                    </script>";
            } else {
                echo "<script>
                        alert('Gagal');
                        document.location = 'index.php?page=information&action=add';
                    </script>";
            }
        }
        break;
        case 'edit':
            $query = mysqli_query($koneksi, "SELECT * FROM admin WHERE username = '" . $_GET['id'] . "'");
            $data = mysqli_fetch_assoc($query);
            ?>
            <form action="index.php?page=admin&action=update" method="post">
                <input type="hidden" name="id" value="<?= $data['username']; ?>">
                <label for="user">Username:</label>
                <input type="text" name="user" id="user" class="form-control" disabled value="<?= $data['username']; ?>">
                <label for="pass">Password:</label>
                <input type="password" name="pass" id="pass" class="form-control" disabled value="<?= $data['password']; ?>">
                <label for="nama">Nama Lengkap:</label>
                <input type="text" name="nama" id="nama" class="form-control" required value="<?= $data['nama']; ?>">
                <br>
                <button type="submit" class="btn btn-primary">UPDATE</button>
                <a href="index.php?page=admin" class="btn btn-danger">KEMBALI</a>
            </form>
            <?php
            break;
        case 'update':
            if (isset($_POST['id'])) {
                $nama = $_POST['nama'];
                $query = mysqli_query($koneksi, "UPDATE admin SET nama = '" . $nama . "' WHERE username = '" . $_POST['id'] . "'");
    
                if ($query) {
                    echo "<script>
                            document.location='index.php?page=admin';
                        </script>";
                } else {
                    echo "<script>
                            alert('Gagal');
                            document.location = 'index.php?page=admin&action=edit&id=" . $_POST['id'] . "';
                        </script>";
                }
            }
            break;
        case 'hapus':
            $query = mysqli_query($koneksi, "DELETE FROM admin WHERE username = '" . $_GET['id'] . "'");
            if ($query) {
                echo "<script>
                            document.location='index.php?page=admin';
                        </script>";
            } else {
                echo "<script>
                            alert('Gagal');
                            document.location = 'index.php?page=admin';
                        </script>";
            }
            break;
        case 'reset':
            $password = md5("12345");
            $query = mysqli_query($koneksi, "UPDATE admin SET password = '" . $password . "' WHERE username = '" . $_GET['id'] . "'");
    
            if ($query) {
                echo "<script>
                            alert('Sukses reset password 12345');
                            document.location='index.php?page=admin';
                        </script>";
            } else {
                echo "<script>
                            alert('Gagal');
                            document.location = 'index.php?page=admin';
                        </script>";
            }
    
    break;
}
?>