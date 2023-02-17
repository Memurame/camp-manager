<?php

namespace App\Entities;

use CodeIgniter\Entity;
use App\Models\RegistrationTeamModel;

class Registration extends Entity
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

    protected $team_name;

    public $data;

    public function getTeam()
    {
        if (empty($this->team_name) && !empty($this->team_id))
        {
            $this->team_name = model(RegistrationTeamModel::class)->find($this->team_id)->name;

        }

        return $this->team_name;
    }

    public function getJsonData()
    {
        $this->data = json_decode($this->data_json);
        return $this->data;
    }
}