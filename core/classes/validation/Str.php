<?php
namespace validation;
require_once 'ValidInterface.php';


class Str implements ValidInterface {

    private $name;
    private $value;

    public function __construct($name , $value) {
         $this->name = $name;
         $this->value = $value;

    }
    public function validate() {
        if (!is_string($this->value)) {
            return "$this->name must be string";
        }

        return '';
    }
}
