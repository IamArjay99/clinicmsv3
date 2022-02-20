<div class="content-wrapper">

    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h4 class="mb-0">Stock In</h4>
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
            if ($.fn.DataTable.isDataTable("#tableStockIn")) {
                $("#tableStockIn").DataTable().destroy();
            }
            
            var table = $("#tableStockIn")
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
                        { targets: 3, width: '250px' },
                        { targets: 4, width: '100px' },
                    ],
                });
        }
        // ----- END DATATABLES -----


        // ----- TABLE CONTENT -----
        function tableContent() {

            let tbodyHTML = '';
            let data = getTableData(
                `stock_in AS si
                    LEFT JOIN purchase_request AS pr USING(purchase_request_id) 
                WHERE si.is_deleted = 0`,
                `si.*, pr.code AS purchase_request_code`);
            data.map((item, index) => {
                let {
                    stock_in_id           = "",
                    purchase_request_code = "",
                    code                  = "",
                    reason                = "",
                } = item;

                tbodyHTML += `
                <tr>
                    <td class="text-center">${index+1}</td>
                    <td class="text-center">${code || "-"}</td>
                    <td class="text-center">${purchase_request_code || "Internal"}</td>
                    <td>${reason || "-"}</td>
                    <td>
                        <div class="text-center">
                            <a class="btn btn-outline-primary btnView"
                                href="${base_url}admin/stock_in/view?id=${stock_in_id}"
                                stockInID="${stock_in_id}"><i class="fas fa-eye"></i> View</a>
                        </div>
                    </td>
                </tr>`;
            });

            let html = `
            <table class="table table-hover table-bordered" id="tableStockIn">
                <thead>
                    <tr class="text-center">
                        <th>No.</th>
                        <th>Code</th>
                        <th>Reference</th>
                        <th>Reason</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="tableStockInTbody">
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
                                href="${base_url}admin/stock_in/add"><i class="fas fa-plus"></i> Add Stock In</a>
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

    })

</script>
    