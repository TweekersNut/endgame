<?php
namespace APP\Core;

use APP\Core\Database as db;

class Validator {
    
    private $db = null, $_passed = false, $_errors = array();
    
    function __construct() {
        $this->db = new db;
    }
    
    public function validate($source,$items = array()){
        foreach ($items as $item => $rules){
            foreach ($rules as $rule => $ruleValue){
                $value = trim($source[$item]);
                $item = htmlentities($item,ENT_QUOTES,'UTF-8');
                
                if($rule == 'required' && empty($value)){
                    $this->addError("Error <strong>{$item}</strong> is required. \nPlease try again.");
                }elseif(!empty ($value)){
                    switch ($rule){
                        case 'min':
                                if(strlen($value) < $ruleValue){
                                    $this->addError("Error <strong>{$item}</strong> must be minimum of {$ruleValue}. \nPlease try again.");
                                }
                            break;
                        case 'max':
                                if(strlen($value) > $ruleValue){
                                    $this->addError("Error <strong>{$item}</strong> must be maximum of {$ruleValue}. \nPlease try again.");
                                }
                             break;
                        case 'matches':
                                if($value != $source[$ruleValue]){
                                    $this->addError("Error <strong>{$ruleValue}</strong> must match {$item}. \nPlease try again.");
                                }
                            break;
                        case 'unique':
                                $this->db->query("select * from {$ruleValue} where {$item} = '{$value}'");
                                $this->db->execute();
                                if(!empty($this->db->resultSet())){
                                    $this->addError("Error <strong>{$item}</strong> already exists. \nPlease try again.");
                                }
                            break;
                        default:
                            
                            break;
                    }
                }
            }
        }
        if(empty($this->_errors)){
            $this->_passed = true;
        }
        return $this;
    }
    
    private function addError($error){
        $this->_errors[] = $error;
    }
    
    public function errors(){
        return $this->_errors;
    }
    
    public function passed(){
        return $this->_passed;
    }
    
}
