<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Material;

class MaterialModel extends Model
{
    protected $table            = 'materiallist';
    protected $primaryKey       = 'id';
    protected $returnType       = Material::class;
    protected $allowedFields    = [
        'name',
        'count',
        'description',
        'created_uid',
        'status',
        'cat',
        'assigned_uid'

    ];

    protected $useAutoIncrement = true;

    protected $useTimestamps = false;

    protected $useSoftDeletes = true;

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
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