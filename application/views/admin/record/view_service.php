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
                    <div class="row" id="checkupForm">
                        <div class="col-md-12 col-sm-12">
                            <div class="row">
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label>Service </label>
                                        <input type="text"
                                            class="form-control"
                                            value="<?= $data['service_name'] ?>"
                                            disabled>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label>Patient Name </label>
                                        <input type="text"
                                            class="form-control"
                                            value="<?= $data['patient_name'] ?>"
                                            disabled>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <input type="text"
                                            class="form-control"
                                            value="<?= $data['gender'] ?>"
                                            disabled>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label>Age</label>
                                        <input type="text"
                                            class="form-control"
                                            value="<?= $data['age'] ?>"
                                            disabled>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Course</label>
                                        <input type="text"
                                            class="form-control"
                                            value="<?= $data['course_name'] ?>"
                                            disabled>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label>Year</label>
                                        <input type="text"
                                            class="form-control"
                                            name="year"
                                            value="<?= $data['year_name'] ?>"
                                            disabled>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label>Section</label>
                                        <input type="text"
                                            class="form-control"
                                            value="<?= $data['section'] ?>"
                                            disabled>
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="mb-0">Chief Complain</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-2 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Temperature</label>
                                                        <input type="text"
                                                            class="form-control validate"
                                                            name="temperature"
                                                            value="<?= $data['temperature'] ?>"
                                                            disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Pulse rate</label>
                                                        <input type="text"
                                                            class="form-control validate"
                                                            name="pulse_rate"
                                                            value="<?= $data['pulse_rate'] ?>"
                                                            disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Respiratory Rate</label>
                                                        <input type="text"
                                                            class="form-control validate"
                                                            name="respiratory_rate"
                                                            value=""<?= $data['respiratory_rate'] ?>
                                                            disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Blood Pressure</label>
                                                        <input type="text"
                                                            class="form-control validate"
                                                            name="blood_pressure"
                                                            value="<?= $data['blood_pressure'] ?>"
                                                            disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Random Blood Sugar</label>
                                                        <input type="text"
                                                            class="form-control validate"
                                                            name="random_blood_sugar"
                                                            value="<?= $data['random_blood_sugar'] ?>"
                                                            disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 col-sm-12">
                                                    <div class="form-group">
                                                        <label>Others</label>
                                                        <input type="text"
                                                            class="form-control validate"
                                                            name="others"
                                                            value="<?= $data['others'] ?>"
                                                            disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-12" id="treatmentDisplay"></div>

                        <div class="col-12 mb-3">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="mb-0">Medicine</h4>
                                </div>
                                <div class="card-body">
                                    <table class="table table-hover table-bordered" id="tableMedicine">
                                        <thead>
                                            <tr class="text-center">
                                                <th>&nbsp;</th>
                                                <th>Name </th>
                                                <th>Brand</th>
                                                <th>Unit</th>
                                                <th>Measurement</th>
                                                <th>Quantity </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                        <?php
                                            if ($data['medicine'] && !empty($data['medicine'])): 
                                            foreach($data['medicine'] as $i => $m): 
                                        ?>
                                            <tr>
                                                <td class="text-center"><?= $i+1 ?></td>
                                                <td><?= $m['medicine_name'] ?></td>
                                                <td><?= $m['medicine_brand'] ?></td>
                                                <td><?= $m['unit_name'] ?></td>
                                                <td><?= $m['measurement_name'] ?></td>
                                                <td class="text-center"><?= $m['quantity'] ?></td>
                                            </tr>
                                        <?php
                                            endforeach;
                                            endif;
                                        ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="mb-0">Care Equipment</h4>
                                </div>
                                <div class="card-body">
                                <table class="table table-hover table-bordered" id="tableCareEquipment">
                                        <thead>
                                            <tr class="text-center">
                                                <th>&nbsp;</th>
                                                <th>Name </th>
                                                <th>Unit</th>
                                                <th>Quantity </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                        <?php
                                            if ($data['care_equipment'] && !empty($data['care_equipment'])): 
                                            foreach($data['care_equipment'] as $i => $m): 
                                        ?>
                                            <tr>
                                                <td class="text-center"><?= $i+1 ?></td>
                                                <td><?= $m['care_equipment_name'] ?></td>
                                                <td><?= $m['unit_name'] ?></td>
                                                <td class="text-center"><?= $m['quantity'] ?></td>
                                            </tr>
                                        <?php
                                            endforeach;
                                            endif;
                                        ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 my-4">
                            <div class="form-group">
                                <label>Recommendation </label>
                                <textarea class="form-control validate"
                                    name="recommendation"
                                    rows="5"
                                    style="resize: none"
                                    disabled><?= $data['recommendation'] ?></textarea>
                                <div class="d-block invalid-feedback"></div>
                            </div>
                        </div>

                        <div class="col-12" id="medicalHistoryContent"></div>
                        <div class="col-12 mt-3" id="clinicalCaseRecordContent">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="mb-0">CLINICAL CASE RECORD</h4>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered table-hover" id="tableClinicalCaseRecord">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Date</th>
                                                <th>Health Complaint</th>
                                                <th>Treatment</th>
                                                <th>Follow-up Schedule/Referral</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                        <?php
                                            if ($data['clinical_case'] && !empty($data['clinical_case'])):
                                            foreach ($data['clinical_case'] as $i => $cc):
                                        ?>
                                            <tr>
                                                <td class="text-center"><?= $i + 1 ?></td>
                                                <td class="text-center"><?= date("F d, Y", strtotime($cc['created_at'])) ?></td>
                                                <td><?= $cc['health_complaint'] ?></td>
                                                <td><?= $cc['treatment'] ?></td>
                                                <td class="text-center"><?= $cc['schedule'] ? date("F d, Y", strtotime($cc['created_at'])) : "-" ?></td>
                                            </tr>
                                        <?php
                                            endforeach;
                                            endif;
                                        ?>

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
    