<?php

class Question
{

    private $id;
    private $question;
    private $post_id;

    public function __contruct($question, $post_id) {
        $this->question = $question;
        $this->$post_id = $post_id;
    }

}

?>