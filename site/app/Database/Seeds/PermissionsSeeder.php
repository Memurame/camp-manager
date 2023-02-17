<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['name' => 'page.dashboard', 'description'    => 'Seite - Anzeigen der Übersicht'],
            ['name' => 'anmeldungen.show', 'description'    => 'Anmeldungen - Anzeigen'],
            ['name' => 'anmeldungen.export', 'description'    => 'Anmeldungen - Exportieren'],
            ['name' => 'anmeldungen.edit', 'description'    => 'Anmeldungen - Bearbeiten'],
            ['name' => 'anmeldungen.delete', 'description'    => 'Anmeldungen - Löschen'],
            ['name' => 'anmeldungen.stack', 'description'    => 'Anmeldungen - Mehrfachbearbeitung'],
            ['name' => 'anmeldungen.create', 'description'    => 'Anmeldungen - Erstellen'],
            ['name' => 'user.show', 'description'    => 'Benutzer - Anzeigen'],
            ['name' => 'user.edit', 'description'    => 'Benutzer - Bearbeiten'],
            ['name' => 'user.create', 'description'    => 'Benutzer - Erstellen'],
            ['name' => 'user.delete', 'description'    => 'Benutzer - Löschen'],
            ['name' => 'matlist.show', 'description'    => 'Materialliste - Anzeigen'],
            ['name' => 'matlist.create', 'description'    => 'Materialliste - Erstellen'],
            ['name' => 'matlist.edit', 'description'    => 'Materialliste - Bearbeiten'],
            ['name' => 'matlist.delete', 'description'    => 'Materialliste - Löschen'],
            ['name' => 'admin.settings', 'description'    => 'Admin - Einstellungen'],
            ['name' => 'admin.log', 'description'    => 'Admin - Log'],
            ['name' => 'zimmer.show', 'description'    => 'Zimmer - Anzeigen'],
            ['name' => 'zimmer.create', 'description'    => 'Zimmer - Erstellen'],
            ['name' => 'zimmer.edit', 'description'    => 'Zimmer - Bearbeiten'],
            ['name' => 'zimmer.delete', 'description'    => 'Zimmer - Löschen'],
            ['name' => 'zimmer.assign', 'description'    => 'Zimmer - Zuweisen von Teilnehmer'],
            ['name' => 'admin.mail', 'description'    => 'Admin - Senden von Mails'],
            ['name' => 'user.permissions', 'description'    => 'Benutzer - Berechtigungen verwalten'],
            ['name' => 'group.show', 'description'    => 'Gruppe - Anzeigen'],
            ['name' => 'group.create', 'description'    => 'Gruppe - Erstellen'],
            ['name' => 'group.edit', 'description'    => 'Gruppe - Bearbeiten'],
            ['name' => 'group.delete', 'description'    => 'Gruppe - Löschen'],
            ['name' => 'page.profile', 'description'    => 'Eigenes Profil bearbeiten'],
            ['name' => 'form.show', 'description'    => 'Formulare anzeigen'],
            ['name' => 'form.create', 'description'    => 'Formulare erstellen'],
            ['name' => 'form.delete', 'description'    => 'Formulare löschen'],
            ['name' => 'form.edit', 'description'    => 'Formulare bearbeiten']
        ];

        // Using Query Builder
        $this->db->table('auth_permissions')->insertBatch($data);
    }
}