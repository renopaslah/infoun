<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Controllers\PaginationController as Pagination;
use App\Models\Score as ScoreModel;
use App\Models\Group;
use App\Models\Student;
use App\Models\Subject;
use App\Exports\ScoreExport;
use Vinkla\Hashids\Facades\Hashids;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ScoreImport;

use function Psy\debug;

class Score extends Component
{
    use WithFileUploads;
    
    public $isOpen;
    public $scoreId;
    public $groupId;
    public $groups = [];
    public $data = [];
    public $studentId;
    public $graduationStatus = 1;
    public $hasScore = 0;

    public $isOpenImport;
    public $importFile;

    public $bidScore = 0;
    public $bigScore = 0;
    public $matScore = 0;
    public $tproScore = 0;
    public $pproScore = 0;

    // Page number
    public $numberOfData;
    public $numberPerPage = 10;
    public $numberOfPage = null;
    public $currentPage = 1;
    public $numberLinkShow = 4;
    public $paginations = [];
    public $canBeNext = true;
    public $canBePrev = false;
    public $numberOfFirstRow = 1;

    // --------------------------------------------------

    public function mount()
    {
        $this->groups = Group::all();
        $this->groupId = $this->groups[0]['id'];
        $this->yearID = session()->get('current_year')['id'];
    }

    // --------------------------------------------------

    public function render()
    {
        $allData = ScoreModel::profiles($this->groupId, $this->yearID);
        $allData = collect($allData)->groupBy('student_id');

        $this->numberOfData = count($allData);
        $this->numberOfFirstRow = ($this->currentPage - 1) * $this->numberPerPage;
        $this->data = $allData->slice($this->numberOfFirstRow, $this->numberPerPage);

        $this->numberOfPage = ceil($this->numberOfData / $this->numberPerPage);

        $this->paginationProcess();
        $this->onOffPrevNext();
        return view('livewire.score.list');
    }

    // --------------------------------------------------

    private function paginationProcess()
    {
        if (isset($this->numberOfData, $this->numberPerPage) === true) {
            $this->paginations = range(1, ceil($this->numberOfData / $this->numberPerPage));

            if (isset($this->currentPage, $this->numberLinkShow) === true) {
                if (($this->numberLinkShow = floor($this->numberLinkShow / 2) * 2 + 1) >= 1) {
                    $this->paginations = array_slice($this->paginations, max(0, min(count($this->paginations) - $this->numberLinkShow, intval($this->currentPage) - ceil($this->numberLinkShow / 2))), $this->numberLinkShow);
                }
            }
        }
    }

    // --------------------------------------------------

    private function onOffPrevNext()
    {
        if ($this->currentPage == $this->numberOfPage) {
            $this->canBeNext = false;
        } else {
            $this->canBeNext = true;
        }

        if ($this->currentPage == 1) {
            $this->canBePrev = false;
        } else {
            $this->canBePrev = true;
        }
    }

    // --------------------------------------------------

    public function next()
    {
        $this->currentPage = $this->currentPage + 1;
    }

    // --------------------------------------------------

    public function prev()
    {
        $this->currentPage = $this->currentPage - 1;
    }

    // --------------------------------------------------

    public function setPage($number)
    {
        $this->currentPage = $number;
    }

    // --------------------------------------------------

    public function resetInputFields()
    {
        $this->graduationStatus = 1;
        $this->studentId = 0;
        $this->bidScore = 0;
        $this->bigScore = 0;
        $this->matScore = 0;
        $this->tproScore = 0;
        $this->pproScore = 0;
        $this->hasScore = 0;
    }

    // --------------------------------------------------

    public function setGroup($id)
    {
        $this->groupId = Hashids::decode($id)[0];
        $this->closeForm();
    }

    // --------------------------------------------------

    public function openForm()
    {
        $this->isOpen = true;
        $this->isOpenImport = false;
    }

    // --------------------------------------------------

    public function openFormImport()
    {
        $this->isOpen = true;
        $this->currentPage = 1;
        $this->isOpenImport = true;
    }

    // --------------------------------------------------

    public function closeForm()
    {
        $this->isOpen = false;
        $this->isOpenImport = false;
        $this->resetInputFields();
    }

    // --------------------------------------------------

    public function add($studentId)
    {
        $this->resetInputFields();
        $this->studentId = Hashids::decode($studentId)[0];
        $this->hasScore = 0;
        $this->openForm();
    }

    // --------------------------------------------------

    public function downloadTemplate()
    {
        return Excel::download(new ScoreExport, 'nilai.xlsx');
    }

    // --------------------------------------------------

    public function store()
    {
        ScoreModel::where('student_id', $this->studentId)->delete();

        $data = [
            [
                'student_id' => $this->studentId,
                'subject_id' => Subject::subjectWithId()['subjectBidId'],
                'score' => $this->bidScore,
            ],
            [
                'student_id' => $this->studentId,
                'subject_id' => Subject::subjectWithId()['subjectMatId'],
                'score' => $this->matScore,
            ],
            [
                'student_id' => $this->studentId,
                'subject_id' => Subject::subjectWithId()['subjectBigId'],
                'score' => $this->bigScore,
            ],
            [
                'student_id' => $this->studentId,
                'subject_id' => Subject::subjectWithId()['subjectTproId'],
                'score' => $this->tproScore,
            ],
            [
                'student_id' => $this->studentId,
                'subject_id' => Subject::subjectWithId()['subjectPproId'],
                'score' => $this->pproScore,
            ],
        ];


        ScoreModel::insert($data);
        $student = Student::find($this->studentId);
        $student->status = $this->graduationStatus;
        $student->save();

        $this->closeForm();
    }

    // --------------------------------------------------

    public function edit($student_id)
    {
        $this->studentId = Hashids::decode($student_id)[0];
        $data = ScoreModel::with('students')->where('student_id', $this->studentId)->get();
        $this->graduationStatus = $data[0]->students->status;
        $this->bidScore = $data[0]->score;
        $this->matScore = $data[1]->score;
        $this->bigScore = $data[2]->score;
        $this->tproScore = $data[3]->score;
        $this->pproScore = $data[4]->score;
        $this->hasScore = 1;
        $this->openForm();
    }

    // --------------------------------------------------

    public function setGraduationStatus($status = 0)
    {
        $this->graduationStatus = $status;
    }

    // --------------------------------------------------

    public function save()
    {
        $this->validate([
            'importFile' => 'required|mimes:xls,xlsx|max:1024', // 1MB Max
        ]);

        $importProcess = new ScoreImport;
        Excel::import($importProcess, $this->importFile);
        $this->closeForm();
        session()->flash('message', 'Nilai berhasil diimport');
    }
}
