<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

    public function authenticate($email = "", $password = "")
    {
        if ($email && $password)
        {
            $sql    = "SELECT * FROM users WHERE email = BINARY '$email' AND password = BINARY '$password'";
            $query  = $this->db->query($sql);
            $result = $query ? $query->row() : null;
            if ($result)
            {
                $userID = $result->user_id ?? 0;
                $this->session->set_userdata('sessionID', $userID);
                return true;
            }
        }
        return false;
    }

    public function authenticateWebsite($email = "", $password = "")
    {
        if ($email && $password)
        {
            $sql    = "SELECT * FROM patients WHERE email = BINARY '$email' AND password = BINARY '$password'";
            $query  = $this->db->query($sql);
            $result = $query ? $query->row() : null;
            if ($result)
            {
                if ($result->is_verified == '1') {
                    $patientID = $result->patient_id ?? 0;
                    $this->session->set_userdata('patientID', $patientID);
                    return "true";
                } else {
                    return "false|Your account is not yet verified";
                }
            }
        }
        return "false|Invalid username or password";
    }

}

