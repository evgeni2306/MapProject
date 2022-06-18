<?php


namespace App\Classes;


class RouteEditableFieldsClass
{
    public $name = "";
    public $difficult = "";
    public $status = "";
    public $shortdescription = "";
    public $description = "";
    public $distance = "";
    public $time = "";
    public $submit = "";

    public function __construct($name, $difficult, $status, $shortdescription, $description, $distance, $time, $submit)
    {
        $this->name = $name;
        $this->difficult = $difficult;
        $this->status = $status;
        $this->shortdescription = $shortdescription;
        $this->description = $description;
        $this->distance = $distance;
        $this->time = $time;
        $this->submit = $submit;
    }
}
