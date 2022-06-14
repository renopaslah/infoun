<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Profile;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'profile_id',
        'group_id',
    ];

    // --------------------------------------------------

    public function profiles($groupId, $yearId, $offset = []){
        $data = DB::table('students')
        ->select('students.id', 'students.nisn', 'students.nis', 'profiles.name')
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
        ->select('students.id', 'students.nisn', 'students.nis', 'profiles.name')
        ->leftJoin('groups', 'students.group_id', '=', 'groups.id')
        ->leftJoin('profiles', 'profiles.id', '=', 'students.profile_id')
        ->where('groups.year_id', $yearId)
        ->where('groups.id', $groupId)
        ->where('profiles.name', 'like', '%' . $keyword . '%')
        ->take(10)
        ->get();
    }

    // --------------------------------------------------

    public function createWithProfile($profiles = [], $groupId){
        $profile = Profile::create([
            'name' => $profiles['name'],
        ]);
        
        DB::table('students')->insert([
            'profile_id' => $profile->id,
            'group_id' => $groupId,
            'nisn' => $profiles['nisn'],
            'nis' => $profiles['nis'],
        ]);
    }

    // --------------------------------------------------

    public function updateWithProfile($profiles = [], $profileId){
        Profile::find($profileId)->update([
            'name' => $profiles['name'],
        ]);
        
        DB::table('students')->where('profile_id', $profileId)->update([
            'nisn' => $profiles['nisn'],
            'nis' => $profiles['nis'],
        ]);
    }
}
