<?php

$koneksi = mysqli_connect("localhost", "root", "2007hadi", "coba");

//tambah data coy
if (isset($_POST['tambah_barang'])) {
    $nama_barang = htmlspecialchars($_POST["nama_barang"]);
    $harga_barang = htmlspecialchars($_POST["harga_barang"]);
    $jumlah_barang = htmlspecialchars($_POST["jumlah_barang"]);
    $kategori = htmlspecialchars($_POST["kategori"]);
    $sql = "INSERT INTO barang(nama_barang,jumlah_barang,harga_barang,kategori) VALUES('$nama_barang','$jumlah_barang','$harga_barang','$kategori')";
    $hasil = mysqli_query($koneksi, $sql);

    if ($hasil) {
        header('location:home.php');
    } else {
        echo "<script>
    alert('tambah barang GAGAL!!!!!!!!!!!!');
    history.go(-1);
    </script>";
    }
};

//edit stock barang
if (isset($_POST['editstock'])) {
    $idbs = $_POST['idbs'];
    $nama_barangs = $_POST['nama_barang'];
    $harga_barangs = $_POST['harga_barang'];
    $jumlah_barangs = $_POST['jumlah_barang'];
    $kategoris = $_POST['kategori'];

    mysqli_query($koneksi, "UPDATE barang SET  nama_barang='$nama_barangs',
    harga_barang='$harga_barangs',jumlah_barang='$jumlah_barangs',kategori = '$kategoris' WHERE id_barang = '$idbs'") or die(mysqli_error($koneksi));

    header("Location:stock_barang.php");
    exit();
}

//hapus stock
if (isset($_POST['delete_stock'])) {

    $iddel = $_POST['id_barang'];
    $sqldel = "DELETE  FROM barang WHERE id_barang ='$iddel'";
    $get_datadel = mysqli_query($koneksi, $sqldel);

    header("Location: stock_barang.php");
    exit();
}


//barang masuk supplier coy
if (isset($_POST['barang_masuk'])) {

    $namaPT = $_POST["nama_pt"];
    $nama_barang_pilihan = $_POST["barang_pilihan"];
    $jumlah = $_POST["jumlah_barang_masuk"];
    $tanggal = $_POST["tanggal_masuk_barang"];

    $jumlah_barang_new = mysqli_query($koneksi, "SELECT * FROM barang WHERE nama_barang='$nama_barang_pilihan' ");
    $get_data2 = mysqli_fetch_array($jumlah_barang_new);

    $stock_sekarang = $get_data2["jumlah_barang"];
    $tambah_jumlah_barang = $stock_sekarang + $jumlah;

    $sql_supp = "INSERT INTO barang_supplier(nama_pt,nama_barang,jumlah_barang_masuk,tanggal_masuk_barang) VALUES ('$namaPT','$nama_barang_pilihan','$jumlah','$tanggal')";
    $hasil = mysqli_query($koneksi, $sql_supp);
    $update_barang_supp = mysqli_query($koneksi, "UPDATE barang set jumlah_barang='$tambah_jumlah_barang' WHERE nama_barang='$nama_barang_pilihan' ");

    if ($hasil && $update_barang_supp) {
        header('location:supplier.php');
    } else {
        echo "<script>
    alert('tambah barang GAGAL!!!!!!!!!!!!');
    history.go(-1);
    </script>";
    }
};


//edit barang
if (isset($_POST['edit_barang'])) {
    $id = $_POST['id_barang'];
    $nama_barang = $_POST['nama_barang'];
    $harga_barang = $_POST['harga_barang'];
    $jumlah_barang = $_POST['jumlah_barang'];
    $kategori = $_POST['kategori'];

    mysqli_query($koneksi, "UPDATE barang SET  nama_barang='$nama_barang',
    harga_barang='$harga_barang',jumlah_barang='$jumlah_barang',kategori = '$kategori' WHERE id_barang = '$id'") or die(mysqli_error($koneksi));

    header("Location:home.php");
    exit();
}

//hapus barang
if (isset($_POST['delete_barang'])) {

    $id = $_POST['id_barang'];
    $sql = "DELETE  FROM barang WHERE id_barang ='$id'";
    $get_data = mysqli_query($koneksi, $sql);

    header("Location: home.php");
    exit();
}

//BAN customer
if (isset($_POST['ban'])) {

    $idc = $_POST['id_customer'];
    $sql = "DELETE  FROM customer WHERE id_customer ='$idc'";
    $get_data = mysqli_query($koneksi, $sql);

    header("Location: customer.php");
    exit();
}

//Daftar pesanan
if (isset($_POST['Pesan'])) {

    $nama_pemesan = $_POST["nama_pemesan"];
    $barang_pilihan = $_POST["barang_pilihan"];
    $jumlahBR = $_POST["jumlah_pesanan"];

    $jumlah_barang_new_pesanan = mysqli_query($koneksi, "SELECT * FROM barang WHERE nama_barang='$barang_pilihan' ");
    $get_data3 = mysqli_fetch_array($jumlah_barang_new_pesanan);

    $stock_rn = $get_data3["jumlah_barang"];
    $hasil_jumlah_barang = $stock_rn - $jumlahBR;

    $sql_pesan = "INSERT INTO pesanan(nama_pemesan,nama_barang,jumlah_barang) VALUES ('$nama_pemesan','$barang_pilihan','$jumlahBR')";
    $hasil_pesanan = mysqli_query($koneksi, $sql_pesan);
    $update_barang_pesan = mysqli_query($koneksi, "UPDATE barang set jumlah_barang='$hasil_jumlah_barang' WHERE nama_barang='$barang_pilihan' ");

    if ($hasil_pesanan && $update_barang_pesan) {
        header('location:pesanan.php');
    } else {
        echo "<script>
    alert('tambah barang GAGAL!!!!!!!!!!!!');
    history.go(-1);
    </script>";
    }
};
