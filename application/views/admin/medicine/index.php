<div class="content-wrapper">

    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0">Medicine</h4>
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
        let unitList        = getTableData(`units WHERE is_deleted = 0`);
        let measurementList = getTableData(`measurements WHERE is_deleted = 0`);
        let categoryList    = getTableData(`category WHERE is_deleted = 0`);
        // ----- END GLOBAL VARIABLES -----


        // ----- DATATABLES -----
        function initDataTables() {
            if ($.fn.DataTable.isDataTable("#tableMedicine")) {
                $("#tableMedicine").DataTable().destroy();
            }
            
            var table = $("#tableMedicine")
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
                        { targets: 1, width: '100px' },
                        { targets: 2, width: '100px' },
                        { targets: 3, width: '100px' },
                        { targets: 4, width: '100px' },
                        { targets: 5, width: '100px' },
                        { targets: 6, width: '100px' },
                    ],
                });
        }
        // ----- END DATATABLES -----


        // ----- UNIT OPTIONS DISPLAY -----
        function getUnitOptionDisplay(unitID = 0) {
            let html = `<option value="" selected>Select unit</option>`;
            unitList.map(unit => {
                let {
                    unit_id,
                    name
                } = unit;

                html += `
                <option value="${unit_id}"
                    ${unit_id == unitID ? "selected" : ""}>${name}</option>`;
            })
            return html;
        }
        // ----- END UNIT OPTIONS DISPLAY -----


        // ----- MEASUREMENT OPTIONS DISPLAY -----
        function getMeasurementOptionDisplay(measurementID = 0) {
            let html = `<option value="" selected>Select measurement</option>`;
            measurementList.map(measurement => {
                let {
                    measurement_id,
                    name
                } = measurement;

                html += `
                <option value="${measurement_id}"
                    ${measurement_id == measurementID ? "selected" : ""}>${name}</option>`;
            })
            return html;
        }
        // ----- END MEASUREMENT OPTIONS DISPLAY -----


        // ----- CATEGORY OPTIONS DISPLAY -----
        function getCategoryOptionDisplay(categoryID = 0) {
            let html = `<option value="" selected>Select category</option>`;
            categoryList.map(category => {
                let {
                    category_id,
                    name
                } = category;

                html += `
                <option value="${category_id}"
                    ${category_id == categoryID ? "selected" : ""}>${name}</option>`;
            })
            return html;
        }
        // ----- END CATEGORY OPTIONS DISPLAY -----


        // ----- TABLE CONTENT -----
        function tableContent() {

            let tbodyHTML = '';
            let data = getTableData(
                `medicines AS m
                    LEFT JOIN units AS u USING(unit_id)
                    LEFT JOIN measurements AS m2 USING(measurement_id) 
                    LEFT JOIN category AS c USING(category_id)
                WHERE m.is_deleted = 0`,
                `m.*, u.name AS unit_name, m2.name AS measurement_name, c.name AS category_name`);
            data.map((item, index) => {
                let {
                    medicine_id      = "",
                    brand            = "",
                    name             = "",
                    unit_name        = "",
                    measurement_name = "",
                    category_name    = "",
                } = item;

                tbodyHTML += `
                <tr>
                    <td class="text-center">${index+1}</td>
                    <td>${name || "-"}</td>
                    <td>${brand || "-"}</td>
                    <td>${unit_name || "-"}</td>
                    <td>${measurement_name || "-"}</td>
                    <td>${category_name || "-"}</td>
                    <td>
                        <div class="text-center">
                            <button class="btn btn-outline-info btnEdit"
                                medicineID="${medicine_id}"><i class="fas fa-pencil-alt"></i></button>
                            <button class="btn btn-outline-danger btnDelete"
                                medicineID="${medicine_id}"><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </td>
                </tr>`;
            });

            let html = `
            <table class="table table-hover table-bordered" id="tableMedicine">
                <thead>
                    <tr class="text-center">
                        <th>No.</th>
                        <th>Name</th>
                        <th>Brand</th>
                        <th>Unit</th>
                        <th>Measurement</th>
                        <th>Category</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="tableMedicineTbody">
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
                                id="btnAdd"><i class="fas fa-plus"></i> Add Medicine</button>
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
                medicine_id    = "",
                brand          = "",
                name           = "",
                unit_id        = "",
                measurement_id = "",
                category_id    = "",
                reorder        = "",
                capacity       = "",
            } = data && data[0];

            let buttonSaveUpdate = !isUpdate ? `
            <button class="btn btn-primary" 
                id="btnSave"
                medicineID="${medicine_id}">Save</button>` : `
            <button class="btn btn-primary" 
                id="btnUpdate"
                medicineID="${medicine_id}">Update</button>`;

            let html = `
            <div class="row p-3">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label>Name <code>*</code></label>
                        <input type="text" 
                            class="form-control validate"
                            name="name"
                            minlength="1"
                            maxlength="100"
                            value="${name}"
                            required>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label>Brand</label>
                        <input type="text" 
                            class="form-control validate"
                            name="brand"
                            minlength="1"
                            maxlength="100"
                            value="${brand}">
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label>Unit <code>*</code></label>
                        <select class="form-control validate"
                            name="unit_id"
                            required>
                            ${getUnitOptionDisplay(unit_id)}    
                        </select>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label>Measurement <code>*</code></label>
                        <select class="form-control validate"
                            name="measurement_id"
                            required>
                            ${getMeasurementOptionDisplay(measurement_id)}    
                        </select>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label>Category <code>*</code></label>
                        <select class="form-control validate"
                            name="category_id"
                            required>
                            ${getCategoryOptionDisplay(category_id)}    
                        </select>
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Re-order <code>*</code></label>
                        <input type="number" 
                            class="form-control validate"
                            name="reorder"
                            minlength="1"
                            maxlength="100"
                            value="${reorder}">
                        <div class="d-block invalid-feedback"></div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label>Maximum Capacity <code>*</code></label>
                        <input type="number" 
                            class="form-control validate"
                            name="capacity"
                            minlength="1"
                            maxlength="100"
                            value="${capacity}">
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
            $("#modal .page-title").text("ADD MEDICINE");
            $("#modal").modal('show');
            generateInputsID("#modal");
        });
        // ----- END BUTTON ADD -----


        // ----- BUTTON EDIT -----
        $(document).on("click", ".btnEdit", function() {
            let medicineID = $(this).attr("medicineID");
            let data = getTableData(`medicines WHERE medicine_id = ${medicineID}`);

            $("#modal .modal-dialog").removeClass("modal-md").addClass("modal-md");
            $("#modal_content").html(preloader);
            $("#modal .page-title").text("EDIT MEDICINE");
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
            let medicineID = $(this).attr("medicineID");
            
            let validate = validateForm("modal");
            if (validate) {
                $("#modal").modal("hide");

                let data = getFormData("modal");
                    data["tableName"] = "medicines";
                    data["feedback"]  = $(`[name="name"]`).val();
                    data["method"]    = "add";
    
                sweetAlertConfirmation("add", "Medicine", "modal", null, data, true, refreshTableContent);
            }
        })
        // ----- END BUTTON SAVE -----


        // ----- BUTTON SAVE -----
        $(document).on("click", `#btnUpdate`, function() {
            let medicineID = $(this).attr("medicineID");
            
            let validate = validateForm("modal");
            if (validate) {
                $("#modal").modal("hide");

                let data = getFormData("modal");
                    data["tableName"]   = "medicines";
                    data["feedback"]    = $(`[name="name"]`).val();
                    data["method"]      = "update";
                    data["whereFilter"] = `medicine_id=${medicineID}`;
    
                sweetAlertConfirmation("update", "Medicine", "modal", null, data, true, refreshTableContent);
            }
        })
        // ----- END BUTTON SAVE -----
        

        // ----- BUTTON DELETE -----
        $(document).on("click", `.btnDelete`, function() {
            let medicineID = $(this).attr("medicineID");

            let data = {
                tableName: 'medicines',
                tableData: {
                    is_deleted: 1
                },
                whereFilter: `medicine_id=${medicineID}`,
                feedback:    $(`[name="name"]`).val(),
                method:      "update"
            }
            sweetAlertConfirmation("delete", "Medicine", "modal", null, data, true, refreshTableContent);
        })
        // ----- END BUTTON DELETE -----

    })

</script>
    