<?php

namespace App\Entities;

use CodeIgniter\Entity;
use App\Models\RegistrationModel;

class Room extends Entity
{
    /**
     * @var array
     */
    protected $datamap = [];

    /**
     * @var string[]
     */
    protected $dates   = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * @var array
     */
    protected $casts   = [];


    public $roomMembers = [];

    public $stock;

    public function getMembers(){
        $this->roomMembers = model(RegistrationModel::class)->where('room_id', $this->id)->findAll();
        $this->stock = count($this->roomMembers);
        return $this->roomMembers;
    }
}