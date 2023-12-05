<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>GIS | <?= $judul ?></title>

    <!-- Custom fonts for this template-->
    <link href="<?=base_url('sb-admin-2/')?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?=base_url('sb-admin-2/')?>css/sb-admin-2.min.css" rel="stylesheet">
    <link href="<?=base_url('sb-admin-2/')?>css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom styles for table -->
    <link href="<?=base_url('sb-admin-2/')?>vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- tambahan script untuk map dll -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <!-- Rute -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>  
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
   
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
    
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('Home') ?>">
                <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-globe-asia"></i>
                </div>
                <div class="sidebar-brand-text mx-3">GIS <sup>Prototype_V1.2</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('Home') ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Main Menu
            </div>
            <div class="navbar-collapse">
                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                        aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-map"></i>
                        <span>Peta Dasar</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">View Map:</h6>
                            <a class="collapse-item" href="<?= base_url('Home/baseMap') ?>">Base Map</a>
                            <a class="collapse-item" href="<?= base_url('Home/getCoordinate') ?>">Get Coordinate</a>
                            <!-- <a class="collapse-item" href="?= base_url('Home/Marker') ?>">Mahkota Kerupuk Location</a> -->
                            <!-- <a class="collapse-item" href="?= base_url('Home/geoJSON') ?>">Distribution Area</a> -->
                        </div>
                    </div>
                </li>

                <!-- Nav Item - Utilities Collapse Menu -->
                <?php if (session()->get('level')==1) { ?> 
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                        aria-expanded="true" aria-controls="collapseUtilities">
                        <i class="fas fa-map-marked-alt"></i>
                        <span>Pemetaan Lokasi</span>
                    </a>
                    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                        data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Pemetaan:</h6>
                            <a class="collapse-item" href="<?= base_url('Lokasi/inputLokasi') ?>">Input Lokasi</a>
                            <a class="collapse-item" href="<?= base_url('Lokasi/pemetaanLokasi') ?>">Peta Lokasi</a>
                            <a class="collapse-item" href="<?= base_url('Lokasi/index') ?>">Data Lokasi</a>
                        </div>
                    </div>
                </li>
                <?php } ?>
                <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-route"></i>
                    <span>Pemetaan Rute</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Routing</h6>
                        <a class="collapse-item" href="<?= base_url('Lokasi/rute') ?>">Without GPS</a>
                        <a class="collapse-item" href="<?= base_url('Lokasi/rute2') ?>">With GPS</a>
                        <a class="collapse-item" href="<?= base_url('Lokasi/rute3') ?>">Free Roam</a>
                    </div>
                </div>
            </li>
            
                    <!-- Divider -->
                    <hr class="sidebar-divider">

                    <!-- Heading -->
                    <div class="sidebar-heading">
                        Other
                    </div>

                    <!-- Nav Item - Pages Collapse Menu -->
                    <!-- <li class="nav-item active">
                        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true"
                            aria-controls="collapsePages">
                            <i class="fas fa-fw fa-folder"></i>
                            <span>Pages</span>
                        </a>
                        <div id="collapsePages" class="collapse show" aria-labelledby="headingPages"
                            data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">Login Screens:</h6>
                                <a class="collapse-item" href="login.html">Login</a>
                                <a class="collapse-item" href="register.html">Register</a>
                                <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                                <div class="collapse-divider"></div>
                                <h6 class="collapse-header">Other Pages:</h6>
                                <a class="collapse-item" href="404.html">404 Page</a>
                                <a class="collapse-item active" href="blank.html">Blank Page</a>
                            </div>
                        </div>
                    </li> -->

                    <!-- Nav Item - Charts -->
                    <li class="nav-item">
                        <a class="nav-link" href="charts.html">
                        <i class="fas fa-info-circle"></i>
                            <span>About</span></a>
                    </li>

                    <!-- Nav Item - Tables -->
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="tables.html">
                            <i class="fas fa-fw fa-table"></i>
                            <span>Tables</span></a>
                    </li> -->
                
                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">

                <!-- Sidebar Toggler (Sidebar) -->
                <div class="menucenter">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>
                        <!-- Nav Item - User Information -->
                        <li></li>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= session()->get('nama_user')?></span>
                                <img class="img-profile rounded-circle" 
                                    src="<?= base_url('foto_user/'.session()->get('foto_user')) ?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                            <div class="card card-primary card-outline">
                                <div class="card-body box-profile">
                                    <div class="text-center">
                                    <img class="img-profile rounded-circle" width="100px" height="100px"
                                        src="<?= base_url('foto_user/'.session()->get('foto_user')) ?>"
                                        alt="User profile picture">
                                    </div>

                                    <h3 class="profile-username text-center"><?= session()->get('nama_user')?></h3>

                                    <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        
                                        <center><?= session()->get('email')?></center>
                                        <center>
                                        <?php if (session()->get('level') ==1) {
                                            echo 'Admin';
                                        }else if (session()->get('level') ==2) {
                                            echo 'User';
                                        } ?>
                                    </center>
                                    </li>
                                    </ul>

                                    <a href="#" class="btn btn-primary btn-block"><b>Profile</b></a>
                                    <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                                </div>
                            </div>
                            
                            <!-- <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div> -->
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $judul ?></h1>
                    <hr>
                    <?php if ($page) {
                        echo view($page);
                    } ?>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Taufiq Hidayat 2023</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
            
        </div>
        <!-- End of Content Wrapper -->
    
    </div>
    <!-- End of Page Wrapper -->
    
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?= base_url('Auth/logout') ?>">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?=base_url('sb-admin-2/')?>vendor/jquery/jquery.min.js"></script>
    <script src="<?=base_url('sb-admin-2/')?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?=base_url('sb-admin-2/')?>vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?=base_url('sb-admin-2/')?>js/sb-admin-2.min.js"></script>

    <!-- Page level plugins for table-->
    <script src="<?=base_url('sb-admin-2/')?>vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?=base_url('sb-admin-2/')?>vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts table -->
    <script src="<?=base_url('sb-admin-2/')?>js/demo/datatables-demo.js"></script>
</body>

</html>