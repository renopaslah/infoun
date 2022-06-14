<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
    ];

    // --------------------------------------------------

    public function subjectWithId()
    {
        $data = [
            'subjectBidId' => 1,
            'subjectBigId' => 2,
            'subjectMatId' => 3,
            'subjectTproId' => 4,
            'subjectPproId' => 5,
        ];

        return $data;
    }
}
