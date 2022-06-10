<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'profile_id',
        'group_id',
    ];

    // --------------------------------------------------

    public function profiles($groupId, $yearId){
        return DB::table('students')
        ->select('students.id', 'profiles.name')
        ->leftJoin('groups', 'students.group_id', '=', 'groups.id')
        ->leftJoin('profiles', 'profiles.id', '=', 'students.profile_id')
        ->where('groups.year_id', $yearId)
        ->where('groups.id', $groupId)
        ->get();
    }

    // --------------------------------------------------

    public function scopeYear(){
        return DB::table('students')
        ->select('students.id', 'profiles.name')
        ->leftJoin('groups', 'students.group_id', '=', 'groups.id')
        ->leftJoin('profiles', 'profiles.id', '=', 'students.profile_id')
        ->get();
    }
}
