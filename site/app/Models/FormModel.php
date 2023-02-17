<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Form;

class FormModel extends Model
{

    public $table = 'forms';
    protected $db;
    protected $allowedFields = [
        "name",
        "title",
        "active",
        "data"
    ];

    protected $primaryKey = 'name';
    protected $useAutoIncrement = true;

    protected $useTimestamps = false;

    protected $returnType = Form::class;
    protected $useSoftDeletes = true;

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

}