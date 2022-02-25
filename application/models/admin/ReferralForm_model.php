<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ReferralForm_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function getReferralForm($referralFormID = 0)
    {
        $sql = "
        SELECT 
            rf.*, CONCAT(firstname, ' ', middlename, ' ', lastname) AS fullname, age, gender
        FROM referral_forms AS rf 
            LEFT JOIN patients AS p USING(patient_id)
        WHERE referral_form_id = $referralFormID";
        $query = $this->db->query($sql);
        return $query ? $query->row() : null;
    }

}

