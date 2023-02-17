<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['key' => 'auth.allowRegistration', 'value' => 1],
            ['key' => 'auth.allowRemembering', 'value' => 1],
            ['key' => 'auth.defaultUserGroup', 'value' => 'user'],
            ['key' => 'auth.ownerGroup', 'value' => 'superadmin'],
            ['key' => 'auth.minimumPasswordLength', 'value' => 9],
            ['key' => 'email.fromMail', 'value' => null],
            ['key' => 'email.fromName', 'value' => null],
            ['key' => 'registration.form', 'value' => 'default'],
            ['key' => 'registration.allowRegistration', 'value' => 0],
            ['key' => 'site.title', 'value' => null],
            ['key' => 'site.title', 'value' => null]
            
        ];

        // Using Query Builder
        $this->db->table('settings')->insertBatch($data);
    }
}