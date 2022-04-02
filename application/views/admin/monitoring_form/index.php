<div class="content-wrapper">

    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0">Monitoring Form</h4>
                </div>
                <div class="card-body" id="pageContent">  
                    <div class="jumping-dots-loader my-5">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>          
                </div>
            </div>
        </div>
    </div>

</div>


<script src="<?=base_url()?>assets/website/assets/js/vendor/modernizr-3.5.0.min.js"></script>
<script src="<?=base_url()?>assets/website/assets/js/vendor/jquery-1.12.4.min.js"></script>
<script src="<?=base_url()?>assets/website/assets/js/popper.min.js bootstrap.min.js.pagespeed.jc.M2u69PhM2B.js"></script><script>eval(mod_pagespeed_yHSzYa$i1N);</script>
<script src="<?= base_url('assets/vendors/inputmask/jquery.inputmask.bundle.js') ?>"></script>
<script src="<?= base_url('assets/js/inputmask.js') ?>"></script>



<script>


    $(document).ready(function() {

        // ----- GLOBAL VARIABLES -----
        let patientList = getTableData(
            `patients WHERE is_deleted = 0`,
            `*, CONCAT(firstname, ' ', middlename, ' ', lastname, ' ', suffix) AS fullname`
        );
        // ----- END GLOBAL VARIABLES -----


        // ----- DATATABLES -----
        function initDataTables() {
            if ($.fn.DataTable.isDataTable("#tableMonitoringRecord")) {
                $("#tableMonitoringRecord").DataTable().destroy();
            }

            var table = $("#tableMonitoringRecord")
                .css({ "min-width": "100%" })
                .removeAttr("width")
                .DataTable({
                    proccessing:    false,
                    serverSide:     false,
                    scrollX:        true,
                    sorting:        [],
                    scrollCollapse: true,
                    columnDefs: [
                        { targets: 0, width: "50px"  },	
                        { targets: 1, width: "150px" },	
                        { targets: 2, width: "100px" },	
                        { targets: 3, width: "100px" },	
                        { targets: 4, width: "100px" },	
                        { targets: 5, width: "100px" },	
                    ],
                });
        }
        // ----- END DATATABLES -----


        // ----- TABLE CONTENT -----
        function tableContent(patientID = 0) {
            let data = getTableData(
                `monitoring_forms AS mf
                    LEFT JOIN patients AS p USING(patient_id)
                    LEFT JOIN patient_type AS pt ON p.patient_type_id = pt.patient_type_id
                WHERE p.is_deleted = 0
                    AND mf.status = 0`,
                `mf.*, CONCAT(firstname, ' ', middlename, ' ', lastname) AS fullname, pt.name AS patient_type_name`);

            let tbodyHTML = '';
            if (data && data.length) {
                data.map((item, index) => {

                    let statusDisplay = (status = 0) => {
                        if (status == 0)      return `<span class="badge badge-primary">Ongoing</span>`;
                        else if (status == 1) return `<span class="badge badge-success">Done</span>`;
                        else                  return `<span class="badge badge-danger">Cancelled</span>`;
                    }

                    tbodyHTML += `
                    <tr>
                        <td class="text-center">${index + 1}</td>
                        <td>${item.fullname}</td>
                        <td>${item.patient_type_name}</td>
                        <td>${moment(item.created_at).format("MMMM DD, YYYY hh:mm A")}</td>
                        <td>${statusDisplay(item.status)}</td>
                        <td class="text-center">
                            <a href="${base_url}admin/monitoring_form/edit_monitoring?id=${item.monitoring_form_id}"
                                class="btn btn-outline-secondary">
                                <i class="fas fa-pencil-alt"></i> Edit    
                            </a>
                        </td>
                    </tr>`;
                })
            }

            let html = `
            <table class="table table-bordered table-hover" id="tableMonitoringRecord">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Patient Name</th>
                        <th>Occupation Type</th>
                        <th>Date Created</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    ${tbodyHTML}
                </tbody>
            </table>`;
            return html;
        }
        // ----- END TABLE CONTENT -----


        // ----- PAGE CONTENT -----
        function pageContent() {
            !document.getElementsByClassName("jumping-dots-loader").length && $("#pageContent").html(preloader);

            let html = `
            <div class="row">
                <div class="col-12" id="filterContent"></div>
                <div class="col-12" id="tableContent">${tableContent()}</div>
            </div>`;

            setTimeout(() => {
                $("#pageContent").html(html);
                initDataTables();
            }, 100);
        }
        pageContent();
        // ----- END PAGE CONTENT -----

    })

</script>
    