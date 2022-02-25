<?php 

    $date            = "";
    $to_doctor       = "";
    $patient_id      = "";
    $fullname        = "";
    $age             = "";
    $gender          = "";
    $address         = "";
    $chief_complaint = "";
    $illness_history = "";
    $medicine_given  = "";
    $impression      = "";
    $referral_reason = "";
    if ($data) {
        $date            = $data->date ?? "";
        $to_doctor       = $data->to_doctor ?? "";
        $patient_id      = $data->patient_id ?? "";
        $fullname        = $data->fullname ?? "";
        $age             = $data->age ?? "";
        $gender          = $data->gender ?? "";
        $address         = $data->address ?? "";
        $chief_complaint = $data->chief_complaint ?? "";
        $illness_history = $data->illness_history ?? "";
        $medicine_given  = $data->medicine_given ?? "";
        $impression      = $data->impression ?? "";
        $referral_reason = $data->referral_reason ?? "";
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> | Clinic Management System</title>
    <!-- base:css -->
    <link rel="stylesheet" href="<?= base_url('assets/vendors/mdi/css/materialdesignicons.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendors/css/vendor.bundle.base.css') ?>">
    <!-- endinject -->

    <!-- plugin css for this page -->
    <link rel="stylesheet" href="<?= base_url('assets/vendors/jqvmap/jqvmap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendors/flag-icon-css/css/flag-icon.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendors/font-awesome/css/font-awesome.min.css') ?>"/>
    <link rel="stylesheet" href="<?= base_url('assets/vendors/jquery-toast-plugin/jquery.toast.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/daterangepicker.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendors/fullcalendar/fullcalendar.min.css') ?>">
    <!-- End plugin css for this page -->

    <!-- inject:css -->
    <link rel="stylesheet" href="<?= base_url('assets/css/vertical-layout-light/style.css') ?>">
    <!-- endinject -->
    <link rel="shortcut icon" href="<?= base_url('assets/images/favicon.png') ?>" />

    <!-- Font Awesome -->
    <link href="<?= base_url('assets/css/fontawesome.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/brands.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/solid.css') ?>" rel="stylesheet">

    <!-- jQuery -->
    <link rel="stylesheet" href="<?= base_url('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') ?>">
    <script src="<?= base_url('assets/js/jquery-3.2.1.min.js') ?>"></script>
    <!-- End jQuery -->

    <!-- Sweet Alert -->
    <link rel="stylesheet" href="<?=base_url('assets/css/sweetalert2.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/css/sweetalert2.min.css')?>">

    <script src="<?=base_url('assets/js/sweetalert2.all.min.js')?>"></script>
    <script src="<?=base_url('assets/js/sweetalert2.min.js')?>"></script>
    <!-- End Sweet Alert -->

    <link rel="stylesheet" href="<?= base_url('assets/css/custom-general.css') ?>">

    <style>
        body {
            font-size: 1.15rem;
        }
        .border-bottom {
            border-bottom: 1px solid #000000 !important;
        }
    </style>
</head>
<body>
    
    <div class="container-fluid p-3 pb-5" id="pageContent">

        <div class="d-flex justify-content-start align-items-center border-bottom pb-3">
            <div>
                <img src="<?= base_url('assets/images/modules/bsu-logo.png') ?>"
                    height="100" width="100">
            </div>
            <div class="ml-4">
                <div>Republic of the Philippines</div>
                <div><b>CENTRAL BICOL STATE UNIVERSITY OF AGRICULTURE</b></div>
                <div>Impig, Sipocot, Camarines Sur - 4408</div>
                <div><i>Website: <a href="www.cbsua.edu.ph" target="_blank">www.cbsua.edu.ph</a></i></div>
            </div>
        </div>

        <div class="mt-3">
            <h4 class="text-center my-2 font-weight-bold">INFIRMARY</h4>
            <h4 class="text-center my-2 font-weight-light">REFERRAL FORM</h4>
        </div>

        <div class="w-100 pr-3">
            <div class="d-flex justify-content-end">Date: <div class="mx-2 border-bottom w-25"><?= date("F d, Y", strtotime($date)) ?></div></div>
        </div>

        <div class="w-100 pl-3">
            <div class="d-flex">To Dr. <div class="mx-2 border-bottom w-25"><?= $to_doctor ?>,</div></div>
        </div>

        <br><br>
        <div class="w-100 px-3">
            <div class="text-justify d-flex" style="white-space: nowrap">
                Patient's Name: <div class="mx-2 border-bottom w-50"><?= $fullname ?></div> 
                Age: <div class="mx-2 border-bottom w-25"><?= $age ?></div> 
                Sex: <div class="mx-2 border-bottom w-25"><?= $gender ?></div>
            </div>
        </div>

        <br>
        <div class="w-100 px-3">
            <div class="text-justify" style="white-space: nowrap">
                Patient's Address:<br>
                <div class="mx-2 border-bottom w-100" style="white-space: break-spaces;"><?= $address ?></div> 
            </div>
        </div>

        <br>
        <div class="w-100 px-3">
            <div class="text-justify" style="white-space: nowrap">
                Chief Complaint/s:<br>
                <div class="mx-2 border-bottom w-100" style="white-space: break-spaces;"><?= $chief_complaint ?></div> 
            </div>
        </div>

        <br>
        <div class="w-100 px-3">
            <div class="text-justify" style="white-space: nowrap">
                History of Present Illness:<br>
                <div class="mx-2 border-bottom w-100" style="white-space: break-spaces;"><?= $illness_history ?></div> 
            </div>
        </div>

        <br>
        <div class="w-100 px-3">
            <div class="text-justify" style="white-space: nowrap">
                Medicines given:<br>
                <div class="mx-2 border-bottom w-100" style="white-space: break-spaces;"><?= $medicine_given ?></div> 
            </div>
        </div>

        <br>
        <div class="w-100 px-3">
            <div class="text-justify" style="white-space: nowrap">
                Impression:<br>
                <div class="mx-2 border-bottom w-100" style="white-space: break-spaces;"><?= $impression ?></div> 
            </div>
        </div>

        <br>
        <div class="w-100 px-3">
            <div class="text-justify" style="white-space: nowrap">
                Reason for Referral: 
                <div class="pl-5 mx-2 w-100">
                    <div>
                        <input type="checkbox" 
                            <?= $referral_reason == "For further evaluation and management" ? "checked" : "" ?> 
                            disabled> For further evaluation and management.
                    </div>
                    <div>
                        <input type="checkbox" 
                            <?= $referral_reason == "As requested by relatives of patient/patient" ? "checked" : "" ?> 
                            disabled> As requested by relatives of patient/patient. 
                    </div>
                </div> 
                <div class="pl-3">Thank you.</div>
            </div>
        </div>

        <br><br>
        <div class="w-50 float-right">
            <div>Respectfully yours,</div>
            <div class="border-bottom" style="height: 50px;"></div>
            <div class="text-center">CBSUA, University Physician/ Nurse</div>
        </div>

    </div>

    <!-- base:js -->
    <script src="<?= base_url('assets/vendors/js/vendor.bundle.base.js') ?>"></script>
    <!-- endinject -->

    <!-- Plugin js for this page-->
    <script src="<?= base_url('assets/vendors/jquery.flot/jquery.flot.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/jquery.flot/jquery.flot.pie.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/jquery.flot/jquery.flot.resize.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/jqvmap/jquery.vmap.min.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/jqvmap/maps/jquery.vmap.world.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/jqvmap/maps/jquery.vmap.usa.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/peity/jquery.peity.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/jquery.flot.dashes.js') ?>"></script>
    <!-- End plugin js for this page-->

    <!-- inject:js -->
    <script src="<?= base_url('assets/js/off-canvas.js') ?>"></script>
    <script src="<?= base_url('assets/js/hoverable-collapse.js') ?>"></script>
    <script src="<?= base_url('assets/js/template.js') ?>"></script>
    <script src="<?= base_url('assets/js/settings.js') ?>"></script>
    <script src="<?= base_url('assets/js/todolist.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/jquery-toast-plugin/jquery.toast.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/toastDemo.js') ?>"></script>
    <script src="<?= base_url('assets/js/desktop-notification.js') ?>"></script>
    <script src="<?= base_url('assets/js/moment.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/daterangepicker.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/fullcalendar/fullcalendar.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/jquery.redirect.js') ?>"></script>
    <!-- endinject -->

    <!-- DataTables -->
    <script src="<?= base_url('assets/vendors/datatables.net/jquery.dataTables.js') ?>"></script>
    <script src="<?= base_url('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') ?>"></script>
    <!-- End DataTables -->

    <!-- Font Awesome -->
    <script defer src="<?= base_url('assets/js/brands.js') ?>"></script>
    <script defer src="<?= base_url('assets/js/solid.js') ?>"></script>
    <script defer src="<?= base_url('assets/js/fontawesome.js') ?>"></script>

    <script src="<?= base_url('assets/js/system-operations.js') ?>"></script>
    <script src="<?= base_url('assets/js/custom-general.js') ?>"></script>

    <script>

        window.print();

    </script>

</body>
</html>