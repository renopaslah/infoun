<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Group as GroupModel;
use App\Models\Year;
use Vinkla\Hashids\Facades\Hashids;

class Group extends Component
{
    public $data, $name, $groupId, $years, $yearId;
    public $isOpen = 0;

    // --------------------------------------------------

    public function mount()
    {
        $this->years = Year::all();
        $this->yearId = session()->get('current_year')['id'];
    }

    // --------------------------------------------------

    public function render()
    {
        $this->data = GroupModel::where('year_id', $this->yearId)->get();
        return view('livewire.group.list');
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
        $this->groupId = '';
    }

    // --------------------------------------------------

    public function store()
    {
        $this->validate([
            'name' => 'required',
        ]);

        GroupModel::updateOrCreate(
            [
                'id' => $this->groupId,
            ],
            [
                'name' => $this->name,
                'year_id' => $this->yearId,
            ]
        );

        session()->flash('message', $this->groupId ? 'Kelas berhasil diubah.' : 'Kelas berhasil ditambahkan.');
        $this->closeForm();
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
        $data = GroupModel::findOrFail($id);
        $this->groupId = $id;
        $this->name = $data->name;

        $this->openForm();
    }

    // --------------------------------------------------

    public function delete($id)
    {
        $id = Hashids::decode($id)[0];
        GroupModel::find($id)->delete();
        session()->flash('message', 'Kelas berhasil dihapus');
    }
}
