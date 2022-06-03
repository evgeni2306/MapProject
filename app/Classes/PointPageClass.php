<?php


namespace App\Classes;


class PointPageClass

{
    public $id;
    public $creatorid;
    public $name;
    public $status;
    public $description;
    public $rating;
    public $type;
    public $address;
    public $lat;
    public $lng;
    public $icon;
    public $photo;
    //Данные владельца
    public $avatar;
    public $uname;
    public $usurname;
    public $nickname;
    public $canAddComment;

    public function __construct(
        int $id,
        int $creatorid,
        string $name,
        string $status,
        $description,
         $rating,
        $type,
        $address,
        $lat,
        $lng,
        $icon,
        $photo,
        string $avatar,
        string $uname,
        string $usurname,
        string $nickname,
        bool $canAddComment

    )
    {
        $this->id = $id;
        $this->creatorid = $creatorid;
        $this->name = $name;
        $this->status = $status;
        $this->description = $description;
        $this->rating = $rating;
        $this->type = $type;
        $this->address = $address;
        $this->lat = $lat;
        $this->lng = $lng;
        $this->icon = $icon;
        $this->photo = $photo;

        $this->rating = $rating;

        $this->avatar = $avatar;
        $this->uname = $uname;
        $this->usurname = $usurname;
        $this->nickname = $nickname;
        $this->canAddComment = $canAddComment;


    }
}
