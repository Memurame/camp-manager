<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class GroupSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['name' => 'Superadmin', 'description' => 'Dies ist der Hauptadministrator', 'mails' => 1],
            ['name' => 'User', 'description' => 'Standart Benutzer', 'mails' => 0],
            
        ];

        // Using Query Builder
        $this->db->table('auth_groups')->insertBatch($data);
    }
}