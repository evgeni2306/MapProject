<?php


namespace App\Classes;


class PointEditableFieldsClass
{
    public $name = "";
    public $category = "";
    public $address = "";
    public $status = "";
    public $shortdescription = "";
    public $description = "";
    public $photo = "";
    public $submit = "";

    public function __construct($name, $category, $address, $status, $shortDescription, $description, $photo, $submit)
    {
        $this->name = $name;
        $this->category = $category;
        $this->address = $address;
        $this->status = $status;
        $this->shortdescription = $shortDescription;
        $this->description = $description;
        $this->photo = $photo;
        $this->submit = $submit;
    }
}
