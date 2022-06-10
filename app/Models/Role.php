<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Role extends Model
{
    use HasFactory;

    // -----------------------------------------------------------------
    
    // public function get_menu_by_role_id($role_id)
    // {
    //     return DB::table('menu_role')
    //     ->select('menus.id', 'menus.parent_id', 'menus.name', 'menus.href')
    //     ->leftJoin('menus', 'menus.id', '=', 'menu_role.menu_id')
    //     ->where('menu_role.role_id', $role_id)
    //     ->get()
    //     ->toArray();
    // }

    // -----------------------------------------------------------------
    
    public function menus()
    {
        return $this->belongsToMany(Menu::class);
    }

    // -----------------------------------------------------------------

    public function xcontrollers()
    {
        return $this->belongsToMany(Xcontroller::class);
    }
}
