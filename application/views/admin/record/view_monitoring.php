<div class="content-wrapper">

    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0"><?= $title ?></h4>
                        <!-- <button class="btn btn-secondary" onclick="window.location.replace('<?= base_url('admin/record') ?>')">Back</button> -->
                    </div>
                </div>
                <div class="card-body" id="pageContent">  
                    <table class="table table-bordered table-hover" id="tableMonitoringForm">
                        <!-- <thead>
                            <tr class="text-center">
                                <th>No.</th>
                                <th>Patient</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Case of Patient</th>
                                <th>Activity</th>
                                <th>Medicine Taken</th>
                                <th>Status</th>
                            </tr>
                        </thead> -->
                        <thead class="text-center">
                            <tr>
                                <th rowspan="2">No.</th>
                                <th rowspan="2">Date</th>
                                <th rowspan="2">Time</th>
                                <th colspan="5">Chief Complaint</th>
                                <th rowspan="2">
                                    <div>Treat/Management<br>Nurse Notes</div>
                                </th>
                                <th rowspan="2">Other</th>
                                <th rowspan="2">Referral</th>
                                <th rowspan="2">Status</th>
                            </tr>
                            <tr>
                                <th>Temperature</th>
                                <th>Pulse Rate</th>
                                <th>Respiratory Rate</th>
                                <th>Blood Pressure</th>
                                <th>Random Blood Sugar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($data && !empty($data)): ?>
                            <?php foreach ($data as $i => $x): 
                                $status = $x['status'] == 0 ? '<span class="badge badge-danger">Serious/Bad</span>' : 
                                    ($x['status'] == 1 ? '<span class="badge badge-primary">Fair</span>' : '<span class="badge badge-success">Good</span>');    
                            ?>
                                <tr>
                                    <td><?= $i+1 ?></td>
                                    <td><?= date("F d, Y", strtotime($x['date'])) ?></td>
                                    <td><?= date("h:i A", strtotime("2021-01-01 ".$x['time'])) ?></td>
                                    <td><?= $x['temperature'] ?></td>
                                    <td><?= $x['pulse_rate'] ?></td>
                                    <td><?= $x['respiratory_rate'] ?></td>
                                    <td><?= $x['blood_pressure'] ?></td>
                                    <td><?= $x['random_blood_sugar'] ?></td>
                                    <td><?= $x['medicine_taken'] ?></td>
                                    <td><?= $x['activity'] ?></td>
                                    <td><?= $x['referral'] ?></td>
                                    <td><?= $status ?></td>
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
    

<script>

    $(document).ready(function() {
        // ----- DATATABLES -----
        function initDataTables() {
            if ($.fn.DataTable.isDataTable("#tableMonitoringForm")) {
                $("#tableMonitoringForm").DataTable().destroy();
            }
            
            var table = $("#tableMonitoringForm")
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
                        { targets: 3, width: "110px" },		
                        { targets: 4, width: "200px" },		
                        { targets: 5, width: "200px" },		
                        { targets: 6, width: "200px" },		
                        { targets: 7, width: "100px" },		
                    ],
                });
        }
        // ----- END DATATABLES -----

        initDataTables();
    })

</script>