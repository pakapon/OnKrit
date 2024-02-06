<?PHP
session_start();
if (empty($_SESSION['token'])) {
?>
    <div class="modal fade bs-example-modal-center show" style="display: block;background-color: #000000e8; " tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-modal="true" style="display: block;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center p-5">
                    <div class="mt-4">
                        <h4 class="mb-3">กรุณาเข้าสู่ระบบอีกครั้ง!!</h4>
                        <div class="hstack gap-2 justify-content-center mt-2">
                            <a href="login.php" class="btn btn-lg btn-dark">ดำเนินการต่อ</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
}
$active = null;
$subactive = null;
switch ($_GET["page"]) {
    case "dashboard":
        $active[1] = 1;
        break;
    case "adduser":
        $active[2] = 1;
        $subactive[21] = 1;
        break;
    case "listuser":
        $active[2] = 1;
        $subactive[22] = 1;
        break;
    case "useredit":
        $active[2] = 1;
        $subactive[22] = 1;
        break;
    case "addSolar":
        $active[3] = 1;
        $subactive[31] = 1;
        break;
    case "addVE":
        $active[3] = 1;
        $subactive[32] = 1;
    case "listProject":
        $active[3] = 1;
        $subactive[33] = 1;
        break;
    case "addProduct":
        $active[4] = 1;
        $subactive[41] = 1;
        break;
    case "viewProduct":
        $active[4] = 1;
        $subactive[42] = 1;
        break;
    case "editProduct":
        $active[4] = 1;
        $subactive[42] = 1;
        break;
    case "addProductType":
        $active[4] = 1;
        $subactive[43] = 1;
        break;
    case "dockStore":
        $active[6] = 1;
        break;
        // สามารถเพิ่ม case อื่นๆ ตามที่ต้องการ
    default:
        $active[1] = 1;
        // สามารถใส่โค้ดสำหรับการจัดการเมื่อไม่ตรงกับ case ใดๆ
        break;
}
?>

<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="light" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>
    <meta charset="utf-8" />
    <title>ONKRIT POWER CO., LTD. - Admin & Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- One of the following themes -->
    <link rel="stylesheet" href="assets/libs/@simonwep/pickr/themes/classic.min.css" /> <!-- 'classic' theme -->
    <link rel="stylesheet" href="assets/libs/@simonwep/pickr/themes/monolith.min.css" /> <!-- 'monolith' theme -->
    <link rel="stylesheet" href="assets/libs/@simonwep/pickr/themes/nano.min.css" /> <!-- 'nano' theme -->

    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

    <!-- Layout config Js -->
    <script src="assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="assets/css/custom.css" rel="stylesheet" type="text/css" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">



</head>

<body>
    <div id="layout-wrapper">
        <header id="page-topbar">
            <div class="layout-width">
                <div class="navbar-header">
                    <div class="d-flex">
                        <div class="navbar-brand-box horizontal-logo">
                            <a href="home.php?page=dashboard" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="assets/images/logo-sm.png" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="assets/images/logo-dark.png" alt="" height="17">
                                </span>
                            </a>

                            <a href="home.php?page=dashboard" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="assets/images/logo-sm.png" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="assets/images/logo-light.png" alt="" height="17">
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger" id="topnav-hamburger-icon">
                            <span class="hamburger-icon">
                                <span></span>
                                <span></span>
                                <span></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </header>
        <div class="app-menu navbar-menu">
            <div class="navbar-brand-box">
                <a href="home.php?page=dashboard" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="assets/images/logo-sm.png" alt="" height="30">
                    </span>
                    <span class="logo-lg">
                        <img src="assets/images/logo-dark.png" alt="" height="60">
                    </span>
                </a>
                <a href="home.php?page=dashboard" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="assets/images/logo-sm.png" alt="" height="30">
                    </span>
                    <span class="logo-lg">
                        <img src="assets/images/logo-light.png" alt="" height="60">
                    </span>
                </a>
                <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
                    <i class="ri-record-circle-line"></i>
                </button>
            </div>

            <div id="scrollbar">
                <div class="container-fluid">

                    <div class="text-center mt-sm-5 mb-4 text-white-50">
                        <div>
                            <a href="home.php?page=dashboard" class="d-block d-sm-none">
                                <img src="assets/images/logo-onkritpower-120.png" alt="" height="60">
                            </a>
                        </div>
                    </div>

                    <div id="two-column-menu">
                        <div class="text-center mt-sm-5 mb-4 text-white-50">
                        </div>
                    </div>
                    <ul class="navbar-nav" id="navbar-nav">
                        <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                        <li class="nav-item">
                            <a class="nav-link menu-link <?php echo $active[1] == 1 ? 'active' : ''; ?>" href="home.php?page=dashboard">
                                <i data-feather="monitor" class="icon-dual"></i> <span data-key="t-widgets">ภาพรวม</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link <?php echo $active[2] == 1 ? 'active' : ''; ?>" href="#sidebarApps1" data-bs-toggle="collapse" role="button" aria-expanded="<?php echo $active[2] == 1 ? 'true' : 'false'; ?>" aria-controls="sidebarApps">
                                <i data-feather="user" class="icon-dual"></i> <span data-key="t-apps1">จัดการลูกค้า</span>
                            </a>
                            <div class="collapse menu-dropdown <?php echo $active[2] == 1 ? 'show' : ''; ?>" id="sidebarApps1">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="home.php?page=adduser" class="nav-link fs-15  <?php echo $subactive[21] == 1 ? 'active' : ''; ?>" data-key="t-api-key">เพิ่มลูกค้า</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="home.php?page=listuser" class="nav-link fs-15 <?php echo $subactive[22] == 1 ? 'active' : ''; ?>" data-key="t-api-key">รายการลูกค้า</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link <?php echo $active[3] == 1 ? 'active' : ''; ?>" href="#sidebarApps2" data-bs-toggle="collapse" role="button" aria-expanded="<?php echo $active[3] == 1 ? 'true' : 'false'; ?>" aria-controls="sidebarApps">
                                <i data-feather="trello" class="icon-dual"></i> <span data-key="t-apps2">จัดการโครงการ</span>
                            </a>
                            <div class="collapse menu-dropdown <?php echo $active[3] == 1 ? 'show' : ''; ?>" id="sidebarApps2">
                                <ul class="nav nav-sm flex-column">

                                    <li class="nav-item">
                                        <a href="#sidebarCrm" class="nav-link collapsed fs-15" data-bs-toggle="collapse" role="button" aria-expanded="<?php echo $active[3] == 1 ? 'true' : 'false'; ?>" aria-controls="sidebarCrm" data-key="t-level-2.2"> เพิ่มโครงการ
                                        </a>
                                        <div class="collapse menu-dropdown <?php echo $active[3] == 1 ? 'show' : ''; ?>" id="sidebarCrm">
                                            <ul class="nav nav-sm flex-column">
                                                <li class="nav-item">
                                                    <a href="home.php?page=addSolar" class="nav-link fs-14 <?php echo $subactive[31] == 1 ? 'active' : ''; ?>" data-key="t-level-3.1"> เพิ่มโครงการโซลาร์เซลล์
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="home.php?page=addVE" class="nav-link fs-14 <?php echo $subactive[32] == 1 ? 'active' : ''; ?>" data-key="t-level-3.2"> เพิ่มโครงการอีวีชาร์จเจอร์
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>

                                    <li class="nav-item">
                                        <a href="home.php?page=listProject" class="nav-link fs-15 <?php echo $subactive[33] == 1 ? 'active' : ''; ?>" data-key="t-api-key">รายการโครงการ</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link <?php echo $active[4] == 1 ? 'active' : ''; ?>" href="#sidebarApps4" data-bs-toggle="collapse" role="button" aria-expanded="<?php echo $active[4] == 1 ? 'true' : 'false'; ?>" aria-controls="sidebarApps">
                                <i data-feather="trello" class="icon-dual"></i> <span data-key="t-apps2">สินค้า</span>
                            </a>
                            <div class="collapse menu-dropdown <?php echo $active[4] == 1 ? 'show' : ''; ?>" id="sidebarApps4">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="home.php?page=addProduct" class="nav-link fs-15 <?php echo $subactive[41] == 1 ? 'active' : ''; ?>" data-key="t-api-key">เพิ่มสินค้า</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="home.php?page=viewProduct" class="nav-link fs-15 <?php echo $subactive[42] == 1 ? 'active' : ''; ?>" data-key="t-api-key">รายการสินค้า</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="home.php?page=addProductType" class="nav-link fs-15 <?php echo $subactive[43] == 1 ? 'active' : ''; ?>" data-key="t-api-key">จัดการหน่วยสินค้า</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link <?php echo $active[5] == 1 ? 'active' : ''; ?>" href="#sidebarApps6" data-bs-toggle="collapse" role="button" aria-expanded="<?php echo $active[5] == 1 ? 'true' : 'false'; ?>" aria-controls="sidebarApps">
                                <i data-feather="printer" class="icon-dual"></i> <span data-key="t-apps5">พิมพ์เอกสาร</span>
                            </a>
                            <div class="collapse menu-dropdown <?php echo $active[5] == 1 ? 'show' : ''; ?>" id=" sidebarApps6">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="home.php?page=222" class="nav-link fs-15 <?php echo $subactive[51] == 1 ? 'active' : ''; ?>" data-key="t-api-key">พิมพ์ใบรับประกัน</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="home.php?page=2222" class="nav-link fs-14 <?php echo $subactive[52] == 1 ? 'active' : ''; ?>" data-key="t-api-key">พิมพ์รายงานบริการ</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link <?php echo $active[6] == 1 ? 'active' : ''; ?>" href="home.php?page=dockStore">
                                <i data-feather="book" class="icon-dual"></i> <span data-key="t-widgets">คลังเอกสาร</span>
                            </a>
                        </li>
                        <li class="nav-item mt-4">
                            <a class="nav-link menu-link" href="logout.php">
                                <i data-feather="log-out" class="icon-dual"></i> <span data-key="t-widgets">ออกจากระบบ</span>
                            </a>
                        </li>

                    </ul>
                </div>
                <!-- Sidebar -->
            </div>

            <div class="sidebar-background"></div>
        </div>
        <!-- Left Sidebar End -->

        <?php
        switch ($_GET["page"]) {
            case "dashboard":
                include 'dashboard.php';
                break;
            case "adduser":
                include 'customer/useradd.php';
                break;
            case "listuser":
                include 'customer/userlist.php';
                break;
            case "useredit":
                include 'customer/useredit.php';
                break;
            case "addProduct":
                include 'product/addProduct.php';
                break;
            case "viewProduct":
                include 'product/viewProduct.php';
                break;
            case "editProduct":
                include 'product/editProduct.php';
                break;
            case "addProductType":
                include 'product/addProductType.php';
                break;
            case "addSolar":
                include 'project/addSolar.php';
                break;
            case "addVE":
                include 'project/addSolar.php';
                break;
            case "listProject":
                include 'project/listProject.php';
                break;
            case "dockStore":
                include 'documentstore/dockStore.php';
                break;
                // สามารถเพิ่ม case อื่นๆ ตามที่ต้องการ

            default:
                include 'dashboard.php';
                break;
        }

        ?>

        <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
            <i class="ri-arrow-up-line"></i>
        </button>
        <div id="preloader">
            <div id="status">
                <div class="spinner-border text-primary avatar-sm" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>

        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>
        <script src="assets/libs/feather-icons/feather.min.js"></script>
        <script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
        <script src="assets/js/plugins.js"></script>


        <!-- Modern colorpicker bundle -->
        <script src="assets/libs/@simonwep/pickr/pickr.min.js"></script>

        <!-- init js -->
        <script src="assets/js/pages/form-pickers.init.js"></script>

        <!-- App js -->
        <script src="assets/js/app.js"></script>
        
    <!-- JAVASCRIPT -->
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="assets/js/plugins.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!--datatable js-->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <script src="assets/js/pages/datatables.init.js"></script>
    <!-- App js -->
    <script src="assets/js/app.js"></script>


</body>

</html>