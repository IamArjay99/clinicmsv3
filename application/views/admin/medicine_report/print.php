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
            font-size: 15px;
        }
        .border-bottom {
            border-bottom: 1px solid #000000 !important;
        }
        @page {
            /* size: landscape; */
            size: 35.7cm 21.6cm ;
            margin:0; /* change the margins as you want them to be. */

        }
        .table tr th, .table tr td {
            padding: 0;
            margin: 0;
            font-size: 10px;
        }
    </style>
</head>
<body base_url="<?= base_url() ?>" year="<?=$year?>" >
    
    <div class="container-fluid p-3 pb-5" id="pageContent">

        <div class="d-flex justify-content-center align-items-center border-bottom pb-3">
            <div class="text-center">
                <img src="<?= base_url('assets/images/modules/bsu-logo.png') ?>"
                    height="100" width="100"><br>
                    <small>
                        <div>ISO 9001:2015</div>
                        <div>CERTIFIED</div>
                    </small>
            </div>
            <div class="ml-4 text-center">
                <div>Republic of the Philippines</div>
                <div><b>CENTRAL BICOL STATE UNIVERSITY OF AGRICULTURE</b></div>
                <div>Impig, Sipocot, Camarines Sur - 4408</div>
                <div><i>Website: <a href="www.cbsua.edu.ph" target="_blank">www.cbsua.edu.ph</a></i></div>
            </div>
        </div>

        <div class="mt-3">
            <h4 class="text-center my-2 font-weight-bold">MEDICINE REPORT</h4>
            <h4 class="text-center my-2 font-weight-light"><?= '<sup>S/Y</sup> '.$year ?></h4>
        </div>

        <div class="mt-4" id="tableContent">
            
        </div>

        <div class="w-100 mt-5 d-flex justify-content-end">
            <div class="text-left"><strong>Prepared By:</strong></div>
            <div class="d-flex justify-content-end align-items-end mt-5">
            <div class="w-100 text-center" style="border-top: 2px solid black">
                    <?=$fullname?>
                    <div>Nurse</div>
            </div>         
            </div>
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





$(document).ready(function() {
        const MEDICINE_DATA = getTableData(`medicines`, ``,`is_deleted = '0'`);
        const CHECK_UP_DATA = getTableData(`check_up_medicines`,``,`is_deleted = 0`);
        const YEAR          = $("body").attr("year");
        const tableHTML     = tableContent();
        


        setTimeout(() => {
            $("#tableContent").html(tableHTML);
            window.print();
        }, 500);










        // ----- TABLE CONTENT -----
        function tableContent(year = YEAR ) {

            let html = `
            <div class="w-100 py-5 text-center">
                <img src="${base_url}assets/images/modal/select.svg"
                    width="200" height="200" alt="Select year and month">
                <h4 class="mt-3">Please select year and month</h4>
            </div>`;

            if (year) {
                let totalRespondent = 0;
                let tableHeadRow = "";
                
                MEDICINE_DATA.map((value,index)=>{
                    tableHeadRow +=` <th>${value.name}<br><smal>${value.brand}</small></th>`;
                });

                let tbodyHTML       = '';
                let monthArr        = ["January","February","March","April","May","June","July","August","September","October","November","December"];
                let footerArr       = [];

                monthArr.map((value,index)=>{
                    let totalConsume    = 0;
                    let totalFooter     = 0;
                    let indexValue      = parseFloat(index) + 1;
                    let colData         = ``;
                    MEDICINE_DATA.map(item=>{
                        let sumData     = 0;
                        let footerTotal = 0;
                        CHECK_UP_DATA.filter(x => x.medicine_id == item.medicine_id && moment(x.created_at).format("YYYY") == year  && moment(x.created_at).format("MMMM") == value).map( x =>{
                            sumData += parseFloat(x.quantity);
                        });
                                                
                        totalConsume += parseFloat(sumData);
                        colData += `<td class="text-center">${sumData}</td>`;


                       

                    });


                    tbodyHTML += `
                                    <tr>
                                        <td class"text-center">${value}</td>
                                        ${colData}
                                        <td class="text-center">${totalConsume}</td>
                                    </tr>
                                 `;
                
                });
                MEDICINE_DATA.map(i => {
                    // ----- FOOTER -----
                    let MEDICINE_ID = i.medicine_id;
                    let TOTAL_CONSUME = CHECK_UP_DATA.filter(x => x.medicine_id == MEDICINE_ID && moment(x.created_at).format("YYYY") == year).map(x => parseFloat(x.quantity)).reduce((a,b) => a+b, 0);
                    footerArr.push(TOTAL_CONSUME);
                    // ----- END FOOTER -----
                })
                let totalFooter = 0;
                footerArr.map(x=>{
                    totalFooter += parseFloat(x);
                });
                html = `
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="text-center">
                            <tr>
                                <th style="width:100px;" rowspan="2">Month</th>
                                <th style="width:100px" colspan="${MEDICINE_DATA.length}">Monthly Medicine Report</th>
                                <th style="width:100px;" rowspan="2">Total Consume</th>
                            </tr>
                            <tr>
                                ${tableHeadRow}
                            </tr>
                        </thead>
                        <tbody>
                            ${tbodyHTML}
                            <tr>
                                <td>Total</td>
                               ${footerArr.map(x=>{return `<td class="text-center">${x}</td>`}).join("")}
                                <td class="text-center">${totalFooter}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>`;
            }

          return html;
        }
        // ----- END TABLE CONTENT -----


})















</script>

</body>
</html>