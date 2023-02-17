<?php

namespace App\Entities;

use CodeIgniter\Entity;
use App\Models\GroupModel;

class UserGroup extends Entity
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

    public $assigned = null;

    public $category = null;

}