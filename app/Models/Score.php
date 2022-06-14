<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Score extends Model
{
    use HasFactory;

    // --------------------------------------------------

    public function students()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    // --------------------------------------------------

    public function profiles($groupId, $yearId, $offset = [])
    {
        $data = DB::table('students')
            ->select('students.id AS student_id', 'students.status', 'students.nisn', 'scores.id', 'profiles.name', 'scores.score')
            ->leftJoin('groups', 'students.group_id', '=', 'groups.id')
            ->leftJoin('profiles', 'profiles.id', '=', 'students.profile_id')
            ->leftJoin('scores', 'scores.student_id', '=', 'students.id')
            ->where('groups.year_id', $yearId)
            ->where('groups.id', $groupId);

        if ($offset) {
            $data->skip($offset[0]);
            $data->take($offset[1]);
        }

        return $data->get();
    }
}
