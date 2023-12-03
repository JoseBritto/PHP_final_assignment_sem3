<?php

class Section
{


    public $section_id;
    public $pathway;
    public $section_title;
    public $section_description;
    public $order;

    public function __construct($sectionId, $pathwayId, $section_title, $section_description, $order)
    {
        $this->section_id = $sectionId;
        $this->pathway = $pathwayId;
        $this->section_title = $section_title;
        $this->section_description = $section_description;
        $this->order = $order;
    }
}