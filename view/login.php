<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/controller/Auth.php';
session_start();

if (!empty($_POST['username'])) {

    $databaseService = new DatabaseService();
    $authService = new AuthService($databaseService);
    $data = new stdClass();

    $data->users = $_POST['username'];
    $data->passWord = $_POST['password-input'];
    $tokens = $authService->loginUser($data);

    if (empty($tokens)) {
        $error_message = "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง";
    }

    $_SESSION["token"] = $tokens['token'];
    $_SESSION["refreshToken"]  = $tokens['refreshToken'];
}

?>

<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>
    <meta charset="utf-8" />
    <title>ONKRIT POWER CO., LTD. - Admin & Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Layout config Js -->
    <script src="assets/js/layout.js"></script>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/custom.css" rel="stylesheet" type="text/css" />

    <?php
    if (!empty($_SESSION['token'])) {
    ?>
        <div class="modal fade bs-example-modal-center show" style="display: block;background-color: #000000e8; " tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-modal="true" style="display: block;">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body text-center p-5">
                        <div class="mt-4">
                            <h4 class="mb-3">ดำเนินการสำเร็จ!!</h4>
                            <div class="hstack gap-2 justify-content-center mt-2">
                                <a href="index.php?page=dashboard" class="btn btn-lg btn-dark">ดำเนินการต่อ</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    if (isset($error_message)) {
    ?>
        <div class="modal fade bs-example-modal-center show" style="display: block;background-color: #000000e8; " tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-modal="true" style="display: block;">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body text-center p-5">
                        <div class="mt-4">
                            <h4 class="mb-3"><?php echo $error_message; ?></h4>
                            <div class="hstack gap-2 justify-content-center mt-2">
                                <a href="" class="btn btn-lg btn-dark">ดำเนินการต่อ</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
        $_POST['username'] = null;
        $_POST['password-input'] = null;
    }
    ?>
</head>

<body>
    <div class="auth-page-wrapper">
        <div class="container" style="margin-top: 150px;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card ">
                            <div class="card-body">
                                <div class="text-center mt-sm-5 mb-4 text-white-50">
                                    <div>
                                        <a href="index.html" class="d-inline-block auth-logo">
                                            <img src="assets/images/logo-onkritpower-120.png" alt="" height="80">
                                        </a>
                                    </div>
                                </div>
                                <div class="text-center mt-5">
                                    <h3 class="text-primary fw-bold">เข้าสู่ระบบ</h3>
                                    <p class="text-muted text-primary" style="font-size: 15px; ">กรุณาเข้าสู่ระบบโดยใช้อิเมล์ และรหัสผ่านที่ได้รับจากผู้ดูแล</p>
                                </div>
                                <div class="p-2 mt-4">
                                    <form method="post" action="login.php">
                                        <div class="mb-3">
                                            <label for="username" class="form-label fs-5">Email</label>
                                            <input type="text" class="form-control" id="username" name="username" placeholder="Enter Email" value="">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fs-5" for="password-input">Password</label>
                                            <div class="position-relative auth-pass-inputgroup mb-3 ">
                                                <input type="password" class="form-control pe-5 password-input" placeholder="Enter password" name="password-input" id="password-input" value="">
                                                <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                            </div>
                                        </div>
                                        <div class="d-grid gap-2 mt-5">
                                            <button class="btn btn-lg btn-dark" type="submit" id="loginBtn">เข้าสู่ระบบ</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0 text-muted" style="color: black !important;">&copy;
                                <?php echo date("Y"); ?> Develop By LJ ALL MEDIA CO.,LTD.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/feather-icons/feather.min.js"></script>
    <script src="assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="assets/js/plugins.js"></script>

    <!-- particles js -->
    <script src="assets/libs/particles.js/particles.js"></script>
    <!-- particles app js -->
    <script src="assets/js/pages/particles.app.js"></script>
    <!-- password-addon init -->
    <script src="assets/js/pages/password-addon.init.js"></script>
</body>

</html>