<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class System_operations extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("SystemOperations_model", "systemoperations");
    }

    public function getTableData() 
    {
        $tableName    = $this->input->post("tableName");
        $columnName   = $this->input->post("columnName"); 
        $searchFilter = $this->input->post("searchFilter");
        $orderBy      = $this->input->post("orderBy");
        $groupBy      = $this->input->post("groupBy");
        $others       = $this->input->post("others");
        echo json_encode($this->systemoperations->getTableData($tableName, $columnName, $searchFilter, $orderBy, $groupBy, $others));
    }

    public function getUploadedFiles()
    {
        $data = [];
        if (is_array($_FILES)) {
            if (count($_FILES) > 0 && !empty($_FILES["tableData"])) {
                $keys = array_keys($_FILES["tableData"]["name"]);
                for($x=0; $x<count($keys); $x++) {
                    $mixedFileName = "";

                    $fileKeyStr = $keys[$x];
                    $fileKeyArrParent = explode("|", $keys[$x]);
                    $fileKey    = $fileKeyArrParent[0];
                    $folderName = $fileKeyArrParent[1] ? $fileKeyArrParent[1] : "";
                    $fileLength = count($_FILES["tableData"]["name"][$fileKeyStr]);
                    for($i=0; $i<$fileLength; $i++) {
                        $fileName    = $_FILES["tableData"]["name"][$fileKeyStr][$i];
                        $fileTmpName = $_FILES["tableData"]["tmp_name"][$fileKeyStr][$i];

                        $targetDir = "assets/uploads/$folderName/";
                        if (!is_dir($targetDir)) {
                            mkdir($targetDir);
                        }

                        if (!file_exists($targetDir."index.html")) {
                            copy('assets/index.html', $targetDir."index.html");
                        }

                        $fileKeyArr  = explode(".", explode("|", $fileName)[1] ?? "");
                        $fileKeyName = $fileKeyArr[0] ?? "";
                        $fileKeyType = $fileKeyArr[1] ?? "";

                        $targetFileName = $fileKeyName.$i.time().'.'.$fileKeyType;
                        $targetFile     = $targetDir.$targetFileName;
            
                        if (move_uploaded_file($fileTmpName, $targetFile)) {
                            $mixedFileName = $mixedFileName ? $mixedFileName."|".$targetFileName : $targetFileName;
                            
                        }
                        $data[$fileKey] = $mixedFileName;
                    }
                }
            }
        }
        return $data;
    }

    public function getUploadedMultipleFiles() 
    {
        $data = [];
        $columNames  = $this->input->post("uploadFileColumnName") ?? null;
        $oldFilename = $this->input->post("uploadFileOldFilename") ?? null;
        $folderName  = $this->input->post("uploadFileFolder") ?? "uploads";

        if ($columNames && !empty($columNames) && is_array($columNames)) {
            foreach($columNames as $index => $columnName) {
                $mixedFileName = $oldFilename[$index] ?? "";

                $uploadFiles = $_FILES["uploadFiles"]["name"][$index] ?? null;
                if ($uploadFiles) {
                    $countFiles = count($uploadFiles);
                    for ($i=0; $i<$countFiles; $i++) {
                        $fileName    = $_FILES["uploadFiles"]["name"][$index][$i];
                        $fileType    = $_FILES["uploadFiles"]["type"][$index][$i];
                        $fileTmpName = $_FILES["uploadFiles"]["tmp_name"][$index][$i];

                        $targetDir = "assets/uploads/$folderName/";
                        if (!is_dir($targetDir)) {
                            mkdir($targetDir);
                        }

                        if (!file_exists($targetDir."index.html")) {
                            copy('assets/index.html', $targetDir."index.html");
                        }

                        $fileKeyArr  = explode(".", $fileName);
                        $fileKeyName = $fileKeyArr[0];
                        $fileKeyType = $fileKeyArr[1];

                        $targetFileName = $fileKeyName.$i.time().'.'.$fileKeyType;
                        $targetFile     = $targetDir.$targetFileName;
                        if (move_uploaded_file($fileTmpName, $targetFile)) {
                            $mixedFileName = $mixedFileName ? $mixedFileName."|".$targetFileName : $targetFileName;
                        }
                    }
                }

                $data[$columnName] = $mixedFileName;
            }
        }
        return $data;
    }

    public function insertTableData() 
    {
        $tableName = $this->input->post("tableName") ? $this->input->post("tableName") : null;
        $tableData = $this->input->post("tableData") ? $this->input->post("tableData") : false;
        $feedback  = $this->input->post("feedback")  ? $this->input->post("feedback") : null;
        $method    = $this->input->post("method")  ? $this->input->post("method") : false;
        $data = array();

        $uploadedFiles = $this->getUploadedFiles();
        if ($uploadedFiles && !empty($uploadedFiles)) {
            foreach ($uploadedFiles as $fileKey => $fileValue) {
                unset($data[$fileKey]);
                $data[$fileKey] = $fileValue;
            }
        }

        $uploadedMultipleFiles = $this->getUploadedMultipleFiles();
        if ($uploadedMultipleFiles && !empty($uploadedMultipleFiles)) {
            foreach ($uploadedMultipleFiles as $fileKey2 => $fileValue2) {
                unset($data[$fileKey2]);
                $data[$fileKey2] = $fileValue2;
            }
        }

        if ($tableName) {
            if ($tableData && !empty($tableData)) {
                foreach ($tableData as $key => $value) {
                    $data[$key] = $value;
                }
            }
            echo json_encode($this->systemoperations->insertTableData($tableName, $data, $feedback, $method));

            if($tableName == "patients"){
                $this->sendEmail($tableData);
            }


        } else {
            echo json_encode("false|Invalid arguments");
        }
    }

    public function updateTableData()
    {
        $tableName   = $this->input->post("tableName") ? $this->input->post("tableName") : null;
        $tableData   = $this->input->post("tableData") ? $this->input->post("tableData") : false;
        $whereFilter = $this->input->post("whereFilter") ? $this->input->post("whereFilter") : false;
        $feedback    = $this->input->post("feedback")  ? $this->input->post("feedback") : null;
        $method      = $this->input->post("method")  ? $this->input->post("method") : false;
        $data = array();

        $uploadedFiles = $this->getUploadedFiles();
        if ($uploadedFiles && !empty($uploadedFiles)) {
            foreach ($uploadedFiles as $fileKey => $fileValue) {
                unset($data[$fileKey]);
                $data[$fileKey] = $fileValue;
            }
        }

        $uploadedMultipleFiles = $this->getUploadedMultipleFiles();
        if ($uploadedMultipleFiles && !empty($uploadedMultipleFiles)) {
            foreach ($uploadedMultipleFiles as $fileKey2 => $fileValue2) {
                unset($data[$fileKey2]);
                $data[$fileKey2] = $fileValue2;
            }
        }
        
        if ($tableName && $whereFilter) {
            if ($tableData && !empty($tableData)) {
                foreach ($tableData as $key => $value) {
                    $data[$key] = $value;
                }
            }
            echo json_encode($this->systemoperations->updateTableData($tableName, $data, $whereFilter, $feedback, $method));
        } else {
            echo json_encode("false|Invalid arguments");
        }
    }


    public function sendEmail($data){
		$from_user 	= 'cbsuaclinic@gmail.com';
        $from_pass 	= 'cbsuaclinicmsadmin';
        $email_to   = $data["email"];

        $config = Array(
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_port' => 465,

            'smtp_user' => $from_user,
            'smtp_pass' => $from_pass,
            'mailtype'  => 'html',
            'charset'   => 'iso-8859-1',
            'wordwrap'  => TRUE,
            'starttls'  => true,
            'newline'   => "\r\n"
            );

            $this->encryption->initialize(
                array(
                        'cipher' => 'aes-256',
                        'mode'   => 'ctr',
                        'key'    => '<a 32-character random string>'
                )
            );

            $this->encryption->initialize(array('driver' => 'mcrypt'));

            $code    =  str_replace('/','slash',$this->encryption->encrypt($email_to));
            $subject = "Activate Your Account";
            $message = '<b><h2>Confirm Your Registration</h2></b>
                        <br>
                        <B>Welcome to Clinic Management System!</B>
                        <br>
                        <br>
                        Thank you for registering. To activate your account, please click the link below to confirm your account.
                        <br>
                        '.base_url().'welcome/verify_account/'.$code.'
                        <br>
                        <br>
                        <br>
                            Clinic Staff,
                        <br>
                        This is an automated message, please do not reply.';
        
        $this->load->library('email', $config);
        $this->email->set_mailtype("html");
        $this->email->set_newline("\r\n");
        $this->email->from($from_user,'CLINIC MANAGEMENT PORTAL');
        $this->email->to($email_to);
        $this->email->subject("Clinic Portal - $subject");
        $this->email->message($message);
        
        if(!$this->email->send())
        {
            print_r($this->email->print_debugger());
        }
    }


}
