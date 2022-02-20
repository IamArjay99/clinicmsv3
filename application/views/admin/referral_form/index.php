<div class="content-wrapper">

    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0">Referral Form</h4>
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
            if ($.fn.DataTable.isDataTable("#tableReferralForm")) {
                $("#tableReferralForm").DataTable().destroy();
            }
            
            var table = $("#tableReferralForm")
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
                        { targets: 1, width: "100px" },		
                        { targets: 2, width: "110px" },		
                        { targets: 3, width: "200px" },		
                        { targets: 4, width: "200px" },		
                        { targets: 5, width: "200px" },		
                        { targets: 6, width: "100px" },		
                    ],
                });
        }
        // ----- END DATATABLES -----


        // ----- TABLE CONTENT -----
        function tableContent() {

            let tbodyHTML = '';
            let data = getTableData(
                `referral_forms AS rf
                    LEFT JOIN patients USING(patient_id) 
                WHERE rf.is_deleted = 0`,
                `rf.*, CONCAT(firstname, ' ', middlename, ' ', lastname, ' ', suffix) AS patient_name`);
            data.map((item, index) => {
                let {
                    referral_form_id = "",
                    date             = "",
                    to_doctor        = "",
                    patient_id       = "",
                    patient_name     = "",
                    address          = "",
                    chief_complaint  = "",
                    illness_history  = "",
                    medicine_given   = "",
                    impression       = "",
                    referral_reason  = "",
                } = item;

                tbodyHTML += `
                <tr>
                    <td>${index + 1}</td>
                    <td>${date ? moment(date).format("MMMM DD, YYYY") : "-"}</td>
                    <td>${to_doctor}</td>
                    <td>${patient_name}</td>
                    <td>${chief_complaint}</td>
                    <td>${medicine_given}</td>
                    <td>${impression}</td>
                    <td>
                        <div class="text-center">
                            <button class="btn btn-outline-info btnEdit"
                                referralFormID="${referral_form_id}"><i class="fas fa-pencil-alt"></i></button>
                            <button class="btn btn-outline-danger btnDelete"
                                referralFormID="${referral_form_id}"><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </td>   
                </tr>`;
            });

            let html = `
            <table class="table table-hover table-bordered" id="tableReferralForm">
                <thead>
                    <tr class="text-center">
                        <th>No.</th>
                        <th>Date</th>
                        <th>Doctor Name</th>
                        <th>Patient Name</th>
                        <th>Chief Complaint/s</th>
                        <th>Medicine Given</th>
                        <th>Impression</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="tableReferralFormTbody">
                    ${tbodyHTML}
                </tbody>
            </table>`;

            return html;
        }
        // ----- END TABLE CONTENT -----


        // ----- REFRESH TABLE CONTENT -----
        function refreshTableContent() {
            $("#tableContent").html(preloader);
            
            setTimeout(() => {
                let content = tableContent();
                $("#tableContent").html(content);
                initDataTables();
            }, 100);
        }
        // ----- END REFRESH TABLE CONTENT -----


        // ----- PAGE CONTENT -----
        function pageContent() {
            !document.getElementsByClassName("jumping-dots-loader").length && $("#pageContent").html(preloader);

            let html = `
            <div class="row">
                <div class="col-12" id="filterContent">
                    <div class="row mb-4">
                        <div class="col-md-4 col-sm-12"></div>
                        <div class="col-md-8 col-sm-12 text-right">
                            <button class="btn btn-primary"
                                id="btnAdd"><i class="fas fa-plus"></i> Add ReferralForm</button>
                        </div>
                    </div>
                </div>
                <div class="col-12" id="tableContent">${tableContent()}</div>
            </div>`;

            setTimeout(() => {
                $("#pageContent").html(html);
                initDataTables();
            }, 100);
        }
        pageContent();
        // ----- END PAGE CONTENT -----


        // ----- PATIENT OPTION DISPLAY -----
        function getPatientOptionDisplay(patientID = 0) {
            let html = `<option value="" selected disabled>Select patient name</option>`;
            patientList.map(patient => {
                let {
                    patient_id,
                    fullname,
                } = patient;

                html += `
                <option value="${patient_id}"
                    ${patientID == patient_id ? "selected" : ""}>${fullname}</option>`;
            });

            return html;
        }
        // ----- END PATIENT OPTION DISPLAY -----


        // ----- FORM CONTENT -----
        function formContent(data = false, isUpdate = false) {
            let {
                referral_form_id = "",
                date             = "",
                to_doctor        = "",
                patient_id       = "",
                address          = "",
                chief_complaint  = "",
                illness_history  = "",
                medicine_given   = "",
                impression       = "",
                referral_reason  = "",
            } = data && data[0];

            let buttonSaveUpdate = !isUpdate ? `
            <button class="btn btn-primary" 
                id="btnSave"
                referralFormID="${referral_form_id}">Save</button>` : `
            <button class="btn btn-primary" 
                id="btnUpdate"
                referralFormID="${referral_form_id}">Update</button>`;

            let html = `
            <div class="row p-3">
                <div class="col-md-12 col-sm-12">
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
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label>To Dr. <code>*</code></label>
                        <input type="text" 
                            class="form-control validate"
                            name="to_doctor"
                            minlength="2"
                            maxlength="50"
                            value="${to_doctor}"
                            required>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label>Patient Name <code>*</code></label>
                        <select class="form-control validate"
                            name="patient_id"
                            required>
                            ${getPatientOptionDisplay(patient_id)}    
                        </select>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label>Address</label>
                        <textarea class="form-control validate"
                            name="address"
                            minlength="1"
                            maxlength="200"
                            rows="3"
                            style="resize: none;">${address}</textarea>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label>Chief Complaint/s <code>*</code></label>
                        <textarea class="form-control validate"
                            name="chief_complaint"
                            minlength="1"
                            maxlength="200"
                            rows="3"
                            style="resize: none;"
                            required>${chief_complaint}</textarea>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label>History of Present Illness <code>*</code></label>
                        <textarea class="form-control validate"
                            name="illness_history"
                            minlength="1"
                            maxlength="200"
                            rows="3"
                            style="resize: none;"
                            required>${illness_history}</textarea>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label>Medicine Given <code>*</code></label>
                        <textarea class="form-control validate"
                            name="medicine_given"
                            minlength="1"
                            maxlength="200"
                            rows="3"
                            style="resize: none;"
                            required>${medicine_given}</textarea>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label>Impression <code>*</code></label>
                        <textarea class="form-control validate"
                            name="impression"
                            minlength="1"
                            maxlength="200"
                            rows="3"
                            style="resize: none;"
                            required>${impression}</textarea>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label>Reason for Referral <code>*</code></label>
                        <select class="form-control validate"
                            name="referral_reason"
                            required>
                            <option value="" selected>Select reason</option>    
                            <option value="For further evaluation and management" ${referral_reason == "For further evaluation and management" ? "selected" : ""}>For further evaluation and management</option>    
                            <option value="As requested by relatives of patient/patient" ${referral_reason == "As requested by relatives of patient/patient" ? "selected" : ""}>As requested by relatives of patient/patient</option>    
                        </select>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
                ${buttonSaveUpdate}
                <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>`;

            return html;
        }
        // ----- END FORM CONTENT -----


        // ----- BUTTON ADD -----
        $(document).on("click", "#btnAdd", function() {
            let html = formContent();
            $("#modal .modal-dialog").removeClass("modal-md").addClass("modal-md");
            $("#modal_content").html(html);
            $("#modal .page-title").text("ADD REFERRAL");
            $("#modal").modal('show');
            generateInputsID("#modal");
            initDateRangePicker();
        });
        // ----- END BUTTON ADD -----


        // ----- BUTTON EDIT -----
        $(document).on("click", ".btnEdit", function() {
            let referralFormID = $(this).attr("referralFormID");
            let data = getTableData(`referral_forms WHERE referral_form_id = ${referralFormID}`);

            $("#modal .modal-dialog").removeClass("modal-md").addClass("modal-md");
            $("#modal_content").html(preloader);
            $("#modal .page-title").text("EDIT REFERRAL");
            $("#modal").modal('show');

            setTimeout(() => {
                let html = formContent(data, true);
                $("#modal_content").html(html);
                generateInputsID("#modal");
                initDateRangePicker();
            }, 100);
        });
        // ----- END BUTTON EDIT -----


        // ----- BUTTON SAVE -----
        $(document).on("click", `#btnSave`, function() {
            let referralFormID = $(this).attr("referralFormID");
            
            let validate = validateForm("modal");
            if (validate) {
                $("#modal").modal("hide");

                let data = getFormData("modal");
                    data["tableName"] = "referral_forms";
                    data["feedback"]  = "Referral Form";
                    data["method"]    = "add";
    
                sweetAlertConfirmation("add", "Referral Form", "modal", null, data, true, refreshTableContent);
            }
        })
        // ----- END BUTTON SAVE -----


        // ----- BUTTON SAVE -----
        $(document).on("click", `#btnUpdate`, function() {
            let referralFormID = $(this).attr("referralFormID");
            
            let validate = validateForm("modal");
            if (validate) {
                $("#modal").modal("hide");

                let data = getFormData("modal");
                    data["tableName"]   = "referral_forms";
                    data["feedback"]    = "Referral Form";
                    data["method"]      = "update";
                    data["whereFilter"] = `referral_form_id=${referralFormID}`;
    
                sweetAlertConfirmation("update", "Referral Form", "modal", null, data, true, refreshTableContent);
            }
        })
        // ----- END BUTTON SAVE -----
        

        // ----- BUTTON DELETE -----
        $(document).on("click", `.btnDelete`, function() {
            let referralFormID = $(this).attr("referralFormID");

            let data = {
                tableName: 'referral_forms',
                tableData: {
                    is_deleted: 1
                },
                whereFilter: `referral_form_id=${referralFormID}`,
                feedback:    "Referral Form",
                method:      "update"
            }
            sweetAlertConfirmation("delete", "Referral Form", "modal", null, data, true, refreshTableContent);
        })
        // ----- END BUTTON DELETE -----

    })

</script>
    