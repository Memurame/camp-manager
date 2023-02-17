<?php

namespace App\Entities;

use CodeIgniter\Entity;
use App\Models\UserModel;
use App\Models\MaterialCategoryModel;

class Material extends Entity
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

    /**
     * @return mixed
     */
    public function getAssignedUser()
    {

        if(!empty($this->assigned_uid)){
            $user = model(UserModel::class)->find($this->assigned_uid);
            $this->assigned = ($user) ? $user->name : false;
        }

        return $this->assigned;

    }

    /**
     * @return string
     */
    public function getCategory(): string
    {

        if(!empty($this->cat)){
            $this->category = model(MaterialCategoryModel::class)->find($this->cat)->name;
        }

        return $this->category;

    }
}