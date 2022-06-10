<?php

namespace App\Http\Controllers;

use \App\Models\Menu;
use \App\Models\User;
use \App\Models\Role;
use \App\Models\Year;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function change($role_id){
        $this->assignToSession(Hashids::decode($role_id)[0]);
        return redirect('/home');
    }

    // --------------------------------------------------

    public function assignToSession($role_id){
        $roles = User::find(Auth::id())->roles()->get()->toArray();
        $menus = Menu::where('parent_id', 0)->get()->toArray();
        $years = Year::all()->toArray();
        $menus_firlter_by_role = Role::find($role_id)->menus()->get();

        // Menambahkan children
        foreach ($menus as $k => $v) {
            foreach ($menus_firlter_by_role as $v1) {
                if($v['id'] == $v1->parent_id){
                    $menus[$k]['child'][] = $v1;
                }
            }
        }

        // Menghapus parent yang tidak tersedia
        foreach ($menus as $k => $v) {
            $exist = 0;
            foreach ($menus_firlter_by_role as $v1) {
                if($v1->parent_id == 0 && $v['id'] == $v1->id){
                    $exist++;
                }
            }

            if(!array_key_exists('child', $v) && !$exist){
                unset($menus[$k]);
            }
        }

        // Generate role yang tersedia pada user ini
        foreach ($roles as $k => $v) {
            $active = ($v['id'] == $role_id) ? 1 : 0;
            $roles[$k]['id'] = Hashids::encode($v['id']);
            $roles[$k]['active'] = $active;
        }
        
        // Set Role yang aktif
        $current_role = [];
        foreach ($roles as $k => $v) {
            if($v['active']){
                $current_role = $v;
                break;
            }
        }

        // Set Year yang aktif
        $current_year = [];
        foreach ($years as $k => $v) {
            if($v['is_active']){
                $current_year = $v;
                break;
            }
        }

        session()->put('profile', User::profile(Auth::id()));
        session()->put('years', $years);
        session()->put('current_year', $current_year);
        session()->put('roles', $roles);
        session()->put('current_role', $current_role);
        session()->put('menus', $menus = (object) $menus);
    }
}
