<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class FormsSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['name' => 'default', 'title' => 'Standartformular', 'description' => 'Dies ist ein Standartformular', 'active' => 1],
            
        ];

        // Using Query Builder
        $this->db->table('forms')->insertBatch($data);
    }
}