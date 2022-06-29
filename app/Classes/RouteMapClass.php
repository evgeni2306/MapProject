<?php

namespace App\Classes;


class RouteMapClass
{
    public $id;
    public $name;
    public $status;
    public $type;
    public $icon;
    public $shortdescription;
    public $difficult;
    public $distance;
    public $time;
    public $rating;
    public $lat;
    public $lng;

    public function __construct(
        int $id,
        string $name,
        string $status,
        string $type,
        string $icon,
        $shortdescription,
        $difficult,
        $distance,
        $time,
        $rating
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->status = $status;
        $this->type = $type;
        $this->icon = $icon;
        $this->shortdescription = $shortdescription;
        $this->difficult = $difficult;
        $this->distance = $distance;
        $this->time = $time;
        $this->rating = $rating;
    }
}
