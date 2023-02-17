<?php

namespace App\Models;

use App\Entities\RegistrationLink;
use CodeIgniter\Model;

class RegistrationLinkModel extends Model
{
    public $table = 'registrations_link';
    protected $db;
    protected $allowedFields = [
        'token',
        'registrations_id'
    ];

    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;

    protected $useTimestamps = true;
    protected $dateFormat = 'int';

    protected $returnType = RegistrationLink::class;
    protected $useSoftDeletes = true;

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    public function getMy($token){
        $builder = $this->db->table('registrations_link');
        $builder->select('*');
        $builder->join('registrations', 'registrations.id = registrations_link.registrations_id');
        $builder->where('token', $token);
        $builder->where('registrations.deleted_at =', null);
        $query = $builder->get();

        return $query->getResultObject();
    }

    public function getToken($id){
        $builder = $this->db->table('registrations');
        $builder->select('*');
        $builder->join('registrations_link', 'registrations_link.registrations_id = registrations.id');
        $builder->where('id', $id);
        $query = $builder->get();
    }
}