<div class="content-wrapper">

    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-header bg-dark text-white py-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0"><?= ucwords($type) ?> (<?= $name ?>)</h4>
                        <button class="btn btn-dark" onclick="window.history.back()">Back</button>
                    </div>
                </div>
                <div class="card-body" id="pageContent">     
                    <div class="row">
                        <div class="col-12" id="supplyContent">

                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">STOCK IN</h5>
                                </div>
                                <div class="card-body" id="stockInContent">
                                    <div class="row">
                                        <div class="col-12" id="tableStockInParent">
                                            <table class="table table-hover table-bordered" id="tableStockIn">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th>No.</th>
                                                        <th>Stock In Date</th>
                                                        <th>Quantity </th>
                                                        <th>Remaining </th>
                                                        <th>Batch No. </th>
                                                        <th>Expiration Date </th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tableStockInTbody">
                                                <?php if ($data['stockin'] && !empty($data['stockin'])): ?>
                                                <?php foreach($data['stockin'] as $key => $si): ?>
                                                    <tr>
                                                        <td class="text-center"><?= $key+1 ?></td>
                                                        <td class="text-center"><?= date("F d, Y", strtotime($si['created_at'])) ?></td>
                                                        <td class="text-center"><?= $si['quantity'] ?></td>
                                                        <td class="text-center"><?= $si['remaining'] ?></td>
                                                        <td><?= $si['batch'] ?></td>
                                                        <td class="text-center"><?= date("F d, Y", strtotime($si['expiration'])) ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mt-4">
                                <div class="card-header">
                                    <h5 class="mb-0">STOCK OUT</h5>
                                </div>
                                <div class="card-body" id="stockOutContent">
                                    <div class="row">
                                        <div class="col-12" id="tableStockOutParent">
                                            <table class="table table-hover table-bordered" id="tableStockOut">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th>No.</th>
                                                        <th>Stock Out Date</th>
                                                        <th>Quantity </th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tableStockOutTbody">
                                                <?php if ($data['stockout'] && !empty($data['stockout'])): ?>
                                                <?php foreach($data['stockout'] as $key => $so): ?>
                                                    <tr>
                                                        <td class="text-center"><?= $key+1 ?></td>
                                                        <td class="text-center"><?= date("F d, Y", strtotime($so['created_at'])) ?></td>
                                                        <td class="text-center"><?= $so['quantity'] ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
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
                    scrollCollapse: true,
                    columnDefs: [
                        { targets: 0, width: '50px'  },
                        { targets: 1, width: '100px' },
                        { targets: 2, width: '100px' },
                        { targets: 3, width: '100px' },
                        { targets: 4, width: '100px' },
                        { targets: 5, width: '100px' },
                    ],
                });

            if ($.fn.DataTable.isDataTable("#tableStockOut")) {
                $("#tableStockOut").DataTable().destroy();
            }
            
            var table = $("#tableStockOut")
                .css({ "min-width": "100%" })
                .removeAttr("width")
                .DataTable({
                    proccessing:    false,
                    serverSide:     false,
                    scrollX:        true,
                    scrollCollapse: true,
                    columnDefs: [
                        { targets: 0, width: '50px'  },
                        { targets: 1, width: '100px' },
                        { targets: 2, width: '100px' },
                    ],
                });
        }
        initDataTables();
        // ----- END DATATABLES -----

    })

</script>
    