<?php
namespace validation;
require_once 'ValidInterface.php';


class Min5 implements ValidInterface {

    private $name;
    private $value;

    public function __construct($name , $value) {
         $this->name = $name;
         $this->value = $value;

    }
    public function validate() {
        if (strlen($this->value) < 5) {
            return "$this->name must between 5 and 20 length";
        }

        return '';
    }
}