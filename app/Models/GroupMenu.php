<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupMenu extends Model
{
    protected $table = "group_menus";
    protected $fillable = ['name', 'icon'];
    protected $guarded = [];
    public function menus()
    {
        return $this->hasMany(Menu::class, 'menu_group_id','id');
    }
}
