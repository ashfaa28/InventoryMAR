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
        <a class="navbar-brand ps-3" href="index.php">Home</a>
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
                    <h1 class="mt-4">Home</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Data data barang</li>
                    </ol>


                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                                Tambah barang
                            </button>
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>Nomor</th>
                                        <th>Nama Barang</th>
                                        <th>Kategori</th>
                                        <th>Harga</th>
                                        <th>Aksi</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $getData = mysqli_query($koneksi, "SELECT *FROM barang");
                                    $no = 1;
                                    while ($data = mysqli_fetch_array($getData)) {
                                        $nama_barang = $data["nama_barang"];
                                        $kategori = $data["kategori"];
                                        $harga = $data["harga_barang"];
                                        $id = $data["id_barang"];

                                    ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $nama_barang; ?></td>
                                            <td><?= $kategori; ?></td>
                                            <td><?= $harga; ?></td>
                                            <td> <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?= $id; ?>">
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
                                                        <h4 class="modal-title">EDIT</h4>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>

                                                    <!-- Modal body -->
                                                    <div class="modal-body">
                                                        <form action="" method="post">
                                                            <input type="text" name="nama_barang" value="<?= $nama_barang; ?>" id="" placeholder="Nama Barang" class="form-control">
                                                            <br>
                                                            <input type="text" name="kategori" id="" value="<?= $kategori; ?>" placeholder="Kategori" class="form-control">
                                                            <br>
                                                            <input type="number" name="harga_barang" value="<?= $harga; ?>" id="" placeholder="Harga Barang" class="form-control">
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
                                                            Apakah anda yakin ingin memnghapus data ini <?= $nama_barang; ?> ?
                                                            <input type="hidden" name="id_barang" value="<?= $id; ?>">
                                                            <br>
                                                            <br>
                                                            <button type="submit" class="btn btn-danger" name="delete_barang">Hapus</button>
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
                    <input type="text" name="nama_barang" id="" placeholder="Nama Barang" class="form-control">
                    <br>
                    <input type="number" name="harga_barang" id="" placeholder="Harga Barang" class="form-control">
                    <br>
                    <input type="number" name="jumlah_barang" id="" placeholder="Jumlah Barang" class="form-control">
                    <br>
                    <input type="text" name="kategori" id="" placeholder="Kategori" class="form-control">
                    <br>
                    <button type="submit" class="btn btn-primary" name="tambah_barang">Tambah</button>
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>

</html>