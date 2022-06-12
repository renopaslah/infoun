<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Subject as SubjectModel;
use Vinkla\Hashids\Facades\Hashids;

class Subject extends Component
{
    public $data, $subjectId, $name;

    // --------------------------------------------------

    public function mount()
    {
    }

    // --------------------------------------------------

    public function render()
    {
        $this->data = SubjectModel::withTrashed()->get();
        return view('livewire.subject.list');
    }

    // --------------------------------------------------

    public function resetForm()
    {
        $this->reset('name');
        $this->reset('subjectId');
    }

    // --------------------------------------------------

    public function resetInputFields()
    {
        $this->name = '';
        $this->subjectId = '';
    }

    // --------------------------------------------------

    public function setId($id)
    {
        $this->subjectId = Hashids::decode($id)[0];
    }

    // --------------------------------------------------

    public function store()
    {
        $this->validate([
            'name' => 'required',
        ]);
        
        if (!$this->subjectId) {
            SubjectModel::create([
                'name' => $this->name,
            ]);
        }else{
            SubjectModel::find($this->subjectId)->update([
                'name' => $this->name,
            ]);
        }

        session()->flash('message', $this->subjectId ? 'Mata Uji berhasil diubah.' : 'Mata Uji berhasil ditambahkan.');
        $this->resetInputFields();
    }

    // --------------------------------------------------

    public function edit($id)
    {
        $this->subjectId = Hashids::decode($id)[0];
        $this->name = SubjectModel::find($this->subjectId)->name;
    }
    
    // --------------------------------------------------

    public function delete()
    {
        SubjectModel::find($this->subjectId)->delete();
        session()->flash('message', 'Mata Uji berhasil dihapus');
        $this->resetInputFields();
    }
    
    // --------------------------------------------------
    
    public function restore($id)
    {
        $this->subjectId = Hashids::decode($id)[0];
        $data = SubjectModel::onlyTrashed()->where('id', $this->subjectId)->restore();
        $this->resetInputFields();
    }
}
