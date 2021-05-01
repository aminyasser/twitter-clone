<?php
namespace validation;
require_once 'ValidInterface.php';


class Required implements ValidInterface {

    private $name;
    private $value;

    public function __construct($name , $value) {
         $this->name = $name;
         $this->value = $value;

    }
    public function validate() {
        if (strlen($this->value) == 0) {
            return "$this->name is required";
        }

        return '';
    }
}