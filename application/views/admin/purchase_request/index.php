<div class="content-wrapper">

    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0">Purchase Request</h4>
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
            if ($.fn.DataTable.isDataTable("#tablePurchaseRequest")) {
                $("#tablePurchaseRequest").DataTable().destroy();
            }
            
            var table = $("#tablePurchaseRequest")
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
                        { targets: 2, width: '250px' },
                        { targets: 3, width: '100px' },
                        { targets: 4, width: '100px' },
                    ],
                });
        }
        // ----- END DATATABLES -----


        // ----- TABLE CONTENT -----
        function tableContent() {

            const getStatusStyle = (status = 0) => {
                if (status == 0) return `<span class="badge badge-info">Pending</span>`;
                else if (status == 1) return `<span class="badge badge-success">Approved</span>`;
                else return `<span class="badge badge-danger">Cancelled</span>`;
            }

            let tbodyHTML = '';
            let data = getTableData(`purchase_request WHERE is_deleted = 0`);
            data.map((item, index) => {
                let {
                    purchase_request_id = "",
                    code                = "",
                    reason              = "",
                    status              = "",
                } = item;

                tbodyHTML += `
                <tr>
                    <td class="text-center">${index+1}</td>
                    <td class="text-center">${code || "-"}</td>
                    <td>${reason || "-"}</td>
                    <td class="text-center">${getStatusStyle(status)}</td>
                    <td>
                        <div class="text-center">
                            <button class="btn btn-outline-info btnEdit"
                                purchaseRequestID="${purchase_request_id}">
                                <i class="fas fa-pencil-alt"></i>
                            </button>
                            <a class="btn btn-outline-primary btnView"
                                href="${base_url}admin/purchase_request/view?id=${purchase_request_id}"
                                purchaseRequestID="${purchase_request_id}"><i class="fas fa-eye"></i></a>
                        </div>
                    </td>
                </tr>`;
            });

            let html = `
            <table class="table table-hover table-bordered" id="tablePurchaseRequest">
                <thead>
                    <tr class="text-center">
                        <th>No.</th>
                        <th>Code</th>
                        <th>Purpose</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="tablePurchaseRequestTbody">
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
                            <a class="btn btn-primary"
                                href="${base_url}admin/purchase_request/add"><i class="fas fa-plus"></i> Add Purchase Request</a>
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


        // ----- BUTTON EDIT -----
        $(document).on('click', '.btnEdit', function() {
            let purchaseRequestID = $(this).attr("purchaseRequestID");
            $("#modal").modal("show");
            $("#modal .page-title").text("EDIT PURCHASE REQUEST");
            $("#modal_content").html(preloader);
            setTimeout(function() {
                let data = getTableData(`purchase_request WHERE purchase_request_id=${purchaseRequestID}`);

                if (data && data.length) {
                    let { purchase_request_id, status } = data && data[0];

                    let html = `
                    <div class="row p-3">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control validate"
                                    name="status"
                                    id="status"
                                    required>
                                    <option value="0" ${status == "0" ? "selected" : ""}>Pending</option>
                                    <option value="1" ${status == "1" ? "selected" : ""}>Approved</option>
                                    <option value="2" ${status == "2" ? "selected" : ""}>Cancelled</option>
                                </select>
                                <div class="d-block invalid-feedback" id="invalid-status"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" 
                            id="btnUpdate"
                            purchaseRequestID="${purchase_request_id}">Update</button>
                        <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    </div>`;
                    $("#modal_content").html(html);
                } else {
                    $("#modal").modal("hide");
                }
            }, 100)
        })
        // ----- END BUTTON EDIT -----


        // ----- BUTTON UPDATE -----
        $(document).on("click", `#btnUpdate`, function() {
            let purchaseRequestID = $(this).attr("purchaseRequestID");
            
            let validate = validateForm("modal");
            if (validate) {
                $("#modal").modal("hide");

                let data = getFormData("modal");
                    data["tableName"]   = "purchase_request";
                    data["feedback"]    = `Pruchase Request`;
                    data["method"]      = "update";
                    data["whereFilter"] = `purchase_request_id=${purchaseRequestID}`;
    
                sweetAlertConfirmation("update", "Purchase Request", "modal", null, data, true, refreshTableContent);
            }
        })
        // ----- END BUTTON UPDATE -----

    })

</script>
    