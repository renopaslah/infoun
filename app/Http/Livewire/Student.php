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

    // --------------------------------------------------

    public function mount()
    {
        $this->yearID = session()->get('current_year')['id'];
        $group = Group::where('year_id', $this->yearID);
        $this->groups = $group->get();
        if(count($group->get())){
            $this->groupId = $group->first()->id;
        }
    }
    
    // --------------------------------------------------
    
    public function render()
    {
        $this->data = StudentModel::profiles($this->groupId, $this->yearID);
        return view('livewire.student.list');
    }

    // --------------------------------------------------

    public function setGroup($group_id)
    {
        $this->groupId = Hashids::decode($group_id)[0];
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
    }

    // --------------------------------------------------

    public function store()
    {
        $this->validate([
            'name' => 'required',
        ]);

        if (!$this->studentId) {
            $profile = Profile::create([
                'name' => $this->name
            ]);

            StudentModel::create([
                'profile_id' => $profile->id,
                'group_id' => $this->groupId,
            ]);
        } else {
            $student = StudentModel::find($this->studentId);
            $student->update(['group_id' => $this->groupId]);
            $student->profile()->update(['name' => $this->name]);
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
        $data = StudentModel::findOrFail($id);
        $this->studentId = $id;
        $this->profileId = $data->profile_id;
        $this->groupId = $data->group_id;

        $this->openForm();
    }

    // --------------------------------------------------

    public function delete($id)
    {
        $id = Hashids::decode($id)[0];
        StudentModel::find($id)->delete();
        session()->flash('message', 'Siswa berhasil dihapus');
    }
}
