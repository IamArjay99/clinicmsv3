<div class="content-wrapper">

    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0">Patient</h4>
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
        let courseList      = getTableData(`courses WHERE is_deleted = 0`);
        let yearList        = getTableData(`years WHERE is_deleted = 0`);
        let patientTypeList = getTableData('patient_type WHERE is_deleted = 0');
        let patientIDList   = [];
        // ----- END GLOBAL VARIABLES -----


        // ----- DATATABLES -----
        function initDataTables() {
            if ($.fn.DataTable.isDataTable("#tablePatient")) {
                $("#tablePatient").DataTable().destroy();
            }
            
            var table = $("#tablePatient")
                .css({ "min-width": "100%" })
                .removeAttr("width")
                .DataTable({
                    proccessing:    false,
                    serverSide:     false,
                    scrollX:        true,
                    sorting:        [],
                    scrollCollapse: true,
                    columnDefs: [
                        { targets: "thXs", width: 50  },	
                        { targets: "thSm", width: 150 },	
                        { targets: "thMd", width: 250 },	
                    ],
                });
        }
        // ----- END DATATABLES -----


        // ----- PATIENT TYPE OPTIONS DISPLAY -----
        function getPatientTypeOptionDisplay(patientTypeID = 0, isAll = false) {
            let html = isAll ? `<option value="0">All</option>` : `<option value="" selected>Select patient type</option>`;
            patientTypeList.map(type => {
                let {
                    patient_type_id,
                    name
                } = type;

                html += `
                <option value="${patient_type_id}"
                    ${patient_type_id == patientTypeID ? "selected" : ""}>${name}</option>`;
            })
            return html;
        }
        // ----- END PATIENT TYPE OPTIONS DISPLAY -----


        // ----- COURSE OPTIONS DISPLAY -----
        function getCourseOptionDisplay(courseID = 0) {
            let html = `<option value="" selected>Select course</option>`;
            courseList.map(course => {
                let {
                    course_id,
                    name
                } = course;

                html += `
                <option value="${course_id}"
                    ${course_id == courseID ? "selected" : ""}>${name}</option>`;
            })
            return html;
        }
        // ----- END COURSE OPTIONS DISPLAY -----


        // ----- YEAR OPTIONS DISPLAY -----
        function getYearOptionDisplay(courseID = 0, yearID = 0) {
            let html = `<option value="" selected>Select year</option>`;
            yearList.filter(yr => yr.course_id == courseID)
            .map(year => {
                let {
                    year_id,
                    name
                } = year;

                html += `
                <option value="${year_id}"
                    ${year_id == yearID ? "selected" : ""}>${name}</option>`;
            })
            return html;
        }
        // ----- END YEAR OPTIONS DISPLAY -----


        // ----- TABLE CONTENT -----
        function tableContent(patientTypeID = 0) {
            let wherePatientType = patientTypeID == 0 ? '1=1' : `p.patient_type_id=${patientTypeID}`;
            let tbodyHTML = '';
            let data = getTableData(
                `patients AS p 
                    LEFT JOIN patient_type AS pt USING(patient_type_id)
                    LEFT JOIN courses AS c USING(course_id)
                    LEFT JOIN years AS y ON p.year_id = y.year_id
                WHERE p.is_deleted = 0 AND ${wherePatientType}`,
                `p.*, pt.name AS pt_name, c.name AS course_name, y.name AS year_name`);
            data.map(item => {
                let {
                    patient_id   = "",
                    patient_code = "",
                    pt_name      = "",
                    course_name  = "",
                    email        = "",
                    password     = "",
                    firstname    = "",
                    middlename   = "",
                    lastname     = "",
                    suffix       = "",
                    year_name      = "",
                    section      = "",
                    age          = "",
                    gender       = "",
                } = item;

                patientIDList.push({patient_id, patient_code});

                tbodyHTML += `
                <tr>
                    <td>${patient_code}</td>
                    <td>${firstname} ${middlename} ${lastname} ${suffix}</td>
                    <td>${pt_name}</td>
                    <td>${email}</td>
                    <td>${age}</td>
                    <td>${gender}</td>
                    <td>${course_name || "-"}</td>
                    <td>${year_name || "-"}</td>
                    <td>${section || "-"}</td>
                    <td>
                        <div class="text-center">
                            <!-- <a class="btn btn-outline-primary btnView"
                                href="patient/profile?id=${patient_id}"
                                target="_blank"
                                patientID="${patient_id}"><i class="fas fa-eye"></i></a> -->
                            <button class="btn btn-outline-info btnEdit"
                                patientID="${patient_id}"><i class="fas fa-pencil-alt"></i></button>
                            <button class="btn btn-outline-danger btnDelete"
                                patientID="${patient_id}"><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </td>
                </tr>`;
            });

            let html = `
            <table class="table table-hover table-bordered" id="tablePatient">
                <thead>
                    <tr class="text-center">
                        <th class="thSm">Patient ID</th>
                        <th class="thSm">Full Name</th>
                        <th class="thSm">Type</th>
                        <th class="thSm">Email</th>
                        <th class="thSm">Age</th>
                        <th class="thSm">Gender</th>
                        <th class="thMd">Course</th>
                        <th class="thSm">Year</th>
                        <th class="thSm">Section</th>
                        <th class="thSm">Action</th>
                    </tr>
                </thead>
                <tbody id="tablePatientTbody">
                    ${tbodyHTML}
                </tbody>
            </table>`;

            return html;
        }
        // ----- END TABLE CONTENT -----


        // ----- REFRESH TABLE CONTENT -----
        function refreshTableContent() {
            let patientTypeID = $(`[name="filter_patient_type"]`).val();
            $("#tableContent").html(preloader);
            
            setTimeout(() => {
                let content = tableContent(patientTypeID);
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
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <label>Patient Type</label>
                                <select class="form-control" 
                                    name="filter_patient_type">
                                    ${getPatientTypeOptionDisplay(0, true)}
                                </select>
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-12 text-right">
                            <button class="btn btn-primary"
                                id="btnAdd"><i class="fas fa-plus"></i> Add Patient</button>
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


        // ----- FORM CONTENT -----
        function formContent(data = false, isUpdate = false) {
            let {
                patient_id      = "",
                patient_code    = "",
                patient_type_id = "",
                course_id       = "",
                year_id         = "",
                email           = "",
                password        = "",
                firstname       = "",
                middlename      = "",
                lastname        = "",
                suffix          = "",
                age             = "",
                gender          = "",
                section         = "",
            } = data && data[0];

            let buttonSaveUpdate = !isUpdate ? `
            <button class="btn btn-primary" 
                id="btnSave"
                patientID="${patient_id}">Save</button>` : `
            <button class="btn btn-primary" 
                id="btnUpdate"
                patientID="${patient_id}">Update</button>`;

            let html = `
            <div class="row p-3">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Patient ID <code>*</code></label>
                        <input type="text" 
                            class="form-control validate inputmask"
                            name="patient_code"
                            minlength="2"
                            maxlength="20"
                            data-inputmask-alias="99-9999"
                            value="${patient_code}"
                            required>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-12"></div>
                <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                        <label>First Name <code>*</code></label>
                        <input type="text" 
                            class="form-control validate"
                            name="firstname"
                            minlength="2"
                            maxlength="20"
                            value="${firstname}"
                            required>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                        <label>Middle Name</label>
                        <input type="text" 
                            class="form-control validate"
                            name="middlename"
                            minlength="2"
                            maxlength="20"
                            value="${middlename}">
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                        <label>Last Name <code>*</code></label>
                        <input type="text" 
                            class="form-control validate"
                            name="lastname"
                            minlength="2"
                            maxlength="20"
                            value="${lastname}"
                            required>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                        <label>Suffix</label>
                        <select class="form-control validate"
                            name="suffix">
                            <option value="" selected>Select suffix</option>    
                            <option value="Jr." ${suffix == "Jr."  ? "selected" : ""}>Jr.</option>
                            <option value="Sr." ${suffix == "Sr."  ? "selected" : ""}>Sr.</option>
                            <option value="I"   ${suffix == "I."   ? "selected" : ""}>I</option>
                            <option value="II"  ${suffix == "II."  ? "selected" : ""}>II</option>
                            <option value="III" ${suffix == "III." ? "selected" : ""}>III</option>
                            <option value="IV"  ${suffix == "IV"   ? "selected" : ""}>IV</option>
                            <option value="V"   ${suffix == "V"    ? "selected" : ""}>V</option>
                        </select>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label>Email <code>*</code></label>
                        <input type="text" 
                            class="form-control validate"
                            name="email"
                            minlength="2"
                            maxlength="50"
                            value="${email}"
                            required>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <div class="form-group">
                        <label>Password <code>*</code></label>

                        <div class="input-group">
                            <input type="password" 
                                class="form-control validate"
                                name="password"
                                minlength="2"
                                maxlength="50"
                                value="${password}"
                                required>
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="password-icon mdi mdi-eye" style="cursor: pointer;" display="true"></i>
                                </span>
                            </div>
                        </div>

                        
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-2 col-sm-12">
                    <div class="form-group">
                        <label>Age <code>*</code></label>
                        <input type="number" 
                            class="form-control validate"
                            name="age"
                            min="1"
                            minlength="2"
                            maxlength="50"
                            value="${age}"
                            required>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-2 col-sm-12">
                    <div class="form-group">
                        <label>Gender <code>*</code></label>
                        <select class="form-control validate"
                            name="gender"
                            required>
                            <option value="" selected>Select gender</option>    
                            <option value="Male"   ${gender == "Male"   ? "selected" : ""}>Male</option>
                            <option value="Female" ${gender == "Female" ? "selected" : ""}>Female</option>
                            <option value="Others" ${gender == "Others" ? "selected" : ""}>Others</option>
                        </select>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                        <label>Patient Type <code>*</code></label>
                        <select class="form-control validate"
                            name="patient_type_id"
                            required>
                            ${getPatientTypeOptionDisplay(patient_type_id)}
                        </select>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                        <label>Course</label>
                        <select class="form-control validate"
                            name="course_id"
                            ${course_id && patient_type_id == 2 ? "" : "disabled"}
                            ${course_id && patient_type_id == 2 ? "" : "required"}>
                            ${getCourseOptionDisplay(course_id)}
                        </select>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                        <label>Year</label>
                        <select class="form-control validate"
                            name="year_id"
                            ${course_id && patient_type_id == 2 ? "" : "disabled"}
                            ${course_id && patient_type_id == 2 ? "" : "required"}>
                            ${getYearOptionDisplay(course_id, year_id)}
                        </select>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                        <label>Section</label>
                        <input type="text" 
                            class="form-control validate"
                            name="section"
                            minlength="1"
                            maxlength="50"
                            value="${section}"
                            ${course_id && patient_type_id == 2 ? "" : "disabled"}
                            ${course_id && patient_type_id == 2 ? "" : "required"}>
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


        // ----- VALIDATE PATIENT ID -----
        function validatePatientID(patientID = 0, patientCode = '') {
            let arr = patientIDList.filter(id => id.patient_id != patientID && id.patient_code == patientCode);
            let flag = arr.length ? false : true;
            if (!flag) {
                showNotification('danger', 'Patient ID is already exists!');
            }
            return flag;
        }
        // ----- END VALIDATE PATIENT ID -----


        // ----- BUTTON ADD -----
        $(document).on("click", "#btnAdd", function() {
            let html = formContent();
            $("#modal .modal-dialog").removeClass("modal-md").addClass("modal-lg");
            $("#modal_content").html(html);
            $("#modal .page-title").text("ADD PATIENT");
            $("#modal").modal('show');
            generateInputsID("#modal");
            $(`[name="patient_code"]`).inputmask({
                mask:        "99-9999",
                placeholder: "00-0000"
            });
        });
        // ----- END BUTTON ADD -----


        // ----- BUTTON EDIT -----
        $(document).on("click", ".btnEdit", function() {
            let patientID = $(this).attr("patientID");
            let data = getTableData(`patients WHERE patient_id = ${patientID}`);

            $("#modal .modal-dialog").removeClass("modal-md").addClass("modal-lg");
            $("#modal_content").html(preloader);
            $("#modal .page-title").text("EDIT PATIENT");
            $("#modal").modal('show');

            setTimeout(() => {
                let html = formContent(data, true);
                $("#modal_content").html(html);
                generateInputsID("#modal");
                $(`[name="patient_code"]`).inputmask({
                    mask:        "99-9999",
                    placeholder: "00-0000"
                });
            }, 100);
        });
        // ----- END BUTTON EDIT -----


        // ----- CHANGE PATIENT TYPE -----
        $(document).on("change", `[name="patient_type_id"]`, function() {
            let patientType = $(this).val();

            $(`[name="course_id"]`).val('').trigger('change');
            $(`[name="year_id"]`).val('').trigger('change');
            $(`[name="section"]`).val('');

            if (patientType && patientType == 2) {
                $(`[name="course_id"]`).removeAttr("disabled").attr("required", true);
                $(`[name="year_id"]`).removeAttr("disabled").attr("required", true);
                $(`[name="section"]`).removeAttr("disabled").attr("required", true);
            } else {
                $(`[name="course_id"]`).attr("disabled", true);
                $(`[name="year_id"]`).attr("disabled", true);
                $(`[name="section"]`).attr("disabled", true);
                $(`[name="course_id"]`).removeClass("is-valid").removeClass("is-invalid").removeClass("no-error").removeClass("has-error");
                $(`[name="year_id"]`).removeClass("is-valid").removeClass("is-invalid").removeClass("no-error").removeClass("has-error");
                $(`[name="section"]`).removeClass("is-valid").removeClass("is-invalid").removeClass("no-error").removeClass("has-error");
                $(`[name="course_id"]`).closest(`.form-group`).find(`.invalid-feedback`).text('');
                $(`[name="year_id"]`).closest(`.form-group`).find(`.invalid-feedback`).text('');
                $(`[name="section"]`).closest(`.form-group`).find(`.invalid-feedback`).text('');
            }
        })
        // ----- END CHANGE PATIENT TYPE -----


        // ----- CHANGE COURSE -----
        $(document).on("change", `[name="course_id"]`, function() {
            let courseID = $(this).val();
            let options  = getYearOptionDisplay(courseID);
            $(`[name="year_id"]`).html(options);
        })
        // ----- END CHANGE COURSE -----


        // ----- TOGGLE PASSWORD -----
        $(document).on("click", ".password-icon", function() {
            let isDisplay = $(this).attr("display") == "true";
            if (isDisplay) {
                $(this).removeClass("mdi-eye").addClass("mdi-eye-off");
                $(`[name="password"]`).attr("type", "text");
            } else {
                $(this).removeClass("mdi-eye-off").addClass("mdi-eye");
                $(`[name="password"]`).attr("type", "password");
            }
            $(this).attr("display", !isDisplay);
        })
        // ----- END TOGGLE PASSWORD -----


        // ----- BUTTON SAVE -----
        $(document).on("click", `#btnSave`, function() {
            let patientID   = $(this).attr("patientID");
            let patientCode = $(`[name="patient_code"]`).val();
            
            let validate       = validateForm("modal");
            let checkPatientID = validatePatientID(patientID, patientCode);

            if (validate && checkPatientID) {
                $("#modal").modal("hide");

                let data = getFormData("modal");
                    data["tableName"] = "patients";
                    data["feedback"]  = $(`[name="patient_code"]`).val();
                    data["method"]    = "add";
    
                sweetAlertConfirmation("add", "Patient", "modal", null, data, true, refreshTableContent);
            }
        })
        // ----- END BUTTON SAVE -----


        // ----- BUTTON SAVE -----
        $(document).on("click", `#btnUpdate`, function() {
            let patientID   = $(this).attr("patientID");
            let patientCode = $(`[name="patient_code"]`).val();
            
            let validate       = validateForm("modal");
            let checkPatientID = validatePatientID(patientID, patientCode);
            
            if (validate && checkPatientID) {
                $("#modal").modal("hide");

                let data = getFormData("modal");
                    data["tableName"]   = "patients";
                    data["feedback"]    = $(`[name="patient_code"]`).val();
                    data["method"]      = "update";
                    data["whereFilter"] = `patient_id=${patientID}`;
    
                sweetAlertConfirmation("update", "Patient", "modal", null, data, true, refreshTableContent);
            }
        })
        // ----- END BUTTON SAVE -----
        

        // ----- BUTTON DELETE -----
        $(document).on("click", `.btnDelete`, function() {
            let patientID = $(this).attr("patientID");

            let data = {
                tableName: 'patients',
                tableData: {
                    is_deleted: 1
                },
                whereFilter: `patient_id=${patientID}`,
                feedback:    $(`[name="patient_code"]`).val(),
                method:      "update"
            }
            sweetAlertConfirmation("delete", "Patient", "modal", null, data, true, refreshTableContent);
        })
        // ----- END BUTTON DELETE -----


        // ----- FILTER PATIENT TYPE -----
        $(document).on('change', `[name="filter_patient_type"]`, function() {
            refreshTableContent();
        })
        // ----- END FILTER PATIENT TYPE -----

    })

</script>
    