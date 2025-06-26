<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Menu;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('*', function ($view) {
            if (auth()->check()) {
                $permissions = auth()->user()->getAllPermissions()->pluck('name')->toArray();

                $menus = Menu::with([
                        'children' => function ($q) use ($permissions) {
                            $q->whereIn('name_permission', $permissions)->orderBy('order');
                        },
                        'group' // eager load menu group relasi
                    ])
                    ->whereNull('parent_id')
                    ->whereIn('name_permission', $permissions)
                    ->orderBy('order')
                    ->get();

                // Kelompokkan berdasarkan nama grup dari relasi menuGroup
                $groupedMenus = $menus->groupBy(function ($menu) {
                    return $menu->group->name ?? 'Ungrouped';
                });

                // dd($groupedMenus);

                $view->with('sidebarMenus', $groupedMenus);
            }
        });
    }
}
