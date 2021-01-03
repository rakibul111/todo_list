<?php

namespace App\Http\Livewire;

use Livewire\Component;

class EditStep extends Component
{
    public $steps = [];

    // take prev_steps from the edit.blade
    public function mount($prev_steps)
    {
        $steps = $prev_steps->toArray();

        foreach($steps as $step){
            $this->steps[] = $step['name'];
        }
    }

    public function add()
    {
        $this->steps[] = '';
    }

    public function remove($index)
    {
        unset($this->steps[$index]);
        // suffle the index
        $this->steps = array_values($this->steps);
    }

    public function render()
    {
        // info($this->steps);
        return view('livewire.edit-step');
    }
}
