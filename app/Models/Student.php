<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_id',
        'group_id',
    ];

    // --------------------------------------------------

    public function profiles($groupId, $yearId, $offset = []){
        $data = DB::table('students')
        ->select('students.id', 'profiles.name')
        ->leftJoin('groups', 'students.group_id', '=', 'groups.id')
        ->leftJoin('profiles', 'profiles.id', '=', 'students.profile_id')
        ->where('groups.year_id', $yearId)
        ->where('groups.id', $groupId);

        if($offset){
            $data->skip($offset[0]);
            $data->take($offset[1]);
        }
        return $data->get();
    }

    // --------------------------------------------------

    public function search($groupId, $yearId, $keyword){
        return DB::table('students')
        ->select('students.id', 'profiles.name')
        ->leftJoin('groups', 'students.group_id', '=', 'groups.id')
        ->leftJoin('profiles', 'profiles.id', '=', 'students.profile_id')
        ->where('groups.year_id', $yearId)
        ->where('groups.id', $groupId)
        ->where('profiles.name', 'like', '%' . $keyword . '%')
        ->take(10)
        ->get();
    }

    // --------------------------------------------------

    // public function scopeYear(){
    //     return DB::table('students')
    //     ->select('students.id', 'profiles.name')
    //     ->leftJoin('groups', 'students.group_id', '=', 'groups.id')
    //     ->leftJoin('profiles', 'profiles.id', '=', 'students.profile_id')
    //     ->get();
    // }
}
