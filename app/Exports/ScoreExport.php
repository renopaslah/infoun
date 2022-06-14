<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\Score;

class ScoreExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $data = Score::profiles(1,1);
        return view('livewire.score.import_file', [
            'data' => collect($data)->groupBy('student_id')
        ]);
    }
}
