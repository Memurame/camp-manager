<?php

namespace App\Models;

use App\Entities\RegistrationTeam;
use CodeIgniter\Model;

class RegistrationTeamModel extends Model
{
    public $table = 'registrations_team';
    protected $db;
    protected $allowedFields = [
        'name'
    ];

    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;

    protected $useTimestamps = false;

    protected $returnType = RegistrationTeam::class;
    protected $useSoftDeletes = true;

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }
}
