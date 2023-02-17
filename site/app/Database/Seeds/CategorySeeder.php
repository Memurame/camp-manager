<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['name' => 'Sport & Spiel'],
            ['name' => 'Kreativ'],
            ['name' => 'Küche & Putzen'],
            ['name' => 'Worship & Technik'],
            ['name' => 'Diverses'],
            
        ];

        // Using Query Builder
        $this->db->table('materiallist_category')->insertBatch($data);
    }
}