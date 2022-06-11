<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Student as StudentModel;
use App\Models\Group;
use App\Models\Profile;
use Vinkla\Hashids\Facades\Hashids;

class Student extends Component
{
    public $data;
    public $studentId, $profileId, $groups, $groupId = 0, $name, $yearId = 0;
    public $isOpen = 0;
    public $keyword = '';

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
        $this->yearID = session()->get('current_year')['id'];
        $group = Group::where('year_id', $this->yearID);
        $this->groups = $group->get();

        if (count($group->get())) {
            $this->groupId = $group->first()->id;
        }
    }

    // --------------------------------------------------

    public function render()
    {
        if($this->keyword == ''){
            $allData = StudentModel::profiles($this->groupId, $this->yearID);
            $this->numberOfData = count($allData);
            $this->numberOfFirstRow = ($this->currentPage - 1) * $this->numberPerPage;
            $this->data = StudentModel::profiles($this->groupId, $this->yearID, [$this->numberOfFirstRow, $this->numberPerPage]);
            $this->numberOfPage = ceil($this->numberOfData/$this->numberPerPage);
        }

        $this->paginationProcess();
        $this->onOffPrevNext();
        return view('livewire.student.list');
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

    public function search()
    {
        $this->data = $allData = StudentModel::search($this->groupId, $this->yearID, $this->keyword);
        $this->numberOfData = count($allData);
        $this->numberOfFirstRow = ($this->currentPage - 1) * $this->numberPerPage;
        $this->numberOfPage = ceil($this->numberOfData/$this->numberPerPage);
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

    public function setId($id)
    {
        $this->studentId = Hashids::decode($id)[0];
    }

    // --------------------------------------------------

    public function setGroup($group_id)
    {
        $this->groupId = Hashids::decode($group_id)[0];
        $this->currentPage = 1;
        $this->keyword = '';
    }

    // --------------------------------------------------

    public function create()
    {
        $this->openForm();
    }

    // --------------------------------------------------

    public function resetInputFields()
    {
        $this->name = '';
        $this->profileId = '';
    }

    // --------------------------------------------------

    public function store()
    {
        $this->validate([
            'name' => 'required',
        ]);

        if (!$this->profileId) {
            $profile = Profile::create([
                'name' => $this->name
            ]);

            StudentModel::create([
                'profile_id' => $profile->id,
                'group_id' => $this->groupId,
            ]);
        } else {
            $profile = Profile::find($this->profileId);
            $profile->update(['name' => $this->name]);
        }

        $this->resetInputFields();
        session()->flash('message', $this->studentId ? 'Siswa berhasil diubah.' : 'Siswa berhasil ditambahkan.');
    }

    // --------------------------------------------------

    public function openForm()
    {
        $this->isOpen = true;
    }

    // --------------------------------------------------

    public function closeForm()
    {
        $this->isOpen = false;
        $this->resetInputFields();
    }

    // --------------------------------------------------

    public function edit($id)
    {
        $id = Hashids::decode($id)[0];
        $this->profileId = StudentModel::findOrFail($id)->profile_id;
        $this->name = Profile::find($this->profileId)->name;

        $this->openForm();
    }

    // --------------------------------------------------

    public function delete()
    {
        StudentModel::find($this->studentId)->delete();
        $this->studentId = 0;
        session()->flash('message', 'Siswa berhasil dihapus');
    }
}
