<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus';
    protected $fillable = [
        'name','url_name','icon','parent_id','order', 'menu_group_id', 'name_permission','is_active',
    ];
    public function permission()
    {
        return $this->hasOne(\Spatie\Permission\Models\Permission::class,'name','name_permission');
    }
    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id')->orderBy('order');
    }
    public function group()
    {
        return $this->belongsTo(GroupMenu::class, 'menu_group_id');
    }

}