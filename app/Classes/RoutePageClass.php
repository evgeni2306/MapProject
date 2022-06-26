<?php

namespace App\Classes;
class RoutePageClass
{
    public $id;
    public $creatorid;
    public $name;
    public $status;
    public $description;
    public $difficult;
    public $distance;
    public $time;
    public $rating;
    public $city;
    public $rpoints = array();
    //Данные владельца
    public $avatar;
    public $uname;
    public $usurname;
    public $nickname;
    public $pointsnear = array();
    public $canAddComment;

    public function __construct(
        int $id,
        int $creatorid,
        string $name,
        string $status,
        $description,
        $difficult,
        $distance,
        $time,
        int $rating,
        object $rpoints,
        string $avatar,
        string $uname,
        string $usurname,
        string $nickname,
        $icon,
        $city,
        $pointsnear,
        bool $canAddComment

    )
    {
        $this->id = $id;
        $this->creatorid = $creatorid;
        $this->name = $name;
        $this->status = $status;
        $this->description = $description;
        $this->difficult = $difficult;
        $this->distance = $distance;
        $this->time = $time;
        $this->rating = $rating;
        $this->rpoints = $rpoints;
        $this->avatar = $avatar;
        $this->uname = $uname;
        $this->usurname = $usurname;
        $this->nickname = $nickname;
        $this->icon = $icon;
        $this->city = $city;
        $this->pointsnear = $pointsnear;
        $this->canAddComment = $canAddComment;

    }

}
