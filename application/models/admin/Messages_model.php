<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Messages_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function sendMessage($data = [])
    {
        if ($data && !empty($data))
        {
            $query = $this->db->insert("messages", $data);
            return $query ? $this->db->insert_id() : 0;
        }
        return 0;
    }

    public function updateConversation($isAdmin = 0, $patientID = 0)
    {
        $data = [ 'is_read' => 1 ];
        $where = [
            "message_id <>" => 0,
            "is_read"       => 0,
            "is_admin"      => $isAdmin == 0 ? 1 : 0,
            "patient_id"    => $patientID,
        ];
        $query = $this->db->update("messages", $data, $where);
        return $query ? "true" : "false";
    }

}

