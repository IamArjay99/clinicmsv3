<div class="content-wrapper">

    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0"><?= $title ?></h4>
                        <button class="btn btn-dark" onclick="window.location.replace('<?= base_url('admin/record') ?>')">Back</button>
                    </div>
                </div>
                <div class="card-body" id="pageContent">  
                    <?php if ($type == "medicine"): ?>

                    <table class="table table-bordered table-hover" id="medicineRecord">
                        <thead>
                            <tr class="text-center">
                                <th>No.</th>
                                <th>Date</th>
                                <th>Patient Name</th>
                                <th>Medicine</th>
                                <th>Brand</th>
                                <th>Category</th>
                                <th>Unit</th>
                                <th>Measurement</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php 
                            if ($data && !empty($data)):
                            foreach ($data as $i => $d):
                        ?>
                            <tr>
                                <td><?= $i+1 ?></td>
                                <td><?= date("F d, Y", strtotime($d['created_at'])) ?></td>
                                <td><?= $d['patient_name'] ?></td>
                                <td><?= $d['medicine_name'] ?></td>
                                <td><?= $d['medicine_brand'] ?></td>
                                <td><?= $d['category_name'] ?></td>
                                <td><?= $d['unit_name'] ?></td>
                                <td><?= $d['measurement_name'] ?></td>
                                <td><?= $d['quantity'] ?></td>
                            </tr>
                        <?php 
                            endforeach;
                            endif;
                        ?>

                        </tbody>
                    </table>     

                    <?php elseif ($type == "care_equipment"): ?>

                    <table class="table table-bordered table-hover" id="careEquipmentRecord">
                        <thead>
                            <tr class="text-center">
                                <th>No.</th>
                                <th>Date</th>
                                <th>Patient Name</th>
                                <th>Equipment Name</th>
                                <th>Unit</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php 
                            if ($data && !empty($data)):
                            foreach ($data as $i => $d):
                        ?>
                            <tr>
                                <td><?= $i+1 ?></td>
                                <td><?= date("F d, Y", strtotime($d['created_at'])) ?></td>
                                <td><?= $d['patient_name'] ?></td>
                                <td><?= $d['care_equipment_name'] ?></td>
                                <td><?= $d['unit_name'] ?></td>
                                <td><?= $d['quantity'] ?></td>
                            </tr>
                        <?php 
                            endforeach;
                            endif;
                        ?>

                        </tbody>
                    </table> 

                    <?php endif; ?> 
                </div>
            </div>
        </div>
    </div>

</div>
    

<script>

    $(document).ready(function() {

        function initDataTables() {
            if ($.fn.DataTable.isDataTable("#medicineRecord")) {
                $("#medicineRecord").DataTable().destroy();
            }
            var table = $("#medicineRecord")
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
                        { targets: 2, width: "100px" },	
                        { targets: 3, width: "100px" },	
                        { targets: 4, width: "100px" },	
                        { targets: 5, width: "100px" },	
                        { targets: 6, width: "100px" },	
                        { targets: 7, width: "100px" },	
                        { targets: 8, width: "100px" },	
                    ],
                });

            if ($.fn.DataTable.isDataTable("#careEquipmentRecord")) {
                $("#careEquipmentRecord").DataTable().destroy();
            }
            var table = $("#careEquipmentRecord")
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
                        { targets: 2, width: "100px" },	
                        { targets: 3, width: "100px" },	
                        { targets: 4, width: "100px" },	
                        { targets: 5, width: "100px" },	
                    ],
                });
        }
        initDataTables();

    })

</script>