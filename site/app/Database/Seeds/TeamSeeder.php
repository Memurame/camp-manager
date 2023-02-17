<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TeamSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['name' => 'Kleinkind', 'ord' => 5],
            ['name' => 'Kids', 'ord' => 4],
            ['name' => 'Jugend', 'ord' => 3],
            ['name' => 'Erwachsen', 'ord' => 2],
            ['name' => 'Leiter', 'ord' => 1],
            
        ];

        // Using Query Builder
        $this->db->table('registrations_team')->insertBatch($data);
    }
}