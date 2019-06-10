<?php

namespace APP\Helpers;

class Upload {

    // make variables of parameters
    private $_upload,
            $_dir,
            $_size,
            $_allowed,
            $_result = array();

    function __construct($upload = array(), $dir, $size, $allowed) {
        // set the paramters equal to the member variable of the upload class
        $this->_upload = $upload;
        $this->_dir = $dir;
        $this->_size = $size;
        $this->_allowed = $allowed;
        // call the upload method and upload the file braaaaaaaa
        $this->Upload();
    }

    // METHOD TO UPLOAD FILE
    private function Upload() {
        // check weather paramters are empty
        if (!empty($this->_upload) && (!empty($this->_dir)) && (!empty($this->_size)) && (!empty($this->_allowed))) {
            // check $_upload & $_allowed is an array
            if ((is_array($this->_upload)) && (is_array($this->_allowed))) {
                // get the extension of the uploaded file
                $explode = explode(".", strtolower($this->_upload['name']));
                $key = count($explode) - 1;
                $extension = $explode[$key];
                // check extension is allowed
                if (in_array($extension, $this->_allowed)) {
                    // check size
                    if ($this->_upload['size'] < $this->_size) {
                        // upload the file
                        $filename = $this->_upload['name'];
                        $tmpname = $this->_upload['tmp_name'];
                        if (move_uploaded_file($tmpname, $this->_dir . $filename)) {
                            $this->_result['type'] = "success";
                            $this->_result['message'] = "File Has been uploaded";
                            $this->_result['path'] = $this->_dir . $filename;
                        } else {
                            $this->_result['type'] = "error";
                            $this->_result['message'] = "Error in uploading file";
                            $this->_result['path'] = false;
                        }
                    } else {
                        $this->_result['type'] = "error";
                        $this->_result['message'] = "Fill should be less then {$this->_size} BYTES";
                        $this->_result['path'] = false;
                    }
                } else {
                    $this->_result['type'] = "error";
                    $this->_result['message'] = "Fill Type not allowed";
                    $this->_result['path'] = false;
                }
            } else {
                $this->_result['type'] = "error";
                $this->_result['message'] = "Parameters 1st and 4th should be an array";
                $this->_result['path'] = false;
            }
        } else {
            $this->_result['type'] = "error";
            $this->_result['message'] = "Parameters can not be empty";
            $this->_result['path'] = false;
        }
    }

    // METHOD TO RETURN RESULT
    public function getResult() {
        return $this->_result;
    }

}

// end of Upload