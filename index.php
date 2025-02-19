<?php
require 'function.php';
require 'cek.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Stock Barang</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet"
        crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js"
        crossorigin="anonymous"></script>

    <style>
        body {
            background-image: url('assets/img/bgdb.jpg'); /* Path ke gambar latar */
            background-size: cover; /* Menutupi seluruh area halaman */
            background-repeat: no-repeat; /* Tidak mengulangi gambar */
            background-attachment: fixed; /* Gambar tetap saat halaman digulir */
            background-position: center; /* Gambar berada di tengah */
        }
    </style>
</head>

<body class="sb-nav-fixed">
<<<<<<< HEAD
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand d-flex align-items-center" href="index.php">
            <img src="assets/img/tekoplogo.png" alt="Logo" style="width: 60px; height: 60px; margin-right: 10px;">
            Tekop's Gudang
        </a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
=======
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- <a class="navbar-brand" href="index.php">Tekop's Gudang</a> -->
        <div
            style="display: flex; align-items: center; background-color:rgb(32, 35, 38); color: white; padding: 10px; gap: 15px;">
            <img src="../assets/img/tekop.png" alt="Logo Tekop" style="height: 50px;">
            <a style="margin: 0; font-size: 1.2rem; font-weight: 500 ;">Tekop's Gudang</a>
        </div>

        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
>>>>>>> 2ff9b808743a74aa03427c47931d9bf853347cb0
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
                            Dashboard Stock Barang
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
                    <h1 class="mt-4">Stock Barang</h1>

                    <div class="card mb-4">
                        <div class="card-header">
                            <!-- Button to Open the Modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                Tambah Data Barang
                            </button>

                            <!-- Export Table stock to Dokumen -->
                            <a href="export.php" class="btn btn-info">Export Data Stock</a>  
                        </div>
                    </div>

                    <div class="card-body">

                        <?php
                        $ambildatastock = mysqli_query($conn, "select * from stock where stock <= 2");

                        while ($fetch = mysqli_fetch_array($ambildatastock)) {
                            $barang = $fetch['namabarang'];


                            ?>
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>Perhatian!</strong> Stock Barang <?= $barang; ?> Telah Habis.
                            </div>

                            <?php
                        }
                        ?>

                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"
                                style="border: 1px solid #ddd; width: 100%; border-collapse: collapse; text-align: left; font-family: Arial, sans-serif; font-size: 14px;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Barang</th>
                                        <th>Deskripsi</th>
                                        <th>Stock</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $i = 0; // Inisialisasi variabel $i di luar loop
                                    $ambilsemuadatastock = mysqli_query($conn, "SELECT * FROM stock");
                                    while ($data = mysqli_fetch_array($ambilsemuadatastock)) {
                                        $namabarang = $data['namabarang'];
                                        $deskripsi = $data['deskripsi'];
                                        $stock = $data['stock'];
                                        $idb = $data['idbarang'];

                                        ?>


                                        <tr>
                                            <td><?= ++$i; ?></td> <!-- Penambahan variabel $i sebelum ditampilkan -->
                                            <td><?= $namabarang; ?></td>
                                            <td><?= $deskripsi; ?></td>
                                            <td><?= $stock; ?></td>
                                           
                                        </tr>

                                       

                                        <?php
                                    }
                                    ;
                                    ?>
                                </tbody>


                            </table>
                        </div>
                    </div>
                </div>
        </div>
        </main>
        <!-- <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Your Website 2020</div>
                    <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer> -->
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/datatables-demo.js"></script>
</body>

<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah Barang</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <form method="post">
                <div class="modal-body">
                    <br>
                    <input type="text" name="namabarang" placeholder="Nama Barang" class="form-control" required>
                    <br>
                    <input type="text" name="deskripsi" placeholder="Deskripsi barang" class="form-control" required>
                    <br>
                    <input type="number" name="stock" class="form-control" placeholder="Stock" required>
                    <br>
                    <button type="submit" class="btn btn-primary" name="addnewbarang" required>Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

</html>