<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Step extends Component
{
    public $steps = [];

    public function add()
    {
        $this->steps[] = '';
    }

    public function remove($index)
    {
        unset($this->steps[$index]);
        // suffle the index
        $this->steps = array_values($this->steps);
        // $this->steps--;
    }

    public function render()
    {
        // info($this->steps);
        return view('livewire.step');
    }
}