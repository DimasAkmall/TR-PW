<?php
session_start();
include "../Controller/KategoriController.php";

$username = $_SESSION["username"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard Admin</title>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link rel="stylesheet" href="../Asset/css/StyleAdmin.css">
    <!-- css gg  -->
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/menu.css' rel='stylesheet'>
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/math-plus.css' rel='stylesheet'>
    <style>
        /* CSS untuk menghilangkan border pada card */
        .card {
            box-shadow: 0 1px 6px 0 rgba(49, 53, 59, 0.12);
            border: none;
            opacity: 0.9;
        }

        .title-body {
            font-weight: 700;
            font-size: 22px;
            color: #0086ad;
            margin-bottom: 20px;
        }

        /* Gaya tombol */
        .btn-edit,
        .btn-delete {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 5px 10px;
            cursor: pointer;
            margin-right: 5px;
        }

        /* Gaya tombol saat di-hover */
        .btn-edit:hover,
        .btn-delete:hover {
            background-color: #0062cc;
        }
    </style>
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar-->
        <div class="border-end bg-white" id="sidebar-wrapper">
        <div class="sidebar-heading border-bottom bg-light fs-4 py-1 fw-semibold"><img src="../Asset/image/BelanjainLogoNav.png" alt="" height="43"></div>
            <div class="list-group list-group-flush">
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="DashAdmin.php">Dashboard</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="BarangAdmin.php">Barang</a>
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="KategoriAdmin.php">Kategori</a>

                <?php if ($_SESSION["role"] == "superadmin") { ?>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="AdminAdmin.php">Administrator</a>
                <?php } else { ?>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="UserAdmin.php">Pengguna</a>
                <?php } ?>
                <a class="list-group-item list-group-item-action list-group-item-light p-3" href="HistoryAdmin.php">History</a>
            </div>
        </div>
        <!-- Page content wrapper-->
        <div id="page-content-wrapper" style="background-color: #f1f1f1;">
            <!-- Top navigation-->
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <div class="container-fluid">
                    <button class="btn p-3" id="sidebarToggle"><i class="gg-menu"></i></button>
                    <div class="nav-item dropdown ms-3">
                        <a class="nav-link dropdown-toggle m-auto text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" id="toggler">
                            <img src=" ../Asset/image/user.png" alt="" class="rounded-circle" width="35" height="35" />
                            <span id="usernameField"><?= $username ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="../Controller/LogoutController.php">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Page content-->
            <div class="container mt-4">
                <div class="row">
                    <div class="container">
                        <div class="card" style="padding: 10px;">
                            <div class="card-header">
                                <div class="content-header">
                                    <h2 class="text-header">Kategori View</h2>
                                    <?php if ($_SESSION["role"] == "superadmin") { ?>
                                        <button class="btn p-0 mb-3 mt-3" onclick="window.location.href='InputKategoriAdmin.php'">
                                            <span class="d-flex align-items-center">
                                                <i class="gg-math-plus" style="margin-right: 5px;"></i>
                                                <span class="fw-bold">Add Kategori</span>
                                            </span>
                                        </button>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="card-body p-0 overflow-auto">
                                <table class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th>Kategori</th>
                                            <th>Gambar</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($kategori->getAll() as $k) {
                                        ?>
                                            <tr>
                                                <td class=" text-center"><?= $no++ ?></td>
                                                <td><?= $k['kategori'] ?></td>
                                                <td><?= $k["gambar"] ?></td>
                                                <td class="text-center">
                                                    <div class="d-flex flex-row">
                                                        <form action="EditKategoriAdmin.php" method="post">
                                                            <input type="hidden" name="id" value="<?= $k["id"] ?>">
                                                            <button class="btn btn-warning border-secondary me-1" type="submit" name="" <?php if ($_SESSION["role"] == "admin") {
                                                                                                                                            echo "disabled";
                                                                                                                                        } ?>><img src="../Asset/image/edit.png" alt=""></button>
                                                        </form>
                                                        <form action="../Controller/KategoriController.php" method="post">
                                                            <input type="hidden" name="id" value="<?= $k["id"] ?>">
                                                            <button class="btn btn-danger border-secondary" type="submit" name="deleteKategori" <?php if ($_SESSION["role"] == "admin") {
                                                                                                                                                    echo "disabled";
                                                                                                                                                } ?>><img src="../Asset/image/trash.png" alt=""></button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function promptJumlah(id) {
            newKategori = prompt("masukkan kategori baru");
            if (newKategori == null) {
                return alert("Ndak boleh yaa!")
            } else {
                document.querySelector("#newKategori" + id).setAttribute("value", "")
                return document.querySelector("#newKategori" + id).setAttribute("value", newKategori)
            }
        }
    </script>
    <!-- Core theme JS-->
    <script src="../Asset/js/scripts.js"></script>
    <script src="../Asset/js/ResponsiveNavUser.js"></script>
</body>

</html>