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
                                <div class="col-md-6 col-sm-12">
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
                                
                            </div>
                        </div>

                        <div class="col-12 mb-3">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="mb-0">Check-up History</h4>
                                </div>
                                <div class="card-body">
                                    <table class="table table-hover table-bordered" id="tableMedicine">
                                        <thead>
                                            <tr class="text-center">
                                                <th>&nbsp;</th>
                                                <th>Date</th>
                                                <th>Service</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        <?php 
                                            if ($data['check_up_data'] && !empty($data['check_up_data'])):
                                            foreach ($data['check_up_data'] as $i => $cu):
                                                $type = $cu['service_id'] == 1 ? "medical" : "dispensing_medicine";
                                        ?>
                                            <tr>
                                                <td class="text-center"><?= $i + 1 ?></td>
                                                <td><?= date('F d, Y', strtotime($cu['created_at'])) ?></td>
                                                <td><?= $cu['service_name'] ?></td>
                                                <td class="text-center">
                                                    <a href="<?= base_url('admin/record/view_service?id='. $cu['check_up_id'] .'&type='.$type) ?>"
                                                        target="_blank"
                                                        class="btn btn-outline-info">
                                                        <i class="fas fa-eye"></i> View    
                                                    </a>
                                                </td>
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
                                    <h4 class="mb-0">Medical History</h4>
                                </div>
                                <div class="card-body">
                                <?php 
                                    if ($data['medical_history'] && !empty($data['medical_history'])):
                                    $mh = $data['medical_history'];
                                ?>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Marital Status</label>
                                                <div class="d-flex align-items-center">
                                                    <div class="ml-3">
                                                        <input type="radio"
                                                            name="marital_status"
                                                            <?= $mh['marital_status'] && $mh['marital_status'] == "Single" ? "checked" : "" ?>
                                                            value="Single"
                                                            disabled> Single
                                                    </div>
                                                    <div class="ml-3">
                                                        <input type="radio"
                                                            name="marital_status"
                                                            <?= $mh['marital_status'] && $mh['marital_status'] == "Married" ? "checked" : "" ?>
                                                            value="Married"
                                                            disabled> Married
                                                    </div>
                                                    <div class="ml-3">
                                                        <input type="radio"
                                                            name="marital_status"
                                                            <?= $mh['marital_status'] && $mh['marital_status'] == "Partnership" ? "checked" : "" ?>
                                                            value="Partnership"
                                                            disabled> Partnership
                                                    </div>
                                                    <div class="ml-3">
                                                        <input type="radio"
                                                            name="marital_status"
                                                            <?= $mh['marital_status'] && $mh['marital_status'] == "Separated" ? "checked" : "" ?>
                                                            value="Separated"
                                                            disabled> Separated
                                                    </div>
                                                    <div class="ml-3">
                                                        <input type="radio"
                                                            name="marital_status"
                                                            <?= $mh['marital_status'] && $mh['marital_status'] == "Divorced" ? "checked" : "" ?>
                                                            value="Divorced"
                                                            disabled> Divorced
                                                    </div>
                                                    <div class="ml-3">
                                                        <input type="radio"
                                                            name="marital_status"
                                                            <?= $mh['marital_status'] && $mh['marital_status'] == "Widowed" ? "checked" : "" ?>
                                                            value="Widowed"
                                                            disabled> Widowed
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Previous or referring doctors</label>
                                                <input type="text"
                                                    class="form-control validate"
                                                    name="referring_doctors"
                                                    minlength="0"
                                                    maxlength="200"
                                                    value="<?= $mh['referring_doctors'] ?>"
                                                    disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Date of last physical exam</label>
                                                <input type="date"
                                                    class="form-control validate"
                                                    name="last_physical_exam"
                                                    minlength="0"
                                                    maxlength="200"
                                                    value="<?= $mh['last_physical_exam'] ?>"
                                                    disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Are you already vaccinated?</label>
                                                <div class="d-flex align-items-center">
                                                    <div class="ml-2">
                                                        <input type="radio"
                                                            name="is_vaccinated"
                                                            value="Yes"
                                                            <?= $mh['is_vaccinated'] == "Yes" ? "checked" : "" ?>
                                                            disabled> Yes
                                                    </div>
                                                    <div class="ml-2">
                                                        <input type="radio"
                                                            name="is_vaccinated"
                                                            value="No"
                                                            <?= $mh['is_vaccinated'] == "No" ? "checked" : "" ?>
                                                            disabled> No
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Covid19 patient?</label>
                                                <div class="d-flex align-items-center">
                                                    <div class="ml-2">
                                                        <input type="radio"
                                                            name="covid_patient"
                                                            value="Yes"
                                                            <?= $mh['covid_patient'] == "Yes" ? "checked" : "" ?>
                                                            disabled> Yes
                                                    </div>
                                                    <div class="ml-2">
                                                        <input type="radio"
                                                            name="covid_patient"
                                                            value="No"
                                                            <?= $mh['covid_patient'] == "Yes" ? "checked" : "" ?>
                                                            disabled> No
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <?php 
                                            $childhood_illness = explode('|', $mh['childhood_illness']);
                                            $immunization      = explode('|', $mh['immunization']);
                                        ?>

                                        <div class="col-12 mt-3">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="mb-0">PERSONAL HEALTH HISTORY</h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label>Childhood illness</label>
                                                                <div class="d-flex align-items-center">
                                                                    <div class="ml-2">
                                                                        <input type="checkbox"
                                                                            name="childhood_illness"
                                                                            value="Measles"
                                                                            <?= in_array('Measles', $childhood_illness) ? "checked" : "" ?>
                                                                            disabled> Measles
                                                                    </div>
                                                                    <div class="ml-2">
                                                                        <input type="checkbox"
                                                                            name="childhood_illness"
                                                                            value="Mumps"
                                                                            <?= in_array('Mumps', $childhood_illness) ? "checked" : "" ?>
                                                                            disabled> Mumps
                                                                    </div>
                                                                    <div class="ml-2">
                                                                        <input type="checkbox"
                                                                            name="childhood_illness"
                                                                            value="Rubella"
                                                                            <?= in_array('Rubella', $childhood_illness) ? "checked" : "" ?>
                                                                            disabled> Rubella
                                                                    </div>
                                                                    <div class="ml-2">
                                                                        <input type="checkbox"
                                                                            name="childhood_illness"
                                                                            value="Chickenpox"
                                                                            <?= in_array('Chickenpox', $childhood_illness) ? "checked" : "" ?>
                                                                            disabled> Chickenpox
                                                                    </div>
                                                                    <div class="ml-2">
                                                                        <input type="checkbox"
                                                                            name="childhood_illness"
                                                                            value="Rheumatic Fever"
                                                                            <?= in_array('Rheumatic Fever', $childhood_illness) ? "checked" : "" ?>
                                                                            disabled> Rheumatic Fever
                                                                    </div>
                                                                    <div class="ml-2">
                                                                        <input type="checkbox"
                                                                            name="childhood_illness"
                                                                            value="Polio"
                                                                            <?= in_array('Polio', $childhood_illness) ? "checked" : "" ?>
                                                                            disabled> Polio
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label>Immunization and dates</label>
                                                                <div class="d-flex align-items-center">
                                                                    <div class="ml-2">
                                                                        <input type="checkbox"
                                                                            name="immunization"
                                                                            value="Tetanus"
                                                                            <?= in_array('Tetanus', $immunization) ? 'checked' : '' ?>
                                                                            disabled> Tetanus
                                                                    </div>
                                                                    <div class="ml-2">
                                                                        <input type="checkbox"
                                                                            name="immunization"
                                                                            value="Pheumonia"
                                                                            <?= in_array('Pheumonia', $immunization) ? 'checked' : '' ?>
                                                                            disabled> Pheumonia
                                                                    </div>
                                                                    <div class="ml-2">
                                                                        <input type="checkbox"
                                                                            name="immunization"
                                                                            value="Hepatatis"
                                                                            <?= in_array('Hepatatis', $immunization) ? 'checked' : '' ?>
                                                                            disabled> Hepatatis
                                                                    </div>
                                                                    <div class="ml-2">
                                                                        <input type="checkbox"
                                                                            name="immunization"
                                                                            value="Chickenpox"
                                                                            <?= in_array('Chickenpox', $immunization) ? 'checked' : '' ?>
                                                                            disabled> Chickenpox
                                                                    </div>
                                                                    <div class="ml-2">
                                                                        <input type="checkbox"
                                                                            name="immunization"
                                                                            value="Influenza"
                                                                            <?= in_array('Influenza', $immunization) ? 'checked' : '' ?>
                                                                            disabled> Influenza
                                                                    </div>
                                                                    <div class="ml-2">
                                                                        <input type="checkbox"
                                                                            name="immunization"
                                                                            value="MMR,Measles,Mumps,Rubella"
                                                                            <?= in_array('MMR,Measles,Mumps,Rubella', $immunization) ? 'checked' : '' ?>
                                                                            disabled> MMR,Measles,Mumps,Rubella
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label>List any medical problems that other doctors have diagnosed</label>
                                                                <textarea class="form-control validate"
                                                                    name="medical_problems"
                                                                    rows="3"
                                                                    style="resize: none;"
                                                                    disabled><?= $mh['medical_problems'] ?></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 pb-3"><hr></div>
                                                        <div class="col-12">
                                                            <h4>Surgeries</h4>
                                                            <table class="table table-bordered table-hover" id="tableSurgery">
                                                                <thead>
                                                                    <tr class="text-center">
                                                                        <th>No</th>
                                                                        <th>Year</th>
                                                                        <th>Reason</th>
                                                                        <th>Hospital</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="tableSurgeryTbody">
                                                                
                                                                <?php 
                                                                    if ($mh['surgery'] && !empty($mh['surgery'])):
                                                                    foreach($mh['surgery'] as $i => $s): 
                                                                ?>
                                                                    <tr>
                                                                        <td class="text-center"><?= $i + 1 ?></td>
                                                                        <td><?= $s['year'] ?></td>
                                                                        <td><?= $s['reason'] ?></td>
                                                                        <td><?= $s['hospital'] ?></td>
                                                                    </tr>
                                                                <?php 
                                                                    endforeach;
                                                                    endif; 
                                                                ?>
                                                                    
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="col-12 py-3"><hr></div>
                                                        <div class="col-12">
                                                            <h4>Other Hospitalizations</h4>
                                                            <table class="table table-bordered table-hover" id="tableHospitalization">
                                                                <thead>
                                                                    <tr class="text-center">
                                                                        <th>No.</th>
                                                                        <th>Year</th>
                                                                        <th>Reason</th>
                                                                        <th>Hospital</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="tableHospitalizationTbody">

                                                                <?php 
                                                                    if ($mh['hospitalization'] && !empty($mh['hospitalization'])):
                                                                    foreach ($mh['hospitalization'] as $i => $h):
                                                                ?>
                                                                    <tr>
                                                                        <td class="text-center"><?= $i+1 ?></td>
                                                                        <td><?= $h['year'] ?></td>
                                                                        <td><?= $h['reason'] ?></td>
                                                                        <td><?= $h['hospital'] ?></td>
                                                                    </tr>
                                                                <?php
                                                                    endforeach;
                                                                    endif;
                                                                ?>

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="col-12 mt-3">
                                                            <div class="form-group">
                                                                <label>Have you ever had a blood transmission?</label>
                                                                <div class="d-flex align-items-center">
                                                                    <div class="ml-2">
                                                                        <input type="radio"
                                                                            name="blood_transmission"
                                                                            value="Yes"
                                                                            <?= $mh['blood_transmission'] == "Yes" ? "checked" : "" ?>
                                                                            disabled> Yes
                                                                    </div>
                                                                    <div class="ml-2">
                                                                        <input type="radio"
                                                                            name="blood_transmission"
                                                                            value="No"
                                                                            <?= $mh['blood_transmission'] == "No" ? "checked" : "" ?>
                                                                            disabled> No
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 py-3"><hr></div>
                                                        <div class="col-12">
                                                            <h4>List your prescribed drugs and over-the-counter drugs, such as vitamins and inhalers</h4>
                                                            <table class="table table-bordered table-hover" id="tablePrescribeDrug">
                                                                <thead>
                                                                    <tr class="text-center">
                                                                        <th>No.</th>
                                                                        <th>Name the drug</th>
                                                                        <th>Strength</th>
                                                                        <th>Frequency Taken</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="tablePrescribeDrugTbody">

                                                                <?php
                                                                    if ($mh['prescribe_drug'] && !empty($mh['prescribe_drug'])):
                                                                    foreach ($mh['prescribe_drug'] as $i => $pd):
                                                                ?>
                                                                    <tr>
                                                                        <td class="text-center"><?= $i+1 ?></td>
                                                                        <td><?= $pd['name'] ?></td>
                                                                        <td><?= $pd['strength'] ?></td>
                                                                        <td><?= $pd['frequently_taken'] ?></td>
                                                                    </tr>
                                                                <?php
                                                                    endforeach;
                                                                    endif;
                                                                ?>
                                                                    
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="col-12 py-3"><hr></div>
                                                        <div class="col-12">
                                                            <h4>Allergies to medications</h4>
                                                            <table class="table table-bordered table-hover" id="tableAllergyMedication">
                                                                <thead>
                                                                    <tr class="text-center">
                                                                        <th>No.</th>
                                                                        <th>Name the drug</th>
                                                                        <th>Reaction you had</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="tableAllergyMedicationTbody">

                                                                <?php 
                                                                    if ($mh['allergy_medication'] && !empty($mh['allergy_medication'])):
                                                                    foreach ($mh['allergy_medication'] as $i => $am):
                                                                ?>
                                                                    <tr>
                                                                        <td class="text-center"><?= $i+1 ?></td>
                                                                        <td><?= $am['name'] ?></td>
                                                                        <td><?= $am['reaction'] ?></td>
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
                                <?php endif; ?>
                                </div>
                            </div>
                        </div>

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
    