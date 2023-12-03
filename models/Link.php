<?php

class Link
{

    public $id;
    public $section;
    public $text;
    public $url;
    public $order;
    
    public $completed;

    public function __construct($id, $section, $url, $text, $order, $completed = 0)
    {
        $this->id = $id;
        $this->section = $section;
        $this->url = $url;
        $this->text = $text;
        $this->order = $order;
        $this->completed = $completed == 1 ? true : false;
    }
    
}