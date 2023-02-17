<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\MaterialCategory;

class MaterialCategoryModel extends Model
{
    protected $table            = 'materiallist_category';
    protected $primaryKey       = 'id';
    protected $returnType       = MaterialCategory::class;
    protected $allowedFields    = [
        'name'
    ];

    protected $useAutoIncrement = true;

    protected $useTimestamps = false;

    protected $useSoftDeletes = true;

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }
}
