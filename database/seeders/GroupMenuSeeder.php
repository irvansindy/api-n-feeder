<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\GroupMenu;
class GroupMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $groups = [
            ['name' => 'Dashboard', 'icon' => 'solar:layers-line-duotone'],
            ['name' => 'Master Data', 'icon' => 'solar:widget-6-line-duotone'],
            ['name' => 'Pages', 'icon' => 'solar:notes-line-duotone'],
            ['name' => 'UI Components', 'icon' => 'solar:archive-line-duotone'],
            ['name' => 'Authentication', 'icon' => 'solar:lock-keyhole-line-duotone'],
            ['name' => 'Multi Level', 'icon' => 'solar:mirror-left-line-duotone'],
        ];

        foreach ($groups as $group) {
            GroupMenu::create($group);
        }
    }
}
