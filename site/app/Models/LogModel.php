<?php

namespace App\Models;

use CodeIgniter\Model;

class LogModel extends Model
{
    protected $table            = 'log';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'app',
        'typ',
        'msg',
        'uid'
    ];

    protected $useAutoIncrement = true;

    protected $useTimestamps = false;

    protected $useSoftDeletes = false;

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    public function room(string $typ, array $msg){

        $data = [
            'app' => 'zimmer',
            'typ' => $typ,
            'msg'  => json_encode($msg),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ];
        $this->db->table($this->table)->insert($data);
    }

    public function user(string $typ, array $msg){

        $data = [
            'app' => 'benutzer',
            'typ' => $typ,
            'msg'  => json_encode($msg),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ];
        $this->db->table($this->table)->insert($data);
    }

    public function person(string $typ, array $msg){

        $data = [
            'app' => 'person',
            'typ' => $typ,
            'msg'  => json_encode($msg),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ];
        $this->db->table($this->table)->insert($data);
    }

    public function material(string $typ, array $msg){

        $data = [
            'app' => 'material',
            'typ' => $typ,
            'msg'  => json_encode($msg),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ];
        $this->db->table($this->table)->insert($data);
    }

    public function userGroup(string $typ, array $msg){

        $data = [
            'app' => 'benutzergruppe',
            'typ' => $typ,
            'msg'  => json_encode($msg),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ];
        $this->db->table($this->table)->insert($data);
    }

    public function mail(string $typ, array $msg){

        $data = [
            'app' => 'mail',
            'typ' => $typ,
            'msg'  => json_encode($msg),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ];
        $this->db->table($this->table)->insert($data);
    }
    public function login(string $typ, array $msg){

        $data = [
            'app' => 'login',
            'typ' => $typ,
            'msg'  => json_encode($msg),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ];
        $this->db->table($this->table)->insert($data);
    }

    public function get_all_data(array $search = [], $return = 'array')
    {
        $builder = $this->db->table($this->table);
        $builder->orderBy('created_at', 'DESC');
        if(!empty($search)){
            foreach($search as $k1 => $v1){
                if(is_array($v1)){
                    foreach($v1 as $v2){
                        if($v1 == 0){
                            $builder->where($k1, $v2);
                        } else {
                            $builder->orWhere($k1, $v2);
                        }
                    }
                } else {
                    $builder->where($k1, $v1);
                }
            }

        }

        $query = $builder->get();
        if($return == 'array'){
            return $query->getResultArray();
        }
        elseif($return == 'first'){
            return $query->getFirstRow('array');
        }
        else {
            return $query->getResultArray();
        }
    }
}
