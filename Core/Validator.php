<?php

namespace Core;

Class Validator {
    
    private $errors = [];

    public function make($data, $rule) {
        foreach($data as $field => $value) {
            if(isset($rule[$field])) {
                $fieldErrors = $this->validateField($field, $rule[$field], $data);
                if(!empty($fieldErrors)) {
                    $this->errors[$field] = $fieldErrors;
                }
            }
        }
        return $this;
    } 


    protected function validateField(string $field, string $ruleField, array $data) {
        $rules = explode("|", $ruleField);
        $errors = [];
        foreach($rules as $rule) {
            $ruleWhiteAttr = explode(":", $rule);
            $ruleName = $ruleWhiteAttr[0];
            $attr = count($ruleWhiteAttr) > 1 ? explode(",", $ruleWhiteAttr[1]) : [];
            $success = $this->validateFieldRule($field, $ruleName, $attr, $data);
            if(!$success) {
                $errors[] = $this->getErrorMessage($field, $ruleName, $attr);
            }
        }
        return $errors;
    }

    protected function getErrorMessage($field, $ruleName, $attr) {
        $messages = [
            "required" => "The field :field is required ",
            "min" => "The field :field must be no longer then :attr charecters long",
            "max" => "The field :field must be at least :attr charecters long",
            "email" => "The field :field not a valid email address",
            "comfirmed" => "The :field comfirmation does not match"
        ];

        if(isset($messages[$ruleName])) {
            $message = $messages[$ruleName];
            $message = str_replace(":field", $field, $message);
            if(!empty($attr)) {
                $message = str_replace(":attr", $attr[0], $message);
            }
        }
        return $message;
    }

    protected function validateFieldRule(string $field, string $ruleName, array $attr, array $data)  {
        
        switch ($ruleName) {
            case "required" :
                return !empty($data[$field]);
                break;
            case "max" : 
                return isset($data[$field]) && strlen($data[$field]) <= $attr[0];
                break;
            case "min" : 
                return isset($data[$field]) && strlen($data[$field]) >= $attr[0];
                break;
            case "email" :
                $pattern = "/\b[\w\.-]+@[\w\.-]+\.\w{2,4}\b/";
                return preg_match($pattern, $data[$field]);
                break;
            case "comfirmed" :
                return isset($data[$field]) && isset($data["comf_" . $field]) && ($data[$field] === $data["comf_" . $field]);
            default : 
                break;
        }

    }

    public function getErrors($field) {
        return !empty($this->errors) ? $this->errors[$field][0] : null;
    }

}