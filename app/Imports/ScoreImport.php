<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\DB;
use App\Models\Subject;
use App\Models\Student;
use App\Models\Score;

class ScoreImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $students = [];
        $students_with_scores = [];
        
        foreach ($collection as $k => $v) {
            if($k > 0){ // mulai dari baris ke 1
                
                // Mengkolektif student_id
                $studentId = Student::where('nisn', $v[2])->first()->id;
                $students[] = $studentId;

                $status = $v[3];
                $bid = $v[4];
                $mat = $v[5];
                $big = $v[6];
                $tpro = $v[7];
                $ppro = $v[8];
                
                // Memfilter nilai yang akan dinput ke database
                if($bid || $mat || $big || $tpro || $ppro){
                    // bahasa indonesia
                    if(isset($bid)){
                        $students_with_scores[] = [
                            'student_id' => $studentId,
                            'subject_id' => Subject::subjectWithId()['subjectBidId'],
                            'score' => $bid,
                        ];
                    }

                    // bahasa inggris
                    if(isset($big)){
                        $students_with_scores[] = [
                            'student_id' => $studentId,
                            'subject_id' => Subject::subjectWithId()['subjectBigId'],
                            'score' => $big,
                        ];
                    }

                    // matematika
                    if(isset($mat)){
                        $students_with_scores[] = [
                            'student_id' => $studentId,
                            'subject_id' => Subject::subjectWithId()['subjectMatId'],
                            'score' => $mat,
                        ];
                    }

                    // teori produktif
                    if(isset($tpro)){
                        $students_with_scores[] = [
                            'student_id' => $studentId,
                            'subject_id' => Subject::subjectWithId()['subjectTproId'],
                            'score' => $tpro,
                        ];
                    }

                    // praktik produktif
                    if(isset($ppro)){
                        $students_with_scores[] = [
                            'student_id' => $studentId,
                            'subject_id' => Subject::subjectWithId()['subjectPproId'],
                            'score' => $ppro,
                        ];
                    }
                }
            }
        }

        // delete nilai
        Score::whereIn('student_id', $students)->delete();

        // re-insert nilai
        Score::insert($students_with_scores);
    }
}
