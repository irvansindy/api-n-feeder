<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;
use Spatie\Permission\Models\Permission;
class MenuPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create permissions
        $permissions = [
            'view_dashboard',
            'view_master',
            'view_mahasiswa',
            'view_dosen',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        // Create menus
        Menu::truncate(); // Bersihkan agar tidak dobel

        $dashboard = Menu::create([
            'name' => 'Dashboard',
            'url_name' => 'dashboard',
            'icon' => 'ti ti-home',
            'parent_id' => null,
            'order' => 1,
            'name_permission' => 'view_dashboard',
        ]);

        $master = Menu::create([
            'name' => 'Master Data',
            'url_name' => '#',
            'icon' => 'solar:airbuds-case-minimalistic-line-duotone',
            'parent_id' => null,
            'order' => 2,
            'name_permission' => 'view_master',
        ]);

        $mahasiswa = Menu::create([
            'name' => 'Mahasiswa',
            'url_name' => 'mahasiswa.index',
            'icon' => 'ti ti-user',
            'parent_id' => $master->id,
            'order' => 1,
            'name_permission' => 'view_mahasiswa',
        ]);

        $dosen = Menu::create([
            'name' => 'Dosen',
            'url_name' => 'dosen.index',
            'icon' => 'ti ti-users',
            'parent_id' => $master->id,
            'order' => 2,
            'name_permission' => 'view_dosen',
        ]);
    }
}
