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
                <th><a href="index.php?page=register&action=add" class="btn btn-sm btn-primary"><i class="fa-solid fa-plus"></i> Add</a></th>
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
                            <a href="index.php?page=register&action=edit&id=<?= $data['name']; ?>" class="btn btn-sm btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="index.php?page=register&action=reset&id=<?= $data['name']; ?>" class="btn btn-sm btn-info"><i class="fa-solid fa-arrow-rotate-right"></i></a>
                            <a href="index.php?page=register&action=hapus&id=<?= $data['name']; ?>" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></a>
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
                <label for="nama_lengkap" class="col-sm-1 control-label">Username</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="user" placeholder="Masukan Username" name="user">
                </div>
            </div>
            <div class="form-group">
                <label for="nama_lengkap" class="col-sm-1 control-label">Password</label>
                <div class="col-sm-10">
                <input type="password" class="form-control" id="pass" placeholder="Masukan Password" name="pass">
                </div>
            </div>
            <div class="form-group">
                <label for="nama_lengkap" class="col-sm-1 control-label">Nama</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="nama" placeholder="Masukkan Nama Lengkap" name="nama">
                </div>
            </div>
            <div class="form-group">
                <label for="nama_lengkap" class="col-sm-1 control-label">No Telpon</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="telpon" placeholder="Masukkan Nomer Telpon" name="telpon">
                </div>
            </div>
            <div class="form-group">
                <label for="nama_lengkap" class="col-sm-1 control-label">Image Profile</label>
                <div class="col-sm-10">
                <input type="file" class="form-control" name="gambar_artikel" id="gambar_artikel" required>
                </div>
            </div>
            <div class="form-group">
                <label for="nama_lengkap" class="col-sm-1 control-label">Pengguna</label>
                <div class="col-sm-10">
                <select class="form-control"  name="user_type">
                    <option value="user">Karyawan</option>
                    <option value="admin">Admin</option>
                </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">SIMPAN</button>
            <a href="index.php?page=register" class="btn btn-danger">KEMBALI</a>
        </form>
        <?php
        break;
    case 'save':
        if (isset($_POST['user'])) {
            $user = $_POST['user'];
            $email = $_POST['email'];
            $password = md5($_POST['password']);
            $name = $_POST['name'];
            $no_telp = $_POST['no_telp'];
            $image = $_POST['image_profile'];
            $user_type = $_POST['user_type'];
            $query = mysqli_query($conn, "INSERT INTO user_form (email, password, nama, no_telp, image_profile, user_type) VALUES ('" . $user . "', '" . $email . "', '" . $password . "', '" . $name . "', '" . $no_telp . "', '" . $image . "', '" . $user_type . "')");

            if(mysqli_num_rows($query) > 0){

                $error[] = 'user already exist!';

            }else{

                if($pass != $cpass){
                    $error[] = 'password not matched!';
                }else{
                    $insert = "INSERT INTO user_form(name, email, password, user_type) VALUES('$name','$email','$pass','$user_type')";
                    mysqli_query($conn, $insert);
                    header('location:login_form.php');
                }
            }

            if ($query) {
                echo "<script>
                        document.location='admin/index.php?page=register';
                    </script>";
            } else {
                echo "<script>
                        alert('Gagal');
                        document.location = 'admin/index.php?page=register&action=add';
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