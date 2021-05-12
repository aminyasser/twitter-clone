<?php
namespace validation;
require_once 'ValidInterface.php';


class Numeric implements ValidInterface {

    private $name;
    private $value;

    public function __construct($name , $value) {
         $this->name = $name;
         $this->value = $value;

    }
    public function validate() {
        if (strlen($this->value) > 0 && !is_numeric($this->value)) {
            return "$this->name must be number";
        }

        return '';
    }
}