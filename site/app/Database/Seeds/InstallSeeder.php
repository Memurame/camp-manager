<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class InstallSeeder extends Seeder
{
    public function run()
    {
        $this->call('PermissionsSeeder');
        $this->call('SettingsSeeder');
        $this->call('GroupSeeder');
        $this->call('TeamSeeder');
        $this->call('CategorySeeder');
        $this->call('FormsSeeder');
    }
}