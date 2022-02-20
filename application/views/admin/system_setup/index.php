<div class="content-wrapper">

    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0">System Setup</h4>
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


        // ----- DATATABLES -----
        function initDataTables() {
            if ($.fn.DataTable.isDataTable("#tableSystemSetup")) {
                $("#tableSystemSetup").DataTable().destroy();
            }
            
            var table = $("#tableSystemSetup")
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
                    ],
                });
        }
        // ----- END DATATABLES -----


        // ----- TABLE CONTENT -----
        function tableContent() {

            let tbodyHTML = '';
            let data = getTableData(`system_setup WHERE is_deleted = 0`);
            data.map((item, index) => {
                let {
                    system_setup_id = "",
                    email           = "",
                } = item;

                tbodyHTML += `
                <tr>
                    <td class="text-center">${index + 1}</td>
                    <td>${email}</td>
                    <td>
                        <div class="text-center">
                            <button class="btn btn-outline-info btnEdit"
                                systemSetupID="${system_setup_id}"><i class="fas fa-pencil-alt"></i></button>
                        </div>
                    </td>   
                </tr>`;
            });

            let html = `
            <table class="table table-hover table-bordered" id="tableSystemSetup">
                <thead>
                    <tr class="text-center">
                        <th class="thSm">No.</th>
                        <th class="thLg">Email</th>
                        <th class="thSm">Action</th>
                    </tr>
                </thead>
                <tbody id="tableSystemSetupTbody">
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
                system_setup_id = "",
                email           = "",
            } = data && data[0];

            let buttonSaveUpdate = !isUpdate ? `
            <button class="btn btn-primary" 
                id="btnSave"
                systemSetupID="${system_setup_id}">Save</button>` : `
            <button class="btn btn-primary" 
                id="btnUpdate"
                systemSetupID="${system_setup_id}">Update</button>`;

            let html = `
            <div class="row p-3">
                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label>Email <code>*</code></label>
                        <input type="text" 
                            class="form-control validate"
                            name="email"
                            minlength="1"
                            maxlength="200"
                            value="${email}"
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


        // ----- BUTTON ADD -----
        $(document).on("click", "#btnAdd", function() {
            let html = formContent();
            $("#modal .modal-dialog").removeClass("modal-md").addClass("modal-md");
            $("#modal_content").html(html);
            $("#modal .page-email").text("ADD SYSTEM SETUP");
            $("#modal").modal('show');
            generateInputsID("#modal");
        });
        // ----- END BUTTON ADD -----


        // ----- BUTTON EDIT -----
        $(document).on("click", ".btnEdit", function() {
            let systemSetupID = $(this).attr("systemSetupID");
            let data = getTableData(`system_setup WHERE system_setup_id = ${systemSetupID}`);

            $("#modal .modal-dialog").removeClass("modal-md").addClass("modal-md");
            $("#modal_content").html(preloader);
            $("#modal .page-title").text("EDIT SYSTEM SETUP");
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
            let systemSetupID = $(this).attr("systemSetupID");
            
            let validate = validateForm("modal");
            if (validate) {
                $("#modal").modal("hide");

                let data = getFormData("modal");
                    data["tableName"] = "system_setup";
                    data["feedback"]  = "System Setup";
                    data["method"]    = "add";
    
                sweetAlertConfirmation("add", "System Setup", "modal", null, data, true, refreshTableContent);
            }
        })
        // ----- END BUTTON SAVE -----


        // ----- BUTTON SAVE -----
        $(document).on("click", `#btnUpdate`, function() {
            let systemSetupID = $(this).attr("systemSetupID");
            
            let validate = validateForm("modal");
            if (validate) {
                $("#modal").modal("hide");

                let data = getFormData("modal");
                    data["tableName"]   = "system_setup";
                    data["feedback"]    = "System Setup";
                    data["method"]      = "update";
                    data["whereFilter"] = `system_setup_id=${systemSetupID}`;
    
                sweetAlertConfirmation("update", "System Setup", "modal", null, data, true, refreshTableContent);
            }
        })
        // ----- END BUTTON SAVE -----
        

        // ----- BUTTON DELETE -----
        $(document).on("click", `.btnDelete`, function() {
            let systemSetupID = $(this).attr("systemSetupID");

            let data = {
                tableName: 'system_setup',
                tableData: {
                    is_deleted: 1
                },
                whereFilter: `system_setup_id=${systemSetupID}`,
                feedback:    "System Setup",
                method:      "update"
            }
            sweetAlertConfirmation("delete", "System Setup", "modal", null, data, true, refreshTableContent);
        })
        // ----- END BUTTON DELETE -----

    })

</script>
    