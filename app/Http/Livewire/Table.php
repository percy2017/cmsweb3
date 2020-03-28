<?php

namespace App\Http\Livewire;

use Livewire\Component;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Support\Facades\DB;
use Modules\Streaming\Entities\Account;
class Table extends Component
{
    public $table;

    public function mount($table)
    {
        $this->table = $table;
    }
    public function render()
    {
        $dataType = Voyager::model('DataType')->where('slug', '=', $this->table)->first();
        $dataTypeContent = DB::table($this->table)->paginate(6);
        return view('livewire.table', [
            'dataType' => $dataType,
            'dataTypeContent' => $dataTypeContent
        ]);
    }
}
