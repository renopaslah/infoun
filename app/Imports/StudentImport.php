<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Student;

class StudentImport implements ToCollection
{
    /**
    * @param Collection $collection
    */

    public $groupId;

    // --------------------------------------------------

    public function collection(Collection $collection)
    {
        // dd($collection);
        foreach ($collection as $k => $v) {
            if($k > 0){ // mulai dari baris ke 1
                Student::createWithProfile([
                    'name' => $v[3],
                    'nis' => $v[2],
                    'nisn' => $v[1],
                ], $this->groupId);
            }
        }
    }
    
    // --------------------------------------------------

    public function setGroupId($id)
    {
        $this->groupId = $id;
    }
}
