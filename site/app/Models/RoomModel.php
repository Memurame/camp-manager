<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Room;

class RoomModel extends Model
{
    protected $table            = 'room';
    protected $primaryKey       = 'id';
    protected $returnType       = Room::class;
    protected $allowedFields    = [
        'name',
        'capacity'
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