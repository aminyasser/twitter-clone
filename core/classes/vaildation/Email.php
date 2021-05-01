<?php
namespace validation;
require_once 'ValidInterface.php';


class Email implements ValidInterface {

    private $name;
    private $value;

    public function __construct($name , $value) {
         $this->name = $name;
         $this->value = $value;

    }
    public function validate() {
        if (!filter_var($this->value, FILTER_VALIDATE_EMAIL) ) {
            return "$this->name is not valid email";
        }

        return '';
    }
}