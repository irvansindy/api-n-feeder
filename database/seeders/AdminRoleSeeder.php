<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
class AdminRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Daftar permission
        $permissions = [
            'view_dashboard',
            'view_master',
            'view_mahasiswa',
            'view_dosen',
        ];

        // Buat permission jika belum ada
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Buat role admin
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        // Assign permission ke role admin
        $adminRole->syncPermissions($permissions);

        // Cari user berdasarkan email
        $user = User::where('email', 'rroyani887@gmail.com')->first();

        if ($user) {
            $user->assignRole('admin');
        } else {
            $this->command->warn("User dengan email rroyani887@gmail.com tidak ditemukan.");
        }
    }
}
