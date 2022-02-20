<div class="content-wrapper">

    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0">Section</h4>
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
        let courseList = getTableData(`courses WHERE is_deleted = 0`);
        let yearList   = getTableData(`years WHERE is_deleted = 0`);
        // ----- END GLOBAL VARIABLES -----


        // ----- DATATABLES -----
        function initDataTables() {
            if ($.fn.DataTable.isDataTable("#tableSection")) {
                $("#tableSection").DataTable().destroy();
            }
            
            var table = $("#tableSection")
                .css({ "min-width": "100%" })
                .removeAttr("width")
                .DataTable({
                    proccessing:    false,
                    serverSide:     false,
                    scrollX:        true,
                    sorting:        [],
                    scrollCollapse: true,
                    columnDefs: [
                        { targets: 0, width: '50px'  },
                        { targets: 1, width: '250px' },
                        { targets: 2, width: '100px' },
                        { targets: 3, width: '100px' },
                        { targets: 4, width: '100px' },
                    ],
                });
        }
        // ----- END DATATABLES -----


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
            yearList
                .filter(year => year.course_id == courseID)
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
        function tableContent() {

            let tbodyHTML = '';
            let data = getTableData(
                `sections AS s
                    LEFT JOIN years AS y ON s.year_id = y.year_id
                    LEFT JOIN courses AS c ON s.course_id = c.course_id
                WHERE s.is_deleted = 0`,
                `s.*, y.name AS year_name, c.name AS course_name`);
            data.map((item, index) => {
                let {
                    section_id  = "",
                    year_id     = "",
                    course_id   = "",
                    year_name   = "",
                    course_name = "",
                    name        = "",
                } = item;

                tbodyHTML += `
                <tr>
                    <td class="text-center">${index+1}</td>
                    <td>${course_name || "-"}</td>
                    <td>${year_name || "-"}</td>
                    <td>${name}</td>
                    <td>
                        <div class="text-center">
                            <button class="btn btn-outline-info btnEdit"
                                sectionID="${section_id}"><i class="fas fa-pencil-alt"></i></button>
                            <button class="btn btn-outline-danger btnDelete"
                                sectionID="${section_id}"><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </td>
                </tr>`;
            });

            let html = `
            <table class="table table-hover table-bordered" id="tableSection">
                <thead>
                    <tr class="text-center">
                        <th>No.</th>
                        <th>Course</th>
                        <th>Year</th>
                        <th>Section</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="tableSectionTbody">
                    ${tbodyHTML}
                </tbody>
            </table>`;

            return html;
        }
        // ----- END TABLE CONTENT -----


        // ----- REFRESH TABLE CONTENT -----
        function refreshTableContent() {
            !document.getElementsByClassName("jumping-dots-loader").length && $("#tableContent").html(preloader);
            
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
                                id="btnAdd"><i class="fas fa-plus"></i> Add Section</button>
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
                section_id  = "",
                year_id     = "",
                course_id   = "",
                name        = "",
            } = data && data[0];

            let buttonSaveUpdate = !isUpdate ? `
            <button class="btn btn-primary" 
                id="btnSave"
                sectionID="${section_id}">Save</button>` : `
            <button class="btn btn-primary" 
                id="btnUpdate"
                sectionID="${section_id}">Update</button>`;

            let html = `
            <div class="row p-3">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label>Course <code>*</code></label>
                        <select class="form-control validate"
                            name="course_id"
                            required>
                            ${getCourseOptionDisplay(course_id)}    
                        </select>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label>Year <code>*</code></label>
                        <select class="form-control validate"
                            name="year_id"
                            required>
                            ${getYearOptionDisplay(course_id, year_id)}    
                        </select>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label>Name <code>*</code></label>
                        <input type="text" 
                            class="form-control validate"
                            name="name"
                            minlength="1"
                            maxlength="50"
                            value="${name}"
                            required>
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


        // ----- SELECT COURSE -----
        $(document).on("change", `[name="course_id"]`, function() {
            let courseID = $(this).val();
            let optionHTML = getYearOptionDisplay(courseID);
            $(`[name="year_id"]`).html(optionHTML);
        })
        // ----- END SELECT COURSE -----


        // ----- BUTTON ADD -----
        $(document).on("click", "#btnAdd", function() {
            let html = formContent();
            $("#modal .modal-dialog").removeClass("modal-md").addClass("modal-md");
            $("#modal_content").html(html);
            $("#modal .page-title").text("ADD SECTION");
            $("#modal").modal('show');
            generateInputsID("#modal");
        });
        // ----- END BUTTON ADD -----


        // ----- BUTTON EDIT -----
        $(document).on("click", ".btnEdit", function() {
            let sectionID = $(this).attr("sectionID");
            let data = getTableData(`sections WHERE section_id = ${sectionID}`);

            $("#modal .modal-dialog").removeClass("modal-md").addClass("modal-md");
            $("#modal_content").html(preloader);
            $("#modal .page-title").text("EDIT SECTION");
            $("#modal").modal('show');

            setTimeout(() => {
                let html = formContent(data, true);
                $("#modal_content").html(html);
                generateInputsID("#modal");
            }, 100);
        });
        // ----- END BUTTON EDIT -----


        // ----- BUTTON SAVE -----
        $(document).on("click", `#btnSave`, function() {
            let sectionID = $(this).attr("sectionID");
            
            let validate = validateForm("modal");
            if (validate) {
                $("#modal").modal("hide");

                let data = getFormData("modal");
                    data["tableName"] = "sections";
                    data["feedback"]  = $(`[name="name"]`).val();
                    data["method"]    = "add";
    
                sweetAlertConfirmation("add", "Section", "modal", null, data, true, refreshTableContent);
            }
        })
        // ----- END BUTTON SAVE -----


        // ----- BUTTON SAVE -----
        $(document).on("click", `#btnUpdate`, function() {
            let sectionID = $(this).attr("sectionID");
            
            let validate = validateForm("modal");
            if (validate) {
                $("#modal").modal("hide");

                let data = getFormData("modal");
                    data["tableName"]   = "sections";
                    data["feedback"]    = $(`[name="name"]`).val();
                    data["method"]      = "update";
                    data["whereFilter"] = `section_id=${sectionID}`;
    
                sweetAlertConfirmation("update", "Section", "modal", null, data, true, refreshTableContent);
            }
        })
        // ----- END BUTTON SAVE -----
        

        // ----- BUTTON DELETE -----
        $(document).on("click", `.btnDelete`, function() {
            let sectionID = $(this).attr("sectionID");

            let data = {
                tableName: 'sections',
                tableData: {
                    is_deleted: 1
                },
                whereFilter: `section_id=${sectionID}`,
                feedback:    $(`[name="name"]`).val(),
                method:      "update"
            }
            sweetAlertConfirmation("delete", "Section", "modal", null, data, true, refreshTableContent);
        })
        // ----- END BUTTON DELETE -----

    })

</script>
    