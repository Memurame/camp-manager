<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Registration;

class RegistrationModel extends Model
{

    public $table = 'registrations';
    protected $db;
    protected $allowedFields = [
        "firstname",
        "lastname",
        "street",
        "street_nr",
        "postcode",
        "location",
        "phone",
        'email',
        "birthday",
        "data_json",
        "paid",
        "paid_amount",
        "form",
        "team_id",
        "room_id"
    ];

    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;

    protected $useTimestamps = true;
    protected $dateFormat = 'int';

    protected $returnType = Registration::class;
    protected $useSoftDeletes = true;

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    public function get_export_data($teamid = null)
    {
        $builder = $this->db->table($this->table);
        $builder->select('lastname, firstname, street, street_nr, postcode, location, email, phone, birthday');
        $builder->orderBy('lastname', 'ASC');
        $builder->where('deleted_at =', null);
        if(!empty($teamid)){
            $builder->where('team_id', $teamid);
        }

        $query = $builder->get();
        return $query->getResultArray();

    }

    public function get_count_of_row($col = null, $val = null){
        $builder = $this->db->table($this->table);
        $builder->where('deleted_at =', null);
        if(!empty($col) && !empty($val)){
            $builder->where($col, $val);
        }
        return $builder->countAllResults();
    }

}