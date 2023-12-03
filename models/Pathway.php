<?php

class Pathway
{
    public $pathway_id;
    public $owner_id;
    public $pathway_title;
    public $pathway_description;
    public $pathway_image;
    public $created_at;

    public function __construct(mixed $pathway_id, mixed $owner_id, mixed $pathway_title, mixed $pathway_description, mixed $pathway_image, mixed $created_at)
    {
        $this->pathway_id = $pathway_id;
        $this->owner_id = $owner_id;
        $this->pathway_title = $pathway_title;
        $this->pathway_description = $pathway_description;
        $this->pathway_image = $pathway_image;
        $this->created_at = $created_at;
    }
}