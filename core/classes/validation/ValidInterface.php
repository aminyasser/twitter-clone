<?php


namespace validation;

interface ValidInterface {
    public function __construct($name , $value);
    public function validate();

}