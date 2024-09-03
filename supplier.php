<?php

require "koneksi.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - SB Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="supplier.php">Supplier</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="login.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Halaman</div>

                        <a class="nav-link" href="home.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Home
                        </a>
                        <a class="nav-link" href="customer.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Customer
                        </a>
                        <a class="nav-link" href="pesanan.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Pesanan
                        </a>
                        <a class="nav-link" href="supplier.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Supplier
                        </a>
                        <a class="nav-link" href="stock_barang.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Stock Barang
                        </a>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as: Admin</div>

                    </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Supplier</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Data barang yang dikirim kan supplier</li>
                    </ol>


                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                                Tambah Supplier
                            </button>
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama PT</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah Barang Masuk</th>
                                        <th>Tanggal Barang Masuk</th>
                                        <th>Aksi</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $getData = mysqli_query($koneksi, "SELECT *FROM barang_supplier");
                                    $no = 1;
                                    while ($data = mysqli_fetch_array($getData)) {
                                        $id = $data["id_supp"];
                                        $nama_ = $data["nama_pt"];
                                        $nama_barang = $data["nama_barang"];
                                        $jumlah_barang_masuk = $data["jumlah_barang_masuk"];
                                        $tanggal = $data["tanggal_masuk_barang"];


                                    ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $nama_; ?></td>
                                            <td><?= $nama_barang; ?></td>
                                            <td><?= $jumlah_barang_masuk; ?></td>
                                            <td><?= $tanggal; ?></td>
                                            <td>
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?= $id; ?>">
                                                    Edit
                                                </button>
                                                <input type="hidden" name="id_barang_yang_mau_dihapus" value="<?= $id; ?>">
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?= $id; ?>">
                                                    Hapus
                                                </button>
                                            </td>
                                        </tr>
                                        <!-- The Modal EDIT -->
                                        <div class="modal fade" id="edit<?= $id; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Edit barang</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <div class="modal-body">
                                                        <form action="" method="post">
                                                            <input type="text" name="nama_pt" value="<?= $nama_; ?>" id="" placeholder="Nama pt" class="form-control">
                                                            <br>
                                                            <input type="text" name="nama_barang" value="<?= $nama_barang; ?>" id="" placeholder="Nama Barang" class="form-control">
                                                            <br>
                                                            <input type="number" name="$jumlah_barang_masuk" value="<?= $jumlah_barang_masuk; ?>" id="" placeholder="Jumlah Barang Masuk" class="form-control">
                                                            <br>
                                                            <input type="date" name="tanggal" id="" value="<?= $tanggal; ?>" placeholder="Kategori" class="form-control">
                                                            <br>
                                                            <input type="hidden" name="id_barang" value="<?= $id; ?>">
                                                            <button type="submit" class="btn btn-primary" name="edit_barang">EDIT</button>
                                                        </form>
                                                    </div>

                                                    <!-- Modal footer -->
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- The Modal DELETE -->
                                        <div class="modal fade" id="delete<?= $id; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <!-- Modal Header -->
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">DELETE ?</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <form action="" method="post">
                                                        <div class="modal-body">
                                                            Apakah anda yakin ingin menghapus data ini ?
                                                            <input type="hidden" name="id_barang" value="<?= $id; ?>">
                                                            <br>
                                                            <br>
                                                            <button type="submit" class="btn btn-danger" name="delete_supp">Hapus</button>
                                                        </div>
                                                    </form>

                                                    <!-- Modal footer -->
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    };
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
</body>

<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Tambah barang</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="" method="post">
                    <input type="text" name="nama_pt" id="" placeholder="Nama PT" class="form-control">
                    <br>
                    <select name="barang_pilihan" id="" placeholder="Nama Barang" class="form-control">
                        <?php
                        $get_all_data = mysqli_query($koneksi, "SELECT * FROM barang");
                        while ($fetcharrray = mysqli_fetch_array($get_all_data)) {
                            $nama_barang = $fetcharrray['nama_barang'];
                            $jumlah_barang = $fetcharrray['jumlah_barang'];
                            $harga_barang = $fetcharrray['harga_barang'];
                            $kategori = $fetcharrray['kategori'];
                            $idbarangnya = $fetcharrray['id_barang'];

                        ?>
                            <option value="<?= $nama_barang ?>"><?= $nama_barang ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <br>
                    <input type="number" min="1" name="jumlah_barang_masuk" id="" placeholder="Jumlah Barang Masuk" class="form-control">
                    <br>
                    <input type="date" name="tanggal_masuk_barang" id="" placeholder="Tanggal barang masuk" class="form-control">
                    <br>
                    <button type="submit" class="btn btn-primary" name="barang_masuk">Tambah</button>
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>




</html>