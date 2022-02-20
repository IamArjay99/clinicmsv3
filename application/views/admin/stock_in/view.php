<div class="content-wrapper">

    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-header bg-dark text-white py-2">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">View Stock In (<?= $data['code'] ?>)</h4>
                        <a href="<?= base_url('admin/stock_in') ?>"
                            class="btn btn-primary">Back</a>
                    </div>
                </div>
                <div class="card-body" id="pageContent">     
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Reference </label>
                                <input class="form-control" 
                                    type="text"
                                    value="<?= $data['code'] ?>"
                                    disabled>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Reason</label>
                                <textarea class="form-control validate"
                                    name="reason"
                                    minlength="0"
                                    maxlength="300"
                                    rows="3"
                                    style="resize: none;"
                                    disabled><?= $data['reason'] ?></textarea>
                                <div class="d-block invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-12" id="addStockInContent">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">MEDICINE</h5>
                                </div>
                                <div class="card-body" id="medicineContent">
                                    <div class="row">
                                        <div class="col-12" id="tableMedicineParent">
                                            <table class="table table-hover table-bordered" id="tableMedicine">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th>No.</th>
                                                        <th>Name </th>
                                                        <th>Brand</th>
                                                        <th>Unit</th>
                                                        <th>Measurement</th>
                                                        <th>Quantity </th>
                                                        <th>Batch No. </th>
                                                        <th>Expiration Date </th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tableMedicineTbody">
                                                <?php if ($data['medicine'] && !empty($data['medicine'])): ?>
                                                <?php foreach($data['medicine'] as $key => $med): ?>
                                                    <tr>
                                                        <td class="text-center"><?= $key+1 ?></td>
                                                        <td><?= $med['medicine_name'] ?></td>
                                                        <td><?= $med['medicine_brand'] ?></td>
                                                        <td><?= $med['unit_name'] ?></td>
                                                        <td><?= $med['measurement_name'] ?></td>
                                                        <td class="text-center"><?= $med['quantity'] ?></td>
                                                        <td><?= $med['batch'] ?></td>
                                                        <td class="text-center"><?= date("F d, Y", strtotime($med['expiration'])) ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card my-4">
                                <div class="card-header">
                                    <h5 class="mb-0">CARE EQUIPMENT</h5>
                                </div>
                                <div class="card-body" id="careEquipmentContent">
                                    <div class="row">
                                        <div class="col-12" id="tableCareEquipmentParent">
                                            <table class="table table-hover table-bordered" id="tableCareEquipment">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th>No.</th>
                                                        <th>Name </th>
                                                        <th>Unit</th>
                                                        <th>Quantity </th>
                                                        <th>Batch No. </th>
                                                        <th>Expiration Date </th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tableCareEquipmentTbody">
                                                <?php if ($data['care_equipment'] && !empty($data['care_equipment'])): ?>
                                                <?php foreach($data['care_equipment'] as $key => $med): ?>
                                                    <tr>
                                                        <td class="text-center"><?= $key+1 ?></td>
                                                        <td><?= $med['care_equipment_name'] ?></td>
                                                        <td><?= $med['unit_name'] ?></td>
                                                        <td class="text-center"><?= $med['quantity'] ?></td>
                                                        <td><?= $med['batch'] ?></td>
                                                        <td class="text-center"><?= date("F d, Y", strtotime($med['expiration'])) ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">OFFICE SUPPLY</h5>
                                </div>
                                <div class="card-body" id="officeSupplyContent">
                                    <div class="row">
                                        <div class="col-12" id="tableOfficeSupplyParent">
                                            <table class="table table-hover table-bordered" id="tableOfficeSupply">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th>No.</th>
                                                        <th>Name </th>
                                                        <th>Unit</th>
                                                        <th>Quantity </th>
                                                        <th>Batch No. </th>
                                                        <th>Expiration Date </th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tableOfficeSupplyTbody">
                                                <?php if ($data['office_supply'] && !empty($data['office_supply'])): ?>
                                                <?php foreach($data['office_supply'] as $key => $med): ?>
                                                    <tr>
                                                        <td class="text-center"><?= $key+1 ?></td>
                                                        <td><?= $med['office_supply_name'] ?></td>
                                                        <td><?= $med['unit_name'] ?></td>
                                                        <td class="text-center"><?= $med['quantity'] ?></td>
                                                        <td><?= $med['batch'] ?></td>
                                                        <td class="text-center"><?= date("F d, Y", strtotime($med['expiration'])) ?></td>
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
                    scrollCollapse: true,
                    columnDefs: [
                        { targets: 0, width: '50px'  },
                        { targets: 1, width: '150px' },
                        { targets: 2, width: '100px' },
                        { targets: 3, width: '100px' },
                        { targets: 4, width: '100px' },
                        { targets: 5, width: '100px' },
                        { targets: 6, width: '100px' },
                        { targets: 7, width: '100px' },
                    ],
                });

            if ($.fn.DataTable.isDataTable("#tableCareEquipment")) {
                $("#tableCareEquipment").DataTable().destroy();
            }
            
            var table = $("#tableCareEquipment")
                .css({ "min-width": "100%" })
                .removeAttr("width")
                .DataTable({
                    proccessing:    false,
                    serverSide:     false,
                    scrollX:        true,
                    scrollCollapse: true,
                    columnDefs: [
                        { targets: 0, width: '50px'  },
                        { targets: 1, width: '150px' },
                        { targets: 2, width: '100px' },
                        { targets: 3, width: '100px' },
                        { targets: 4, width: '100px' },
                        { targets: 5, width: '100px' },
                    ],
                });

            if ($.fn.DataTable.isDataTable("#tableOfficeSupply")) {
                $("#tableOfficeSupply").DataTable().destroy();
            }
            
            var table = $("#tableOfficeSupply")
                .css({ "min-width": "100%" })
                .removeAttr("width")
                .DataTable({
                    proccessing:    false,
                    serverSide:     false,
                    scrollX:        true,
                    scrollCollapse: true,
                    columnDefs: [
                        { targets: 0, width: '50px'  },
                        { targets: 1, width: '150px' },
                        { targets: 2, width: '100px' },
                        { targets: 3, width: '100px' },
                        { targets: 4, width: '100px' },
                        { targets: 5, width: '100px' },
                    ],
                });
        }
        initDataTables();
        // ----- END DATATABLES -----

    })

</script>
    