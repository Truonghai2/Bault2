<?php

namespace App\Http\Livewire;

use App\Models\ListInterest;
use Livewire\Component;

class SearchInteresting extends Component
{
    public $searchInterest = '';

    public function render()
    {

        $interest = ListInterest::where('content', 'LIKE', '%' . $this->searchInterest . '%')->get();
        return view('livewire.search-interesting',['interest' => $interest]);
    }
}
