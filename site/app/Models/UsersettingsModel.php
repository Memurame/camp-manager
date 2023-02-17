<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersettingsModel extends Model
{
    protected $table            = 'users_settings';

    protected $allowedFields = [
        'uid',
        'key',
        'value'
    ];
    protected $db;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }


    public function setting($id, $key)
    {
        $builder = $this->db->table($this->table);
        $builder->select('*');
        $builder->where('uid', $id);
        $builder->where('key', $key);
        $query = $builder->get();
        return $query->getFirstRow('array');
    }

    public function update_setting($data){
        $builder = $this->db->table($this->table);
        $builder->replace($data);
    }

    public function insert_setting($data){
        $builder = $this->db->table($this->table);
        $builder->insert($data);
    }
}
