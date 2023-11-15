<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>Add Account</p>
</body>
</html>
<?php
error_reporting(0);
switch ($_GET['action']) {
    default:
        ?>
        <table class="table table-bordered table-striped">
            <thead>
                <th>No</th>
                <th>Tipe pengguna</th>
                <th>Nama</th>
                <th>Email</th>
                <th>No Telpon</th>
                <th>Profile Image</th>
                <th><a href="index.php?page=admin&action=add" class="btn btn-sm btn-primary"><i class="fa-solid fa-plus"></i> Add</a></th>
            </thead>
            <tbody>
                <?php
                $nomor = 1;
                $query = mysqli_query($conn, "SELECT * FROM user_form");
                ?>
                <?php while ($data = mysqli_fetch_assoc($query)) : ?>
                    <tr>
                        <td><?= $nomor; ?></td>
                        <td><?= $data['user_type']; ?></td>
                        <td><?= $data['name']; ?></td>
                        <td><?= $data['email']; ?></td>
                        <td><?= $data['no_telp']; ?></td>
                        <td><?= $data['image_profile']; ?></td>
                        <td>
                            <a href="index.php?page=admin&action=edit&id=<?= $data['username']; ?>" class="btn btn-sm btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="index.php?page=admin&action=reset&id=<?= $data['username']; ?>" class="btn btn-sm btn-info"><i class="fa-solid fa-arrow-rotate-right"></i></a>
                            <a href="index.php?page=admin&action=hapus&id=<?= $data['username']; ?>" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></a>
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
        <form action="index.php?page=admin&action=save" method="post">
            <label for="user">Username:</label>
            <input type="text" name="user" id="user" class="form-control" required>
            <label for="pass">Password:</label>
            <input type="password" name="pass" id="pass" class="form-control" required>
            <label for="nama">Nama Lengkap:</label>
            <input type="text" name="nama" id="nama" class="form-control" required>
            <label for="telpon">No Telpon:</label>
            <input type="text" name="telpon" id="telpon" class="form-control" required>
            <label for="image">Image Profile:</label>
            <input type="file" class="form-control" name="gambar_artikel" id="gambar_artikel" required>
            <label for="nama">User Type:</label>
            <select class="form-control"  name="user_type">
                <option value="user">Karyawan</option>
                <option value="admin">Admin</option>
            </select>
            <br>
            <button type="submit" class="btn btn-primary">SIMPAN</button>
            <a href="index.php?page=admin" class="btn btn-danger">KEMBALI</a>
        </form>
    <?php
        break;
    case 'save':
        if (isset($_POST['user'])) {
            $user = $_POST['user'];
            $password = md5($_POST['password']);
            $nama = $_POST['nama'];
            $no_telp = $_POST['no_telp'];
            $image = $_POST['image_profile'];
            $user_type = $_POST['user_type'];
            $query = mysqli_query($conn, "INSERT INTO user_form (email, password, nama, no_telp, image_profile, user_type) VALUES ('" . $user . "', '" . $password . "', '" . $nama . "', '" . $no_telp . "', '" . $image . "', '" . $user_type . "')");

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