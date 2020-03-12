<?php

class Post 
{
    private $id;
    private $text;
    private $img;

    public function __construct($text){
        $this->text = $text;
    }
}

?>