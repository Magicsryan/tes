<?php
require_once "config.php";

$nama = $email = $kontak = $pesan = "";
$nama_err = $email_err = $kontak_err =  $pesan_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_nama = trim($_POST["nama"]);
    if (empty($input_nama)) {
        $nama_err = "Masukkan Nama Anda.";
    } else {
        $nama = $input_nama;
    }

    $input_email = trim($_POST["email"]);
    if (empty($input_email)) {
        $email_err = "Masukkan Email Anda.";
    } else {
        $email = $input_email;
    }

    $input_kontak = trim($_POST["kontak"]);
    if (empty($input_kontak)) {
        $kontak_err = "Masukkan No. Telepon Anda.";
    } else {
        $kontak = $input_kontak;
    }

    $input_pesan = trim($_POST["pesan"]);
    if (empty($input_pesan)) {
        $pesan_err = "Masukkan Isi Pesan.";
    } else {
        $pesan = $input_pesan;
    }

    if (empty($nama_err) && empty($email_err) && empty($notelepon_err) && empty($pesan_err)) {
        $sql = "INSERT INTO tabeltamu (nama, email, kontak, pesan) VALUES (?, ?, ?, ?)";

        $stmt = mysqli_prepare($link, $sql);
        if (!$stmt) {
            die('Error: ' . mysqli_error($link));
        }

        mysqli_stmt_bind_param($stmt, "ssis", $param_nama, $param_email, $param_kontak, $param_pesan);

        $param_nama = $nama;
        $param_email = $email;
        $param_kontak = $kontak;
        $param_pesan = $pesan;

        if (mysqli_stmt_execute($stmt)) {
            header("location:tabel.php");
            exit();
        } else {
            echo "Something went wrong. Please try again later.";
        }

        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Aplikasi Catatan</title>
    <link rel="stylesheet" href="bootstrap-5.1.3-dist/css/bootstrap.css">
    <link rel="stylesheet" href="fontawesome-free-6.0.0-web/css/all.min.css">
    
    <style type="text/css">
        .wrapper {
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Tambah Catatan</h2>
                    </div>
                    <table><tr>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($nama_err)) ? 'has-error' : ''; ?>">
                            <td><label>Nama :</label></td>
                            <td><input type="text" name="nama" class="form-control" value="<?php echo $nama; ?>"></td>
                            <span class="help-block"><?php echo $nama_err;?></span>
                        </div>
                    </tr>
                    <tr>
                        <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                            <td><label>Email :</label></td>
                            <td><textarea type="text" name="email" class="form-control" value="<?php echo $email; ?>"></textarea></td>
                            <span class="help-block"><?php echo $email_err;?></span>
                        </div>
                    </tr>
                    <tr>
                        <div class="form-group <?php echo (!empty($kontak_err)) ? 'has-error' : ''; ?>">
                            <td><label>Kontak : </label></td>
                            <td><input type="text" name="kontak" class="form-control" value="<?php echo $kontak; ?>"></td>
                            <span class="help-block"><?php echo $kontak_err;?></span>
                        </div></tr>
                    <tr>
                    <tr>
                        <div class="form-group <?php echo (!empty($pesan_err)) ? 'has-error' : ''; ?>">
                            <td><label>Pesan : </label></td>
                            <td><input type="text" name="pesan" class="form-control" value="<?php echo $pesan; ?>"></td>
                            <span class="help-block"><?php echo $pesan_err;?></span>
                        </div></tr>
                    <tr>
                        <td><input type="submit" class="btn btn-primary" value="Submit"></td>
                        <td><a href="index.php" class="btn btn-default">Cancel</a></td>
                        <td><a href="tabel.php" class="btn btn-default">Preview</a></td>
                    </form></tr></table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
