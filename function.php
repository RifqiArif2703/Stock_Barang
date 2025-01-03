<?php
session_start();


//Membuat koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "stockbarang");


    //Tambah barang baru
    if (isset($_POST['addnewbarang'])) {
        $namabarang = $_POST['namabarang'];
        $deskripsi = $_POST['deskripsi'];
        $stock = $_POST['stock'];

        $addtotable = mysqli_query($conn, "insert into stock (namabarang, deskripsi, stock) VALUES ('$namabarang','$deskripsi','$stock')");
        if ($addtotable) {
            header('location:index.php');
        } else {
            echo 'Gagal';
            header('location:index.php');
        }
        // $addtotable = mysqli_query($conn, "insert into stock (`idbarang`, `namabarang`, `deskripsi`, `stock`) VALUES ('$id','$namabarang','$deskripsi','$qty')");
        // if($addtotable){
        //     header('location:index.php');
        // } else {
        //     echo 'Gagal';
        //     header('Gagal');
        // }
    };

    //Tambah Barang Masuk
    if (isset($_POST['barangmasuk'])) {
        $barangnya = $_POST['barangnya'];
        $penerima = $_POST['penerima'];
        $qty = $_POST['qty'];

        $cekstocksekarang = mysqli_query($conn,"select * from stock where idbarang='$barangnya'");
        $ambildatanya = mysqli_fetch_array($cekstocksekarang);

        $stocksekarang = $ambildatanya['stock'];
        $tambahkanstocksekarangdenganquantity = $stocksekarang+$qty;

        $addtomasuk = mysqli_query($conn, "insert into masuk (idbarang, keterangan, qty) values('$barangnya','$penerima','$qty')");
        $updatestockmasuk = mysqli_query($conn,"update stock set stock='$tambahkanstocksekarangdenganquantity' where idbarang='$barangnya'");
        if ($addtomasuk&&$updatestockmasuk) {
            header('location:masuk.php');
        } else {
            echo 'Gagal';
            header('location:masuk.php');
        }
}


    //Tambah Barang Keluar
    if (isset($_POST['addbarangkeluar'])) {
        $barangnya = $_POST['barangnya'];
        $penerima = $_POST['penerima'];
        $qty = $_POST['qty'];

        $cekstocksekarang = mysqli_query($conn,"select * from stock where idbarang='$barangnya'");
        $ambildatanya = mysqli_fetch_array($cekstocksekarang);

        $stocksekarang = $ambildatanya['stock'];
        $tambahkanstocksekarangdenganquantity = $stocksekarang-$qty;

        $addtokeluar = mysqli_query($conn, "insert into keluar (idbarang, penerima, qty) values('$barangnya','$penerima','$qty')");
        $updatestockkeluar = mysqli_query($conn,"update stock set stock='$tambahkanstocksekarangdenganquantity' where idbarang='$barangnya'");
        if ($addtokeluar&&$updatestockmasuk) {
            header('location:keluar.php');
        } else {
            echo 'Gagal';
            header('location:keluar.php');
        }
    }

    //Fungsi Update info barang
    if (isset($_POST['updatebarang'])){
        $idb= $_POST['idb'];
        $namabarang= $_POST['namabarang'];
        $deskripsi= $_POST['deskripsi'];

        $update = mysqli_query($conn,"update stock set namabarang='$namabarang', deskripsi='$deskripsi' where idbarang='$idb'");
        if ($update) {
            header('location:index.php');
        } else {
            echo 'Gagal';
            header('location:index.php');
        }

    }


    //Menghapus Barang dari Stock
    if (isset($_POST['hapusbarang'])){
        $idb = $_POST['idb'];

        $hapus = mysqli_query($conn,"delete from stock where idbarang='$idb'");
        if ($hapus) {
            header('location:index.php');
        } else {
            echo 'Gagal';
            header('location:index.php');
        }
    }

    //Menambah Admin
    if (isset($_POST['addadmin'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        $queryinsert = mysqli_query($conn,"insert into login (email, password) values ('$email','$password')");
        if ($queryinsert) {
            //if berhasil add
            header('location:admin.php');
        } else {
            //else gagal add
            echo 'Gagal';
            header('location:admin.php');
        }
    }
// Query data barang masuk
$ambilsemuadatastock = mysqli_query($conn, "SELECT m.idbarang, s.namabarang, m.tanggal, m.qty, m.keterangan FROM masuk m, stock s WHERE s.idbarang = m.idbarang");

// Logika Edit Barang Masuk
if (isset($_POST['updatebarangmasuk'])) {
    $idbarang = $_POST['idbarang'];
    $qtybaru = $_POST['qty'];
    $keteranganbaru = $_POST['keterangan'];

    $cekstocksekarang = mysqli_query($conn, "SELECT * FROM stock WHERE idbarang='$idbarang'");
    $ambildata = mysqli_fetch_array($cekstocksekarang);
    $stocksekarang = $ambildata['stock'];

    $cekqtylama = mysqli_query($conn, "SELECT * FROM masuk WHERE idbarang='$idbarang'");
    $ambildatalama = mysqli_fetch_array($cekqtylama);
    $qtylama = $ambildatalama['qty'];

    $stockbaru = $stocksekarang - $qtylama + $qtybaru;

    $updatestock = mysqli_query($conn, "UPDATE stock SET stock='$stockbaru' WHERE idbarang='$idbarang'");
    $updatemasuk = mysqli_query($conn, "UPDATE masuk SET qty='$qtybaru', keterangan='$keteranganbaru' WHERE idbarang='$idbarang'");

    if ($updatestock && $updatemasuk) {
        header('location:masuk.php');
    } else {
        echo 'Gagal mengupdate barang masuk';
    }
}

// Logika Hapus Barang Masuk
if (isset($_POST['hapusbarangmasuk'])) {
    $idbarang = $_POST['idbarang'];

    $cekqty = mysqli_query($conn, "SELECT * FROM masuk WHERE idbarang='$idbarang'");
    $ambildata = mysqli_fetch_array($cekqty);
    $qty = $ambildata['qty'];

    $cekstocksekarang = mysqli_query($conn, "SELECT * FROM stock WHERE idbarang='$idbarang'");
    $ambildatastock = mysqli_fetch_array($cekstocksekarang);
    $stocksekarang = $ambildatastock['stock'];

    $stockbaru = $stocksekarang - $qty;

    $updatestock = mysqli_query($conn, "UPDATE stock SET stock='$stockbaru' WHERE idbarang='$idbarang'");
    $hapusmasuk = mysqli_query($conn, "DELETE FROM masuk WHERE idbarang='$idbarang'");

    if ($updatestock && $hapusmasuk) {
        header('location:masuk.php');
    } else {
        echo 'Gagal menghapus barang masuk';
    }
}

if (isset($_POST['deleteuser'])) {
    $iduser = $_POST['iduser']; // Ambil iduser dari POST

    // Eksekusi query untuk menghapus data
    $deleteData = mysqli_query($conn, "DELETE FROM login WHERE iduser = '$iduser'");
    if ($deleteData) {
        echo "<script>alert('User berhasil dihapus'); window.location='admin.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus user');</script>";
    }
}

?>