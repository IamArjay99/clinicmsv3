
<?php 
    $sessionID = !$this->session->has_userdata('patientID') ? false : $this->session->userdata('patientID'); 
    $hasMonitoring = false;
    if ($sessionID) {
        $sql = "SELECT * FROM monitoring_forms WHERE patient_id = $sessionID AND status = 0";
        $query = $this->db->query($sql);
        $hasMonitoring = $query ? ($query->num_rows() ? true : false) : false;
    }

    $btnAdd = $hasMonitoring ? '<button class="btn btn-success p-3 btnAddMonitoring" id="btnAddMonitoring">Add Monitoring</button>' : '';
?>

<main>

<div class="slider-area hero-bg-color hero-height2">
<div class="slider-active">

<div class="single-slider">
<div class="slider-cap-wrapper">
<div class="hero-caption hero-caption2">
<h2 data-animation="fadeInUp" data-delay=".2s">Monitoring</h2>

<div class="hero-shape2">
<img src="<?=base_url()?>assets/website/assets/img/hero/tooth2.png" alt="">
</div>
</div>
<div class="hero-img hero-img2 position-relative">
<center><img src="<?=base_url()?>assets/website/assets/img/hero/h1_hero1.png" alt="" data-animation="pulse" data-transition-duration="5s"></center>
</div>
</div>
</div>
</div>
</div>


<div class="container py-5 border-bottom">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Monitoring</h4>
                    <?= $btnAdd ?>
                </div>
                <div class="card-body" id="pageContent">
                </div>
            </div>

        </div>
    </div>
</div>


<section class="visit-tailor-area2 fix">

<div class="tailor-offers"> </div>

<div class="tailor-details">
<div class="sinlge-wrapper">
<div class="single-details wow fadeInUp mb-20" data-wow-duration="1s" data-wow-delay=".3s">
<h3>Best <br> clinic specialist</h3>
<p>All Students and faculty of cbsua- sipocot can have a free check-up and free medicine.</p>
<p>Nurse conduct seminar related to health to make all students and faculty aware of their physical health how they can take care of it and avoid any harm to their body.</p>
<a href="#" class="btn_01 mt-15 make-appointment">Make an Appointment</a>
</div>
<div class="single-details wow fadeInUp mb-20 ml-90" data-wow-duration="2s" data-wow-delay=".3s">
<div class="address">
<h5>PHONE</h5>
<p>0948-518-9064</p>
</div>
<div class="address">
<h5>WORKING TIME</h5>
<p>08:00 AM – 05:00 PM
    <br> Saturday Offline
    <br> Sunday Offline
</p>
</div>
<div class="address">
<h5>OUR CLINIC ADDRESS</h5>
<p>Impig Sipocot Camarines Sur, at Central Bicol State University of Agriculture beside BAC OFFICE near AVR.</p>
</div>
</div>
</div>
</div>
</section>


<!-- ----- MODAL ----- -->
<div id="modal" class="modal custom-modal fade" data-backdrop="static" data-keyboard="false" role="dialog">
    <div class="modal-dialog modal-md mt-5" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="page-title font-weight-bold"></h4>
                <button type="button" class="close btnCloseModal" data-dismiss="modal" aria-label="Close">
                    <span class="text-dark" aria-hidden="true">&times;</span>
                </button>
            </div>

            <div id="modal_content"></div>
        </div>
    </div>
</div>
<!-- ----- END MODAL ----- -->




</main>


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
            if ($.fn.DataTable.isDataTable("#tableMonitoringForm")) {
                $("#tableMonitoringForm").DataTable().destroy();
            }
            
            var table = $("#tableMonitoringForm")
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
                        { targets: 1, width: "200px" },		
                        { targets: 2, width: "100px" },		
                        { targets: 3, width: "110px" },		
                        { targets: 4, width: "200px" },		
                        { targets: 5, width: "200px" },		
                        { targets: 6, width: "200px" },		
                        { targets: 7, width: "100px" },		
                        { targets: 8, width: "100px" },		
                    ],
                });
        }
        // ----- END DATATABLES -----


        // ----- TABLE CONTENT -----
        function tableContent(patientID = 0) {
            patientID = $('body').attr("sessionid");

            let tbodyHTML = '';
            let data = getTableData(
                `monitoring_form_items AS mf
                    LEFT JOIN patients USING(patient_id) 
                WHERE mf.is_deleted = 0 ${patientID && patientID != 0 ? `AND mf.patient_id = ${patientID}` : ""}
                ORDER BY mf.created_at DESC`,
                `mf.*, CONCAT(firstname, ' ', middlename, ' ', lastname, ' ', suffix) AS patient_name`);
            data.map((item, index) => {
                let {
                    patient_name       = "",
                    monitoring_form_item_id = "",
                    patient_id         = "",
                    date               = "",
                    time               = "",
                    patient_case       = "",
                    activity           = "",
                    medicine_taken     = "",
                    status             = "",
                    is_deleted         = "",
                    created_at         = "",
                    updated_at         = "",
                } = item;

                let statusDisplay = (status = 0) => {
                    if (status == 0)      return `<span class="">Serious/Bad</span>`;
                    else if (status == 1) return `<span class="">Fair</span>`;
                    else                  return `<span class="">Good</span>`;
                }

                tbodyHTML += `
                <tr>
                    <td>${index + 1}</td>
                    <td>${patient_name}</td>
                    <td>${date ? moment(date).format("MMMM DD, YYYY") : "-"}</td>
                    <td>${time ? moment("2021-01-01 " + time).format("hh:mm A") : "-"}</td>
                    <td>${patient_case}</td>
                    <td>${activity}</td>
                    <td>${medicine_taken}</td>
                    <td>${statusDisplay(status)}</td>
                    <td>
                        <div class="text-center">
                            <button class="btn btn-outline-info btnEditMonitoring p-2"
                                monitoringFormItemID="${monitoring_form_item_id}"><i class="fas fa-pencil-alt p-0"></i></button>
                        </div>
                    </td>   
                </tr>`;
            });

            let html = `
            <table class="table table-hover table-bordered" id="tableMonitoringForm">
                <thead>
                    <tr class="text-center">
                        <th>No.</th>
                        <th>Patient</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Case of Patient</th>
                        <th>Activity</th>
                        <th>Medicine Taken</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="tableMonitoringFormTbody">
                    ${tbodyHTML}
                </tbody>
            </table>`;

            return html;
        }
        // ----- END TABLE CONTENT -----


        // ----- REFRESH TABLE CONTENT -----
        function refreshTableContent() {
            $("#tableContent").html(preloader);

            let status           = $(`[name="status"]`).val();
            let monitoringFormID = $(`[name="patient_id"] option:selected`).attr("monitoringFormID");
            console.log(status, monitoringFormID);
            if (status == 2) { // GOOD
                $.ajax({
                    method: "POST",
                    url: `<?= base_url('admin/monitoring_form/updateMonitorPatient') ?>`,
                    data: { monitoringFormID },
                    async: true,
                    success: function(data) {}
                })
            }
            
            setTimeout(() => {
                let patientID = $(`[name="filterPatient"]`).val();
                let content = tableContent(patientID);
                $("#tableContent").html(content);
                initDataTables();
            }, 100);
        }
        // ----- END REFRESH TABLE CONTENT -----


        // ----- PATIENT OPTION DISPLAY -----
        function getPatientOptionDisplay(patientID = 0, forFilter = false) {
            let html = '';
            if (forFilter) {
                html = `<option value="0" selected>All</option>`;
                patientList.map(patient => {
                    let {
                        patient_id,
                        fullname,
                    } = patient;

                    html += `
                    <option value="${patient_id}"
                        ${patientID == patient_id ? "selected" : ""}>${fullname}</option>`;
                });
            } else {
                html = `<option value="" disabled selected>Select patient</option>`;
                let monitorPatientList = getTableData(
                    `monitoring_forms AS mf
                        LEFT JOIN patients AS p USING(patient_id)
                    WHERE mf.status = 0
                        AND p.is_deleted = 0`,
                    `mf.*, CONCAT(firstname, ' ', middlename, ' ', lastname) AS fullname`
                );
                monitorPatientList.map(mp => {
                    let {
                        monitoring_form_id,
                        patient_id,
                        fullname
                    } = mp;
                    html += `
                    <option value="${patient_id}"
                        monitoringFormID="${monitoring_form_id}"
                        ${patientID == patient_id ? "selected" : ""}>${fullname}</option>`;
                })
            }
            return html;
        }
        // ----- END PATIENT OPTION DISPLAY -----


        // ----- PAGE CONTENT -----
        function pageContent() {
            !document.getElementsByClassName("jumping-dots-loader").length && $("#pageContent").html(preloader);

            let html = `
            <div class="row">
                <div class="col-12" id="tableContent">${tableContent()}</div>
            </div>`;

            setTimeout(() => {
                $("#pageContent").html(html);
                initDataTables();
            }, 100);
        }
        pageContent();
        // ----- END PAGE CONTENT -----


        // ----- FORM CONTENT -----
        function formContent(data = false, isUpdate = false) {
            let {
                monitoring_form_item_id = "",
                patient_id         = "",
                date               = "",
                time               = "",
                patient_case       = "",
                activity           = "",
                medicine_taken     = "",
                status             = "",
                is_deleted         = "",
                created_at         = "",
                updated_at         = "",
            } = data && data[0];

            let buttonSaveUpdate = !isUpdate ? `
            <button class="btn btn-primary p-4" 
                id="btnSaveMonitoring"
                monitoringFormItemID="${monitoring_form_item_id}">Save</button>` : `
            <button class="btn btn-primary p-4" 
                id="btnUpdate"
                monitoringFormItemID="${monitoring_form_item_id}">Update</button>`;

            let html = `
            <div class="row p-3">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label>Patient <code>*</code></label>
                        <select class="form-control"
                            name="patient_id"
                            required
                            disabled>
                            ${getPatientOptionDisplay(PATIENT_ID)}    
                        </select>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Date <code>*</code></label>
                        <input type="date" 
                            class="form-control validate"
                            name="date"
                            value="${date}"
                            required>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Time <code>*</code></label>
                        <input type="time" 
                            class="form-control validate"
                            name="time"
                            value="${time}"
                            required>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label>Case of Patient <code>*</code></label>
                        <input type="text" 
                            class="form-control validate"
                            name="patient_case"
                            minlength="1"
                            maxlength="250"
                            value="${patient_case}"
                            required>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label>Activity (What did you do?) <code>*</code></label>
                        <input type="text" 
                            class="form-control validate"
                            name="activity"
                            minlength="1"
                            maxlength="500"
                            value="${activity}"
                            required>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label>Medicine Taken (Please include how many grams) <code>*</code></label>
                        <input type="text" 
                            class="form-control validate"
                            name="medicine_taken"
                            minlength="1"
                            maxlength="500"
                            value="${medicine_taken}"
                            required>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label>Status <code>*</code></label>
                        <select class="form-control validate"
                            name="status"
                            required>
                            <option value="" selected>Select status</option>    
                            <option value="0" ${status == "0" ? "selected" : ""}>Serious/Bad</option>     
                            <option value="1" ${status == "1" ? "selected" : ""}>Fair</option>    
                            <option value="2" ${status == "2" ? "selected" : ""}>Good</option>    
                        </select>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
                ${buttonSaveUpdate}
                <button class="btn btn-danger p-4 btnCloseModal" data-dismiss="modal">Cancel</button>
            </div>`;

            return html;
        }
        // ----- END FORM CONTENT -----


        // ----- BUTTON ADD -----
        $(document).on("click", "#btnAddMonitoring", function() {
            let html = formContent();
            $("#modal .modal-dialog").removeClass("modal-md").addClass("modal-md");
            $("#modal_content").html(html);
            $("#modal .page-title").text("ADD MONITORING");
            $("#modal").modal('show');
            generateInputsID("#modal");
        });
        // ----- END BUTTON ADD -----


        // ----- BUTTON EDIT -----
        $(document).on("click", ".btnEditMonitoring", function() {
            let monitoringFormItemID = $(this).attr("monitoringFormItemID");
            let data = getTableData(`monitoring_form_items WHERE monitoring_form_item_id = ${monitoringFormItemID}`);

            $("#modal .modal-dialog").removeClass("modal-md").addClass("modal-md");
            $("#modal_content").html(preloader);
            $("#modal .page-title").text("EDIT MONITORING");
            $("#modal").modal('show');

            setTimeout(() => {
                let html = formContent(data, true);
                $("#modal_content").html(html);
                generateInputsID("#modal");
            }, 100);
        });
        // ----- END BUTTON EDIT -----


        // ----- BUTTON SAVE -----
        $(document).on("click", `#btnSaveMonitoring`, function() {
            let monitoringFormItemID = $(this).attr("monitoringFormItemID");
            
            let validate = validateForm("modal");
            if (validate) {
                $("#modal").modal("hide");

                let data = getFormData("modal");
                    data["tableData[monitoring_form_id]"] = $(`[name="patient_id"] option:selected`).attr("monitoringFormID");
                    data["tableName"] = "monitoring_form_items";
                    data["feedback"]  = "Monitoring Form";
                    data["method"]    = "add";
    
                sweetAlertConfirmation("add", "Monitoring Form", "modal", null, data, true, refreshTableContent);
            }
        })
        // ----- END BUTTON SAVE -----


        // ----- BUTTON SAVE -----
        $(document).on("click", `#btnUpdate`, function() {
            let monitoringFormItemID = $(this).attr("monitoringFormItemID");
            
            let validate = validateForm("modal");
            if (validate) {
                $("#modal").modal("hide");

                let data = getFormData("modal");
                    data["tableData[monitoring_form_id]"] = $(`[name="patient_id"] option:selected`).attr("monitoringFormID");
                    data["tableName"]   = "monitoring_form_items";
                    data["feedback"]    = "Monitoring Form";
                    data["method"]      = "update";
                    data["whereFilter"] = `monitoring_form_item_id=${monitoringFormItemID}`;
    
                sweetAlertConfirmation("update", "Monitoring Form", "modal", null, data, true, refreshTableContent);
            }
        })
        // ----- END BUTTON SAVE -----
        

        // ----- BUTTON DELETE -----
        $(document).on("click", `.btnDelete`, function() {
            let monitoringFormItemID = $(this).attr("monitoringFormItemID");

            let data = {
                tableName: 'monitoring_form_items',
                tableData: {
                    is_deleted: 1
                },
                whereFilter: `monitoring_form_item_id=${monitoringFormItemID}`,
                feedback:    "Monitoring Form",
                method:      "update"
            }
            sweetAlertConfirmation("delete", "Monitoring Form", "modal", null, data, true, refreshTableContent);
        })
        // ----- END BUTTON DELETE -----


        // ----- FILTER PATIENT -----
        $(document).on('change', `[name="filterPatient"]`, function() {
            refreshTableContent();
        })
        // ----- END FILTER PATIENT -----


        // ----- CLOSE MODAL -----
        $(document).on("click", ".btnCloseModal", function() {
            $("#modal").modal("hide");
        })
        // ----- END CLOSE MODAL -----

    })

</script>
    