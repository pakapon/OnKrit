<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/controller/Product.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/controller/Customer.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/controller/Project.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/config/globalfuction.php';

$databaseService = new DatabaseService();
$conn = $databaseService->getConnection();

$proService = new ProductService($conn);
$cusService = new CuntomerService($conn);
$prjService = new ProjectService($conn);

$data = null;
$data = new stdClass;

$data->cus = $cusService->countCustomer();
$data->prod = $proService->countProduct();
$data->pro = $prjService->countProject();
$data->csv = $prjService->countService();


?>
 <!-- Vertical Overlay-->
 <div class="vertical-overlay"></div>

 <!-- ============================================================== -->
 <!-- Start right Content here -->
 <!-- ============================================================== -->
 <div class="main-content">

     <div class="page-content">
         <div class="container-fluid">

             <!-- start page title -->
             <div class="row">
                 <div class="col-12">
                     <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                         <h4 class="mb-sm-0">ภาพรวมทั้งหมด</h4>

                         <div class="page-title-right">
                             <ol class="breadcrumb m-0">
                                 <li class="breadcrumb-item"></a></li>
                             </ol>
                         </div>

                     </div>
                 </div>
             </div>
             <div class="row">
                 <div class="col-xl-3 col-md-6">
                     <!-- card -->
                     <div class="card card-animate">
                         <div class="card-body">
                             <div class="d-flex align-items-center">
                                 <div class="flex-grow-1">
                                     <p class="text-uppercase fw-medium text-muted mb-0">All Customers</p>
                                 </div>

                             </div>
                             <div class="d-flex align-items-end justify-content-between mt-4">
                                 <div>
                                     <h4 class="fs-24 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="<?=$data->cus?>"></span> User</h4>
                                 </div>
                                 <div class="avatar-sm flex-shrink-0">
                                     <span class="avatar-title bg-primary-subtle rounded fs-3">
                                         <i class="bx bx-user-circle text-primary"></i>
                                     </span>
                                 </div>
                             </div>
                         </div><!-- end card body -->
                     </div><!-- end card -->
                 </div><!-- end col -->

                 <div class="col-xl-3 col-md-6">
                     <!-- card -->
                     <div class="card card-animate">
                         <div class="card-body">
                             <div class="d-flex align-items-center">
                                 <div class="flex-grow-1">
                                     <p class="text-uppercase fw-medium text-muted mb-0">All Projects
                                     </p>
                                 </div>

                             </div>
                             <div class="d-flex align-items-end justify-content-between mt-4">
                                 <div>
                                     <h4 class="fs-24 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="<?=$data->pro?>"></span> Project</h4>
                                 </div>
                                 <div class="avatar-sm flex-shrink-0">
                                     <span class="avatar-title bg-primary-subtle rounded fs-3">
                                         <i class="bx bx-buildings text-primary"></i>
                                     </span>
                                 </div>
                             </div>
                         </div><!-- end card body -->
                     </div><!-- end card -->
                 </div><!-- end col -->

                 <div class="col-xl-3 col-md-6">
                     <!-- card -->
                     <div class="card card-animate">
                         <div class="card-body">
                             <div class="d-flex align-items-center">
                                 <div class="flex-grow-1">
                                     <p class="text-uppercase fw-medium text-muted mb-0">All Poducts
                                     </p>
                                 </div>

                             </div>
                             <div class="d-flex align-items-end justify-content-between mt-4">
                                 <div>
                                     <h4 class="fs-24 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="<?=$data->prod?>"></span> Product</h4>
                                 </div>
                                 <div class="avatar-sm flex-shrink-0">
                                     <span class="avatar-title bg-primary-subtle rounded fs-3">
                                         <i class="bx bx-store-alt text-primary"></i>
                                     </span>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="col-xl-3 col-md-6">
                     <div class="card card-animate">
                         <div class="card-body">
                             <div class="d-flex align-items-center">
                                 <div class="flex-grow-1">
                                     <p class="text-uppercase fw-medium text-muted mb-0">All Services
                                     </p>
                                 </div>

                             </div>
                             <div class="d-flex align-items-end justify-content-between mt-4">
                                 <div>
                                     <h4 class="fs-24 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="<?=$data->csv?>"></span> Service</h4>
                                 </div>
                                 <div class="avatar-sm flex-shrink-0">
                                     <span class="avatar-title bg-primary-subtle rounded fs-3">
                                         <i class="bx bx-message-rounded-dots text-primary"></i>
                                     </span>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>

     <footer class="footer">
         <div class="container-fluid">
             <div class="row">
                 <div class="col-sm-6">
                     <script>
                         document.write(new Date().getFullYear())
                     </script> Develop By LJ ALL MEDIA CO.,LTD.
                 </div>

             </div>
         </div>
     </footer>
 </div>


 </div>
 <!-- END layout-wrapper -->