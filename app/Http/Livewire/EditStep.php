<?php

namespace App\Http\Livewire;

use App\Models\Step;
use Livewire\Component;

class EditStep extends Component
{
    public $steps = [];

    // take prev_steps from the edit.blade
    public function mount($prev_steps)
    {

        $prev_steps = $prev_steps->toArray();

        foreach($prev_steps as $prev_step){
            $tmp_step=[];

            $tmp_step['id'] = $prev_step['id'];
            $tmp_step['name'] = $prev_step['name'];

            $this->steps[] = $tmp_step;
            // $tmp_step=[];
        }
        // dd($tmp_step);
    }

    public function add()
    {
        $this->steps[] = ['id' => '' , 'name' => ''];
    }

    public function remove($index)
    {
        // if a step in database delete it from also
        $step_id = $this->steps[$index]['id'];
        if($step_id)
        {
            Step::find($step_id)->delete();
        }
        // remove steps from the array
        unset($this->steps[$index]);
        // suffle the index
        $this->steps = array_values($this->steps);
    }

    public function render()
    {
        info($this->steps);
        return view('livewire.edit-step');
    }
}
