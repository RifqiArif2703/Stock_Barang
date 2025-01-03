<?php
require 'function.php';
require 'cek.php';

if (isset($_POST['barangkeluar'])) {
    $idbarang = $_POST['barangnya'];
    $qty = $_POST['qty'];
    $penerima = $_POST['penerima'];
    $tanggal = date('Y-m-d'); // Tambahkan tanggal untuk data baru

    $addData = mysqli_query($conn, "INSERT INTO keluar (idbarang, qty, penerima, tanggal) VALUES ('$idbarang', '$qty', '$penerima', '$tanggal')");
    if ($addData) {
        echo "<script>alert('Barang keluar berhasil ditambahkan'); window.location='keluar.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan barang keluar');</script>";
    }
}


if (isset($_POST['updatebarangkeluar'])) {
    $idkeluar = $_POST['idkeluar'];
    $qty = $_POST['qty'];
    $penerima = $_POST['penerima'];

    $updateData = mysqli_query($conn, "UPDATE keluar SET qty = '$qty', penerima = '$penerima' WHERE idkeluar = '$idkeluar'");
    if ($updateData) {
        echo "<script>alert('Barang keluar berhasil diperbarui'); window.location='keluar.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data barang keluar');</script>";
    }
}

if (isset($_POST['deletebarangkeluar'])) {
    $idkeluar = $_POST['idkeluar'];

    $deleteData = mysqli_query($conn, "DELETE FROM keluar WHERE idkeluar = '$idkeluar'");
    if ($deleteData) {
        echo "<script>alert('Barang keluar berhasil dihapus'); window.location='keluar.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data barang keluar');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Barang Keluar</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand d-flex align-items-center" href="index.php">
            <img src="assets/img/tekoplogo.png" alt="Logo" style="width: 60px; height: 60px; margin-right: 10px;">
            Tekop's Gudang
        </a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
        <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </form>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Stock Barang
                        </a>
                        <a class="nav-link" href="masuk.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Barang Masuk
                        </a>
                        <a class="nav-link" href="keluar.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Barang Keluar
                        </a>
                        <a class="nav-link" href="admin.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Kelola Admin
                        </a>
                        <a class="nav-link" href="logout.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Logout
                        </a>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <h1 class="mt-4">Barang Keluar</h1>
                    <div class="card mb-4">
                        <div class="card-header">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Input Barang Keluar</button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah</th>
                                        <th>Penerima</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ambilsemuadatakeluar = mysqli_query($conn, "SELECT * FROM keluar k, stock s WHERE s.idbarang = k.idbarang");
                                    while ($data = mysqli_fetch_array($ambilsemuadatakeluar)) {
                                        $idkeluar = $data['idkeluar'];
                                        $tanggal = $data['tanggal'];
                                        $namabarang = $data['namabarang'];
                                        $qty = $data['qty'];
                                        $penerima = $data['penerima'];
                                    ?>
                                    <tr>
                                        <td><?= $tanggal ?></td>
                                        <td><?= $namabarang ?></td>
                                        <td><?= $qty ?></td>
                                        <td><?= $penerima ?></td>
                                        <td>
                                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?= $idkeluar; ?>"><i class="fas fa-pen"></i></button>
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?= $idkeluar; ?>"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <!-- Modal Edit -->
                                    <div class="modal fade" id="edit<?= $idkeluar; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Edit Barang Keluar</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <form method="post">
                                                    <div class="modal-body">
                                                        <input type="hidden" name="idkeluar" value="<?= $idkeluar; ?>">
                                                        <input type="number" name="qty" value="<?= $qty; ?>" class="form-control" required>
                                                        <input type="text" name="penerima" value="<?= $penerima; ?>" class="form-control" required>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary" name="updatebarangkeluar">Update</button>
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal Delete -->
                                    <div class="modal fade" id="delete<?= $idkeluar; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Hapus Barang Keluar</h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">Apakah Anda yakin ingin menghapus barang keluar ini?</div>
                                                <div class="modal-footer">
                                                    <form method="post">
                                                        <input type="hidden" name="idkeluar" value="<?= $idkeluar; ?>">
                                                        <button type="submit" class="btn btn-danger" name="deletebarangkeluar">Hapus</button>
                                                    </form>
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <!-- Modal Input Barang Keluar -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Barang Keluar</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form method="post">
                    <div class="modal-body">
                        <select name="barangnya" class="form-control">
                            <?php
                            $ambilsemuadatanya = mysqli_query($conn, "SELECT * FROM stock");
                            while ($fetcharray = mysqli_fetch_array($ambilsemuadatanya)) {
                                $namabarangnya = $fetcharray['namabarang'];
                                $idbarangnya = $fetcharray['idbarang'];
                            ?>
                            <option value="<?= $idbarangnya; ?>"><?= $namabarangnya; ?></option>
                            <?php } ?>
                        </select>
                        <br>
                        <input type="number" name="qty" class="form-control" placeholder="Quantity" required>
                        <br>
                        <input type="text" name="penerima" class="form-control" placeholder="Penerima" required>
                        <br>
                        <button type="submit" class="btn btn-primary" name="barangkeluar">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "language": {
                    "emptyTable": "No data available in table"
                }
            });
        });
    </script>
</body>
</html>
