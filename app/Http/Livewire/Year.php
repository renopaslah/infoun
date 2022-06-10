<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Year as YearModel;
use Vinkla\Hashids\Facades\Hashids;

class Year extends Component
{
    public $data, $name, $year_id, $validate = [];
    public $isOpen = 0;

    // --------------------------------------------------

    public function render()
    {
        $this->data = YearModel::all();
        return view('livewire.year.list');
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
        $this->year_id = '';
    }

    // --------------------------------------------------

    /**
     * Mengubah year active di table
     * berdampak ke semua pengguna yang akan login setelah ini
     */
    public function change_active($year_id = 0)
    {
        // remove all active
        YearModel::where('is_active', 1)->update(['is_active' => 0]);

        // Change active
        $year_id = Hashids::decode($year_id)[0];
        $year = YearModel::find($year_id);
        $year->is_active = 1;
        $year->save();
    }

    // --------------------------------------------------

    public function store()
    {
        $this->validate([
            'name' => 'required',
        ]);

        YearModel::updateOrCreate(
            [
                'id' => $this->year_id,
            ],
            [
                'name' => $this->name,
            ]
        );

        session()->flash('message', $this->year_id ? 'Tahun Ajaran berhasil diubah.' : 'Tahun Ajaran berhasil ditambahkan.');
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
        $data = YearModel::findOrFail($id);
        $this->year_id = $id;
        $this->name = $data->name;

        $this->openForm();
    }

    // --------------------------------------------------

    public function delete($id)
    {
        YearModel::find($id)->delete();
        session()->flash('message', 'Tahun Ajaran berhasil dihapus');
    }
}
