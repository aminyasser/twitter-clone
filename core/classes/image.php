<?php

class Image {
  
    private $name;
    private $tmp_name;
    public $new_name;
    protected $sign;

    public function __construct($img , $tweet = null) {
          
         $this->name =$img['name'];
         $this->tmp_name =$img['tmp_name'];

         $ext = pathinfo($this->name)['extension'];
        
         if ($tweet != null) {
         $this->new_name = 'tweet-' .  uniqid() . '.' . $ext ; 
          $this->sign = true;
        } else   $this->new_name = 'user-' .  uniqid() . '.' . $ext ;


    }


        public function upload () {
            if ($this->sign == true)
            move_uploaded_file($this->tmp_name , '../assets/images/tweets/' . $this->new_name);
          else move_uploaded_file($this->tmp_name , '../assets/images/users/' . $this->new_name);
        }



}